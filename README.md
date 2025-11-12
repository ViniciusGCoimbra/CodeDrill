<!-- duplicate block removed -->

# CodeDrill

Aplicação web educativa em PHP (protótipo) com autenticação, área de perfil e ambiente de desenvolvimento integrado.

Status: protótipo / desenvolvimento

## Requisitos

- PHP 7.4+ (ou compatível)
- MySQL / MariaDB
- Servidor local: XAMPP, WAMP, Laragon ou similar

## Instalação rápida

1. Copie a pasta `Codedrill` para a pasta pública do seu servidor (ex.: `C:\\xampp\\htdocs\\Codedrill`).
2. Importe o banco de dados (opcional): `config/codedrill_db.sql`.
3. Atualize credenciais de banco em `config/conexao.php` / `config/config.php`.
4. Acesse `http://localhost/Codedrill/public/`.

## Funcionalidades principais

- Cadastro, login e logout de usuários.
- Página de perfil (`public/perfil.php`) para alterar nome e avatar (avatares padrões + upload para `public/uploads/avatars/`).
- Sidebar responsiva com estado minimizado persistido via localStorage.
- Página de desenvolvimento/compilador (`public/compilador.php`) com editor integrado (CodeMirror) — estrutura pronta para integrar uma API de execução/compilação.
- Proteções básicas: limite de tentativas de login, validações no upload.

## Estrutura de pastas

```
Codedrill/
├── config/                 # conexao.php, config.php, SQL dump (codedrill_db.sql)
├── functions/              # ações do back-end (cadastroaction.php, loginaction.php, update_profile.php, logout.php ...)
├── includes/               # cabeçalho, rodapé, sidebar e componentes reutilizáveis
├── public/                 # arquivos públicos
│   ├── assets/
│   │   ├── css/            # custom.css
│   │   ├── js/             # sidebar.js, ui.js, compilador.js
│   │   ├── images/         # logos, avatares, mascote
│   │   └── fonts/
│   ├── uploads/avatars/    # uploads de avatar
│   ├── cadastro.php        # modal/página de cadastro
│   ├── login.php           # modal/página de login
│   ├── inicio.php          # página inicial / dashboard
│   ├── perfil.php          # edição de perfil (anteriormente configuracoes.php)
│   ├── configuracoes.php   # redireciona para perfil (compatibilidade)
│   ├── compilador.php      # ambiente de dev / editor
│   ├── sobre.php
│   └── ...
└── README.md
```

## Segurança e observações

- As senhas devem ser sempre validadas e armazenadas com hashing seguro (ex.: `password_hash`). Verifique `functions/cadastroaction.php`.
- Limites de login são registrados em um arquivo temporário; para produção, use armazenamento mais robusto (BD / cache).
- Ao habilitar uploads, valide extensão, MIME type e aplique medidas contra upload de conteúdo malicioso.

## Desenvolvimento e próximos passos

- Integrar um serviço de execução/sandbox (ex.: Judge0) para compilar/rodar código com segurança.
- Implementar testes automatizados e validação adicional no servidor.
- Documentar endpoints e fluxo de autenticação se for ampliar a API.

---

Se quiser, atualizo este README com instruções específicas para Windows/XAMPP (ex.: como configurar `php.ini`, permissões de pasta `uploads/`) ou incluo trechos de exemplos de `config/conexao.php`.



