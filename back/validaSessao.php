<?php 
session_start();

print_r($_SESSION);

if (isset($_SESSION['id'])) {
    $user = $_SESSION['id'];
} else {
    session_destroy();
    header("Location:../login.php?Tentativa_Invalida");
}
?>