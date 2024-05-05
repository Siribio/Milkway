<?php

require_once "check_signin.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['user'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $user_register = new User_Register();

    $result = $user_register->register($username, $password, $email);

    echo json_encode(['success' => 'Entrou Post!']);
} else {
    echo json_encode(['error' => 'Formulário não processado!']);

    exit();
}
