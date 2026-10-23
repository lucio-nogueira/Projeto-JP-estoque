<?php
// Copie para jp-config.php FORA de public_html. Nunca envie senhas ao GitHub.
return [
    'dsn' => 'mysql:host=localhost;dbname=SEU_BANCO;charset=utf8mb4',
    'db_user' => 'SEU_USUARIO_MYSQL',
    'db_password' => '',
    'setup_token' => '', // Gere uma chave aleatória com pelo menos 32 caracteres.
    'secure_cookies' => true, // Mantenha true na Hostinger: o site exige HTTPS.
];
