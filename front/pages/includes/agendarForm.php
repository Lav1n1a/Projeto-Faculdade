<div>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="email" value="<?php echo $email; ?>">
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
    <p><b>Dia:</b></p>
    <p><input class="form-control" id="data" type="date" name="data" /></p>

    <script>
        const inputDate = document.getElementById('data');

        inputDate.addEventListener('change', function() {
            const selectedDate = new Date(inputDate.value);
            const day = selectedDate.getDay();

            if (day === 5 || day === 6) { // Se for domingo (0) ou sábado (6)
                alert("Por favor, selecione uma data de segunda a sexta-feira.")
                inputDate.value = ''; 
            } 

        });
    </script>
</div>
<div>
    <p><b>Horário:</b></p>
    <select class="form-select" name="hora" id="hora" style="margin-bottom: 10px;">
        <option>Selecione um horário...</option>
        <?php
        $queryHorarios = "SELECT * from horarios";

        $horarios = mysqli_query($conn, $queryHorarios);

        while ($dadoshorarios = mysqli_fetch_assoc($horarios)) {
        ?>
            <option value=<?php echo $dadoshorarios['id'] ?>><?php echo $dadoshorarios['hora'] ?></option>
        <?php
        }
        ?>
    </select>
</div>
<div class="row">
    <div class="col-4">
        <button type="submit" class="btn btn-dark btn-block" style="background-color: black; border: 1px solid white;">Agendar</button>
    </div>
</div>