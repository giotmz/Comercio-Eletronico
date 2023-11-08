# Instruções
Primeiramente dar um composer update, caso der erro, ensira um arquivo vendor

Crie o arquivo .env com os dados: <br>
<br>APP_NAME=Lumen 
<br>APP_ENV=local
<br>APP_KEY=
<br>APP_DEBUG=true
<br>APP_URL=http://localhost
<br>APP_TIMEZONE=UTC
<br>LOG_CHANNEL=stack
<br>LOG_SLACK_WEBHOOK_URL=
<br>DB_CONNECTION=sqlite
<br>CACHE_DRIVER=file
<br>QUEUE_CONNECTION=sync
<br>
Depois, rode o comando: `php artisan migrate`

Obs.: Certifique-se de ter um arquivo `database.sqlite` na pasta `./database`

Após isso, digite `php -S localhost:8000 -t public` para subir a aplicação

A documentação da API pode ser encontrada em `http://localhost:8000/api/openapi.yaml`
