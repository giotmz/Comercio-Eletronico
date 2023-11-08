# Instruções

Primeiramente, crie o arquivo `.env` com base no `.env.example`

Depois, rode o comando: `php artisan migrate`

Obs.: Certifique-se de ter um arquivo `database.sqlite` na pasta `./database`

Após isso, digite `php -S localhost:8000 -t public` para subir a aplicação

A documentação da API pode ser encontrada em `http://localhost:8000/api/openapi.yaml`