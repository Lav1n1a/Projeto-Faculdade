<?php
include '../conexao.php';
$acao = isset($_GET['acao']) ? $_GET['acao'] : null;

if ($acao == 'cadastraOuEditaEspecialista') {

    $email = $_POST['email'];
    $senha = md5($_POST['senha']);
    $perfilEspecialidade = $_POST['id_perfil'];


    if (!$_POST['id']) {

        
        $sql = "INSERT INTO `usuarios`( `email`, `senha`, `perfil_id`) VALUES 
        ('$email', '$senha', '$perfilEspecialidade')";


        if (mysqli_query($conn, $sql)) { // retorna se o insert deu certo
            echo "<script> alert('Especialista cadastrado com sucesso!')
                window.location.href = '../../front/pages/especialistas.php'
                </script>";
        } else{
            echo "Não foi possível cadastrar" . mysqli_error($conn);
        }

    
    } else {

        $id = $_POST['id'];

        $sql = "UPDATE usuarios SET email='$email', senha='$senha', perfil_id='$perfilEspecialidade' WHERE id = $id";

        if (mysqli_query($conn, $sql)) {
            echo "<script> alert('Especialista editado com sucesso!')
            window.location.href = '../../front/pages/especialistas.php'
            </script>";
            exit;
        } else{
            echo "Não foi possível editar". mysqli_error($conn);
        }
           
           
    }

}
