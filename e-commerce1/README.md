# Instruções
Primeiramente dar um composer update, caso der erro, ensira um arquivo vendor

Crie o arquivo .env com os dados: <br>
APP_NAME=Lumen
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost
APP_TIMEZONE=UTC
LOG_CHANNEL=stack
LOG_SLACK_WEBHOOK_URL=
DB_CONNECTION=sqlite
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
<br>
Depois, rode o comando: `php artisan migrate`

Obs.: Certifique-se de ter um arquivo `database.sqlite` na pasta `./database`

Após isso, digite `php -S localhost:8000 -t public` para subir a aplicação

A documentação da API pode ser encontrada em `http://localhost:8000/api/openapi.yaml`
