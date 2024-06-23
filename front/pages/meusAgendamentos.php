<?php include('includes/header.php') ?>

<div class="content-wrapper" style="padding: 15px;">
    <h2 style="padding-bottom: 10px;">Meus Agendamentos</h2>
    <?php
    $perfil_id = $_SESSION['perfil_id'];

    $sqlRegistros = "SELECT a.*, e.nome as especialidade, DATE_FORMAT(a.data, '%d/%m/%Y') as data, 
    a.hora as hora, s.nome as status, a.status as codigo_status, u.email as email
    FROM agendamentos a
    LEFT JOIN status s ON s.id = a.status
    LEFT JOIN especialidades e ON e.id = a.especialidade
    LEFT JOIN usuarios u ON u.id = a.usuario_id
    WHERE a.especialidade = 1 AND status != 0
    ORDER BY data, hora ASC";
    $dadosRegistros = mysqli_query($conn, $sqlRegistros);

    while ($dadosUsuario = mysqli_fetch_assoc($dadosRegistros)) {
        $id =  $dadosUsuario['id'];
        $statusColor = getStatusColor($dadosUsuario['codigo_status']);
    ?>
        <div class="callout callout-dark" style="font-size: 18px; display: flex; justify-content: space-between;border-left: 5px solid black;">
            <div style="display: flex; gap: 35px;">
                <p class="card-text"><b>USUÁRIO:</b> <?php echo $dadosUsuario['email']; ?></p>
                <p class="card-text"><b>DATA:</b> <?php echo $dadosUsuario['data']; ?></p>
                <p class="card-text"><b>HORÁRIO: </b> <?php echo $dadosUsuario['hora']; ?> </p>
                <p class="card-text"><b>STATUS:</b><span style="color: <?php echo $statusColor; ?>;"> <?php echo $dadosUsuario['status']; ?></span></p>
            </div>
            <div>
                <button type="button" onclick="pegarId('<?php echo $id; ?>', 'idAtender')" data-bs-toggle="modal" data-bs-target="#atenderAgendamento" style="background-color: black; padding: 6px; color: white; border: 0px; border-radius: 5px; margin-bottom: 10px; width: 110px;">
                    Atender
                </button>
                <button type="button" onclick="pegarId('<?php echo $id; ?>', 'idFinalizar')" data-bs-toggle="modal" data-bs-target="#finalizarAgendamento" style="background-color: red; padding: 6px; color: white; border: 0px; border-radius: 5px; margin-bottom: 10px; width: 110px;">
                    Finalizar
                </button>
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
                return 'blue';
            default:
                return 'red';
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

    if ($acao == 'atender') {
        $status = 2;
        $id = $_POST['id'];

        $sql = "UPDATE agendamentos SET status='$status' WHERE id = $id";

        if (mysqli_query($conn, $sql)) {
            echo "<script>window.location.href = 'meusAgendamentos.php';</script>";  // Redireciona para a mesma página após a edição
            exit;
        } else
            echo "Não foi editado";
    }

    if ($acao == 'finalizar') {
        $status = 0;
        $id = $_POST['id'];

        $sql = "UPDATE agendamentos SET status='$status' WHERE id=$id";

        if (mysqli_query($conn, $sql)) {
            echo "<script>window.location.href = 'meusAgendamentos.php';</script>";  // Redireciona para a mesma página após a edição
            exit;
        } else
            echo "não foi editado";
    }
    ?>

    <!-- Modal para Atender -->
    <div class="modal fade" id="atenderAgendamento" tabindex="-1" aria-labelledby="atenderAgendamento" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" style="display: flex; align-items: center; justify-content: center;padding: 40px 0px 0px;">
                    <form id="atenderForm" action="meusAgendamentos.php?acao=atender" method="post" style="padding: 20px;">
                        <div class="d-flex flex-column align-items-center">
                            <i class="fa fa-exclamation-circle" style="font-size: 60px; padding: 10px; color: orange;"></i>
                            <h3>Atender Agendamento?</h3>
                        </div>
                        <p style="font-size: 20px;">Não é possível reverter essa ação!</p>
                </div>
                <div style="display: flex; align-items: center; justify-content: center; gap:10px; padding-bottom: 20px;">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="width: 25%; font-size: 20px;">Fechar</button>
                    <input type="text" name="id" id="idAtender" value="" readonly hidden>
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
                            <h3>Finalizar Atendimento?</h3>
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