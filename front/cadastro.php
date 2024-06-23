<?php

include "../back/conexao.php";

$acao = isset($_GET['acao']) ? $_GET['acao'] : null;
$msg = isset($_GET['msg']) ? $_GET['msg'] : null;
$tipoMsg = isset($_GET['tipo']) ? $_GET['tipo'] : null;

if ($acao == 'cadastrar') {

    $senha = $_POST['senha'];
    $email = $_POST['email'];
    $perfilId = 2; // Comum


    $sql = "INSERT INTO `usuarios`( `email`, `senha`, `perfil_id`) VALUES 
('$email', '$senha', '$perfilId')";

    if (mysqli_query($conn, $sql)) { // retorna se o insert deu certo
        echo "<script> alert('Usuário cadastrado com sucesso!')</script>";
        header("location: login.php");
    } else
        echo "$nome NÃO foi cadastrado" . mysqli_error($conn);
}


if ($msg) {
    echo $msg;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/agendaphp/front/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/agendaphp/front/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/agendaphp/front/AdminLTE-3.2.0/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-dark">
            <div class="card-header text-center">
                <a class="navbar-brand" href="#" style="margin-left: 34px; font-family: 'Phudu', cursive; font-size: 27px; color:black;">Agenda<i class="bi bi-calendar-plus"></i>Saude</a>
            </div>
            <div class="card-body">
                <form action="cadastro.php?acao=cadastrar" method="post">
                    <p>Torne-se um paciente!</p>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Senha" name="senha">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <button type="submit" class="btn btn-dark btn-block" style="background-color: black; border: 1px solid white;">Cadastrar</button>
                        </div>
                    </div>
                    <div style="margin-top: 15px; ">
                        <p>Já possui cadastrado? <a href="/agendaphp/front/login.php">Login</a></p>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.login-box -->

        <!-- jQuery -->
        <script src="/agendaphp/front/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="/agendaphp/front/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="/agendaphp/front/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
</body>

</html>