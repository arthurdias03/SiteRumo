<?php
$servername = "ph21429941251_";
$username = "adminrumo";
$password = "adminrumo";
$dbname = "Rumo@2025";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else
    
?>
