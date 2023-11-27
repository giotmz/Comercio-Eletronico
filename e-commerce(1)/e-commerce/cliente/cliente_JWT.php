<?php

require 'vendor/autoload.php';
require 'credenciais.php';

use GuzzleHttp\Client;

$baseURL = 'localhost:8000'; 
$cliente_http = new Client(['base_uri' => $baseURL]);

do {
    // Adicionando opções de rotas do cliente
    $opcao = readline("Escolha uma opção (1-5): ");

    switch ($opcao) {
        case 1:
            listarProdutos();
            break;

        case 2:
            cadastrarProduto();
            break;

        case 3:
            visualizarProduto();
            break;

        case 4:
            atualizarProduto();
            break;

        case 5:
            deletarProduto();
            break;

        default:
            echo "Opção inválida\n";
            break;
    }
} while (true); // O loop executa indefinidamente, ajuste conforme necessário

# Funções

function listarProdutos() {
    global $cliente_http;
    $response = $cliente_http->get('/products');
    echo $response->getBody();
}

function cadastrarProduto() {
    global $cliente_http;
    $data = [
        'name' => readline("Nome do Produto: "),
        'description' => readline("Descrição do Produto: "),
        'price' => readline("Preço do Produto: "),
        'stock' => readline("Estoque do Produto: "),
    ];

    $response = $cliente_http->post('/products', ['form_params' => $data]);
    echo $response->getBody();
}

function visualizarProduto() {
    global $cliente_http;
    $id = readline("Digite o ID do produto: ");
    $response = $cliente_http->get("/products/{$id}");
    echo $response->getBody();
}

function atualizarProduto() {
    global $cliente_http;
    $id = readline("Digite o ID do produto: ");
    $data = [
        'name' => readline("Novo Nome do Produto: "),
        'description' => readline("Nova Descrição do Produto: "),
        'price' => readline("Novo Preço do Produto: "),
        'stock' => readline("Novo Estoque do Produto: "),
    ];

    $response = $cliente_http->put("/products/{$id}", ['form_params' => $data]);
    echo $response->getBody();
}

function deletarProduto() {
    global $cliente_http;
    $id = readline("Digite o ID do produto: ");
    $response = $cliente_http->delete("/products/{$id}");
    echo $response->getBody();
}
