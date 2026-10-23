"""Integração em banco descartável. Requer PHP e Playwright Python.

Inicie a aplicação com JP_CONFIG_FILE apontando para um banco cujo nome termine
em _test. Defina JP_TEST_CONFIG_FILE para o mesmo arquivo, JP_TEST_RESET=yes,
JP_TEST_BASE_URL (padrão http://127.0.0.1:8000) e, se necessário,
JP_PHP_BINARY e JP_CHROMIUM. Executar: python3 tests/auth_smoke.py.
APAGA as contas e registros SOMENTE desse banco de teste.
"""
import json
import os
from pathlib import Path
import re
import secrets
import subprocess

from playwright.sync_api import sync_playwright

ROOT = Path(__file__).resolve().parents[1]
PHP = os.environ.get("JP_PHP_BINARY", "php")
CONFIG = os.environ.get("JP_TEST_CONFIG_FILE", "")
BASE = os.environ.get("JP_TEST_BASE_URL", "http://127.0.0.1:8000")
if os.environ.get("JP_TEST_RESET") != "yes" or not CONFIG:
    raise SystemExit("Use um banco descartável e defina JP_TEST_CONFIG_FILE e JP_TEST_RESET=yes.")


def php(code, data=""):
    env = dict(os.environ, JP_CONFIG_FILE=CONFIG)
    return subprocess.run([PHP, "-r", code], input=data, text=True, capture_output=True,
                          env=env, cwd=ROOT, check=True).stdout


setup_token = php(r'''
$c=require getenv('JP_CONFIG_FILE');
if(!preg_match('/dbname=([^;]+)/',$c['dsn'],$m) || !str_ends_with($m[1],'_test')) exit(3);
$d=new PDO($c['dsn'],$c['db_user'],$c['db_password']);
$d->exec(file_get_contents('schema.sql'));
$d->exec('DELETE FROM jp_records');$d->exec('DELETE FROM jp_users');$d->exec('DELETE FROM jp_login_limits');
echo $c['setup_token'];
''')
password_a = secrets.token_urlsafe(24)
password_b = secrets.token_urlsafe(24)


def csrf(response):
    return re.search(r'name="csrf" value="([a-f0-9]+)"', response.text()).group(1)


def login(client, email, password):
    token = csrf(client.get("/login.php"))
    response = client.post("/login.php", form={"csrf": token, "email": email, "password": password}, max_redirects=0)
    assert response.status == 303, "Falha no login de teste"
    return csrf(client.get("/index.php"))


with sync_playwright() as p:
    anonymous = p.request.new_context(base_url=BASE)
    assert anonymous.get("/index.php", max_redirects=0).status == 303
    assert anonymous.get("/api.php").status == 401
    assert anonymous.get("/tools/manage-user.php").status == 404
    setup = anonymous.get("/setup.php")
    assert setup.status == 200
    setup_csrf = csrf(setup)
    payload = {"csrf": setup_csrf, "setup_token": setup_token, "email": "owner@example.test",
               "password": password_a, "confirm": password_a}
    assert anonymous.post("/setup.php", form=dict(payload, csrf="invalid")).status == 403
    assert anonymous.post("/setup.php", form=dict(payload, setup_token="invalid")).status == 403
    assert anonymous.post("/setup.php", form=dict(payload, password="short", confirm="short")).status == 422
    assert anonymous.post("/setup.php", form=payload, max_redirects=0).status == 303
    assert anonymous.get("/setup.php").status == 404
    login_csrf = csrf(anonymous.get("/login.php"))
    assert anonymous.post("/login.php", form={"csrf": "bad", "email": "owner@example.test", "password": password_a}).status == 403
    assert anonymous.post("/login.php", form={"csrf": login_csrf, "email": "owner@example.test", "password": "wrong"}).status == 401
    token_a = login(anonymous, "owner@example.test", password_a)
    cookies = anonymous.storage_state()["cookies"]
    assert cookies[0]["httpOnly"] and cookies[0]["sameSite"] == "Lax"
    assert anonymous.get("/api.php").json() == {"produtos": [], "movimentos": []}
    product = {"id": "shoe", "nome": "Salto preto", "codigo": "P001", "unidade": "par", "tamanhos": ["36", "37"], "minimo": 2}
    assert anonymous.put("/api.php?collection=produtos", data=product).status == 403
    headers_a = {"X-CSRF-Token": token_a}
    assert anonymous.put("/api.php?collection=produtos", data=product, headers=headers_a).status == 200
    movement = {"id": "initial", "produtoId": "shoe", "tipo": "entrada", "qtd": 10, "tamanho": "36", "data": "2026-10-23"}
    assert anonymous.put("/api.php?collection=movimentos", data=movement, headers=headers_a).status == 200
    batch_product = dict(product, id="batch")
    batch_movement = dict(movement, id="batch-entry", produtoId="batch")
    batch = {"records": [{"collection": "produtos", "record": batch_product},
                         {"collection": "movimentos", "record": dict(batch_movement, produtoId="missing")}]}
    assert anonymous.post("/api.php?action=batch", data=batch, headers=headers_a).status == 422
    assert len(anonymous.get("/api.php").json()["produtos"]) == 1
    batch["records"][1]["record"] = batch_movement
    assert anonymous.post("/api.php?action=batch", data=batch, headers=headers_a).status == 200
    assert len(anonymous.get("/api.php").json()["movimentos"]) == 2
    assert anonymous.delete("/api.php?collection=produtos&id=batch", headers=headers_a).status == 200
    assert len(anonymous.get("/api.php").json()["movimentos"]) == 1
    assert anonymous.put("/api.php?collection=invalid", data=product, headers=headers_a).status == 422
    assert anonymous.get("/logout.php", max_redirects=0).status == 403

    # Conta adicional criada pelo comando administrativo; senha somente pela entrada padrão.
    env = dict(os.environ, JP_CONFIG_FILE=CONFIG)
    subprocess.run([PHP, "tools/manage-user.php", "other@example.test"], input=password_b + "\n",
                   text=True, capture_output=True, env=env, cwd=ROOT, check=True)
    other = p.request.new_context(base_url=BASE)
    token_b = login(other, "other@example.test", password_b)
    headers_b = {"X-CSRF-Token": token_b}
    assert other.get("/api.php").json() == {"produtos": [], "movimentos": []}
    assert other.put("/api.php?collection=movimentos", data=movement, headers=headers_b).status == 422
    assert other.put("/api.php?collection=produtos", data=dict(product, nome="Produto de outra conta"), headers=headers_b).status == 200
    assert anonymous.get("/api.php").json()["produtos"][0]["nome"] == "Salto preto"
    assert other.delete("/api.php?collection=produtos&id=shoe", headers=headers_b).status == 200
    assert len(anonymous.get("/api.php").json()["produtos"]) == 1
    # Importação inválida deve desfazer os produtos inseridos antes do erro.
    backup = {"produtos": [product], "movimentos": [dict(movement, produtoId="missing")]}
    assert other.post("/api.php?action=import", data=backup, headers=headers_b).status == 422
    assert other.get("/api.php").json() == {"produtos": [], "movimentos": []}
    assert other.post("/api.php?action=import", data={"produtos": [product], "movimentos": [movement]}, headers=headers_b).status == 200
    assert other.post("/api.php?action=import", data={"produtos": [product], "movimentos": []}, headers=headers_b).status == 409
    assert other.delete("/api.php?collection=produtos&id=shoe", headers=headers_b).status == 200
    assert other.post("/logout.php", form={"csrf": token_b}, max_redirects=0).status == 303
    assert other.get("/api.php").status == 401

    # Exercita a interface real após autenticar, incluindo persistência no MySQL.
    browser = p.chromium.launch(executable_path=os.environ.get("JP_CHROMIUM", "/usr/bin/chromium"),
                                headless=True, args=["--no-sandbox"])
    context = browser.new_context(viewport={"width": 390, "height": 844})
    page = context.new_page()
    errors = []
    page.on("pageerror", lambda error: errors.append(str(error)))
    page.route("https://fonts.googleapis.com/**", lambda route: route.abort())
    page.goto(BASE + "/index.php")
    assert page.url.endswith("/login.php")
    page.locator("#email").fill("owner@example.test")
    page.locator("#password").fill(password_a)
    page.locator("button[type=submit]").click()
    page.wait_for_url("**/index.php")
    page.locator('.nav [data-go="estoque"]').click()
    page.locator('[data-act="out"]').click()
    page.locator("#outSize").select_option("36")
    page.locator("#outQtd").fill("3")
    page.locator('#formOut [type="submit"]').click()
    page.wait_for_function("document.querySelector('#outQtd').value === ''")
    page.reload()
    page.locator('.nav [data-go="estoque"]').click()
    page.locator('[data-detail]').click()
    assert "7 par" in page.locator(".size-card").first.inner_text()
    page.locator('#btnNovo').click()
    page.locator('#pNome').fill('Produto criado pela interface')
    page.locator('#addSize').click()
    page.locator('.size-row input').nth(0).fill('37')
    page.locator('.size-row input').nth(1).fill('2')
    page.locator('#formProd [type="submit"]').click()
    page.wait_for_selector('#ovProd', state='hidden')
    page.locator('#listEstoque > tr').filter(has_text='Produto criado pela interface').first.locator('[data-act="edit"]').click()
    page.locator('#pmDel').click()
    page.locator('#cfYes').click()
    page.wait_for_selector('#ovProd', state='hidden')
    page.locator('#stockFilters summary').click()
    page.locator('[name="stockSize"][value="36"]').check()
    assert "7 par" in page.locator(".size-card").first.inner_text()
    page.locator('.nav [data-go="historico"]').click()
    assert page.locator('#listHist > li.mrow').count() == 2
    page.locator('.account-bar [type="submit"]').click()
    page.wait_for_url("**/login.php")
    assert context.request.get(BASE + "/api.php").status == 401
    assert not errors, errors
    page.screenshot(path="/tmp/jp-login-mobile.png", full_page=True)
    # Migração explícita mantém o backup local e grava os registros na conta correta.
    page.locator('#email').fill('other@example.test')
    page.locator('#password').fill(password_b)
    page.locator('button[type=submit]').click()
    page.wait_for_url('**/index.php')
    page.evaluate('(data)=>localStorage.setItem("jp-gerencial-v1",JSON.stringify(data))',
                  {'produtos': [product], 'movimentos': [movement]})
    page.reload()
    page.locator('#importLocal').click()
    page.locator('#cfYes').click()
    page.wait_for_selector('#legacyImport', state='hidden')
    page.locator('.nav [data-go="estoque"]').click()
    assert page.locator('[data-detail]').inner_text() == 'Salto preto'
    assert page.evaluate('JSON.parse(localStorage.getItem("jp-gerencial-v1")).produtos.length') == 1
    assert len(context.request.get(BASE + '/api.php').json()['movimentos']) == 1
    assert not errors, errors
    browser.close()

    # Limite de tentativas com conta inexistente: nenhuma senha é registrada.
    attacker = p.request.new_context(base_url=BASE)
    attack_csrf = csrf(attacker.get("/login.php"))
    for attempt in range(9):
        response = attacker.post("/login.php", form={"csrf": attack_csrf, "email": "missing@example.test", "password": "incorrect"})
        assert response.status == (401 if attempt < 8 else 429)
    # Troca administrativa de senha invalida sessões anteriores.
    subprocess.run([PHP, "tools/manage-user.php", "owner@example.test"], input=secrets.token_urlsafe(24) + "\n",
                   text=True, capture_output=True, env=env, cwd=ROOT, check=True)
    assert anonymous.get("/api.php").status == 401
    print("PASS: primeira conta, login, CSRF, limite de tentativas, saída, revogação de sessão, isolamento de duas contas, importação transacional, estoque, histórico e interface móvel sem erros JavaScript.")
