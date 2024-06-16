<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'conexao.php';

class ProdutoController
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectionFactory::conexaoMysqli(); // Conecta ao banco
        if ($this->conn->connect_error) {
            $this->sendError("Conexão falhou: " . $this->conn->connect_error);
        }
    }

    private function sendError($message)
    {
        echo json_encode(['error' => $message]);
        exit;
    }

    private function execute_query($sql, $params)
    {
        $query = $this->conn->prepare($sql);
        if ($query === false) {
            $this->sendError("Erro na preparação da query2: " . $this->conn->error);
        }

        if ($params) {
            $query->bind_param(...$params);
        }

        if (!$query->execute()) {
            $this->sendError("Erro na execução da query2: " . $query->error);
        }

        $result = $query->get_result();
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    private function calcular_valor($produtos)
    {
        $valor_total = 0;

        foreach ($produtos as $produto) {
            $id = $produto['id'];

            // Obtém o valor do produto com base no ID do banco de dados
            $sql = "SELECT valor FROM estoque WHERE id_produtos = ?";
            $result = $this->execute_query($sql, ['i', $id]);

            if (!empty($result)) {
                $valor_total += $result[0]['valor'];
            } else {
                // Valor padrão se o ID não estiver na tabela
                $valor_total += 0;
            }
        }

        return $valor_total;
    }

    private function salvar_pedido($id_usuario, $valor, $produtos)
    {
        $status_pedido = 'pendente';
        $id_produtos = json_encode($produtos); // Converte array de produtos para JSON
        $data_pedido = date('Y-m-d H:i:s'); // Data atual
        $letters = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
        $numbers = substr(str_shuffle("0123456789"), 0, 10);
        $id = $letters . $numbers;
        $sql = "INSERT INTO carrinho (id_carrinho, id_usuario, valor, status_pedido, id_produtos, data_pedido) VALUES (?, ?, ?, ?, ?, ?)";
        $query = $this->conn->prepare($sql);
        if ($query === false) {
            $this->sendError("Erro na preparação da query1: " . $this->conn->error);
        }

        $query->bind_param('ssdsss', $id, $id_usuario, $valor, $status_pedido, $id_produtos, $data_pedido);
        if (!$query->execute()) {
            $this->sendError("Erro na execução da query1: " . $query->error);
        }
    }

    public function processar_json($json)
    {
        $produtos = json_decode($json, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            // Calculando o valor total
            $valor_total = $this->calcular_valor($produtos);

            // Obtendo id_usuario da sessão
            session_start();
            if (!isset($_SESSION['id'])) {
                $this->sendError("ID do usuário não encontrado na sessão.");
            }
            $id_usuario = $_SESSION['id'];
            // Salvando pedido no banco de dados
            $this->salvar_pedido($id_usuario, $valor_total, $produtos);

            // Retornando o resultado como JSON
            echo json_encode(['valor_total' => $valor_total]);
        } else {
            $this->sendError('Erro ao decodificar JSON: ' . json_last_error_msg());
        }
    }
}

// Cria uma instância do ProdutoController e processa o JSON de entrada
$controller = new ProdutoController();
$json = file_get_contents('php://input');
$controller->processar_json($json);
