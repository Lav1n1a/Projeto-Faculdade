<?php include('includes/header.php') ?>

<div class="content-wrapper" style="padding: 15px;">
    <h2>Agendamentos </h2>
    <?php
    if ($perfilId == 2) {
    ?>
        <button class="btn btn-success" style="width: 100px; margin: 7px 0px;" data-bs-toggle="modal" data-bs-target="#agendar" onclick="abrirModalAgendamento()"><i class="fas fa-plus"></i> Novo</button>
    <?php
    }
    ?>

    <?php
    if ($perfilId == 1) {
    ?>
    <?php
        $sqlRegistros = "SELECT a.id as id, a.id_usuario, DATE_FORMAT(a.data, '%d/%m/%Y') as data, a.hora as hora, e.nome, u.email as email, 
                        s.nome as status, s.id as codigo_status
                        FROM agendamentos a
                        LEFT JOIN especialidades e ON e.id = a.especialidade
                        LEFT JOIN usuarios u ON u.id = a.id_usuario
                        LEFT JOIN status s ON s.id = a.status";
    } else if ($perfilId == 2) {
    ?>
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
    <?php
        $sqlRegistros = "SELECT a.id AS id, a.email AS email, DATE_FORMAT(a.data, '%d/%m/%Y') as data, a.hora AS hora, e.nome AS nome, 
                        s.id AS codigo_status,  s.nome as status
                        FROM agendamentos a
                        LEFT JOIN perfil_especialidade pe ON pe.id_especialidade = a.especialidade
                        LEFT JOIN usuarios u ON u.id = a.id_usuario
                        LEFT JOIN especialidades e ON e.id = a.especialidade
                        LEFT JOIN status s ON s.id = a.status
                        WHERE pe.id_perfil = $perfilId AND s.id != 3";
    }

    $dadosRegistros = mysqli_query($conn, $sqlRegistros);

    if (mysqli_num_rows($dadosRegistros) > 0) {
    ?>
        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 10%; text-align: center;">ID</th>
                        <th style="width: 15%;">EMAIL</th>
                        <th style="width: 15%;">DATA</th>
                        <th style="width: 10%;">HORÁRIO</th>
                        <th style="width: 15%;">ESPECIALIDADE</th>
                        <th style="width: 10%;">STATUS</th>
                        <th style="width: 10%;">ACOES</th>
                    </tr>
                </thead>

                <tbody>

                    <?php

                    while ($dadosAgendamentos = mysqli_fetch_assoc($dadosRegistros)) {
                        $idAgendamento = $dadosAgendamentos['id'];
                        $statusColor = getStatusColor($dadosAgendamentos['codigo_status']);


                    ?>
                        <tr>

                            <td style="text-align:center;"><?php echo $dadosAgendamentos['id']; ?></td>
                            <td><?php echo $dadosAgendamentos['email']; ?></td>
                            <td><?php echo $dadosAgendamentos['data']; ?></td>
                            <td><?php echo $dadosAgendamentos['hora']; ?> </td>
                            <td><?php echo $dadosAgendamentos['nome']; ?></td>
                            <td><span style="color: <?php echo $statusColor; ?>;"> <?php echo $dadosAgendamentos['status']; ?></span></td>
                            <td>
                                <?php if ($perfilId == 1) { ?>
                                    <i title="Cancelar" class="fas fa-ban" style="cursor: pointer; margin: 0px 5px; " onclick="abrirAlert('<?php echo $idAgendamento; ?>', 'idCancelar')" data-bs-toggle="modal" data-bs-target="#cancelarAgendamento"></i>
                                    <i title="Finalizar" class="fas fa-times" style="cursor: pointer; margin: 0px 5px;" onclick="abrirAlert('<?php echo $idAgendamento; ?>', 'idFinalizar')" data-bs-toggle="modal" data-bs-target="#finalizarAgendamento"></i>
                                <?php } elseif ($perfilId == 2) { ?>
                                    <i title="Cancelar" class="fas fa-ban" style="cursor: pointer; margin: 0px 5px;" onclick="abrirAlert('<?php echo $idAgendamento; ?>', 'idCancelar')" data-bs-toggle="modal" data-bs-target="#cancelarAgendamento"></i>
                                <?php } else { ?>
                                    <i title="Finalizar" class="fas fa-times" style="cursor: pointer; margin: 0px 5px;" onclick="abrirAlert('<?php echo $idAgendamento; ?>', 'idFinalizar')" data-bs-toggle="modal" data-bs-target="#finalizarAgendamento"></i>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php
    } else {
        echo '
            <div class="alert alert-danger">
                <h5><i class="icon fas fa-ban"></i> Sem dados!</h5>
            </div>
            ';
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
                return 'orange';
        }
    }
    ?>

    <!-- Modal para Agendar -->
    <div class="modal fade" id="agendar" tabindex="-1" aria-labelledby="modalAgendamento" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalAgendamento">Agendar Consulta</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="agendamentoForm" action="../../back/controller/agendamentoController.php?acao=agendar" method="post" style="padding: 20px;">
                    <?php include('includes/agendarForm.php'); ?>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal para Atender -->
    <div class="modal fade" id="cancelarAgendamento" tabindex="-1" aria-labelledby="cancelarAgendamento" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" style="display: flex; align-items: center; justify-content: center;padding: 40px 0px 0px;">
                    <form id="cancelarForm" action="../../back/controller/agendamentoController.php?acao=cancelarAgendamento" method="post" style="padding: 20px;">
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
                    <form id="finalizarForm" action="../../back/controller/agendamentoController.php?acao=finalizarAgendamento" method="post" style="padding: 20px;">
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