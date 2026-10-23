# Josyanne Portela Gerencial

Sistema de estoque de calçados com login por e-mail e senha. A aplicação usa PHP 8.2+ e MySQL 8+ ou MariaDB 10.6+, com as extensões PDO e pdo_mysql. Não há dependências Composer ou npm.

## Publicar na Hostinger

Esta versão precisa de hospedagem PHP e banco MySQL: não funciona como aplicativo estático no GitHub Pages nem abrindo o HTML com dois cliques. O arquivo `index.html` apenas encaminha para `index.php`.

1. Faça um backup dos arquivos atuais e dos dados antigos antes de substituir a versão existente.
2. No hPanel, ative o certificado SSL e force HTTPS. Selecione PHP 8.2 ou mais recente e confirme que `pdo_mysql` está habilitado.
3. Crie um banco MySQL e um usuário com acesso a ele. No phpMyAdmin desse banco, importe `schema.sql`. O script cria as tabelas com prefixo `jp_`; não remove outras tabelas.
4. Envie os arquivos do projeto para `public_html`, incluindo `.htaccess` e `app/.htaccess`. Não envie `.git`, `tests`, arquivos de configuração locais ou backups do banco. A página inicial deve ser `index.php`; remova páginas iniciais antigas que possam ter precedência.
5. Copie `app/config.example.php` para um arquivo chamado `jp-config.php` **na pasta imediatamente acima de `public_html`**. Preencha os dados MySQL do hPanel. Mantenha esse arquivo fora da pasta pública e nunca o envie ao GitHub.
6. Em `setup_token`, coloque uma chave aleatória com pelo menos 32 caracteres, gerada pelo seu gerenciador de senhas. Não reutilize a senha da conta ou do MySQL. Mantenha `secure_cookies` como `true`.
7. Acesse `https://SEU-DOMINIO/setup.php`, informe a chave, o e-mail e uma senha de 12 a 72 caracteres. Não existe usuário ou senha padrão. Ao criar a primeira conta, essa página é automaticamente desativada.
8. Entre em `https://SEU-DOMINIO/login.php`. Depois, esvazie `setup_token` no arquivo privado e remova `setup.php` do servidor como limpeza de instalação.
9. Teste uma entrada e uma saída, recarregue a página e confirme a persistência. Clique em **Sair** e confirme que `index.php` volta a pedir login.

Se a hospedagem não permitir o arquivo na pasta superior, a alternativa é `app/config.local.php`, que está ignorado pelo Git e protegido pelo `.htaccess`. Antes de usá-lo, confirme que o endereço `/app/config.local.php` responde com 403/404. Não use essa alternativa em servidor que ignore `.htaccess`. O servidor embutido do PHP é apenas para desenvolvimento.

## Dados anteriores

Os dados da versão antiga ficavam no `localStorage` do navegador. Eles não são enviados ao servidor automaticamente. Se a nova instalação usar o mesmo endereço e navegador, a conta vazia oferece **Importar dados deste navegador**, com confirmação. A importação é uma transação e só é permitida em conta sem registros. A cópia local é preservada. Não importe dados de outra pessoa em sua conta.

Ao trocar de domínio (por exemplo, de GitHub Pages para Hostinger), o novo site não consegue ler o armazenamento do endereço anterior. Antes de substituí-lo, abra o site antigo, acesse o console de desenvolvedor do navegador e execute este código para baixar um backup:

```js
const dados = localStorage.getItem('jp-gerencial-v1');
if (!dados) throw new Error('Nenhum dado local encontrado neste endereço.');
const arquivo = URL.createObjectURL(new Blob([dados], {type: 'application/json'}));
const link = document.createElement('a');
link.href = arquivo;
link.download = 'jp-estoque-backup.json';
link.click();
setTimeout(() => URL.revokeObjectURL(arquivo), 1000);
```

No novo site, entre na conta vazia e use **Selecionar backup**. São aceitos arquivos JSON de até 2 MB. Verifique os produtos e o histórico importados antes de limpar os dados do endereço antigo. Os dados antigos que continuam no `localStorage` não passam a ser protegidos pelo login; mantenha o backup e limpe essa cópia pelo navegador somente depois de conferir a migração.

## Proteção e operação

- O servidor verifica a sessão antes de entregar o sistema e em cada acesso à API. Os registros são associados ao ID da conta no servidor, sem aceitar um proprietário enviado pelo navegador.
- Senhas usam `password_hash`/`password_verify`. Sessões usam cookies HttpOnly, SameSite=Lax e Secure em produção, rotação de ID ao entrar, limite de 30 minutos de inatividade e 12 horas de duração.
- Formulários e operações de escrita exigem token CSRF. Consultas usam parâmetros preparados. O login limita tentativas por conta e IP em janelas de 15 minutos.
- Não há cadastro público nem envio de recuperação de senha por e-mail. A primeira versão é para uma conta administradora. Para criar outra conta ou redefinir uma senha, o responsável pode usar `tools/manage-user.php` pelo terminal da hospedagem, conforme abaixo.
- Faça backups regulares do MySQL pelo hPanel e proteja também a conta da Hostinger. Não coloque senhas, backups ou dados de clientes no repositório.

### Criar conta adicional ou redefinir senha

No terminal, na pasta do projeto, execute `php tools/manage-user.php email@exemplo.com`. O comando cria a conta se ela não existe ou atualiza somente sua senha. A senha é lida pela entrada padrão e não deve ser passada como argumento. Use um terminal privado: a entrada pode aparecer na tela se o terminal não estiver configurado para ocultá-la. O arquivo rejeita execução via navegador. As sessões existentes dessa conta serão invalidadas na próxima verificação do servidor.

## Desenvolvimento e testes

Use um banco dedicado de desenvolvimento. Copie a configuração para fora da raiz pública e aponte a variável `JP_CONFIG_FILE` para ele. Somente em desenvolvimento local por HTTP, defina `secure_cookies` como `false`. Importe `schema.sql` e inicie `php -S 127.0.0.1:8000`. Não crie worktrees para usar este projeto, a menos que sejam explicitamente solicitados.

Os testes de integração exigem um banco de testes vazio, PHP e Playwright Python. Veja `tests/auth_smoke.py`; execute apenas contra uma instância descartável, nunca contra dados de produção.

Publicar arquivos no GitHub não publica nem configura o site na Hostinger. O banco, o arquivo privado, o SSL e a primeira conta precisam ser configurados no hPanel. Nenhuma senha de produção deve ser enviada em chat.
