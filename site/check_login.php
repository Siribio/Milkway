<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'conexao.php';
header('Content-Type: application/json'); // Define a resposta como JSON

class User_Login
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectionFactory::conexaoMysqli(); //conecta banco
        if ($this->conn->connect_error) {
            die(json_encode(["error" => "Conexão falhou: " . $this->conn->connect_error]));
        }
    }

    public function login($username_string, $password_string)
    {
        $username = mysqli_real_escape_string($this->conn, $username_string);
        $password = $password_string; // Senha não deve ser hasheada aqui, compara-se o hash do banco

        if (empty($username) || empty($password)) {
            echo json_encode(["error" => "Por favor, insira um nome de usuário e senha válidos!"]);
            exit;
        }

        $query = $this->conn->prepare("SELECT * FROM `usuario` WHERE `usuario` = ?");
        $query->bind_param('s', $username);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            // Adicione estas linhas para depuração:
            echo json_encode(['error' => "Password from user: " . $password_string]);
            echo json_encode(['error' => "Password from database: " . $user['senha']]);
            exit;
            if (password_verify($password_string, $user['senha'])) {
                $_SESSION['id'] = $user['id_usuario'];
                $_SESSION['name'] = $user['usuario'];
                echo json_encode(['success' => 'Login realizado com sucesso.']);
                exit;
            } else {
                echo json_encode(['error' => 'Senha incorreta.']);
                exit;
            }
        } else {
            echo json_encode(['error' => 'Usuário não encontrado.']);
            exit;
        }
    }
}
