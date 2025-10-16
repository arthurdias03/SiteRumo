<?php
$servername = "p3nlmysql151plsk.secureserver.net:3306";
$username = "adminrumo";
$password = "Rumo@2025";
$dbname = "ph21429941251_";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else
    
?>
