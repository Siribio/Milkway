<?php
require_once('check_redirect.php');

require 'elementos_sistema.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Sorveteria</title>
    <link rel="stylesheet" href="./src/css/header/header.css">
    <link rel="stylesheet" href="./src/css/main.css">
    <link rel="stylesheet" href="./src/css/footer/footer.css">
    <link rel="stylesheet" href="./src/css/pedido/style.css">
    <link rel="icon" href="./src/img/logo_milkway.png" type="image/png">

</head>

<body>
    <?php
    $elemento = new elementos_sistema();
    $elemento->imprimir_nav_bar();
    ?>

    <main class="pedido_main">
        <section class="header_main">
            <h4>MONTE SEU SORVETE</h4>
        </section>
        <section class="pedido">
            <div class="pedido_header">
                <div class="ph_t">Sabores:</div>
                <div class="ph_t">Valor</div>
            </div>
            <div class="ph_sabores">
                <span>Quantos sabores deseja:</span>
                <select class="s_sty" name="" id="sel_sabores">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>
            <div class="sabores_sec">
                <!-- <div class="sabores_console">
                    <div class="sc_l">
                        <span class="sc_s">selecione o sabor:</span>
                        <select class="s_sty" name="" id=""></select>
                    </div>
                    <div class="sc_s" id="valor">R$ <span>6,00</span></div>
                </div> -->
            </div>
            <div class="pedido_header">
                Acompanhamentos:
            </div>
            <div class="ph_sabores">
                <span>Quantos acompanhamentos deseja:</span>
                <select class="s_sty" name="" id="sel_acom">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select>
            </div>
            <div class="acomp_sec">
            </div>
            <div class="pedido_header">
                Total pedido:
            </div>
            <div class="sc_st">
                <span>Total do pedido:</span>
                <div>
                    <span>R$</span>
                    <span id="total_pedido">6,00</span>
                </div>
            </div>
            <div class="sec_btn">
                <div id="car" class="btn">
                    Adicione o pedido ao carrinho
                </div>
                <div id="comp" class="btn">
                    Finalizar compra
                </div>
            </div>
        </section>
    </main>


    <?php
    $elemento->btn_buy();
    $elemento->imprimir_footer();
    ?>

    <script src="./src/js/mobile.js"></script>
    <script src="./src/js/feed_infos.js"></script>
    <script src="./src/js/pedidos.js"></script>

</body>

</html>