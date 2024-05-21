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
    $this->conn = connectionFactory::conexaoMysqli(); // conecta banco
    if ($this->conn->connect_error) {
      die(json_encode(["error" => "Conexão falhou: " . $this->conn->connect_error]));
    }
  }


  private function set_token($username)
  {
    // Garante que todos os comandos anteriores foram processados
    while ($this->conn->more_results() && $this->conn->next_result()) {
      if ($res = $this->conn->store_result()) {
        $res->free();
      }
    }

    // Gera um token de 64 caracteres
    $token = bin2hex(random_bytes(32));
    $_SESSION['token'] = $token;
    try {
      // Prepara a declaração SQL
      $query = $this->conn->prepare("UPDATE usuario SET token = ? WHERE usuario = ?");
      if (!$query) {
        throw new Exception('Erro ao preparar: ' . $this->conn->error);
      }

      // Vincula os parâmetros
      if (!$query->bind_param('ss', $token, $username)) {
        throw new Exception('Erro ao vincular parâmetros: ' . $query->error);
      }

      // Executa a query
      if (!$query->execute()) {
        throw new Exception('Erro ao executar: ' . $query->error);
      }

      // Fecha a declaração
      $query->close();
    } catch (Exception $e) {
      // Lida com exceções
      die($e->getMessage());
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

      // Verifique se a senha fornecida corresponde ao hash armazenado
      if (password_verify($password_string, $user['senha'])) {
        session_set_cookie_params([
          'lifetime' => 3600,
          'httponly' => true, // Impede acesso ao cookie via JavaScript
        ]);
        session_start();
        session_regenerate_id(true); // True para deletar o ID de sessão antigo

        $_SESSION['id'] = $user['id_usuario'];
        $_SESSION['name'] = $user['usuario'];
        $this->conn->next_result();
        $this->set_token($username);

        $query_login = $this->conn->prepare("SELECT id_usuario, usuario, email FROM `usuario` WHERE `usuario` = ?");
        $query_login->bind_param('s', $username);
        $query_login->execute();
        $dados = $query_login->get_result();
        $data = $dados->fetch_all(MYSQLI_ASSOC);
        echo json_encode(['success' => $data]);
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
