<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL)

require 'conexao.php';
$conn = connectionFactory::conexaoMysqli();

if(!$conn){
    echo json_encode(["error" => "A conexão com o banco de dados falhou: " . mysqli_error()]);
    exit;
}

if(isset($_POST['user_input'])){
    $username = mysqli_real_escape_string($conn, $_POST['user_input']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($username) || empty($password)) {
        echo json_encode(["error" => "Por favor, insira um nome de usuário e senha válidos!"]);
        exit;
    }

    $query = "SELECT `senha` FROM `usuario` WHERE `nome` = '$username'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1){

    }
    
}





?>