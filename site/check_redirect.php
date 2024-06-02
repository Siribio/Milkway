<?php
session_start(); // Inicia a sessão

if (!isset($_SESSION['id'])) { // Verifica se a sessão 'user_id' não está setada
    header("Location: error.html"); // Redireciona para a página de login
    exit(); // Garante que o script pare de executar após o redirecionamento
}
