<?php
include '../back/conexao.php';

if (@$_POST['email'] && @$_POST['senha']) {

  $email =  $_POST['email'];
  $senha = $_POST['senha'];

  $sql = "SELECT * FROM `usuarios` WHERE email = '$email' AND senha = '$senha' limit 1";

  if ($dados = mysqli_query($conn, $sql)) {
    $resultado = mysqli_fetch_assoc($dados);

    if (($email == $resultado['email']) and ($senha == $resultado['senha'])) {

      session_start();
      
      $_SESSION['id'] = $resultado['id'];
      $_SESSION['email'] = $resultado['email'];
      $_SESSION['perfil_id'] = $resultado['perfil_id'];

      header("Location: pages/home.php");

     
    } else {
      echo "<script> 
        alert('Este usuário não existe!')
        window.location.href = 'login.php';
      </script>";
      unset($_POST);
      $_POST['email'] = '';
    }
  } else {
    unset($_POST);
    $_POST['email'] = '';
  };
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tela de Login</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="/agendaphp/front/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="/agendaphp/front/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="/agendaphp/front/AdminLTE-3.2.0/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-outline card-dark">
      <div class="card-header text-center">
        <a class="navbar-brand" href="#" style="margin-left: 34px; font-family: 'Phudu', cursive; font-size: 27px; color:black;">Agenda<i class="bi bi-calendar-plus"></i>Saude</a>
      </div>
      <div class="card-body">
        <form action="login.php" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Email" name="email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
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
              <button type="submit" class="btn btn-dark btn-block" style="background-color: black; border: 1px solid white;">Entrar</button>
            </div>
          </div>
        </form>
        <div style="margin-top: 15px; ">
          <p>Ainda não possui cadastrado? <a href="/agendaphp/front/cadastro.php">Cadastre-se</a></p>
        </div>
      </div>
    </div>


    <script src="/agendaphp/front/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
    <script src="/agendaphp/front/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/agendaphp/front/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
</body>
</html>