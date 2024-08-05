<?php 
session_start();

if (isset($_SESSION['id'])) {
    $email = $_SESSION['id'];
} else {
    session_destroy();
    header("Location:../login.php?Tentativa_Invalida");
}
?>