<?php
$server = '172.17.0.2'; 
$email = 'root';
$password = 'root'; 
$bd = 'agenda';

// Conectando ao banco de dados MySQL
$conn = new mysqli($server, $email, $password, $bd);

if ($conn->connect_error) {
    die("Não foi possível conectar ao banco de dados: " . $conn->connect_error);
} else {
    // echo "Conectado com sucesso!";
}
?>
