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
</head>

<body>
    <?php
        $elemento = new elementos_sistema();
        $elemento->imprimir_nav_bar();
    ?>


    <?php
        $elemento->btn_buy();
        $elemento->imprimir_footer();
    ?>

    <script src="./src/js/mobile.js"></script>
</body>

</html>