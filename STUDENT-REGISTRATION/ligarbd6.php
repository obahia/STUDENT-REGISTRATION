<?php
$servername = "localhost:3306";
$database = "alunos4";
$username = "root";
$password = "";
//Criar ligacao
$conn =  mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Erro de ligação" . mysql_connect_error());
}

?>

