<?php session_start();?>


<?php include('../../back/conexao.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Agenda Saúde</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="/agendaphp/front/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="/agendaphp/front/AdminLTE-3.2.0/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="display: flex; justify-content: space-between;">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <a type="button" class="btn btn-danger" href="/agendaphp/front/logout.php" style="margin: 5px 10px 0px 0pX">Deslogar</a>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: black;" style="height: 100%;">
      <a class="brand-link" style="text-decoration: none; padding-left: 25px;">
        <span class="brand-text" style=" font-family: 'Phudu', cursive; font-size: 27px;">Agenda<i class="bi bi-calendar-plus"></i>Saude</span>
      </a>

      <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="info">
            <a style="text-decoration: none;" class="d-block"><?php echo $_SESSION['email'];?></a>
          </div>
        </div>

        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <?php 
            // if ($_SESSION['perfil_id'] == 1) {
            ?>
              <li class="nav-item">

              </li>
            <?php
            // }
            ?>

            <?php
            $idPerfil = $_SESSION['perfil_id'];
            $sqlMenu = "SELECT *,
            menu.nome as menu_nome,
            menu.link as menu_link
            FROM perfil_menu as pm
            LEFT JOIN menu on menu.id = pm.menu_id 
            WHERE pm.perfil_id = $idPerfil";

            $sqlMenuDados = mysqli_query($conn, $sqlMenu);

            if (!$sqlMenuDados) {
              die("Erro na consulta SQL: " . mysqli_error($conn));
            }

            while ($row = mysqli_fetch_assoc($sqlMenuDados)) {
            ?>
              <li class="nav-item">
                <a href="<?php echo $row['menu_link']; ?>" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    <?php echo $row['menu_nome']; ?>
                  </p>
                </a>
              </li>
            <?php
            }
           ?> 
          </ul>
        </nav>
      </div>
    </aside>
