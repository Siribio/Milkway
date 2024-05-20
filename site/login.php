<?php

require_once('check_login.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['user_input']) ? $_POST['user_input'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $errors = [];

    if (empty($username)) $errors['error_pre'] = "Preencha todos os campos";
    if (empty($password)) $errors['error_pre'] = "Preencha todos os campos";

    if (!empty($errors)) {
        echo json_encode($errors); // Enviar todos os erros de uma vez
        exit(); // Finaliza a execução após enviar os erros
    }


    $user_login = new User_Login();

    $result_l = $user_login->login($username, $password);


    echo json_encode(['success' => "$result"]);
} else {
    echo json_encode(['error' => 'Formulário não processado!']);

    exit();
}
