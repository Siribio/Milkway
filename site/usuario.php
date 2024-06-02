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
            <section class="user_info">
                <div class="img_user">
                    <img src="./src/img/image.png" alt="">
                </div>
                <div class="table_info">
                    <div class="table_l">
                        <div class="cell cell_border_bottom cell_l"><span class="cell_cont">E-mail</span></div>
                        <div class="cell cell_border_bottom cell_l"><span class="cell_cont">Telefone</span></div>
                        <div class="cell cell_border_bottom cell_l"><span class="cell_cont">Histórico</span></div>
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

</body>

</html>