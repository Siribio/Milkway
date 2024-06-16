<?php
require_once('check_redirect.php');

require 'elementos_sistema.php';


require_once 'conexao.php';

// Função para buscar pedidos do usuário
function getUserOrders($userId)
{
    $conn = connectionFactory::conexaoMysqli();
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM carrinho WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    $orders = [];
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }

    $stmt->close();
    $conn->close();

    return $orders;
}

// Recuperar ID do usuário da sessão
$userId = $_SESSION['id'];
$totalValor = 0;
// Buscar pedidos do usuário
$orders = getUserOrders($userId);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/css/header/header.css">
    <link rel="stylesheet" href="./src/css/main.css">
    <link rel="stylesheet" href="./src/css/carrinho/carrinho.css">
    <link rel="icon" href="./src/img/logo_milkway.png" type="image/png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Carrinho de compras</title>
</head>

<body>
    <?php
    $elemento = new elementos_sistema();
    $elemento->imprimir_nav_bar();
    ?>
    <div id="mensagem" class="mensagem">Pedido Realizado! <i class='bx bxs-check-circle'></i></div>

    <main class="carrinho">
        <h4>
            <i class='bx bxs-cart'></i>
            Carrinho de compra
        </h4>
        <div class="infos">
            <div class="in_t in_td">Produto</div>
            <div class="in_t in_tq">Preço</div>
            <div class="in_t in_tp">Excluir</div>
        </div>
        <div class="sec_carrinho">
            <?php foreach ($orders as $order) :
                if ($order['id_usuario'] === $userId) {
                    $details = json_decode($order['id_produtos'], true);
                    $sabores = count(array_filter($details, fn ($item) => $item['tipo'] === 'SAB'));
                    $acompanhamentos = count(array_filter($details, fn ($item) => $item['tipo'] === 'ACOM'));
                    $totalValor += $order['valor']; // Adiciona o valor do pedido ao total
            ?>
                    <div class="pedido">
                        <div class="sp_produto">
                            <div class="sp_img">
                                PEDIDO
                            </div>
                            <div class="sp_desc">
                                <span class="pedido_span"><strong>Quantidade de sabores: <?php echo $sabores; ?></strong></span>
                                <span class="pedido_span"><strong>Acompanhamentos:
                                        <?php echo $acompanhamentos; ?></strong></span>
                                <span class="pedido_span id_span">ID do pedido: <?php echo $order['id_carrinho']; ?></span>
                            </div>
                        </div>
                        <div class="sp_quantidade">
                            <span>R$ <?php echo number_format($order['valor'], 2, ',', '.'); ?></span>

                        </div>
                        <div class="sp_excluir">
                            <i class='bx bxs-x-circle' data-id="<?php echo $order['id_carrinho']; ?>"></i>

                        </div>
                    </div>
            <?php
                }
            endforeach;
            ?>
        </div>
        <!-- <div class="sec_carrinho">
            <div class="pedido">
                <div class="sp_produto">
                    <div class="sp_img">
                        PEDIDO
                    </div>
                    <div class="sp_desc">
                        <span class="pedido_span"><strong>Quantidade de sabores: 2</strong></span>
                        <span class="pedido_span"><strong>Acompanhamentos: 4</strong></span>
                        <span class="pedido_span">ID do pedido: DSA3298D</span>
                    </div>
                </div>
                <div class="sp_quantidade">
                    <input type="number" name="" id="">
                </div>
                <div class="sp_preco">
                    <span>R$ 90,00</span>
                </div>
            </div>
            <div class="pedido">
                <div class="sp_produto">
                    <div class="sp_img">
                        PEDIDO
                    </div>
                    <div class="sp_desc">
                        <span class="pedido_span"><strong>Quantidade de sabores: 2</strong></span>
                        <span class="pedido_span"><strong>Acompanhamentos: 4</strong></span>
                        <span class="pedido_span">ID do pedido: DSA3298D</span>
                    </div>
                </div>
                <div class="sp_quantidade">
                    <input type="number" name="" id="">
                </div>
                <div class="sp_preco">
                    <span>R$ 90,00</span>
                </div>
            </div>
            <div class="pedido">
                <div class="sp_produto">
                    <div class="sp_img">
                        PEDIDO
                    </div>
                    <div class="sp_desc">
                        <span class="pedido_span"><strong>Quantidade de sabores: 2</strong></span>
                        <span class="pedido_span"><strong>Acompanhamentos: 4</strong></span>
                        <span class="pedido_span">ID do pedido: DSA3298D</span>
                    </div>
                </div>
                <div class="sp_quantidade">
                    <input type="number" name="" id="">
                </div>
                <div class="sp_preco">
                    <span>R$ 90,00</span>
                </div>
            </div>
            <div class="pedido">
                <div class="sp_produto">
                    <div class="sp_img">
                        PEDIDO
                    </div>
                    <div class="sp_desc">
                        <span class="pedido_span"><strong>Quantidade de sabores: 2</strong></span>
                        <span class="pedido_span"><strong>Acompanhamentos: 4</strong></span>
                        <span class="pedido_span">ID do pedido: DSA3298D</span>
                    </div>
                </div>
                <div class="sp_quantidade">
                    <input type="number" name="" id="">
                </div>
                <div class="sp_preco">
                    <span>R$ 90,00</span>
                </div>
            </div>
        </div> -->
        <div class="sec_finalizar">
            <div class="sf_cep">
                <div class="sf_sec">
                    <input type="text" name="" id="">
                    <div class="btn_frete">calcular</div>
                </div>

            </div>
            <div class="sf_total">
                <div class="sft sft_frete">
                    <span>Valor Frete:</span>
                    <span>RS 10,00</span>
                </div>
                <div class="sft sft_total">
                    <span>Valor Pedido:</span>
                    <span>R$ <?php echo number_format($totalValor, 2, ',', '.'); ?></span>
                </div>
                <div class="sft sft_pagar">
                    <span>Valor Total:</span>
                    <span>RS <?php echo number_format($totalValor + 10, 2, ',', '.'); ?></span>
                </div>
            </div>
        </div>
    </main>

    <div class="btn_finalizar" data-id="<?php echo $_SESSION['id']; ?>">
        Finalizar compra
    </div>

    <script src="./src/js/mobile.js"></script>
    <script src="./src/js/feed_infos.js"></script>
    <script src="./src/js/carrinho.js"></script>
</body>

</html>