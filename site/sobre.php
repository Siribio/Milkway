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
    <link rel="stylesheet" href="src/css/main.css">

    <link rel="stylesheet" href="./src/css/header/header.css">
    <link rel="stylesheet" href="./src/css/footer/footer.css">
    <link rel="stylesheet" href="src/css/sobre/style.css">
    <link rel="icon" href="./src/img/logo_milkway.png" type="image/png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <?php
    $elemento = new elementos_sistema();
    $elemento->imprimir_nav_bar();
    ?>

    <main class="about_us">
        <section class="first_sec">
            <h4>Sobre nós</h4>
            <p>&nbsp Na Sorveteria Milkway Gelato, acreditamos que o sorvete é mais do que apenas uma sobremesa. É um
                momento de alegria, de pura indulgência e de criar memórias doces com quem você ama. É por isso que nos
                dedicamos a oferecer a melhor experiência possível aos nossos clientes, desde o primeiro sorriso até a
                última lambida.</p>
        </section>

        <section class="second_sec d-flex">
            <div class="wrapper_img_sec">
                <img class="img_sec" src="./src/img/frutas1-1.webp" alt="">
            </div>
            <div class="text_wrapper">
                <h5>Nossos ingredientes</h5>
                <p> &nbsp Usamos apenas ingredientes frescos e da mais alta qualidade, sem conservantes artificiais ou
                    sabores
                    artificiais.
                </p>
                <p>&nbsp Nossos sorvetes são feitos com leite fresco, frutas reais e outros ingredientes nutritivos.</p>
            </div>
        </section>

        <section class="third_sec d-flex">
            <div class="text_wrapper">
                <h5>Atendimento ao cliente</h5>
                <p>&nbsp Acreditamos que um bom atendimento ao cliente é essencial para uma experiência agradável. </p>
                <p>&nbsp Nossa equipe está sempre pronta para atender você com um sorriso e ajudá-lo a escolher o
                    sorvete perfeito.</p>
            </div>
            <div class="wrapper_img_sec">
                <img class="img_sec" src="./src/img/frutas3-1_1.webp" alt="">
            </div>
        </section>
    </main>

    <?php
    $elemento->btn_buy();

    $elemento->imprimir_footer();
    ?>

    <script src="./src/js/mobile.js"></script>
    <script src="./src/js/feed_infos.js"></script>

</body>

</html>