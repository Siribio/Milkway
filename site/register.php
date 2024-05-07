<?php

require_once "check_signin.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['user'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $user_register = new User_Register();

    $result = $user_register->register($username, $password, $email);
    if (strlen($result) == 0) $result = "Cadastro realizado com sucesso!";

    echo json_encode(['success' => "$result"]);
} else {
    echo json_encode(['error' => 'Formulário não processado!']);

    exit();
}
