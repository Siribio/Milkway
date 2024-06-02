<?php
require_once('check_redirect.php');

require 'elementos_sistema.php';
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="src/css/main.css">
    <link rel="stylesheet" href="src/css/font/nunito.css" />
    <link rel="stylesheet" href="src/css/header/header.css">
    <link rel="stylesheet" href="src/css/home/home.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./src/css/footer/footer.css">
    <link rel="icon" href="./src/img/logo_milkway.png" type="image/png">


    <title>E-Sorveteria</title>

</head>

<body>
    <?php
    $elemento = new elementos_sistema();
    $elemento->imprimir_nav_bar();
    ?>

    </div>
    <main class="home">
        <div class="row">
            <div class="column">
                <div class="esquerda">
                    <div class="ponta">
                        <p>FEITO COM<br />LEITE FRESCO</p>
                    </div>
                    <img src="./src/img/leite_1.webp" alt="" class="leite" />
                </div>
                <div class="texto">
                    <p>Uma nova forma de<br />montar sua felicidade.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="column">
                <div class="direita">
                    <img class="bola" src="./src/img/SORVETE-1_1.webp" alt="" />
                </div>
            </div>
        </div>
    </main>

    <?php
    $elemento->btn_buy();
    $elemento->imprimir_footer();
    ?>
    <script src="./src/js/mobile.js"></script>
    <script src="./src/js/feed_infos.js"></script>
</body>

</html>