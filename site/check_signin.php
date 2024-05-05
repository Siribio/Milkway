<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'conexao.php';
$conn = connectionFactory::conexaoMysqli();

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

header('Content-Type: application/json'); // Define a resposta como JSON





?>