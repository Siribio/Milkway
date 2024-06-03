<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'conexao.php';
$conn = connectionFactory::conexaoMysqli();

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

class Controller
{

    private $conn;

    public function __construct()
    {
        $this->conn = connectionFactory::conexaoMysqli(); //conecta banco
    }

    public function get_pedido()
    {
        $query = $this->conn->prepare("SELECT * FROM `estoque`");
        $query->execute();

        $result = $query->get_result();
        return $result;
    }
}
