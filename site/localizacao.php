<?php
require_once('check_redirect.php');

require_once('elementos_sistema.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/css/header/header.css">
    <link rel="stylesheet" href="./src/css/main.css">
    <link rel="stylesheet" href="./src/css/footer/footer.css">
    <link rel="stylesheet" href="./src/css/local/local.css">
    <link rel="icon" href="./src/img/logo_milkway.png" type="image/png">


    <title>Localização</title>
</head>

<body>
    <?php
    $elemento = new elementos_sistema();
    $elemento->imprimir_nav_bar()
    ?>

    <main class="main_loc">
        <section class="info">
            <h3>
                Localização & <br>Horários
            </h3>

            <p class="info_loc">Em um dia quente de verão, nada melhor do que se refrescar com um delicioso sorvete. Mas
                antes de sair em busca dessa delícia gelada, é importante verificar alguns detalhes: a localização e o
                horário da sorveteria.</p>

            <div class="btn_monte_loc">MONTE O SEU!</div>
        </section>
        <div class="wrapper_img">
            <img src="./src/img/map1.png" alt="mapa_localização">
            <span class="info_img">verifique a localidade<br> mais próxima de você</span>
        </div>
    </main>

    <script src="./src/js/mobile.js"></script>
    <script src="./src/js/feed_infos.js"></script>

</body>

</html>