<?php
require_once('check_redirect.php');

require 'elementos_sistema.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>usuario</title>
    <link rel="stylesheet" href="./src/css/header/header.css">
    <link rel="stylesheet" href="./src/css/main.css">
    <link rel="stylesheet" href="./src/css/usuario/usuario.css">
    <link rel="icon" href="./src/img/logo_milkway.webp type=" image/png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./src/css/carrinho/carrinho.css">

    <link rel="icon" href="./src/img/logo_milkway.png" type="image/png">


</head>

<body>
    <?php
    $elemento = new elementos_sistema();
    $elemento->imprimir_nav_bar();
    ?>

    <main class="main_user">
        <section class="profile_desc">
            <span class="pdu">Perfil do usuário</span>
            <span class="sp">Seu perfil</span>

        </section>
        <section class="sec_user">
            <h6 id="user_name">Eduardo Souza Gomes</h6>
            <section class="pedidos">
                <?php
                require_once 'conexao.php';
                $conn = connectionFactory::conexaoMysqli();
                // Verificar a conexão
                if ($conn->connect_error) {
                    die("Falha na conexão: " . $conn->connect_error);
                }

                // Consulta SQL para buscar todos os pedidos
                $sql = "SELECT id_pedido, id_usuario, valor, status_pedido, id_produtos, data_pedido FROM pedidos";
                $result = $conn->query($sql);

                // Verificar se há resultados
                if ($result->num_rows > 0) {
                    // Iterar sobre cada pedido e gerar o HTML
                    while ($row = $result->fetch_assoc()) {
                        echo '<div style="width: 100%" class="pedido">';
                        echo '    <div class="sp_produto">';
                        echo '        <div class="sp_img">';
                        echo '            PEDIDO';
                        echo '        </div>';
                        echo '        <div class="sp_desc">';
                        echo '            <span class="pedido_span id_span">ID do pedido: ' . $row["id_pedido"] . '</span>';
                        echo '        </div>';
                        echo '    </div>';
                        echo '    <div class="sp_quantidade">';
                        echo '        <span>R$ ' . number_format($row["valor"], 2, ',', '.') . '</span>';
                        echo '    </div>';
                        echo '</div>';
                    }
                } else {
                    echo "0 pedidos encontrados.";
                }

                // Fechar a conexão
                $conn->close();
                ?>

                <!-- <div style="width: 100%" class="pedido">
                    <div class="sp_produto">
                        <div class="sp_img">
                            PEDIDO
                        </div>
                        <div class="sp_desc">
                            <span class="pedido_span id_span">ID do pedido: 938427890asdjk</span>
                        </div>
                    </div>
                    <div class="sp_quantidade">
                        <span>R$ 20,00</span>

                    </div>

                </div> -->
            </section>
            <section class="user_info">
                <div class="img_user">
                    <img src="./src/img/image.png" alt="">
                </div>
                <div class="table_info">
                    <div class="table_l">
                        <div class="cell cell_border_bottom cell_l"><span class="cell_cont">E-mail</span></div>
                        <div class="cell cell_border_bottom cell_l"><span class="cell_cont">Telefone</span></div>
                        <div class="cell cell_border_bottom cell_l"><span class="cell_cont">Meus Pedidos</span></div>
                        <div class="cell cell_l"><span class="cell_cont">Endereço</span></div>
                    </div>
                    <div class="table_r">
                        <div class="cell cell_border_bottom"><span class="cell_cont">eduardo123@email.com</span></div>
                        <div class="cell cell_border_bottom"><span class="cell_cont">+55 11 987654321</span></div>
                        <div class="cell cell_border_bottom"><span id="btn_verify" class="cell_cont">verificar</span>
                        </div>
                        <div class="cell"><span class="cell_cont">Rua das Graças N77, Vila Nova, SP</span></div>
                    </div>
                </div>
            </section>
            <section class="btn_edit_sec">
                <button id="btn_edit">
                    <i class='bx bxs-pencil'></i>
                    <span class="btn_edit_cont">Editar perfil</span>
                </button>
            </section>
        </section>
    </main>

    <script src="./src/js/mobile.js"></script>
    <script src="./src/js/feed_infos.js"></script>
    <script>
    document.querySelector('#btn_verify').addEventListener('click', function() {
        document.querySelector('.btn_edit_sec').style.display = 'none';
        document.querySelector('.user_info').style.display = 'none';
        document.querySelector('.pedidos').style.display = 'flex';

    })
    </script>
</body>

</html>