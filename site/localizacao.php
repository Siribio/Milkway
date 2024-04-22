<?php
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
    <link rel="stylesheet" href="./src/css/local/local.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <?php
    $elemento = new elementos_sistema();
    $elemento->imprimir_nav_bar();
    ?>

    <main class="local">
        <section class="left">
            <div class="text">
                <h3>Localização & Horários</h3>
                <p>
                    Em um dia quente de verão, nada melhor do que se refrescar com um
                    delicioso sorvete. Mas antes de sair em busca dessa delícia gelada,
                    é importante verificar alguns detalhes: a localização e o horário da
                    sorveteria.
                </p>
            </div>
            <div class="btn_monte">
                <button>MONTE O SEU!</button>
            </div>
        </section>
        <section class="right">
            <div class="map">
                <img src="src/img/map1.png" alt="" />
            </div>
            <div class="map_text">
                <p>verifique a localidade mais próxima de você!</p>
            </div>
        </section>
    </main>

    <?php
    $elemento->btn_buy();
    $elemento->imprimir_footer();
    ?>

    <script src="./src/js/mobile.js"></script>
</body>

</html>