<?php

require __DIR__ . '/../vendor/autoload.php';
require 'client.php';

/* CONSTANTES */

const OP_SAIR = 'Sair';
const OP_CANCELAR = 'Cancelar';
const OP_ADICIONAR = 'Adicionar produto';
const OP_EXCLUIR = 'Excluir produto';
const OP_ATUALIZAR = "Atualizar produto";

const OP_INVALIDA = 'Operação inválida';



/* CLASSES */

/**
 * Interface CLI para o Microblog.
 */
class Main {

    /**
     * @param Main cliente_microblog - Cliente da API do Microblog.
     * @param string temp_msg - Uma mensagem temporária a ser exibida uma vez.
     */
    public function __construct(private Client $client, private string $temp_msg = '') {}


    /**
     * Exibe o menu principal em loop.
     */
    public function menuPrincipal() {
        do {
            $this->limparTela();

            $this->exibirTitulo();
        
            $produtos = $this->client->getAllProducts();
            $this->exibirProdutos($produtos);
        
            $this->exibirMensagemTemporaria();
            
            echo "\n";
            $operacao = $this->menuOperacoes();
        
            switch ($operacao) {
                case OP_SAIR:
                    # Não faz nada, apenas sai
                    break;
                case OP_ADICIONAR:
                    $p = $this->menuAdicionarProduto();
                    $this->client->createProduct($p);
                    break;
                case OP_ATUALIZAR:
                    $p = $this->menuAtualizarProduto();
                    $this->client->updateProduct($p, $p['id']);
                    break;
                case OP_EXCLUIR:
                    $id = $this->menuExcluirProduto();
                    $resposta = $this->client->deleteProduct($id);
                    $this->exibirErroNaResposta($resposta);
                    break;
            }
        } while ($operacao != OP_SAIR);
        
        $this->tchau();
    }


    /**
     * Limpa a tela do terminal.
     */
    private function limparTela() {
        echo "\033c";
    }

    
    /**
     * Exibe o título da aplicação.
     */
    public function exibirTitulo() {
        echo
        "\r---------------------------------------------------------------------
        \r                            E-COMMERCE
        \r---------------------------------------------------------------------
        ";
    }


    /**
     * Exibe a lista de publicações.
     * 
     * @param array publicacoes - lista de publicações.
     */
    public function exibirProdutos($produtos) {
        foreach ($produtos as $p) {
            echo "
            \rID: $p->id
            \rNome: $p->name
            \rEstoque: $p->stock
            \rPreço: $p->price
            \rDescricão: $p->description
            \rCriado em: $p->created_at
            \r";
        }
    }
    
    
    /**
     * Exibe a lista de operações disponíveis e retorna a que o usuário
     * escolher.
     */
    public function menuOperacoes(): string {
        echo "Operações:\n";
        $operacoes = [
            1 => OP_ADICIONAR,
            2 => OP_EXCLUIR,
            3 => OP_ATUALIZAR,
            0 => OP_SAIR
        ];
        foreach ($operacoes as $i => $op) {
            echo "[$i] $op\n";
        }

        $escolhida = (int) readline('O que você deseja fazer? ');

        if ($escolhida >= count($operacoes) || $escolhida < 0) {
            $this->temp_msg = 'Operação inválida';
            return OP_INVALIDA;
        }
        
        return $operacoes[$escolhida];
    }


    /**
     * Exibe menu para ler os dados de um produto a ser criado.
     */
    public function menuAdicionarProduto() {
        $p = [];
        $p['name'] = readline('Escreva o nome: ');
        // echo "Escreva o texto da publicação:\n";
        $p['description'] = readline("Escreva a descricao: ");
        $p['price'] = (int) readline('Escreva o preco: ');
        $p['stock'] = (int) readline('Digite o estoque: ');
        return $p;
    }

    public function menuAtualizarProduto() {
        $p = [];
        $p['id'] = (int) readline('Digite o id do produto que você deseja atualizar: ');
        $p['name'] = readline('Escreva o novo nome: ');
        // echo "Escreva o texto da publicação:\n";
        $p['description'] = readline("Escreva a nova descricao: ");
        $p['price'] = (int) readline('Escreva o novo preco: ');
        $p['stock'] = (int) readline('Digite o novo estoque: ');
        return $p;
    }


    /**
     * Exibe menu para ler o id de um produto a ser excluido.
     */
    public function menuExcluirProduto() {
        $id = (int) readline('Digite o id do produto que você deseja excluir: ');
        return $id;
    }


    /**
     * Exibe uma mensagem temporária, que é apagada em seguida.
     */
    public function exibirMensagemTemporaria() {
        if ($this->temp_msg != '') {
            echo "\n$this->temp_msg\n";
            $this->temp_msg = '';
        }
    }


    /**
     * Exibe uma possível a mensagem de reposta de erro.
     * Se não houver erro, nada é exibido.
     */
    public function exibirErroNaResposta($resposta) {
        if ($resposta->getStatusCode() != 200) {
            $msg = json_decode($resposta->getBody());
            $this->temp_msg = "[$msg->tipo] $msg->conteudo";
        }
    }


    /**
     * Exibe uma mensagem de despedida.
     */
    public function tchau() {
        echo "\nObrigado por usar o E-commerce :)\n\n";
    }
}



/* PROGRAMA PRINCIPAL */


$client = new Client('http://localhost:8000/');
$interface = new Main($client);
$interface->menuPrincipal();