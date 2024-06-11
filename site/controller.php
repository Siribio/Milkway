<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'conexao.php';

class Controller
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectionFactory::conexaoMysqli(); //conecta banco
        if ($this->conn->connect_error) {
            die("Conexão falhou: " . $this->conn->connect_error);
        }
    }

    public function execute_query($sql)
    {
        $query = $this->conn->prepare($sql);
        if ($query === false) {
            die("Erro na preparação da query: " . $this->conn->error);
        }

        $query->execute();

        $result = $query->get_result();
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
}
