<?php
require 'conexao.php'; // Inclua o arquivo de conexão com o banco de dados
$conn = connectionFactory::conexaoMysqli();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    function gerarIdPedido()
    {
        $letras = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 4);
        $numeros = substr(str_shuffle("0123456789"), 0, 7);
        return $letras . $numeros;
    }
    function atualizarEstoque($conn, $id_usuario)
    {
        // Prepara e executa a consulta para pegar o carrinho do usuário
        $sqlCarrinho = "SELECT id_produtos, valor FROM carrinho WHERE id_usuario = ?";
        $stmtCarrinho = $conn->prepare($sqlCarrinho);
        $stmtCarrinho->bind_param("s", $id_usuario);
        $stmtCarrinho->execute();
        $resultCarrinho = $stmtCarrinho->get_result();

        if ($resultCarrinho->num_rows > 0) {
            $valorTotal = 10;
            $id_produtos_array = [];

            // Itera por todas as linhas do carrinho
            // Itera por todas as linhas do carrinho
            while ($rowCarrinho = $resultCarrinho->fetch_assoc()) {
                $id_produtos_json = $rowCarrinho['id_produtos'];
                $produtos = json_decode($id_produtos_json, true);

                // Verifica cada produto no JSON
                foreach ($produtos as $produto) {
                    $id_produto = $produto['id'];
                    $tipo_produto = $produto['tipo'];

                    //Prepara e executa a consulta para atualizar a quantidade no estoque
                    $sqlEstoque = "UPDATE estoque SET quantidade = quantidade - 1 WHERE id_produtos = ? AND tipo = ?";
                    $stmtEstoque = $conn->prepare($sqlEstoque);
                    $stmtEstoque->bind_param("is", $id_produto, $tipo_produto);
                    $stmtEstoque->execute();
                }

                // Soma o valor total dos produtos do carrinho
                $valorTotal += $rowCarrinho['valor'];
                $id_produtos_array[] = $id_produtos_json;
            }
            // Gera um ID de pedido
            $id_pedido = gerarIdPedido();
            // Define o status do pedido
            $status_pedido = "pendente";
            // Obtém a data e hora atual
            $data_pedido = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
            $data_pedido_formatada = $data_pedido->format('Y-m-d H:i:s');
            // Converte o array de id_produtos para JSON
            $id_produtos_final = json_encode($id_produtos_array);

            // Prepara e executa a consulta para inserir o pedido
            $sqlInsertPedido = "INSERT INTO pedidos (id_pedido, id_usuario, valor, status_pedido, id_produtos, data_pedido, endereco_entrega, forma_pagamento)
                            VALUES (?, ?, ?, ?, ?, ?, '', '')";
            $stmtInsertPedido = $conn->prepare($sqlInsertPedido);
            $stmtInsertPedido->bind_param("ssdsis", $id_pedido, $id_usuario, $valorTotal, $status_pedido, $id_produtos_final, $data_pedido_formatada);
            $stmtInsertPedido->execute();

            $sqlDeleteCarrinho = "DELETE FROM carrinho WHERE id_usuario = ?";
            $stmtDeleteCarrinho = $conn->prepare($sqlDeleteCarrinho);
            $stmtDeleteCarrinho->bind_param("s", $id_usuario);
            $stmtDeleteCarrinho->execute();
            echo "Entrou";
        } else {
            echo "Nenhum carrinho encontrado para este usuário.";
        }

        // Fecha os statements
        // $stmtCarrinho->close();
        // $stmtEstoque->close();
    }
    $data = json_decode(file_get_contents('php://input'), true);
    // $id_usuario = $data['id'] ?? null;
    $id_usuario = "BZ2350";
    // Exemplo de uso da função
    atualizarEstoque($conn, $id_usuario);
}

$conn->close();
