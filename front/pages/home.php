<?php include('includes/header.php'); ?>

<?php
include '../../back/conexao.php';

$acao = isset($_GET['acao']) ? $_GET['acao'] : null;

if ($acao == 'cadastrar') {
    
    $usuarioID = $_SESSION['id'];
    $especialidade = $_POST['especialidade'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];
    $status = 1;

    // Verifica se o horário já está ocupado para a data escolhida
    $sqlVerificaHorario = "SELECT *
                            FROM agendamentos
                            WHERE data = '$data' AND hora = '$hora'";

    $resultVerificaHorario = mysqli_query($conn, $sqlVerificaHorario);

    if (mysqli_num_rows($resultVerificaHorario) > 0) {
        echo "<script>alert('Desculpe, este horário já está ocupado. Por favor, escolha outro horário.');</script>";
    } else {
        // Se o horário estiver disponível, realiza a inserção
        $sql = "INSERT INTO `agendamentos`(`usuario_id`, `especialidade`, `data`, `hora`, `status`) 
                                VALUES
                                ('$usuarioID', '$especialidade', '$data', '$hora', '$status')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Cadastrado com sucesso!');</script>";
        } else {
            echo "NÃO foi cadastrado" . mysqli_error($conn);
        }
    }
}
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="modal fade" id="agendar" tabindex="-1" aria-labelledby="modalAgendamento" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalAgendamento">Agendar Consulta</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="agendamentoForm" action="home.php?acao=cadastrar" method="post" style="padding: 20px;">
                            <div>
                                <p style="padding: 10px auto;"><b>Especialidade:</b></p>
                                <select class="form-select" aria-label="Default select example" name="especialidade" id="especialidade" style="margin-bottom: 10px;">
                                    <option selected>Selecione uma especialidade...</option>
                                    <?php
                                    $queryEspecialidades = "SELECT * from especialidades";

                                    $especialidades = mysqli_query($conn, $queryEspecialidades);

                                    while ($dadosEspecialidades = mysqli_fetch_assoc($especialidades)) {
                                    ?>
                                        <option value=<?php echo $dadosEspecialidades['id'] ?>><?php echo $dadosEspecialidades['nome'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <p><b>Disponibilidade:</b></p>
                                <p><input class="form-control" id="data" type="date" name="data" /></p>
                            </div>
                            <div>
                                <p><b>Horário:</b></p>
                                <select class="form-select" name="hora" id="hora" style="margin-bottom: 10px;">
                                    <option>Selecione um horário...</option>
                                    <option value="08:00">07:00</option>
                                    <option value="10:00">08:30</option>
                                    <option value="18:00">10:00</option>
                                    <option value="18:00">13:00</option>
                                    <option value="18:00">15:30</option>
                                    <option value="18:00">17:00</option>
                                </select>
                            </div>

                            <script>
                                document.addEventListener("DOMContentLoaded", function() {

                                    function obterHorariosDisponiveis(dataSelecionada) {

                                        return Promise.resolve(["08:00", "10:00", "13:00", "15:30", "17:00"]);
                                    }

                                    document.getElementById('data').addEventListener('change', function() {
                                        var dataSelecionada = this.value;


                                        obterHorariosDisponiveis(dataSelecionada)
                                            .then(function(horariosDisponiveis) {
                                                // Atualiza as opções do select de horário com os horários disponíveis
                                                var selectHorario = document.getElementById('hora');
                                                selectHorario.innerHTML = '<option>Selecione um horário...</option>';

                                                horariosDisponiveis.forEach(function(horario) {
                                                    var option = document.createElement('option');
                                                    option.value = horario;
                                                    option.text = horario;
                                                    selectHorario.appendChild(option);
                                                });
                                            })
                                            .catch(function(error) {
                                                console.error('Erro ao obter horários disponíveis:', error);
                                            });
                                    });
                                });
                            </script>


                            <div class="row">
                                <div class="col-4">
                                    <button type="submit" class="btn btn-dark btn-block" style="background-color: black; border: 1px solid white;">Agendar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <b>
                        Plataforma para a Consulta
                    </b>

                </div>
                <ol style="padding-top: 10px; display: flex;">
                    <div>
                        <p>A plataforma que usaremos para nossa consulta online será o <a href="https://meet.google.com/">Google Meet</a>.</p>
                        <li>Acesse o Google Meet em um dispositivo com camera;</li>
                        <li>Permita que seu navegador use a sua camera e seu microfone.</li>
                    </div>
                    <p><img src="/agendaphp/assets/permissoes_meet.png" style="width: 45%; margin: 5px 35px;"></p>
                </ol>
            </div>

            <div class="card">
                <div class="card-header">
                    <b>Como Funciona:</b>

                </div>
                <ul style="padding-top: 10px;">
                    <li>No dia previsto para a sua consulta, você irá receber em seu gmail um convite com o link para acessar a video-chamada.</li>
                    <li>Acesse o link do convite e você será direcionado para sua consulta pelo Google Meet.</li>
                </ul>
                <p style="width: 39%; margin: 5px 35px;"><b>FIQUE ATENTO! TOLERÂNCIA DE 15 MINUTOS DE ATRASO.</b></p>

                <?php
                //Aqui estou deixando apenas disponiveis a ações de agendar para perfil comum(id:2)
                $perfilId = $_SESSION['perfil_id'];

                if ($perfilId != 2) {
                } else {
                ?>
                    <div style="display: flex; width: 100%; padding: 50px; gap: 50px;  margin-left: 20px;">
                        <?php
                        $usuario_id = $_SESSION['id'];

                        $sqlAgendamentoAtivo = " SELECT * FROM agendamentos
                    WHERE usuario_id = $usuario_id AND status = 1";

                        $horarioAtivo = mysqli_query($conn, $sqlAgendamentoAtivo);

                        if (mysqli_num_rows($horarioAtivo) > 0) {
                        } else {
                        ?>
                            <button class="btn btn-success" style="width: 35%;  font-size: 20px; " data-bs-toggle="modal" data-bs-target="#agendar" onclick="abrirModal()">
                                Agendar Consulta
                            </button>
                        <?php
                        }
                        ?>

                        <button class="btn btn-secondary" style="width: 35%;  font-size: 20px; " data-bs-toggle="modal" data-bs-target="#editar" onclick="abrirModal()">
                            <a href="/agendaphp/front/pages/meusAgendamentos.php" style="color: white; text-decoration: none;">
                                Meu Agendamento
                            </a>
                        </button>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>