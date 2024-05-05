<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'conexao.php';
$conn = connectionFactory::conexaoMysqli();

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

class User_Register
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectionFactory::conexaoMysqli(); //conecta banco
    }

    public function register($username, $password, $email)
    {
        $id = $this->generate_id();

        // if ($this->user_exists($username, $email, $id)) {
        //     return "Usuário ou Email já cadastrados!";
        // }


        // if (!$this->validate_input($username, $password, $email)) {
        //     return "Validação dos dados falhou.";
        // }

        return $this->insert_data($id, $username, $email, $password);
    }

    private function validate_input($username, $password, $email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($username) > 5 && strlen($password) > 5;
    }

    private function insert_data($id, $username, $email, $password)
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $query = $this->conn->prepare("INSERT INTO usuario (id_usuario, usuario, senha, email) VALUES (?, ?, ?, ?)");
        $query->bind_param("ssss", $id, $username, $passwordHash, $email);
        $query->execute();
    }

    private function user_exists($username, $email, $id)
    {
        $query = $this->conn->prepare("SELECT id_usuario FROM usuario WHERE usuario = ? OR email = ?");
        $query->bind_param("ss", $username, $email);
        $query->execute();

        return $query->fetch() !== false;
    }

    private function generate_id()
    {
        $letters = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 2);
        $numbers = substr(str_shuffle("0123456789"), 0, 4);
        $id = $letters . $numbers;

        while ($this->id_exists($id)) {
            $letters = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 2);
            $numbers = substr(str_shuffle("0123456789"), 0, 4);
            $id = $letters . $numbers;
        }

        return $id;
    }

    private function id_exists($id)
    {
        $query = $this->conn->prepare("SELECT id_usuario FROM usuario WHERE id_usuario = ?");
        $query->bind_param("s", $id);
        $query->execute();
        $result = $query->get_result();
        return $result->num_rows > 0;  // Correção para o método de verificação
    }
}