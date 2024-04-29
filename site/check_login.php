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


if (isset($_POST['user_input']) || isset($_POST['password'])) {

    if (strlen($_POST['user_input']) == 0) {
        echo json_encode(['error' => 'Preencha seu e-mail']);
        exit;
    }
    if (strlen($_POST['password']) == 0) {
        echo json_encode(['error' => 'Preencha sua senha']);
        exit;
    }

    $username = mysqli_real_escape_string($conn, $_POST['user_input']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);


    if (empty($username) || empty($password)) {
        echo json_encode(["error" => "Por favor, insira um nome de usuário e senha válidos!"]);
        exit;
    }

    $query = $conn->prepare("SELECT * FROM `usuario` WHERE `usuario` = ? AND senha = ?");
    $query->bind_param('ss', $username, $password);

    $query->execute();

    $result = $query->get_result();
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['id'] = $user['id_usuario'];
        $_SESSION['name'] = $user['usuario'];

        echo json_encode(['success' => 'Login realizado com sucesso.']);
    } else {
        echo json_encode(['error' => 'Usuário ou senha incorretos.']);

    }

} else {
    echo json_encode(['error' => 'Falha ao logar, verifique os dados!']);
}





?>