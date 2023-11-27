<?php

require __DIR__ . '/../vendor/autoload.php';
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;

class Client{
    private array $routes;
    private GuzzleHttp\Client $client;

    public function __construct(private string $host = "http://localhost:8000/api/"){
        $this->client = new GuzzleClient([
            'base_uri' => $this->host,
            'http_errors' => false
        ]);
    }

    /**
     * Retorna todos os produtos
     */
    public function getAllProducts(): array
    {
        
        $response = $this->client->request('GET', 'products');
        $products = json_decode($response->getBody());
        return $products;
    }

    /**
     * @param array $product - array com os dados do novo produto
     * 
     * Cria um novo produto
     */
    public function createProduct(array $product)
    {
        $response = $this->client->post('products', ['json' => $product]);
        return $response;
    }

    /**
     * @param array $product - array com os dados para atualizar o produto
     * @param int $id - id do produto
     * 
     * Atualiza um produto
     */
    public function updateProduct(array $product, int $id)
    {
        $response = $this->client->put('products/' . $id, ['json' => $product]);
        return $response;
    }

    /**
     * @param int $id - id do produto
     * 
     * Deleta um produto
     */
    public function deleteProduct(int $id)
    {
        $response = $this->client->delete('products/' . $id);
        return $response;
    }

}