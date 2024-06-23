<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;800;900&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&family=Poppins:wght@400;800;900&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            font-family: 'Poppins', sans-serif;
            font-family: 'Roboto', sans-serif;
            background-color: #f4f6f9;
        }

        .conteudo-principal {
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            width: 20%;
            margin: 50px 590px;
        }

        .lado-AB {
            margin-top: 60px;
            width: 310px;
        }

        #but {
            width: 30%;

        }
    </style>
</head>

<body>
    <?php
    include "connection/conexao.php" ;

    if (isset($_GET['email'])) { // Verifica se o e-mail está definido na URL
        $email = $_GET['email'];
        $sql = "SELECT * FROM cadastro WHERE email = '$email'"; // Adicionadas aspas simples em torno do e-mail
        $dados = mysqli_query($conn, $sql);

        if (mysqli_num_rows($dados) > 0) { // Verifica se há linhas no conjunto de resultados
            $linha = mysqli_fetch_assoc($dados);
    ?>
            <!-- Seu conteúdo HTML para exibir as informações do usuário -->
            <nav class="navbar navbar-expand-lg bg-body-tertiary" style=" box-shadow: 2px 2px 20px 2px rgba(128, 128, 128, 0.61);">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#" style="margin-left: 34px;">Agenda<i class="bi bi-calendar-plus"></i>Saude</a>
                    <a href="/agendacrud/index.php">Voltar ao Início</a>
                </div>
            </nav>
            <div class="conteudo-principal">
                <form>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nome Completo</label>
                        <input type="text" class="form-control" name="nome" value="<?php echo $linha['nome']; ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">E-mail</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $linha['email']; ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputDate1" class="form-label">Horário</label>
                        <input type="datetime-local" class="form-control" name="horario" value="<?php echo $linha['horario']; ?>" disabled>
                    </div>
                    <div class="botoes">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleEditar">Editar</button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleExcluir">Excluir</button>
                    </div>
                </form>
            </div>
            <!--Modal Editar-->
            <div class="modal fade" id="exampleEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Cadastro</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="editar_script.php" method="POST">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nome Completo</label>
                                    <input type="text" class="form-control" name="nome" value="<?php echo $linha['nome']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">E-mail</label>
                                    <input type="email" class="form-control" name="email" value="<?php echo $linha['email']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputDate1" class="form-label">Horário</label>
                                    <input type="datetime-local" class="form-control" name="horario" value="<?php echo $linha['horario']; ?>">
                                </div>
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!--Modal Excluir-->
            <div class="modal fade" id="exampleExcluir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" style="padding-bottom: 18px;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Excluir Cadastro</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="excluir_script.php" method="POST">
                            <div class="modal-body">
                                <?php echo "Deseja realmente excluir o cadastro?" ?>
                            </div>
                            <button type="submit" class="btn btn-primary" style="margin: 0px 15px;">Excluir</button>
                        </form>
                    </div>
                </div>
            </div>

    <?php
        } else {
            echo "Nenhum usuário encontrado com esse e-mail.";
        }
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>