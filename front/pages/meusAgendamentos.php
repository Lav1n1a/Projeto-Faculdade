<?php include('includes/header.php') ?>

<div class="content-wrapper" style="padding: 15px;">
    <?php
    $perfil_id = $_SESSION['perfil_id'];
    $id = $_SESSION['id'];

    if ($_SESSION['perfil_id'] == 2) {
        ?>
        <h2 style="padding-bottom: 10px;">Meu Agendamento</h2>
        <?php
        $sqlRegistros = "SELECT a.id as id, a.id_usuario, DATE_FORMAT(a.data, '%d/%m/%Y') as data, a.hora as hora, e.nome, u.email as email, 
                s.nome as status, s.id as codigo_status
                FROM agendamentos a
                LEFT JOIN especialidades e ON e.id = a.especialidade
                LEFT JOIN usuarios u ON u.id = a.id_usuario
                LEFT JOIN status s ON s.id = a.status
                WHERE a.id_usuario = $id and s.id = 1";
    } else {
        ?>
        <h2 style="padding-bottom: 10px;">Meus Agendamentos</h2>
        <?php
        $sqlRegistros = "SELECT a.id AS id, a.email AS email, DATE_FORMAT(a.data, '%d/%m/%Y') as data, a.hora AS hora, e.nome AS nome, 
                s.id AS codigo_status,  s.nome as status
                FROM agendamentos a
                LEFT JOIN perfil_especialidade pe ON pe.id_especialidade = a.especialidade
                LEFT JOIN usuarios u ON u.id = a.id_usuario
                LEFT JOIN especialidades e ON e.id = a.especialidade
                LEFT JOIN status s ON s.id = a.status
                WHERE pe.id_perfil = $perfil_id AND s.id != 0";
    }

    $dadosRegistros = mysqli_query($conn, $sqlRegistros);

    while ($dadosUsuario = mysqli_fetch_assoc($dadosRegistros)) {
        $id = $dadosUsuario['id'];
        $statusColor = getStatusColor($dadosUsuario['codigo_status']);

    ?>
        <div class="callout callout-dark" style="font-size: 18px; display: flex; justify-content: space-between;border-left: 5px solid black;">
            <div style="display: flex; gap: 33px;">
                <p class="card-text"><b>ID:</b> <?php echo $dadosUsuario['id']; ?></p>
                <p class="card-text"><b>USUÁRIO:</b> <?php echo $dadosUsuario['email']; ?></p>
                <p class="card-text"><b>DATA:</b> <?php echo $dadosUsuario['data']; ?></p>
                <p class="card-text"><b>HORÁRIO: </b> <?php echo $dadosUsuario['hora']; ?> </p>
                <p class="card-text"><b>ESPECIALIDADE: </b> <?php echo $dadosUsuario['nome']; ?> </p>
                <p class="card-text"><b>STATUS:</b><span style="color: <?php echo $statusColor; ?>;"> <?php echo $dadosUsuario['status']; ?></span></p>
            </div>
            <div>
                <?php if ($perfil_id == 1) { ?>
                    <button type="button" onclick="pegarId('<?php echo $id; ?>', 'idCancelar')" data-bs-toggle="modal" data-bs-target="#cancelarAgendamento" style="background-color: black; padding: 6px; color: white; border: 0px; border-radius: 5px; margin-bottom: 10px; width: 110px;">
                        Cancelar
                    </button>
                    <button type="button" onclick="pegarId('<?php echo $id; ?>', 'idFinalizar')" data-bs-toggle="modal" data-bs-target="#finalizarAgendamento" style="background-color: red; padding: 6px; color: white; border: 0px; border-radius: 5px; margin-bottom: 10px; width: 110px;">
                        Finalizar
                    </button>
                <?php } elseif ($perfil_id == 2) { ?>
                    <button type="button" onclick="pegarId('<?php echo $id; ?>', 'idCancelar')" data-bs-toggle="modal" data-bs-target="#cancelarAgendamento" style="background-color: black; padding: 6px; color: white; border: 0px; border-radius: 5px; margin-bottom: 10px; width: 110px;">
                        Cancelar
                    </button>
                <?php } else { ?>
                    <button type="button" onclick="pegarId('<?php echo $id; ?>', 'idFinalizar')" data-bs-toggle="modal" data-bs-target="#finalizarAgendamento" style="background-color: red; padding: 6px; color: white; border: 0px; border-radius: 5px; margin-bottom: 10px; width: 110px;">
                        Finalizar
                    </button>
                <?php } ?>
            </div>
        </div>
    <?php
    }

    ?>

    <?php
    function getStatusColor($statusColor)
    {
        switch ($statusColor) {
            case 1:
                return 'green';
            case 2:
                return 'red';
            default:
                return 'yellow';
        }
    }
    ?>

    <script>
        function pegarId(id, modalId) {
            document.getElementById(modalId).value = id;
        }
    </script>

    <?php

    $acao = isset($_GET['acao']) ? $_GET['acao'] : null;
    if ($acao == 'cancelar') {
        $status = 0;
        $id = $_POST['id'];

        $sql = "UPDATE agendamentos SET status='$status' WHERE id = $id";

        if (mysqli_query($conn, $sql)) {
            echo "<script>
                alert('Agendamento cancelado!')
                window.location.href = 'meusAgendamentos.php'; 
            </script>";
            exit;
        } else
            echo "Não foi editado";
    }

    if ($acao == 'finalizar') {
        $status = 2;
        $id = $_POST['id'];

        $sql = "UPDATE agendamentos SET status='$status' WHERE id=$id";

        if (mysqli_query($conn, $sql)) {
            echo "<script>
               alert('Agendamento finalizado!')
                window.location.href = 'meusAgendamentos.php';
            </script>";
            exit;
        } else
            echo "não foi editado";
    }
    ?>

    <!-- Modal para Atender -->
    <div class="modal fade" id="cancelarAgendamento" tabindex="-1" aria-labelledby="cancelarAgendamento" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" style="display: flex; align-items: center; justify-content: center;padding: 40px 0px 0px;">
                    <form id="cancelarForm" action="meusAgendamentos.php?acao=cancelar" method="post" style="padding: 20px;">
                        <div class="d-flex flex-column align-items-center">
                            <i class="fa fa-exclamation-circle" style="font-size: 60px; padding: 10px; color: orange;"></i>
                            <h3>Cancelar agendamento?</h3>
                        </div>
                        <p style="font-size: 20px;">Não é possível reverter essa ação!</p>
                </div>
                <div style="display: flex; align-items: center; justify-content: center; gap:10px; padding-bottom: 20px;">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="width: 25%; font-size: 20px;">Fechar</button>
                    <input type="text" name="id" id="idCancelar" value="" readonly hidden>
                    <button type="submit" class="btn btn-success" style="width: 25%; font-size: 20px;">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Finalizar -->
    <div class="modal fade" id="finalizarAgendamento" tabindex="-1" aria-labelledby="finalizarAgendamento" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" style="display: flex; align-items: center; justify-content: center;padding: 40px 0px 0px;">
                    <form id="finalizarForm" action="meusAgendamentos.php?acao=finalizar" method="post" style="padding: 20px;">
                        <div class="d-flex flex-column align-items-center">
                            <i class="fa fa-exclamation-circle" style="font-size: 60px; padding: 10px;color: red"></i>
                            <h3>Finalizar atendimento?</h3>
                        </div>
                        <p style="font-size: 20px;">Não é possível reverter essa ação!</p>
                </div>
                <div style="display: flex; align-items: center; justify-content: center; gap:10px; padding-bottom: 20px;">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="width: 25%; font-size: 20px;">Fechar</button>
                    <input type="text" name="id" id="idFinalizar" value="" readonly hidden>
                    <button type="submit" class="btn btn-success" style="width: 25%; font-size: 20px;">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php') ?>