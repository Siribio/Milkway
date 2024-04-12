<?php

require 'conexao.php';
$conn = connectionFactory::conexaoMysqli();

$query = mysqli_query($conn, "SELECT nome FROM `estoque`");

while ($row = mysqli_fetch_assoc($query)) {
    $nome = $row['nome']; // Access the 'nome' column value
    echo $nome . "<br>"; // Display the stock name
}


mysqli_close($conn);


?>