<?php include('includes/header.php'); ?>

<div class="content-wrapper" style="padding: 15px;">
            <h1>Bem vindo!</h1>
            <?php
            if ($perfilId == 2) {
                //Perfil paciente
            ?>

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

                <div class="card" id="cardPlataformaConsulta" style="width: 96%;">
                    <div class="card-header">
                        <b>
                            Plataforma para a Consulta
                        </b>

                    </div>
                    <ol style="padding-top: 10px; display: flex;">
                        <div>
                            <p>A plataforma que usaremos para nossa consulta online será o <a target="_blank" href="https://meet.google.com/">Google Meet</a>.</p>
                            <li>Acesse o Google Meet em um dispositivo com camera;</li>
                            <li>Permita que seu navegador use a sua camera e seu microfone.</li>
                        </div>
                        <p><img src="../assets/permissoes_meet.png" style="width: 45%; margin: 5px 35px;"></p>
                    </ol>
                </div>

                <div class="card" id="cardComoFunciona" style="width: 96%;">
                    <div class="card-header">
                        <b>Como Funciona:</b>

                    </div>
                    <ul style="padding-top: 10px;">
                        <li>No dia da sua consulta, você receberá um e-mail com um link para acessar a videochamada.</li>
                        <li>Abra o e-mail e clique em "Participar da chamada" para entrar na reunião.</li>
                    </ul>
                    <p style="width: 39%; margin: 5px 35px;"><b>FIQUE ATENTO! TOLERÂNCIA DE 15 MINUTOS DE ATRASO.</b></p>


                    <div style="display: flex; width: 100%; padding: 25px; gap: 50px;  margin-left: 20px;">
                        <?php

                        $sqlAgendamentoAtivo = " SELECT * FROM agendamentos
                    WHERE id_usuario = $id AND status = 1";

                        $horarioAtivo = mysqli_query($conn, $sqlAgendamentoAtivo);

                        if (mysqli_num_rows($horarioAtivo) > 0) {
                        } else {
                        ?>
                            <button class="btn btn-success" style="width: 35%;  font-size: 20px; " data-bs-toggle="modal" data-bs-target="#agendar" onclick="abrirModalAgendamento()">
                                Agendar Consulta
                            </button>
                        <?php
                        }
                        ?>

                        <button class="btn btn-secondary" style="width: 35%; font-size: 20px; padding: 5px; ">
                            <a href="/front/pages/agendamentos.php" style="display: block; width: 100%; height: 100%; color: white; text-decoration: none; text-align: center; line-height: 1.5;">
                                Meu Agendamento
                            </a>
                        </button>
                    </div>
                </div>
            <?php
            } else if ($perfilId != 1) {
                //Qualquer perfil que não seja de paciente ou administrador
            ?>
                <div class="card" id="cardEspecialista" style="width: 96%;">
                    <div class="card-header">
                        <b>
                            Plataforma para a Consulta
                        </b>

                    </div>
                    <ol style="padding-top: 10px; display: flex;">
                        <div>
                            <p>A plataforma que usada para a consulta online será o <a target="_blank" href="https://meet.google.com/">Google Meet</a>.</p>
                            <p>Para iniciar, siga estas etapas:</p>
                            <li>Acesse o Google Meet em um dispositivo com câmera.</li>
                            <li>Permita que o navegador use sua câmera e microfone.</li>
                            <li>Na página inicial do <a target="_blank" href="https://meet.google.com/">Google Meet</a>, clique no botão “Nova reunião”.</li>
                            <li>Selecione a opção “Iniciar uma reunião instantânea”.</li>
                            <li>Após isso, clique em “Adicionar outras pessoas”.</li>
                            <li>Digite o e-mail do paciente e, quando ele aparecer, selecione-o.</li>
                            <li>Finalmente, clique em “Enviar e-mail” para que o convite para a reunião seja enviado.</li>

                        </div>
                        <p><img src="../assets/permissoes_meet.png" style="width: 45%; margin: 5px 35px;"></p>
                    </ol>
                </div>

            <?php
            }
            ?>
</div>

<?php include('includes/footer.php') ?>