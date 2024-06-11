<?php

require_once 'Controller.php';

$controller = new Controller();
$pedidos = $controller->execute_query("SELECT * FROM `estoque`");

header('Content-Type: application/json');
echo json_encode($pedidos);
