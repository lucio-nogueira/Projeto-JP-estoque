<?php
declare(strict_types=1);
require __DIR__ . '/app/bootstrap.php';
require_user();
?>
<!doctype html><html><head><meta charset=utf8><meta name=viewport content="width=device-width,initial-scale=1,viewport-fit=cover"><style>:root{color-scheme:light;box-sizing:border-box;padding-top:env(safe-area-inset-top,0px);padding-bottom:env(safe-area-inset-bottom,0px)}html{scroll-padding-top:env(safe-area-inset-top,0px)}body{margin:0;padding:0;font:14px -apple-system,BlinkMacSystemFont,sans-serif;background:#fff;color:#000}img{max-width:100%}[hidden]:not([hidden=until-found i]){display:none!important}.sheet-wrap{overflow-x:auto;margin-top:16px;border:1px solid var(--line)}.sheet{width:100%;border-collapse:collapse;min-width:850px}.sheet th,.sheet td{padding:12px 14px;border:1px solid var(--line);text-align:left}.sheet th{background:var(--sunken);font-size:12px;text-transform:uppercase}.sheet tbody tr:nth-child(4n+3){background:var(--sunken)}.sheet .lnk{padding:0;text-align:left}.sheet td:nth-child(3),.sheet td:nth-child(4),.sheet td:nth-child(5){font-variant-numeric:tabular-nums}.size-grid{display:flex;gap:12px;flex-wrap:wrap;margin:12px 0}.size-card{border:1px solid var(--line);padding:12px;min-width:100px}.size-card strong{display:block}.size-row{display:grid;grid-template-columns:1fr 1fr auto;gap:8px;margin:8px 0}.sr-only{position:absolute;width:1px;height:1px;overflow:hidden;clip-path:inset(50%)}
</style></head><body>
<title>Josyanne Portela Gerencial</title>
<meta name="claude:viewport-fit-sides" content="cover">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@700&family=Poppins:wght@400;500;600;700&family=Questrial&display=swap">
<style>
/* Layout: cabeçalho fixo com a navegação; no celular a navegação vira barra inferior.
   Conteúdo em coluna única de até 1080px, sem cartões: linhas finas separam as listas. */
:root{
  --bg:#ffffff; --surface:#ffffff; --sunken:#f5f5f5;
  --line:#e5e5e5; --line-strong:#cfcfcf;
  --ink:#0a0a0a; --muted:#5c5c5c;
  --ok:#17794a; --warn:#9a5b00; --bad:#bf2530;
  --scrim:rgba(0,0,0,.5);
  --font-brand:"League Spartan","Helvetica Neue",Arial,sans-serif;
  --font-display:"Poppins","Helvetica Neue",Arial,sans-serif;
  --font-body:"Questrial","Poppins","Helvetica Neue",Arial,sans-serif;
  --font-mono:"Poppins","Helvetica Neue",Arial,sans-serif;
  --radius:6px;
}
@media (prefers-color-scheme: dark){
  :root:not([data-theme="light"]){
    --bg:#0a0a0a; --surface:#121212; --sunken:#171717;
    --line:#262626; --line-strong:#3b3b3b;
    --ink:#f5f5f5; --muted:#a3a3a3;
    --ok:#4cc38a; --warn:#e5a23c; --bad:#ff6b6b;
    color-scheme:dark;
  }
}
:root[data-theme="dark"]{
  --bg:#0a0a0a; --surface:#121212; --sunken:#171717;
  --line:#262626; --line-strong:#3b3b3b;
  --ink:#f5f5f5; --muted:#a3a3a3;
  --ok:#4cc38a; --warn:#e5a23c; --bad:#ff6b6b;
  color-scheme:dark;
}

*{box-sizing:border-box}
body{background:var(--bg);color:var(--ink);font-family:var(--font-body);font-size:15px;line-height:1.5;-webkit-font-smoothing:antialiased}
body::before{content:"";position:fixed;inset:0 0 auto;height:env(safe-area-inset-top,0px);background:var(--bg);z-index:10}
button,input,select,textarea{font-family:inherit}
button,label,strong,.st,.sec-h,.stat span,.phead,.calc span,.err,.toast{font-family:var(--font-display)}
h1,h2,p{margin:0}
:focus-visible{outline:2px solid var(--ink);outline-offset:2px}

.wrap{max-width:1080px;margin-inline:auto;padding-left:max(16px,env(safe-area-inset-left,0px));padding-right:max(16px,env(safe-area-inset-right,0px))}

/* Cabeçalho e navegação */
.top{position:sticky;top:env(safe-area-inset-top,0px);z-index:20;background:var(--bg);border-bottom:1px solid var(--line)}
.top .wrap{display:flex;align-items:center;justify-content:space-between;gap:24px;height:60px}
.brand{min-width:0;font-family:var(--font-brand);font-size:clamp(17px,4.8vw,23px);font-weight:700;line-height:1.05;letter-spacing:.01em}
.nav{display:flex;gap:2px}
.nav button{display:flex;align-items:center;gap:8px;min-height:60px;padding:0 14px;background:none;border:0;border-bottom:2px solid transparent;margin-bottom:-1px;color:var(--muted);font-size:14px;font-weight:500;cursor:pointer}
.nav button:hover{color:var(--ink)}
.nav button[aria-current="page"]{color:var(--ink);border-bottom-color:var(--ink);font-weight:700}
.nav .ic{display:none}
.ic{width:22px;height:22px;fill:none;stroke:currentColor;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round;flex:none}

main.wrap{padding-block:36px 56px}
.view[hidden]{display:none}

.vh{display:flex;align-items:flex-end;justify-content:space-between;gap:16px;flex-wrap:wrap;margin-bottom:28px}
h1{font-family:var(--font-display);font-weight:600;font-size:clamp(26px,6vw,36px);line-height:1.1;letter-spacing:-.01em;text-wrap:balance}
.sub{margin-top:8px;color:var(--muted);font-size:14px}
.btns{display:flex;gap:10px;flex-wrap:wrap}
.sec-h{margin-bottom:4px;padding-bottom:12px;font-size:12px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--muted)}

/* Botões */
.btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;min-height:44px;padding:0 20px;border:1px solid var(--ink);border-radius:var(--radius);background:var(--ink);color:var(--bg);font-size:14px;font-weight:600;cursor:pointer;transition:opacity .15s}
.btn:hover{opacity:.86}
.btn.ghost{background:transparent;color:var(--ink);border-color:var(--line-strong)}
.btn.ghost:hover{border-color:var(--ink);opacity:1}
.btn.danger{color:var(--bad);border-color:var(--line-strong)}
.btn.block{width:100%}
.lnk{min-height:40px;padding:0 8px;background:none;border:0;color:var(--ink);font-size:13px;font-weight:600;text-decoration:underline;text-underline-offset:3px;cursor:pointer}
.lnk:hover{opacity:.7}
.icon{display:inline-flex;align-items:center;justify-content:center;width:40px;height:40px;background:none;border:0;border-radius:var(--radius);color:var(--muted);cursor:pointer}
.icon:hover{color:var(--bad);background:var(--sunken)}

/* Painel */
.notice{display:flex;align-items:center;justify-content:space-between;gap:8px 16px;flex-wrap:wrap;margin-bottom:20px;padding:12px 16px;background:var(--sunken);border:1px solid var(--line);border-radius:var(--radius);font-size:14px}
.stats{display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:1px;margin-bottom:40px;background:var(--line);border:1px solid var(--line)}
.stat{min-width:0;padding:18px 16px;background:var(--bg)}
.stat span{display:block;font-size:12px;font-weight:600;letter-spacing:.06em;text-transform:uppercase;color:var(--muted)}
.stat strong{display:block;margin-top:8px;font-family:var(--font-display);font-weight:600;font-size:clamp(18px,4.2vw,26px);line-height:1.1;white-space:nowrap;font-variant-numeric:tabular-nums}
.cols{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:40px}
.cols>div{min-width:0}

.list{list-style:none;margin:0;padding:0;border-top:1px solid var(--line)}
.list>li{border-bottom:1px solid var(--line)}
.list>li.empty{padding:28px 0;color:var(--muted);font-size:14px}
.empty .btn{margin-top:14px}

.arow{display:flex;flex-wrap:wrap;align-items:center;gap:6px 12px;padding:12px 0}
.amain{flex:1 1 180px;min-width:0}
.amain strong,.mmain strong,.pname strong{display:block;font-weight:600;overflow-wrap:anywhere}
.mmeta,.code{display:block;font-size:13px;color:var(--muted);overflow-wrap:anywhere}
.code{font-family:var(--font-mono);font-size:12px}

.st{display:inline-flex;align-items:center;gap:7px;font-size:13px;font-weight:600;white-space:nowrap}
.st::before{content:"";width:8px;height:8px;border-radius:50%;background:currentColor}
.st.ok{color:var(--ok)} .st.warn{color:var(--warn)} .st.bad{color:var(--bad)}

/* Movimentações */
.mrow{display:grid;grid-template-columns:auto minmax(0,1fr) auto;gap:4px 14px;align-items:center;padding:12px 0}
.mrow.hasdel{grid-template-columns:auto minmax(0,1fr) auto auto;gap:4px 10px 14px}
.tag{display:inline-block;min-width:68px;padding:3px 8px;border:1px solid var(--line-strong);border-radius:4px;font-family:var(--font-mono);font-size:11px;letter-spacing:.06em;text-align:center;text-transform:uppercase}
.tag.out{background:var(--ink);border-color:var(--ink);color:var(--bg)}
.mqty{font-family:var(--font-mono);font-size:14px;font-weight:500;text-align:right;white-space:nowrap;font-variant-numeric:tabular-nums}
.mqty.pos{color:var(--ok)} .mqty.neg{color:var(--bad)}

/* Estoque */
.tools{display:flex;gap:12px;flex-wrap:wrap;margin-bottom:20px}
.tools input{flex:1 1 240px}
.stock-filters{position:relative;align-self:flex-start}
.stock-filters summary{display:flex;align-items:center;justify-content:center;gap:8px;min-height:44px;padding:10px 20px;border:1px solid var(--line-strong);border-radius:var(--radius);font-family:var(--font-display);font-weight:600;cursor:pointer;list-style:none;background:var(--surface)}
.stock-filters summary::-webkit-details-marker{display:none}
.stock-filters summary::after{content:'';width:6px;height:6px;border-right:2px solid currentColor;border-bottom:2px solid currentColor;transform:rotate(45deg);transition:transform .15s}
.stock-filters[open] summary::after{transform:rotate(225deg)}
.stock-filters[open] summary{border-color:var(--ink)}
#stockFilterCount,#historyFilterCount{border-radius:12px;background:var(--ink);color:var(--bg);padding:0 7px;font-size:12px}
.filter-panel{position:absolute;right:0;top:calc(100% + 8px);z-index:15;width:min(320px,calc(100vw - 32px));max-height:55vh;overflow-y:auto;padding:16px;background:var(--surface);border:1px solid var(--line-strong);border-radius:var(--radius);box-shadow:0 8px 24px rgba(0,0,0,.12)}
.filter-panel fieldset{border:0;padding:0;margin:0 0 16px;min-width:0}
.filter-panel legend{font-family:var(--font-display);font-weight:600;margin-bottom:6px}
.filter-panel label{display:flex;align-items:center;gap:10px;min-height:44px;cursor:pointer;font-weight:400}
.tools .filter-panel input[type="checkbox"]{flex:none;width:18px;height:18px;min-height:0;margin:0;padding:0;accent-color:var(--ink)}
#stockSizeOptions,#historySizeOptions{display:grid;grid-template-columns:repeat(2,minmax(0,1fr))}
.seg{display:inline-flex;border:1px solid var(--line-strong);border-radius:var(--radius);overflow:hidden}
.seg button{min-height:44px;padding:0 16px;background:none;border:0;border-right:1px solid var(--line-strong);color:var(--muted);font-size:14px;font-weight:500;cursor:pointer}
.seg button:last-child{border-right:0}
.seg button[aria-pressed="true"]{background:var(--ink);color:var(--bg);font-weight:600}

.pgrid{display:grid;grid-template-columns:minmax(0,2.2fr) minmax(0,1fr) 84px 84px 104px 124px auto;gap:12px;align-items:center;padding:14px 0}
.phead{padding:10px 0;border-top:1px solid var(--line);border-bottom:1px solid var(--line);font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--muted)}
.phead + .list{border-top:0}
.num{text-align:right;font-family:var(--font-mono);font-size:13px;font-variant-numeric:tabular-nums}
.psaldo b{font-size:15px;font-weight:500}
.pcat{font-size:14px;color:var(--muted);overflow-wrap:anywhere}
.pact{display:flex;justify-content:flex-end;flex-wrap:wrap}
.cell::before{display:none}

/* Formulários */
.split{display:grid;grid-template-columns:minmax(0,440px) minmax(0,1fr);gap:56px;align-items:start}
.form{display:flex;flex-direction:column;gap:18px;min-width:0}
.field{display:flex;flex-direction:column;gap:6px;min-width:0}
label{font-size:13px;font-weight:600}
input,select{width:100%;min-width:0;min-height:44px;padding:10px 12px;background:var(--surface);color:var(--ink);border:1px solid var(--line-strong);border-radius:var(--radius);font-size:16px}
input:focus-visible,select:focus-visible{outline:2px solid var(--ink);outline-offset:1px;border-color:var(--ink)}
input::placeholder{color:var(--muted);opacity:.7}
.row2{display:grid;grid-template-columns:1fr 1fr;gap:16px}
.hint{font-size:12.5px;color:var(--muted)}
.err{min-height:1.4em;color:var(--bad);font-size:13.5px;font-weight:500}
.calc{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:1px;background:var(--line);border:1px solid var(--line)}
.calc div{min-width:0;padding:12px;background:var(--sunken)}
.calc span{display:block;font-size:11px;font-weight:600;letter-spacing:.06em;text-transform:uppercase;color:var(--muted)}
.calc b{display:block;margin-top:4px;font-family:var(--font-mono);font-size:14px;font-weight:500;overflow-wrap:anywhere;font-variant-numeric:tabular-nums}
.calc.neg [data-c="d"]{color:var(--bad)}
.form .lnk{align-self:flex-start;padding-left:0}

/* Janelas */
.overlay{position:fixed;inset:0;z-index:50;display:flex;align-items:center;justify-content:center;background:var(--scrim);padding-top:max(16px,env(safe-area-inset-top,0px));padding-bottom:max(16px,env(safe-area-inset-bottom,0px));padding-left:max(16px,env(safe-area-inset-left,0px));padding-right:max(16px,env(safe-area-inset-right,0px))}
.panel{width:100%;max-width:480px;max-height:100%;overflow:auto;padding:24px;background:var(--surface);color:var(--ink);border:1px solid var(--line-strong);border-radius:10px}
.panel h2{margin-bottom:20px;font-family:var(--font-display);font-weight:600;font-size:22px}
.panel p{margin-bottom:20px;color:var(--muted)}
.actions{display:flex;align-items:center;gap:10px;flex-wrap:wrap;margin-top:6px}
.grow{flex:1}
.toast{position:fixed;left:50%;bottom:24px;z-index:60;transform:translateX(-50%);max-width:calc(100% - 32px);padding:12px 18px;background:var(--ink);color:var(--bg);border-radius:var(--radius);font-size:14px;font-weight:500;text-align:center}

.foot{margin-top:56px;padding-top:16px;border-top:1px solid var(--line);font-size:12.5px;color:var(--muted)}

.account-bar{display:flex;align-items:center;justify-content:flex-end;gap:12px;margin-bottom:20px;color:var(--muted);font-size:13px;overflow-wrap:anywhere}.account-bar form{flex:none}
/* Tablet e celular */
@media (max-width:859px){
  .cols{grid-template-columns:minmax(0,1fr);gap:36px}
  .split{grid-template-columns:minmax(0,1fr);gap:40px}
}
@media (max-width:719px){
  .stock-filters{margin-left:auto}
  .filter-panel{position:fixed;left:16px;right:16px;top:auto;bottom:calc(76px + env(safe-area-inset-bottom,0px));width:auto;max-height:calc(100dvh - 160px)}
  #v-estoque .sheet{min-width:0;table-layout:fixed}
  #v-estoque .sheet th,#v-estoque .sheet td{padding:10px 8px;overflow-wrap:anywhere}
  #v-estoque .sheet th:nth-child(2),
  #v-estoque .sheet th:nth-child(3),
  #v-estoque .sheet th:nth-child(4),
  #v-estoque .sheet th:nth-child(6),
  #listEstoque > tr > td:not([colspan]):nth-child(2),
  #listEstoque > tr > td:not([colspan]):nth-child(3),
  #listEstoque > tr > td:not([colspan]):nth-child(4),
  #listEstoque > tr > td:not([colspan]):nth-child(6){display:none}
  #v-estoque .sheet th:first-child{width:44%}
  #v-estoque .sheet th:nth-child(5){width:22%}
  #v-estoque .sheet th:last-child{width:34%}
  #v-estoque .sheet th{font-size:11px}
  #listEstoque > tr > td:not([colspan]):last-child{font-size:0}
  #listEstoque > tr > td:not([colspan]):last-child .lnk{display:block;min-height:36px;font-size:12px}
  #v-estoque .stock-heading-code{display:none}
  .nav{position:fixed;left:0;right:0;bottom:0;z-index:20;display:grid;grid-template-columns:repeat(5,minmax(0,1fr));gap:0;background:var(--bg);border-top:1px solid var(--line);padding-top:4px;padding-bottom:env(safe-area-inset-bottom,0px);padding-left:max(16px,env(safe-area-inset-left,0px));padding-right:max(16px,env(safe-area-inset-right,0px))}
  .nav button{flex-direction:column;justify-content:center;gap:3px;min-height:56px;padding:6px 0;border-bottom:0;margin-bottom:0;font-size:11px}
  .nav button[aria-current="page"]{border-bottom:0}
  .nav button[aria-current="page"] .ic{stroke-width:2.4}
  .nav .ic{display:block}
  main.wrap{padding-block:24px calc(104px + env(safe-area-inset-bottom,0px))}
  .toast{bottom:calc(84px + env(safe-area-inset-bottom,0px))}
  .phead{display:none}
  .pgrid{grid-template-columns:repeat(3,minmax(0,1fr));grid-template-areas:"name name saldo" "cat in out" "status act act";gap:12px;padding:16px 0}
  .pname{grid-area:name} .psaldo{grid-area:saldo} .pcat{grid-area:cat} .pin{grid-area:in} .pout{grid-area:out} .pstatus{grid-area:status} .pact{grid-area:act}
  .cell::before{content:attr(data-l);display:block;margin-bottom:2px;font-family:var(--font-body);font-size:11px;font-weight:600;letter-spacing:.06em;text-transform:uppercase;color:var(--muted)}
  .num{text-align:left;font-size:14px}
  .psaldo{text-align:right}
  .stat{padding:16px 14px}
  .vh .btns{width:100%}
  .vh .btns .btn{flex:1}
}
@media (max-width:379px){
  .row2{grid-template-columns:1fr}
}
@media (prefers-reduced-motion: reduce){
  *{transition:none!important;animation:none!important}
}
</style>

<svg width="0" height="0" style="position:absolute" aria-hidden="true" focusable="false">
  <symbol id="i-painel" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></symbol>
  <symbol id="i-estoque" viewBox="0 0 24 24"><path d="M3 7.5 12 3l9 4.5v9L12 21l-9-4.5z"/><path d="M3 7.5 12 12l9-4.5M12 12v9"/></symbol>
  <symbol id="i-entrada" viewBox="0 0 24 24"><path d="M12 3v11M7 9l5 5 5-5"/><path d="M4 20h16"/></symbol>
  <symbol id="i-saida" viewBox="0 0 24 24"><path d="M12 14V3M7 8l5-5 5 5"/><path d="M4 20h16"/></symbol>
  <symbol id="i-historico" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></symbol>
  <symbol id="i-trash" viewBox="0 0 24 24"><path d="M4 7h16M10 11v6M14 11v6M6 7l1 13h10l1-13M9 7V4h6v3"/></symbol>
</svg>

<header class="top">
  <div class="wrap">
    <div class="brand">Josyanne Portela Gerencial</div>
    <nav class="nav" aria-label="Navegação principal">
      <button type="button" data-go="painel"><svg class="ic"><use href="#i-painel"/></svg>Painel</button>
      <button type="button" data-go="estoque"><svg class="ic"><use href="#i-estoque"/></svg>Estoque</button>
      <button type="button" data-go="entrada"><svg class="ic"><use href="#i-entrada"/></svg>Entrada</button>
      <button type="button" data-go="saida"><svg class="ic"><use href="#i-saida"/></svg>Saída</button>
      <button type="button" data-go="historico"><svg class="ic"><use href="#i-historico"/></svg>Histórico</button>
    </nav>
  </div>
</header>

<main class="wrap">
  <div class="account-bar"><span><?= h((string)$_SESSION['email']) ?></span><form method="post" action="logout.php"><input type="hidden" name="csrf" value="<?= h(csrf_token()) ?>"><button type="submit" class="lnk">Sair</button></form></div>
  <div class="notice" id="serverError" role="alert" hidden><span>Não foi possível carregar seus dados.</span><button type="button" class="lnk" id="retryLoad">Tentar novamente</button></div>
  <div class="notice" id="legacyImport" hidden><span>Encontramos dados antigos neste navegador. Deseja importá-los para esta conta? A cópia local será preservada.</span><button type="button" class="lnk" id="importLocal">Importar dados deste navegador</button></div>
  <div class="notice" id="fileImport"><span>Já usava o sistema em outro endereço? Você pode importar um backup JSON para uma conta vazia.</span><label class="lnk" for="backupFile">Selecionar backup</label><input type="file" id="backupFile" accept=".json,application/json" hidden></div>

  <section class="view" id="v-painel">
    <div class="vh">
      <div><h1>Painel</h1><p class="sub" id="hoje"></p></div>
      <div class="btns">
        <button type="button" class="btn" data-go="entrada">Registrar entrada</button>
        <button type="button" class="btn ghost" data-go="saida">Registrar saída</button>
      </div>
    </div>
    <div class="notice" id="exBanner" hidden>
      <span>Os dados abaixo são exemplos para você testar o sistema.</span>
      <button type="button" class="lnk" id="btnRmEx">Remover exemplos</button>
    </div>
    <div class="stats" id="stats"></div>
    <div>
      <h2 class="sec-h">Pedem reposição</h2>
      <ul class="list" id="listAtencao"></ul>
    </div>
  </section>

  <section class="view" id="v-estoque" hidden>
    <div class="vh">
      <div><h1>Estoque</h1><p class="sub">O saldo de cada produto é calculado sozinho: entradas menos saídas.</p></div>
      <button type="button" class="btn" id="btnNovo">Novo produto</button>
    </div>
    <div class="tools">
      <input id="qEstoque" type="search" placeholder="Buscar por nome, código ou categoria" aria-label="Buscar produto" autocomplete="off">
      <details class="stock-filters" id="stockFilters">
        <summary>Filtrar <span id="stockFilterCount" hidden></span></summary>
        <div class="filter-panel">
          <fieldset><legend>Numeração</legend>
            <label><input type="checkbox" id="allStockSizes"> Todas as numerações</label>
            <div id="stockSizeOptions"></div>
          </fieldset>
          <fieldset><legend>Situação do estoque</legend><p class="hint">Sem opções marcadas, todas as situações são exibidas.</p>
            <label><input type="checkbox" name="stockStatus" value="todos"> Todos</label>
            <label><input type="checkbox" name="stockStatus" value="baixo"> Baixo</label>
            <label><input type="checkbox" name="stockStatus" value="zerado"> Zerado</label>
          </fieldset>
          <button type="button" class="lnk" id="clearStockFilters">Limpar filtros</button>
        </div>
      </details>
    </div>
    <p class="hint" id="sizeSummary" role="status" hidden></p>
    <p class="hint">Selecione um produto para consultar suas características e o saldo por numeração.</p>
    <div class="sheet-wrap"><table class="sheet"><caption class="sr-only">Estoque de produtos</caption><thead><tr><th>Produto<span class="stock-heading-code"> / código</span></th><th>Categoria</th><th>Entradas</th><th>Saídas</th><th>Saldo</th><th>Situação</th><th>Ações</th></tr></thead><tbody id="listEstoque"></tbody></table></div>
  </section>

  <section class="view" id="v-entrada" hidden>
    <div class="vh">
      <div><h1>Entrada</h1><p class="sub">Registre o que chegou. O saldo do produto aumenta na hora.</p></div>
    </div>
    <div class="split">
      <form class="form" id="formIn" novalidate>
        <div class="field">
          <label for="inProd">Produto</label>
          <select id="inProd"></select>
          <label for="inSize">Numeração</label><select id="inSize" aria-label="Numeração da entrada"></select>
        </div>
        <div class="row2">
          <div class="field">
            <label for="inQtd">Quantidade</label>
            <input id="inQtd" type="number" inputmode="decimal" min="0" step="any" placeholder="0">
          </div>
          <div class="field">
            <label for="inCusto">Custo unitário (R$)</label>
            <input id="inCusto" type="number" inputmode="decimal" min="0" step="any" placeholder="0,00">
          </div>
        </div>
        <div class="field">
          <label for="inData">Data</label>
          <input id="inData" type="date">
        </div>
        <div class="field">
          <label for="inObs">Fornecedor ou observação</label>
          <input id="inObs" type="text" maxlength="120" placeholder="Opcional" autocomplete="off">
        </div>
        <div class="calc" id="calcIn" aria-live="polite">
          <div><span>Saldo atual</span><b data-c="a">—</b></div>
          <div><span>Entrada</span><b data-c="m">—</b></div>
          <div><span>Saldo depois</span><b data-c="d">—</b></div>
        </div>
        <p class="err" id="inErr" role="alert"></p>
        <button type="submit" class="btn block">Registrar entrada</button>
        <button type="button" class="lnk" data-newprod>Cadastrar novo produto</button>
      </form>
      <div>
        <h2 class="sec-h">Entradas recentes</h2>
        <ul class="list" id="listRecIn"></ul>
      </div>
    </div>
  </section>

  <section class="view" id="v-saida" hidden>
    <div class="vh">
      <div><h1>Saída</h1><p class="sub">Registre o que saiu. O saldo do produto diminui na hora.</p></div>
    </div>
    <div class="split">
      <form class="form" id="formOut" novalidate>
        <div class="field">
          <label for="outProd">Produto</label>
          <select id="outProd"></select>
          <label for="outSize">Numeração</label><select id="outSize" aria-label="Numeração da saída"></select>
        </div>
        <div class="row2">
          <div class="field">
            <label for="outQtd">Quantidade</label>
            <input id="outQtd" type="number" inputmode="decimal" min="0" step="any" placeholder="0">
          </div>
          <div class="field">
            <label for="outMotivo">Motivo</label>
            <select id="outMotivo">
              <option>Venda</option>
              <option>Consumo interno</option>
              <option>Perda ou avaria</option>
              <option>Devolução ao fornecedor</option>
              <option>Outro</option>
            </select>
          </div>
        </div>
        <div class="field">
          <label for="outData">Data</label>
          <input id="outData" type="date">
        </div>
        <div class="field">
          <label for="outObs">Cliente ou observação</label>
          <input id="outObs" type="text" maxlength="120" placeholder="Opcional" autocomplete="off">
        </div>
        <div class="calc" id="calcOut" aria-live="polite">
          <div><span>Saldo atual</span><b data-c="a">—</b></div>
          <div><span>Saída</span><b data-c="m">—</b></div>
          <div><span>Saldo depois</span><b data-c="d">—</b></div>
        </div>
        <p class="err" id="outErr" role="alert"></p>
        <button type="submit" class="btn block">Registrar saída</button>
      </form>
      <div>
        <h2 class="sec-h">Saídas recentes</h2>
        <ul class="list" id="listRecOut"></ul>
      </div>
    </div>
  </section>

  <section class="view" id="v-historico" hidden>
    <div class="vh">
      <div><h1>Histórico</h1><p class="sub">Todas as entradas e saídas. Excluir uma movimentação recalcula o saldo.</p></div>
    </div>
    <div class="tools">
      <input id="qHist" type="search" placeholder="Buscar por produto, motivo ou observação" aria-label="Buscar movimentação" autocomplete="off">
      <details class="stock-filters" id="historyFilters">
        <summary>Filtrar <span id="historyFilterCount" hidden></span></summary>
        <div class="filter-panel">
          <fieldset><legend>Tipo de movimentação</legend>
            <label><input type="checkbox" name="historyType" value="todos"> Todas</label>
            <label><input type="checkbox" name="historyType" value="entrada"> Entradas</label>
            <label><input type="checkbox" name="historyType" value="saida"> Saídas</label>
          </fieldset>
          <fieldset><legend>Numeração</legend>
            <label><input type="checkbox" id="allHistorySizes"> Todas as numerações</label>
            <div id="historySizeOptions"></div>
          </fieldset>
          <fieldset><legend>Situação atual do estoque</legend><p class="hint">Usa o saldo atual do produto ou da numeração. Sem opções marcadas, todas as situações são exibidas.</p>
            <label><input type="checkbox" name="historyStatus" value="todos"> Todos</label>
            <label><input type="checkbox" name="historyStatus" value="baixo"> Baixo</label>
            <label><input type="checkbox" name="historyStatus" value="zerado"> Zerado</label>
          </fieldset>
          <button type="button" class="lnk" id="clearHistoryFilters">Limpar filtros</button>
        </div>
      </details>
    </div>
    <ul class="list" id="listHist"></ul>
  </section>

  <p class="foot" id="foot"></p>
</main>

<div class="overlay" id="ovProd" hidden>
  <div class="panel" role="dialog" aria-modal="true" aria-labelledby="pmTitle">
    <h2 id="pmTitle">Novo produto</h2>
    <form class="form" id="formProd" novalidate>
      <div class="field">
        <label for="pNome">Nome</label>
        <input id="pNome" type="text" maxlength="80" autocomplete="off">
      </div>
      <div class="row2">
        <div class="field">
          <label for="pCodigo">Código</label>
          <input id="pCodigo" type="text" maxlength="24" placeholder="Automático" autocomplete="off">
        </div>
        <div class="field">
          <label for="pUn">Unidade</label>
          <select id="pUn">
            <option value="par">par</option><option value="un">un</option><option value="cx">cx</option><option value="pct">pct</option>
            <option value="kg">kg</option><option value="L">L</option><option value="m">m</option>
          </select>
        </div>
      </div>
      <div class="field">
        <label for="pCategoria">Categoria</label>
        <input id="pCategoria" type="text" maxlength="40" list="dlCategorias" placeholder="Opcional" autocomplete="off">
        <datalist id="dlCategorias"></datalist>
      </div>
      <div class="row2">
        <div class="field">
          <label for="pMin">Estoque mínimo</label>
          <input id="pMin" type="number" inputmode="decimal" min="0" step="any" placeholder="0">
        </div>
        <div class="field">
          <label for="pCusto">Custo unitário (R$)</label>
          <input id="pCusto" type="number" inputmode="decimal" min="0" step="any" placeholder="0,00">
        </div>
      </div>
      <div class="field" id="fInicial">
        <label for="pInicial">Estoque inicial</label>
        <input id="pInicial" type="number" inputmode="decimal" min="0" step="any" placeholder="0">
        <span class="hint">Vira uma entrada automática no histórico.</span>
      </div>
      <fieldset style="border:1px solid var(--line);padding:12px"><legend>Grade de numeração</legend><p class="hint" id="sizeHint">Informe o tamanho e a quantidade inicial de pares. O total é calculado pela grade.</p><div id="sizeRows"></div><button type="button" class="lnk" id="addSize">Adicionar numeração</button></fieldset>
      <p class="err" id="pmErr" role="alert"></p>
      <div class="actions">
        <button type="button" class="btn ghost danger" id="pmDel" hidden>Excluir</button>
        <span class="grow"></span>
        <button type="button" class="btn ghost" data-close>Cancelar</button>
        <button type="submit" class="btn">Salvar</button>
      </div>
    </form>
  </div>
</div>

<div class="overlay" id="ovConf" hidden>
  <div class="panel" role="alertdialog" aria-modal="true" aria-labelledby="cfTitle" aria-describedby="cfMsg">
    <h2 id="cfTitle">Confirmar</h2>
    <p id="cfMsg"></p>
    <div class="actions">
      <span class="grow"></span>
      <button type="button" class="btn ghost" id="cfNo">Cancelar</button>
      <button type="button" class="btn" id="cfYes">Confirmar</button>
    </div>
  </div>
</div>

<div class="toast" id="toast" role="status" aria-live="polite" hidden></div>

<script nonce="<?= h($nonce) ?>">
(function(){
'use strict';

var CSRF = <?= json_encode(csrf_token()) ?>;
var $ = function(s, r){ return (r || document).querySelector(s); };
var $$ = function(s, r){ return Array.prototype.slice.call((r || document).querySelectorAll(s)); };
var esc = function(s){ return String(s == null ? '' : s).replace(/[&<>"']/g, function(c){ return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]; }); };
var nf = new Intl.NumberFormat('pt-BR', {maximumFractionDigits: 3});
var bf = new Intl.NumberFormat('pt-BR', {style: 'currency', currency: 'BRL'});
var bf0 = new Intl.NumberFormat('pt-BR', {style: 'currency', currency: 'BRL', maximumFractionDigits: 0});
var money = function(v){ return Math.abs(v) >= 10000 ? bf0.format(v) : bf.format(v); };
var r3 = function(n){ return Math.round((n + Number.EPSILON) * 1000) / 1000; };
var uid = function(){ return Date.now().toString(36) + Math.random().toString(36).slice(2, 7); };
var pad = function(n){ return String(n).padStart(2, '0'); };
var today = function(){ var d = new Date(); return d.getFullYear() + '-' + pad(d.getMonth() + 1) + '-' + pad(d.getDate()); };
var fmtDate = function(s){ var p = String(s || '').split('-'); return p.length === 3 ? p[2] + '/' + p[1] + '/' + p[0] : '—'; };
var clean = function(o){ return JSON.parse(JSON.stringify(o)); };

var VIEWS = ['painel', 'estoque', 'entrada', 'saida', 'historico'];
var S = {
  produtos: [], movimentos: [], ready: false, mode: 'server', memOnly: false,
  view: 'painel', stockStatuses: [], stockSizes: [], stockAllSizes: false, qEstoque: '', historyStatuses: [], historySizes: [], historyAllSizes: false, historyTypes: [], qHist: ''
};
var calcMap = new Map(), pMap = new Map();
var LS_KEY = 'jp-gerencial-v1';

/* ---------- Armazenamento ---------- */
async function requestApi(path,options){
  var opts=Object.assign({credentials:'same-origin',cache:'no-store'},options || {});
  opts.headers=Object.assign({'Content-Type':'application/json','X-CSRF-Token':CSRF},opts.headers || {});
  var response;
  try{response=await fetch('api.php'+path,opts);}catch(e){throw new Error('Não foi possível acessar o servidor. Confira sua conexão e tente novamente.');}
  if(response.status===401){location.replace('login.php');throw new Error('Sua sessão expirou. Entre novamente.');}
  var body;
  try{body=await response.json();}catch(e){throw new Error('Não foi possível acessar o servidor. Tente novamente mais tarde.');}
  if(!response.ok) throw new Error(body.error || 'Não foi possível acessar os dados.');
  return body;
}
async function put(col,obj){
  var o=clean(obj);
  await requestApi('?collection='+encodeURIComponent(col),{method:'PUT',body:JSON.stringify(o)});
  cacheRecord(col,o);
}
function cacheRecord(col,o){
  var arr=S[col],i=arr.findIndex(function(x){return x.id===o.id;});
  if(i>=0) arr[i]=o;else arr.push(o);
}
async function putMany(records){
  await requestApi('?action=batch',{method:'POST',body:JSON.stringify({records:records})});
  records.forEach(function(item){cacheRecord(item.collection,clean(item.record));});
}
async function del(col,id){
  await requestApi('?collection='+encodeURIComponent(col)+'&id='+encodeURIComponent(id),{method:'DELETE'});
  S[col]=S[col].filter(function(x){return x.id!==id;});
  if(col==='produtos') S.movimentos=S.movimentos.filter(function(m){return m.produtoId!==id;});
}
async function run(fn, okMsg){
  if(!S.ready){toast('Aguarde o carregamento dos dados antes de salvar.');return false;}
  try {
    await fn();
    render();
    if (okMsg) toast(okMsg);
    return true;
  } catch (e) {
    render();
    toast(e.message || 'Não foi possível salvar. Tente de novo.');
    return false;
  }
}

/* ---------- Cálculo de estoque ---------- */
function calc(){
  var map = new Map();
  S.produtos.forEach(function(p){ map.set(p.id, {ent: 0, sai: 0, saldo: 0}); });
  S.movimentos.forEach(function(m){
    var r = map.get(m.produtoId); if (!r) return;
    var q = +m.qtd || 0;
    if (m.tipo === 'entrada') r.ent += q; else r.sai += q;
  });
  map.forEach(function(r){ r.ent = r3(r.ent); r.sai = r3(r.sai); r.saldo = r3(r.ent - r.sai); });
  return map;
}
function statusOf(p, saldo){
  if (saldo <= 0) return ['bad', 'Sem estoque'];
  if (saldo <= (+p.minimo || 0)) return ['warn', 'Estoque baixo'];
  return ['ok', 'Em estoque'];
}
function movsSorted(){
  return S.movimentos.slice().sort(function(a, b){
    return String(b.data || '').localeCompare(String(a.data || '')) || (b.ts || 0) - (a.ts || 0);
  });
}
var byName = function(a, b){ return String(a.nome).localeCompare(String(b.nome), 'pt-BR'); };

/* ---------- Telas ---------- */
function loadingRow(){ return '<li class="empty">Carregando…</li>'; }

function movRow(m, withDel){
  var p = pMap.get(m.produtoId);
  var nome = p ? p.nome : 'Produto removido', un = p ? (p.unidade || '') : '';
  var ent = m.tipo === 'entrada';
  var parts = [fmtDate(m.data)];
  if (!ent && m.motivo) parts.push(m.motivo);
  if (ent && m.custo != null) parts.push(bf.format(m.custo) + ' por ' + (un || 'un'));
  if (m.tamanho) parts.push('Tamanho '+m.tamanho);
  if (m.obs) parts.push(m.obs);
  return '<li class="mrow' + (withDel ? ' hasdel' : '') + '">' +
    '<span class="tag ' + (ent ? 'in' : 'out') + '">' + (ent ? 'Entrada' : 'Saída') + '</span>' +
    '<div class="mmain"><strong>' + esc(nome) + '</strong><span class="mmeta">' + esc(parts.join(' · ')) + '</span></div>' +
    '<span class="mqty ' + (ent ? 'pos' : 'neg') + '">' + (ent ? '+' : '−') + nf.format(m.qtd) + ' ' + esc(un) + '</span>' +
    (withDel ? '<button type="button" class="icon" data-del-mov="' + esc(m.id) + '" aria-label="Excluir movimentação"><svg class="ic"><use href="#i-trash"/></svg></button>' : '') +
    '</li>';
}

function renderPainel(){
  var d = new Date().toLocaleDateString('pt-BR', {weekday: 'long', day: 'numeric', month: 'long'});
  $('#hoje').textContent = d.charAt(0).toUpperCase() + d.slice(1);
  $('#exBanner').hidden = !(S.produtos.some(function(p){ return p.exemplo; }) || S.movimentos.some(function(m){ return m.exemplo; }));

  var itens = 0, valor = 0, atencao = [];
  S.produtos.forEach(function(p){
    var r = calcMap.get(p.id);
    itens += r.saldo; valor += r.saldo * (+p.custo || 0);
    if (statusOf(p, r.saldo)[0] !== 'ok') atencao.push(p);
  });
  $('#stats').innerHTML =
    '<div class="stat"><span>Produtos</span><strong>' + nf.format(S.produtos.length) + '</strong></div>' +
    '<div class="stat"><span>Itens em estoque</span><strong>' + nf.format(r3(itens)) + '</strong></div>' +
    '<div class="stat"><span>Valor em estoque</span><strong>' + money(valor) + '</strong></div>' +
    '<div class="stat"><span>Pedem reposição</span><strong>' + nf.format(atencao.length) + '</strong></div>';

  var la = $('#listAtencao');
  if (!S.ready) { la.innerHTML = loadingRow(); return; }

  atencao.sort(function(a, b){ return calcMap.get(a.id).saldo - calcMap.get(b.id).saldo; });
  la.innerHTML = atencao.length ? atencao.slice(0, 6).map(function(p){
    var r = calcMap.get(p.id), st = statusOf(p, r.saldo);
    return '<li class="arow"><div class="amain"><strong>' + esc(p.nome) + '</strong><span class="mmeta">Saldo ' +
      nf.format(r.saldo) + ' ' + esc(p.unidade || '') + ' · mínimo ' + nf.format(+p.minimo || 0) + '</span></div>' +
      '<span class="st ' + st[0] + '">' + st[1] + '</span>' +
      '<button type="button" class="lnk" data-act="in" data-id="' + esc(p.id) + '">Repor</button></li>';
  }).join('') : '<li class="empty">Nenhum produto abaixo do mínimo.</li>';


}

function syncFilterOptions(prefix,availableSizes){
  var sizeOptions = $('#'+prefix+'SizeOptions');
  var orderedSizes = Array.from(new Set(Array.from(availableSizes).concat(S[prefix+'Sizes']))).sort(function(a,b){return a.localeCompare(b,'pt-BR',{numeric:true});});
  var signature = JSON.stringify(orderedSizes);
  if (sizeOptions.dataset.signature !== signature) {
    sizeOptions.dataset.signature = signature;
    sizeOptions.innerHTML = orderedSizes.length ? orderedSizes.map(function(t){return '<label><input type="checkbox" name="'+prefix+'Size" value="'+esc(t)+'"> Tamanho '+esc(t)+'</label>';}).join('') : '<p class="hint">Nenhuma numeração cadastrada.</p>';
  }
  $$('input[name="'+prefix+'Size"]').forEach(function(input){input.checked=S[prefix+'Sizes'].includes(input.value);});
  $('#all'+(prefix==='stock'?'Stock':'History')+'Sizes').checked=S[prefix+'AllSizes'];
  $$('input[name="'+prefix+'Status"]').forEach(function(input){input.checked=S[prefix+'Statuses'].includes(input.value);});
}

function renderEstoque(){
  var ul = $('#listEstoque'), selectedSizes = S.stockSizes, selectedSize = selectedSizes.length > 0;
  var availableSizes = new Set();
  function productSizes(p){
    var sizes = new Set((p.tamanhos || []).map(String));
    S.movimentos.forEach(function(m){if(m.produtoId === p.id && m.tamanho) sizes.add(String(m.tamanho));});
    return Array.from(sizes);
  }
  S.produtos.forEach(function(p){productSizes(p).forEach(function(t){availableSizes.add(t);});});
  syncFilterOptions('stock',availableSizes);
  var count = selectedSizes.length + S.stockStatuses.filter(function(st){return st!=='todos';}).length;
  $('#stockFilterCount').hidden = !count;
  $('#stockFilterCount').textContent = count;
  function matchesStatus(p,saldo){
    var st=statusOf(p,saldo)[0];
    return !S.stockStatuses.length || S.stockStatuses.includes('todos') || (S.stockStatuses.includes('baixo') && st==='warn') || (S.stockStatuses.includes('zerado') && st==='bad');
  }
  function matchingSizes(p){
    return productSizes(p).filter(function(t){return selectedSizes.includes(t) && matchesStatus(p,sizeBalance(p.id,t));});
  }
  function stockFor(p){
    if (!selectedSize) return calcMap.get(p.id);
    var sizes=matchingSizes(p), r={ent:0,sai:0};
    S.movimentos.forEach(function(m){
      if(m.produtoId===p.id && sizes.includes(String(m.tamanho || ''))) r[m.tipo==='entrada'?'ent':'sai']+= +m.qtd || 0;
    });
    r.ent=r3(r.ent);r.sai=r3(r.sai);r.saldo=r3(r.ent-r.sai);
    return r;
  }
  var list = S.produtos.filter(function(p){
    var q = S.qEstoque.trim().toLowerCase();
    if(selectedSize ? !matchingSizes(p).length : !matchesStatus(p,calcMap.get(p.id).saldo)) return false;
    return !q || [p.nome,p.codigo,p.categoria].some(function(v){return String(v || '').toLowerCase().includes(q);});
  }).sort(byName);
  var summary = $('#sizeSummary');
  summary.hidden = !count;
  var labels=[];
  if(selectedSize) labels.push('Numeração: '+selectedSizes.join(', '));
  if(S.stockStatuses.length && !S.stockStatuses.includes('todos')) labels.push('Situação: '+S.stockStatuses.map(function(st){return st==='baixo'?'Baixo':'Zerado';}).join(', '));
  summary.textContent=labels.join(' · ')+' · '+list.length+' modelo(s) · Saldo: '+nf.format(r3(list.reduce(function(total,p){return total+stockFor(p).saldo;},0)))+' pares.'+(selectedSize?' Quantidades referentes às numerações que atendem aos filtros.':'');
  ul.innerHTML = !S.ready ? '<tr><td colspan="7">Carregando…</td></tr>' : !list.length ? '<tr><td colspan="7">Nenhum produto encontrado para os filtros selecionados. <button class="lnk" data-newprod>Cadastrar produto</button></td></tr>' : list.map(function(p,i){
    var r=stockFor(p), st=statusOf(p,r.saldo), id=esc(p.id);
    var sizes=(p.tamanhos || []).slice();
    S.movimentos.filter(function(m){return m.produtoId===p.id;}).forEach(function(m){var key=m.tamanho || '';if(!sizes.includes(key)) sizes.push(key);});
    if (selectedSize) {
      sizes = matchingSizes(p);
      var states = sizes.map(function(t){return statusOf(p,sizeBalance(p.id,t));});
      st = states.every(function(state){return state[0]===states[0][0];}) ? states[0] : ['warn','Varia por numeração'];
    }
    return '<tr><td><button class="lnk" data-detail="detail-'+i+'" aria-expanded="'+(selectedSize?'true':'false')+'" aria-controls="detail-'+i+'">'+esc(p.nome)+'</button><span class="code">'+esc(p.codigo)+'</span></td><td>'+esc(p.categoria || '—')+'</td><td>'+nf.format(r.ent)+'</td><td>'+nf.format(r.sai)+'</td><td><strong>'+nf.format(r.saldo)+'</strong> '+esc(p.unidade)+'</td><td><span class="st '+st[0]+'">'+st[1]+'</span></td><td>'+['in','out','edit'].map(function(a,j){return '<button class="lnk" data-act="'+a+'" data-id="'+id+'">'+['Entrada','Saída','Editar'][j]+'</button>';}).join(' · ')+'</td></tr><tr id="detail-'+i+'" '+(selectedSize?'':'hidden')+'><td colspan="7"><strong>'+esc(p.nome)+'</strong><p>Categoria: '+esc(p.categoria || '—')+' · Custo: '+bf.format(p.custo || 0)+' · Estoque mínimo: '+nf.format(p.minimo || 0)+'</p><div class="size-grid">'+sizes.map(function(t){return '<div class="size-card">'+(t ? 'Tamanho '+esc(t) : 'Sem numeração')+'<strong>'+nf.format(sizeBalance(p.id,t))+' '+esc(p.unidade)+'</strong></div>';}).join('')+'</div></td></tr>';
  }).join('');
}

function renderRecent(tipo, sel){
  var ul = $(sel);
  if (!S.ready) { ul.innerHTML = loadingRow(); return; }
  var list = movsSorted().filter(function(m){ return m.tipo === tipo; }).slice(0, 8);
  ul.innerHTML = list.length ? list.map(function(m){ return movRow(m, false); }).join('')
    : '<li class="empty">Nenhuma ' + (tipo === 'entrada' ? 'entrada' : 'saída') + ' registrada ainda.</li>';
}

function renderHist(){
  var ul = $('#listHist');
  if (!S.ready) { ul.innerHTML = loadingRow(); return; }
  var availableSizes=new Set();
  S.movimentos.forEach(function(m){if(m.tamanho) availableSizes.add(String(m.tamanho));});
  syncFilterOptions('history',availableSizes);
  $$('input[name="historyType"]').forEach(function(input){input.checked=S.historyTypes.includes(input.value);});
  var count=S.historySizes.length+S.historyStatuses.filter(function(st){return st!=='todos';}).length+S.historyTypes.filter(function(t){return t!=='todos';}).length;
  $('#historyFilterCount').hidden=!count;$('#historyFilterCount').textContent=count;
  var q = S.qHist.trim().toLowerCase();
  var list = movsSorted().filter(function(m){
    if(S.historyTypes.length && !S.historyTypes.includes('todos') && !S.historyTypes.includes(m.tipo)) return false;
    if(S.historySizes.length && !S.historySizes.includes(String(m.tamanho || ''))) return false;
    if(S.historyStatuses.length && !S.historyStatuses.includes('todos')){
      var product=pMap.get(m.produtoId);
      if(!product) return false;
      var balance=m.tamanho?sizeBalance(product.id,String(m.tamanho)):calcMap.get(product.id).saldo;
      var status=statusOf(product,balance)[0];
      if(!((S.historyStatuses.includes('baixo') && status==='warn') || (S.historyStatuses.includes('zerado') && status==='bad'))) return false;
    }
    if (!q) return true;
    var p = pMap.get(m.produtoId);
    return [p ? p.nome : '', m.motivo, m.obs].some(function(v){ return String(v || '').toLowerCase().indexOf(q) >= 0; });
  });
  ul.innerHTML = list.length ? list.map(function(m){ return movRow(m, true); }).join('')
    : '<li class="empty">' + (S.movimentos.length ? 'Nenhuma movimentação encontrada.' : 'O histórico aparece aqui quando você registrar a primeira entrada ou saída.') + '</li>';
}

/* Seletores de produto e categorias */
var selSig = '';
function fillSelects(){
  var list = S.produtos.slice().sort(byName);
  var sig = list.map(function(p){ return p.id + '|' + p.nome + '|' + p.codigo; }).join(';');
  if (sig !== selSig) {
    selSig = sig;
    ['#inProd', '#outProd'].forEach(function(id){
      var sel = $(id), cur = sel.value;
      sel.innerHTML = '';
      sel.appendChild(new Option(list.length ? 'Selecione um produto' : 'Cadastre um produto primeiro', ''));
      list.forEach(function(p){ sel.appendChild(new Option(p.nome + (p.codigo ? ' · ' + p.codigo : ''), p.id)); });
      if (cur && pMap.has(cur)) sel.value = cur;
    });
    var cats = {}; S.produtos.forEach(function(p){ if (p.categoria) cats[p.categoria] = 1; });
    $('#dlCategorias').innerHTML = Object.keys(cats).sort().map(function(c){ return '<option value="' + esc(c) + '">'; }).join('');
  }
}

function updCalc(k){
  fillSizes(k);
  var pid = $('#' + k + 'Prod').value, qtd = parseFloat($('#' + k + 'Qtd').value);
  var q = qtd > 0 ? r3(qtd) : 0;
  var box = $('#calc' + (k === 'in' ? 'In' : 'Out'));
  var a = $('[data-c="a"]', box), m = $('[data-c="m"]', box), d = $('[data-c="d"]', box);
  var p = pMap.get(pid), r = calcMap.get(pid);
  if (!p || !r) { a.textContent = m.textContent = d.textContent = '—'; box.classList.remove('neg'); return; }
  var selectedSize=$('#'+k+'Size').value;
  if(selectedSize) r={saldo:sizeBalance(pid,selectedSize==='__none__'?'':selectedSize)};
  var un = ' ' + (p.unidade || ''), depois = k === 'in' ? r3(r.saldo + q) : r3(r.saldo - q);
  a.textContent = nf.format(r.saldo) + un;
  m.textContent = (k === 'in' ? '+' : '−') + nf.format(q) + un;
  d.textContent = nf.format(depois) + un;
  box.classList.toggle('neg', depois < 0);
}

function renderFoot(){
  $('#foot').textContent='Dados salvos na sua conta. Para proteger o acesso, clique em Sair ao terminar.';
}

function render(){
  calcMap = calc();
  pMap = new Map(S.produtos.map(function(p){ return [p.id, p]; }));
  fillSelects();
  if (S.view === 'painel') renderPainel();
  if (S.view === 'estoque') renderEstoque();
  if (S.view === 'entrada') { renderRecent('entrada', '#listRecIn'); updCalc('in'); }
  if (S.view === 'saida') { renderRecent('saida', '#listRecOut'); updCalc('out'); }
  if (S.view === 'historico') renderHist();
  renderFoot();
}

/* ---------- Navegação ---------- */
function go(v, noScroll){
  if (VIEWS.indexOf(v) < 0) v = 'painel';
  S.view = v;
  VIEWS.forEach(function(n){ $('#v-' + n).hidden = n !== v; });
  $$('.nav button').forEach(function(b){
    if (b.getAttribute('data-go') === v) b.setAttribute('aria-current', 'page'); else b.removeAttribute('aria-current');
  });
  render();
  if (!noScroll) window.scrollTo(0, 0);
  try { history.replaceState(null, '', '#' + v); } catch (e) {}
}
function goForm(k, pid){
  go(k === 'in' ? 'entrada' : 'saida');
  var sel = $('#' + k + 'Prod');
  if (pid && pMap.has(pid)) {
    sel.value = pid;
    if (k === 'in') { var p = pMap.get(pid); $('#inCusto').value = p.custo ? p.custo : ''; }
  }
  updCalc(k);
  setTimeout(function(){ $('#' + k + 'Qtd').focus(); }, 30);
}

/* ---------- Avisos e janelas ---------- */
var tt;
function toast(msg){
  var t = $('#toast'); t.textContent = msg; t.hidden = false;
  clearTimeout(tt); tt = setTimeout(function(){ t.hidden = true; }, 3200);
}
var lastFocus = null;
function openOv(id){ lastFocus = document.activeElement; $(id).hidden = false; }
function closeOv(id){ $(id).hidden = true; if (lastFocus && lastFocus.focus) { try { lastFocus.focus(); } catch (e) {} } }

var confResolve = null;
function askConfirm(title, msg, label){
  return new Promise(function(res){
    $('#cfTitle').textContent = title; $('#cfMsg').textContent = msg; $('#cfYes').textContent = label || 'Confirmar';
    confResolve = res; openOv('#ovConf');
    setTimeout(function(){ $('#cfNo').focus(); }, 30);
  });
}
function endConfirm(v){
  if (!confResolve) return;
  var r = confResolve; confResolve = null; closeOv('#ovConf'); r(v);
}

/* Produto: criar, editar, excluir */
var editId = null;
function sizeBalance(pid,size){return r3(S.movimentos.filter(function(m){return m.produtoId===pid && (m.tamanho || '')===size;}).reduce(function(n,m){return n+(m.tipo==='entrada'?1:-1)*m.qtd;},0));}
function fillSizes(k){
 var sel=$('#'+k+'Size'), old=sel.value, p=pMap.get($('#'+k+'Prod').value), sizes=p && p.tamanhos || [];
 sel.innerHTML='<option value="">'+(sizes.length?'Selecione a numeração':'Sem numeração')+'</option>'+sizes.map(function(t){return '<option value="'+esc(t)+'">'+esc(t)+' — saldo '+nf.format(sizeBalance(p.id,t))+'</option>';}).join('');
 if(k==='out' && sizes.length && sizeBalance(p.id,'')>0) sel.add(new Option('Sem numeração — saldo '+nf.format(sizeBalance(p.id,'')),'__none__'));
 if(sizes.includes(old) || old==='__none__') sel.value=old;
}
function addSizeRow(size,qty){
 var row=document.createElement('div');row.className='size-row';row.innerHTML='<input aria-label="Tamanho" type="number" min="1" max="60" step="1" placeholder="Ex.: 36" value="'+esc(size || '')+'" '+(editId && size?'readonly':'')+'><input aria-label="Quantidade de pares" type="number" min="0" step="1" placeholder="Pares" value="'+esc(qty == null?'':qty)+'" '+(editId?'disabled':'')+'><button type="button" class="lnk">Remover</button>';
 row.lastChild.onclick=function(){if(editId && size){toast('Numerações cadastradas são mantidas para preservar o histórico.');return;} row.remove();syncInitial();};
 row.oninput=syncInitial;$('#sizeRows').appendChild(row);syncInitial();
}
function syncInitial(){var rows=$$('.size-row');if(!rows.length && $('#pInicial').disabled) $('#pInicial').value='';$('#pInicial').disabled=rows.length>0;if(rows.length) $('#pInicial').value=rows.reduce(function(n,row){return n+(Number(row.children[1].value)||0);},0);}
$('#addSize').onclick=function(){addSizeRow();};

function openProd(id){
  editId = id || null;
  var p = id ? pMap.get(id) : null;
  $('#pmTitle').textContent = p ? 'Editar produto' : 'Novo produto';
  $('#pNome').value = p ? p.nome : '';
  $('#pCodigo').value = p ? (p.codigo || '') : '';
  $('#pUn').value = p ? (p.unidade || 'un') : 'par';
  $('#pCategoria').value = p ? (p.categoria || '') : '';
  $('#pMin').value = p && p.minimo ? p.minimo : '';
  $('#pCusto').value = p && p.custo ? p.custo : '';
  $('#pInicial').value = '';
  $('#fInicial').hidden = !!p;
  $('#sizeRows').innerHTML='';
  (p && p.tamanhos || []).forEach(function(t){addSizeRow(t,sizeBalance(p.id,t));});
  $('#sizeHint').textContent=p?'Adicione numerações aqui. Ajuste as quantidades pelas telas Entrada e Saída.':'Informe tamanho e quantidade inicial de pares. O total é calculado pela grade.';
  syncInitial();
  $('#pmDel').hidden = !p;
  $('#pmErr').textContent = '';
  openOv('#ovProd');
  setTimeout(function(){ $('#pNome').focus(); }, 30);
}

$('#formProd').addEventListener('submit', async function(e){
  e.preventDefault();
  var err = $('#pmErr'); err.textContent = '';
  var nome = $('#pNome').value.trim();
  if (!nome) { err.textContent = 'Informe o nome do produto.'; $('#pNome').focus(); return; }
  var codigo = $('#pCodigo').value.trim().toUpperCase();
  if (codigo && S.produtos.some(function(x){ return x.codigo === codigo && x.id !== editId; })) {
    err.textContent = 'Já existe um produto com esse código.'; return;
  }
  if (!codigo) {
    var n = S.produtos.length + 1;
    do { codigo = 'P' + String(n++).padStart(3, '0'); } while (S.produtos.some(function(x){ return x.codigo === codigo; }));
  }
  var grade=$$('.size-row').map(function(row){return {t:row.children[0].value.trim()?String(Number(row.children[0].value)):'',q:editId?0:Number(row.children[1].value)};});
  if(grade.some(function(x){return !x.t || !Number.isInteger(Number(x.t)) || +x.t<1 || +x.t>60 || !Number.isInteger(x.q) || x.q<0;}) || new Set(grade.map(function(x){return x.t;})).size!==grade.length){err.textContent='Informe tamanhos únicos de 1 a 60 e quantidades inteiras a partir de zero.';return;}
  var base = {tamanhos:grade.map(function(x){return x.t;}),
    nome: nome, codigo: codigo, categoria: $('#pCategoria').value.trim(), unidade: grade.length?'par':$('#pUn').value,
    minimo: Math.max(0, parseFloat($('#pMin').value) || 0), custo: Math.max(0, parseFloat($('#pCusto').value) || 0)
  };
  var ok;
  if (editId) {
    var old = pMap.get(editId);
    ok = await run(function(){ return put('produtos', Object.assign({}, old, base)); }, 'Produto atualizado');
  } else {
    var prod = Object.assign({id: uid(), criado: Date.now()}, base);
    var ini = parseFloat($('#pInicial').value);
    ok = await run(async function(){
      var records=[{collection:'produtos',record:prod}];
      if(grade.length){for(var g of grade){if(g.q>0) records.push({collection:'movimentos',record:{id:uid(),produtoId:prod.id,tipo:'entrada',qtd:g.q,tamanho:g.t,data:today(),obs:'Estoque inicial',ts:Date.now()}});}}
      else if(ini>0) records.push({collection:'movimentos',record:{id:uid(),produtoId:prod.id,tipo:'entrada',qtd:r3(ini),data:today(),obs:'Estoque inicial',ts:Date.now()}});
      await putMany(records);
    }, 'Produto cadastrado');
  }
  if (ok) closeOv('#ovProd');
});

$('#pmDel').addEventListener('click', async function(){
  var p = pMap.get(editId); if (!p) return;
  var id = p.id;
  var yes = await askConfirm('Excluir produto', 'Excluir "' + p.nome + '"? As entradas e saídas dele também serão removidas. Isso não pode ser desfeito.', 'Excluir');
  if (!yes) return;
  var ok = await run(async function(){
    await del('produtos', id);
  }, 'Produto excluído');
  if (ok) closeOv('#ovProd');
});

/* Entrada */
$('#formIn').addEventListener('submit', async function(e){
  e.preventDefault();
  var err = $('#inErr'); err.textContent = '';
  var pid = $('#inProd').value, qtd = parseFloat($('#inQtd').value);
  if (!pid) { err.textContent = 'Escolha um produto.'; return; }
  if (!(qtd > 0)) { err.textContent = 'Informe uma quantidade maior que zero.'; $('#inQtd').focus(); return; }
  var tamanho=$('#inSize').value, produto=pMap.get(pid);
  if((produto.tamanhos || []).length && (!tamanho || !Number.isInteger(qtd))){err.textContent='Selecione a numeração e informe uma quantidade inteira de pares.';return;}
  var raw = $('#inCusto').value, custo = raw === '' ? null : parseFloat(raw);
  var mv = {id: uid(), produtoId: pid, tamanho: tamanho==='__none__'?'':tamanho, tipo: 'entrada', qtd: r3(qtd), data: $('#inData').value || today(), obs: $('#inObs').value.trim(), ts: Date.now()};
  if (custo != null && custo >= 0) mv.custo = custo;
  var p = pMap.get(pid);
  var ok = await run(async function(){
    var records=[{collection:'movimentos',record:mv}];
    if(custo!=null && custo>=0 && p && +p.custo!==custo) records.push({collection:'produtos',record:Object.assign({},p,{custo:custo})});
    await putMany(records);
  }, 'Entrada registrada');
  if (ok) { $('#inQtd').value = ''; $('#inObs').value = ''; updCalc('in'); }
});

/* Saída */
$('#formOut').addEventListener('submit', async function(e){
  e.preventDefault();
  var err = $('#outErr'); err.textContent = '';
  var pid = $('#outProd').value, qtd = parseFloat($('#outQtd').value);
  if (!pid) { err.textContent = 'Escolha um produto.'; return; }
  if (!(qtd > 0)) { err.textContent = 'Informe uma quantidade maior que zero.'; $('#outQtd').focus(); return; }
  var tamanho=$('#outSize').value, produto=pMap.get(pid);
  if((produto.tamanhos || []).length && (!tamanho || !Number.isInteger(qtd))){err.textContent='Selecione a numeração e informe uma quantidade inteira de pares.';return;}
  if(tamanho && qtd>sizeBalance(pid,tamanho==='__none__'?'':tamanho)){err.textContent='Saldo insuficiente para esta numeração.';return;}
  var p = pMap.get(pid), r = calcMap.get(pid);
  if (r3(qtd) > r.saldo) {
    err.textContent = 'Saldo insuficiente: há ' + nf.format(r.saldo) + ' ' + (p.unidade || '') + ' em estoque.'; return;
  }
  var mv = {id: uid(), produtoId: pid, tamanho: tamanho==='__none__'?'':tamanho, tipo: 'saida', qtd: r3(qtd), motivo: $('#outMotivo').value, data: $('#outData').value || today(), obs: $('#outObs').value.trim(), ts: Date.now()};
  var ok = await run(function(){ return put('movimentos', mv); }, 'Saída registrada');
  if (ok) { $('#outQtd').value = ''; $('#outObs').value = ''; updCalc('out'); }
});

['in', 'out'].forEach(function(k){
  $('#'+k+'Size').addEventListener('change',function(){updCalc(k);});
  $('#' + k + 'Qtd').addEventListener('input', function(){ updCalc(k); });
  $('#' + k + 'Prod').addEventListener('change', function(){
    if (k === 'in') { var p = pMap.get($('#inProd').value); $('#inCusto').value = p && p.custo ? p.custo : ''; }
    updCalc(k);
  });
});

/* Filtros */
function bindFilter(prefix,renderFilter){
  var capital=prefix==='stock'?'Stock':'History';
  $('#'+prefix+'Filters').addEventListener('change',function(e){
    var input=e.target;
    if(input.id==='all'+capital+'Sizes') {S[prefix+'AllSizes']=input.checked;S[prefix+'Sizes']=[];}
    else if(input.name===prefix+'Size') {S[prefix+'AllSizes']=false;S[prefix+'Sizes']=$$('input[name="'+prefix+'Size"]:checked').map(function(x){return x.value;});}
    else {
      var suffix=input.name===prefix+'Status'?'Statuses':input.name===prefix+'Type'?'Types':null;
      if(!suffix) return;
      S[prefix+suffix]=input.value==='todos' ? (input.checked?['todos']:[]) : $$('input[name="'+input.name+'"]:checked').filter(function(x){return x.value!=='todos';}).map(function(x){return x.value;});
    }
    renderFilter();
  });
  $('#clear'+capital+'Filters').addEventListener('click',function(){
    S[prefix+'Sizes']=[];S[prefix+'Statuses']=[];S[prefix+'AllSizes']=false;
    if(prefix==='history') S.historyTypes=[];
    renderFilter();
  });
}
bindFilter('stock',renderEstoque);
bindFilter('history',renderHist);
$('#qEstoque').addEventListener('input', function(e){ S.qEstoque = e.target.value; renderEstoque(); });
$('#qHist').addEventListener('input', function(e){ S.qHist = e.target.value; renderHist(); });
/* Cliques gerais */
document.addEventListener('click', async function(e){
  ['stock','history'].forEach(function(prefix){var filter=$('#'+prefix+'Filters');if(!filter.contains(e.target)) filter.open=false;});
  var t = e.target.closest('[data-go],[data-act],[data-del-mov],[data-close],[data-newprod],[data-detail]');
  if (e.target.classList && e.target.classList.contains('overlay')) {
    if (e.target.id === 'ovConf') endConfirm(false); else closeOv('#' + e.target.id);
    return;
  }
  if (!t) return;
  if(t.hasAttribute('data-detail')){var detail=document.getElementById(t.dataset.detail);detail.hidden=!detail.hidden;t.setAttribute('aria-expanded',String(!detail.hidden));return;}
  if (t.hasAttribute('data-go')) { go(t.getAttribute('data-go')); return; }
  if (t.hasAttribute('data-newprod')) { openProd(null); return; }
  if (t.hasAttribute('data-close')) { closeOv('#ovProd'); return; }
  if (t.hasAttribute('data-act')) {
    var a = t.getAttribute('data-act'), id = t.getAttribute('data-id');
    if (a === 'in') goForm('in', id); else if (a === 'out') goForm('out', id); else if (a === 'edit') openProd(id);
    return;
  }
  if (t.hasAttribute('data-del-mov')) {
    var mid = t.getAttribute('data-del-mov');
    var yes = await askConfirm('Excluir movimentação', 'O saldo do produto será recalculado sem essa movimentação.', 'Excluir');
    if (yes) run(function(){ return del('movimentos', mid); }, 'Movimentação excluída');
  }
});
$('#btnNovo').addEventListener('click', function(){ openProd(null); });
$('#cfYes').addEventListener('click', function(){ endConfirm(true); });
$('#cfNo').addEventListener('click', function(){ endConfirm(false); });
document.addEventListener('keydown', function(e){
  if (e.key !== 'Escape') return;
  var filter=$$('.stock-filters').find(function(item){return item.open;});
  if(filter){filter.open=false;$('summary',filter).focus();return;}
  if (!$('#ovConf').hidden) endConfirm(false);
  else if (!$('#ovProd').hidden) closeOv('#ovProd');
});

$('#btnRmEx').addEventListener('click', async function(){
  var yes = await askConfirm('Remover exemplos', 'Os produtos e movimentações de exemplo serão excluídos. O que você cadastrou continua.', 'Remover');
  if (!yes) return;
  run(async function(){
    var ms = S.movimentos.filter(function(m){ return m.exemplo; }), ps = S.produtos.filter(function(p){ return p.exemplo; });
    for (var i = 0; i < ms.length; i++) await del('movimentos', ms[i].id);
    for (var j = 0; j < ps.length; j++) await del('produtos', ps[j].id);
  }, 'Exemplos removidos');
});

/* ---------- Início ---------- */
$('#inData').value = today();
$('#outData').value = today();

async function loadServerData(){
  S.ready=false;$('#serverError').hidden=true;
  try{
    var data=await requestApi('',{method:'GET'});
    S.produtos=data.produtos;S.movimentos=data.movimentos;S.ready=true;
    var empty=!S.produtos.length && !S.movimentos.length;
    $('#fileImport').hidden=!empty;
    var legacy=null;try{legacy=JSON.parse(localStorage.getItem(LS_KEY) || 'null');}catch(e){}
    $('#legacyImport').hidden=!(empty && legacy && ((legacy.produtos || []).length || (legacy.movimentos || []).length));
  }catch(e){$('#serverError').hidden=false;}
  render();
}
async function importBackup(data){
  var yes=await askConfirm('Importar dados','Importar os produtos e movimentações deste backup para a conta conectada? Confirme que os dados pertencem a você. A cópia original será mantida.','Importar');
  if(!yes) return;
  var ok=await run(function(){return requestApi('?action=import',{method:'POST',body:JSON.stringify(data)});},'Dados importados');
  if(ok) await loadServerData();
}
$('#retryLoad').onclick=loadServerData;
$('#importLocal').onclick=async function(){
  try{await importBackup(JSON.parse(localStorage.getItem(LS_KEY)));}catch(e){toast('Não foi possível ler os dados locais.');}
};
$('#backupFile').onchange=async function(e){
  var file=e.target.files[0];if(!file)return;
  try{if(file.size>2097152)throw new Error();await importBackup(JSON.parse(await file.text()));}catch(err){toast('Selecione um backup JSON válido de até 2 MB.');}
  e.target.value='';
};
async function boot(){
  var h = '';
  try { h = location.hash.replace('#', ''); } catch (e) {}
  go(VIEWS.indexOf(h) >= 0 ? h : 'painel', true);

  await loadServerData();
}
boot();
})();
</script>

</body></html>
