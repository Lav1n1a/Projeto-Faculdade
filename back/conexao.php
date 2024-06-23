<?php
$server = '172.17.0.3'; 
$user = 'root';
$password = 'root'; 
$bd = 'agenda_crud2';

// Conectando ao banco de dados MySQL
$conn = new mysqli($server, $user, $password, $bd);

if ($conn->connect_error) {
    die("Não foi possível conectar ao banco de dados: " . $conn->connect_error);
} else {
    // echo "Conectado com sucesso!";
}
?>
