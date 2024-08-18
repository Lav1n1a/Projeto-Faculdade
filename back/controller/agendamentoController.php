<?php
include '../conexao.php';
$acao = isset($_GET['acao']) ? $_GET['acao'] : null;

if ($acao == 'agendar') {

    $idUsuario = $_POST['id'];
    $email = $_POST['email'];
    $idHora = $_POST['hora'];
    $idEspecialidade = $_POST['especialidade'];
    $data = $_POST['data'];

    $pegaHora = "select * from horarios where id = $idHora";
    $sqlhora = mysqli_query($conn, $pegaHora);
    $resultadoHorario =  mysqli_fetch_assoc($sqlhora);
    $hora = $resultadoHorario['hora'];

    //verifica se ja existe agendamento para o usuário
    $sqlAgendamentoAtivo = "SELECT *
    FROM agendamentos 
    WHERE id_usuario = '$idUsuario' AND status = 1";

    $agendamentoAtivo = mysqli_query($conn, $sqlAgendamentoAtivo);

    if (mysqli_num_rows($agendamentoAtivo) == 0) {

        $validaHorario = "select * from agendamentos where especialidade = '$idEspecialidade'
    and data = '$data' and hora = '$hora'";

        $sqlValidaHorario = mysqli_query($conn, $validaHorario);

         //Se não existir agendamento ativo, verifica se já existe agendamento do mesmo horário e especialidade
        if (mysqli_num_rows($sqlValidaHorario) > 0) {
            echo "<script>
        alert('Desculpe, este horário já está ocupado. Por favor, escolha outro horário.');
        window.location.href = '../../front/pages/home.php'
        </script>";
        } else {

            //Caso horário esteja livre, insere no banco
            $sql = "INSERT INTO `agendamentos` (`id_usuario`,  `email`, `especialidade`,  `data`, `hora`, `status`) VALUES ($idUsuario, '$email','$idEspecialidade', '$data', '$hora', '1')";

            if (mysqli_query($conn, $sql)) {

                echo "<script> alert('Agendado com sucesso!') 
            window.location.href = '../../front/pages/home.php'
            </script> ";
            } else {
                echo "Erro ao cadastrar agendamento:" . mysqli_error($conn);
                echo "<script>
            window.location.href = '../../front/pages/home.php'
            </script> ";
            }
        }

    } else {

        echo "<script>
            alert('Não é possível ter mais de um agendamento ativo!');
            window.location.href = '../../front/pages/home.php'
            </script> ";
    }
}

if ($acao == 'cancelarAgendamento') {
    $status = 3;
    $id = $_POST['id'];

    $sql = "UPDATE agendamentos SET status='$status' WHERE id = $id";


    $sqlPegaSeStatusFinalizado = "select * from agendamentos where id = $id and status = 2";

    $valida = mysqli_query($conn, $sqlPegaSeStatusFinalizado);

    if (mysqli_num_rows($valida) == 0) {

        if (mysqli_query($conn, $sql)) {
            echo "<script>
            alert('Agendamento cancelado!')
            window.location.href = '../../front/pages/agendamentos.php'
        </script>";
            exit;
        } else
            echo "Erro ao cancelar agendamento:" . mysqli_error($conn);
        echo "<script>
            window.location.href = '../../front/pages/agendamentos.php'
            </script> ";
    } else {
        echo "<script>
    alert('Não é possível cancelar um agendamento finalizado!')
     window.location.href = '../../front/pages/agendamentos.php'
 </script>";
    }
}

if ($acao == 'finalizarAgendamento') {
    $status = 2;
    $id = $_POST['id'];

    $sqlPegaSeStatusCancelado = "select * from agendamentos where id = $id and status = 3";

    $valida = mysqli_query($conn, $sqlPegaSeStatusCancelado);

    if (mysqli_num_rows($valida) == 0) {

        $sql = "UPDATE agendamentos SET status='$status' WHERE id=$id";

        if (mysqli_query($conn, $sql)) {
            echo "<script>
           alert('Agendamento finalizado!')
            window.location.href = '../../front/pages/agendamentos.php'
        </script>";
            exit;
        } else
            echo "Erro ao finalizar agendamento:" . mysqli_error($conn);
        echo "<script>
            window.location.href = '../../front/pages/agendamentos.php'
            </script> ";
    } else {
        echo "<script>
        alert('Não é possível finalizar um agendamento cancelado!')
         window.location.href = '../../front/pages/agendamentos.php'
     </script>";
    }
}
