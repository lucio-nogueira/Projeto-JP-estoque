<?php
// Variáveis fornecidas por login.php ou setup.php: $title, $description e $error.
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= h($title) ?> · Josyanne Portela Gerencial</title>
  <style>
    *{box-sizing:border-box}body{margin:0;background:#f5f5f5;color:#111;font:16px/1.5 system-ui,sans-serif}main{min-height:100dvh;display:grid;place-items:center;padding:24px}.auth{width:100%;max-width:440px;background:white;border:1px solid #ddd;border-radius:12px;padding:32px}.brand{font-weight:750;font-size:18px;margin:0 0 36px}h1{font-size:28px;line-height:1.2;margin:0 0 12px}.description{color:#5c5c5c;margin:0 0 24px}.field{display:grid;gap:6px;margin:18px 0}label{font-weight:600;font-size:14px}input,button{width:100%;font:inherit;min-height:48px;border-radius:6px}input{border:1px solid #aaa;padding:10px 12px;min-width:0}button{border:1px solid #111;background:#111;color:#fff;font-weight:650;cursor:pointer;padding:10px 16px}a{color:inherit}.error{color:#a71926;background:#fff1f2;border:1px solid #f2b7be;border-radius:6px;padding:12px}.note{font-size:13px;color:#5c5c5c;margin-top:24px}:focus-visible{outline:2px solid #111;outline-offset:3px}@media(max-width:420px){.auth{padding:24px}main{padding:16px}}
  </style>
</head>
<body><main><section class="auth" aria-labelledby="authTitle">
  <p class="brand">Josyanne Portela Gerencial</p>
  <h1 id="authTitle"><?= h($title) ?></h1>
  <p class="description"><?= h($description) ?></p>
  <?php if ($error): ?><p class="error" role="alert"><?= h($error) ?></p><?php endif ?>
  <form method="post">
    <input type="hidden" name="csrf" value="<?= h(csrf_token()) ?>">
    <?php if ($isSetup ?? false): ?>
    <div class="field"><label for="setupToken">Chave de configuração</label><input id="setupToken" name="setup_token" type="password" autocomplete="off" required></div>
    <?php endif ?>
    <div class="field"><label for="email">E-mail</label><input id="email" name="email" type="email" autocomplete="username" maxlength="254" value="<?= h($email ?? '') ?>" required></div>
    <div class="field"><label for="password">Senha</label><input id="password" name="password" type="password" autocomplete="<?= ($isSetup ?? false) ? 'new-password' : 'current-password' ?>" <?= ($isSetup ?? false) ? 'minlength="12"' : '' ?> maxlength="72" required></div>
    <?php if ($isSetup ?? false): ?>
    <div class="field"><label for="confirm">Confirmar senha</label><input id="confirm" name="confirm" type="password" autocomplete="new-password" minlength="12" maxlength="72" required></div>
    <?php endif ?>
    <button type="submit"><?= ($isSetup ?? false) ? 'Criar primeira conta' : 'Entrar' ?></button>
  </form>
  <p class="note"><?= ($isSetup ?? false) ? 'Configuração restrita ao responsável pela hospedagem. Depois da primeira conta, esta página será desativada.' : 'Acesso restrito. Se precisar redefinir sua senha, fale com o responsável pela hospedagem.' ?></p>
</section></main></body></html>
