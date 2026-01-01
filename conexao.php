<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "didipratas_db"; 

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}
?>