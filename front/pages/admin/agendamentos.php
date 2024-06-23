<?php include ('./includes/header.php')?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding: 15px;">
   <h2 style="padding-bottom: 10px;">Agendamentos Registrados</h2>
   <div class="card" style="padding: 0px 15px 15px;">
    <table class="table">
        <thead>
            <tr>
                <th style="width: 15%;">Email</th>
                <th style="width: 15%;">Especialidade</th>
                <th style="width: 15%;">Data</th>
                <th style="width: 15%;">Horário</th>
                <th style="width: 15%;">Status</th>
            </tr>
        </thead>
        <?php 
        $sqlRegistros = "SELECT *, e.nome as especialidade, DATE_FORMAT(a.data, '%d/%m/%Y') as data,
        u.email as email, u.id as usuario_id, s.nome as status, a.status as codigo_status
        FROM agendamentos as a
        LEFT JOIN usuarios as u on u.id = a.usuario_id
        LEFT JOIN especialidades e ON e.id = a.especialidade
        LEFT JOIN status s ON s.codigo = a.status
        ORDER BY data ASC
        ";
        $dadosRegistros = mysqli_query($conn, $sqlRegistros); 

        while ($item = mysqli_fetch_assoc($dadosRegistros)) {
            $statusColor = getCodigoStatus($item['codigo_status']);
        ?>
        <tr>
            <td><?php echo $item['email']; ?></td>
            <td><?php echo $item['especialidade']; ?></td>
            <td><?php echo $item['data']; ?></td>
            <td><?php echo $item['hora']; ?></td>
            <td><span style="color: <?php echo $statusColor; ?>"><?php echo $item['status']; ?></span></td>
        </tr>
        <?php
        }
        ?>

        <?php 
            function getCodigoStatus($statusColor){
                switch($statusColor){
                    case 1:
                        return 'green';
                    case 2:
                        return 'blue';
                    default:
                        return 'red'; 
                }
            }
        ?>

    </table> 
    </div>
</div>

<?php include ('./includes/footer.php')?>
