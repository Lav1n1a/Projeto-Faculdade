<?php include('./includes/header.php') ?>

<div class="content-wrapper" style="padding: 15px;">
    <h2 style="padding-bottom: 10px;">Especialistas Registrados</h2>
    <button class="btn btn-success" style="width: 120px; margin: 7px 0px;" data-bs-toggle="modal" data-bs-target="#cadastrarUsuario" onclick="abrirModal()">Cadastrar</button>
    <div class="card">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 25%;">Email</th>
                    <th style="width: 25%;">Perfil</th>
                    <th style="width: 10%;">Ações</th>
                </tr>
            </thead>
            <?php
            $sqlRegistros = "SELECT *,u.email as email, u.id as idUsuario,p.nome as perfilNome
        FROM usuarios as u
        LEFT JOIN perfil p ON p.id = u.perfil_id
        WHERE u.perfil_id != 2 AND u.perfil_id != 1;
        ";
            $dadosRegistros = mysqli_query($conn, $sqlRegistros);

            while ($item = mysqli_fetch_assoc($dadosRegistros)) {
                $id = $item['idUsuario'];
            ?>
                <tr>
                    <td><?php echo $item['email']; ?></td>
                    <td><?php echo $item['perfilNome']; ?></td>
                    <td style="display: flex; gap:10px">
                        <button onclick="pegarId('<?php echo $id; ?>', 'idEditar')" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editarEspecialista">Editar</button>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>

    <!--Cadastro de Usuário Especialista-->
    <div class="modal fade" id="cadastrarUsuario" tabindex="-1" aria-labelledby="cadastrarUsuario" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="cadastrarUsuario">Cadastrar Usuário</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <?php

                include "../connection/conexao.php";

                $acao = isset($_GET['acao']) ? $_GET['acao'] : null;

                if ($acao == 'cadastrar') {

                    $senha = $_POST['senha'];
                    $email = $_POST['email'];
                    $perfilEspecialidade = $_POST['especialidade'];


                    $sql = "INSERT INTO `usuarios`( `email`, `senha`, `perfil_id`) VALUES 
        ('$email', '$senha', '$perfilEspecialidade')";


                    if (mysqli_query($conn, $sql)) { // retorna se o insert deu certo
                        echo "<script> alert('Especialista cadastrado com sucesso!')
                        window.location.href = 'especialistasRegistrados.php';
                        </script>";
                    } else
                        echo "usuário não foi cadastrado" . mysqli_error($conn);
                }
                ?>
                <form id="cadastrarUsuarioForm" action="especialistasRegistrados.php?acao=cadastrar" method="post" style="padding: 20px;">

                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email">
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
                    <div class="input-group mb-3">
                        <select class="form-select" aria-label="Default select example" name="especialidade" id="especialidade" style="margin-bottom: 10px;">
                            <option selected>Selecione um perfil</option>
                            <?php
                            $queryPerfilEspecialidades = "SELECT * from perfil
                            WHERE id != 1 AND id != 2";

                            $perfilEspecialidades = mysqli_query($conn, $queryPerfilEspecialidades);

                            while ($dadosEspecialidades = mysqli_fetch_assoc($perfilEspecialidades)) {
                            ?>
                                <option value=<?php echo $dadosEspecialidades['id'] ?>><?php echo $dadosEspecialidades['nome'] ?></option>
                            <?php
                            }
                            ?>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <button type="submit" class="btn btn-dark btn-block" style="background-color: black; border: 1px solid white;">Cadastrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        function pegarId(id, modalId) {
            document.getElementById(modalId).value = id;
        }
    </script>

    <!--Edição de Usuário Especialista-->
    <div class="modal fade" id="editarEspecialista" tabindex="-1" aria-labelledby="editarEspecialista" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editarEspecialista">Editar Usuário</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <?php

                include "../../../back/conexao.php";

                $acao = isset($_GET['acao']) ? $_GET['acao'] : null;

                if ($acao == 'editar') {
                    $id = $_POST['id'];
                    $email = $_POST['email'];
                    $senha = $_POST['senha'];
                    $perfil_especialidade = $_POST['perfil_especialidade'];

                    $sql = "UPDATE usuarios SET email='$email', senha='$senha', perfil_id='$perfil_especialidade' WHERE id=$id";

                    if (mysqli_query($conn, $sql)) {
                        echo "<script> alert('Especialista editado com sucesso!')
                        window.location.href = 'especialistasRegistrados.php';
                        </script>";  // Redireciona para a mesma página após a edição
                        exit;
                    } else
                        echo "não foi editado";
                }
                ?>
                <form id="cadastrarUsuarioForm" action="especialistas.php?acao=editar" method="post" style="padding: 20px;">

                    <input type="text" name="id" id="idEditar" value="" readonly>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" id="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Senha" name="senha" id="senha">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <select class="form-select" aria-label="Default select example" name="perfil_especialidade" id="perfil_especialidade" style="margin-bottom: 10px;">
                            <option selected>Selecione um perfil</option>
                            <?php
                            $queryPerfilEspecialidades = "SELECT * from perfil
                            WHERE id != 1 AND id != 2";

                            $perfilEspecialidades = mysqli_query($conn, $queryPerfilEspecialidades);

                            while ($dadosEspecialidades = mysqli_fetch_assoc($perfilEspecialidades)) {
                            ?>
                                <option value=<?php echo $dadosEspecialidades['id'] ?>><?php echo $dadosEspecialidades['nome'] ?></option>
                            <?php
                            }
                            ?>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <button type="submit" class="btn btn-dark btn-block" style="background-color: black; border: 1px solid white;">Cadastrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('./includes/footer.php') ?>