<?php
require 'conexao.php'; // Inclua o arquivo de conexão com o banco de dados
$conn = connectionFactory::conexaoMysqli();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $idCarrinho = $data['id_carrinho'] ?? null;

    if ($idCarrinho) {
        $stmt = $conn->prepare("DELETE FROM carrinho WHERE id_carrinho = ?");
        $stmt->bind_param("s", $idCarrinho);

        if ($stmt->execute()) {
            echo 'success';
        } else {
            echo 'error';
        }

        $stmt->close();
    } else {
        echo 'error';
    }
} else {
    echo 'invalid';
}

$conn->close();
