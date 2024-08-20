<?php
$HOST = 'ep-shrill-bonus-a29kj3k0.eu-central-1.pg.koyeb.app'; 
$USER = 'koyeb-adm';
$PASSWORD = 'fahwME8Im9dN'; 
$NAME = 'koyebdb';

$conn = new mysqli($HOST, $USER, $PASSWORD,$NAME);

if ($conn->connect_error) {
    die("Não foi possível conectar ao banco de dados: " . $conn->connect_error);
} 

// $HOST = '3306'; 
// $USER = 'root';
// $PASSWORD = 'root'; 
// $NAME = 'agenda';

// $conn = new mysqli($HOST, $USER, $PASSWORD,$NAME);

// if ($conn->connect_error) {
//     die("Não foi possível conectar ao banco de dados: " . $conn->connect_error);
// } 
   
   
?>
