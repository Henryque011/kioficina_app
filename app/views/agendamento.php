<!DOCTYPE html>
<html lang="pt-br">

<?php
require_once('template/head.php')
?>



<body>
    <section class="agendamento">
        <article class="site">
            <div class="space"></div>
            <h2>faça seu agendamento</h2>
            <div class="form-conteiner <?php echo $statusClass; ?>">
                <form action="<?php echo BASE_URL; ?>index.php?url=" method="POST">
                    <input type="hidden" name="id_Agendamento" value="<?php echo htmlspecialchars($Agendamento['id']); ?>"
                        <label class="form-label">veiculo:</label>
                    <select class="form-select mb-3">
                        <option selected value="<?php echo htmlspecialchars($agendamento['veiculo']); ?>" <?php echo htmlspecialchars($agendamento['veiculo'] ?? 'Honda Motor Co. Ltd. - Honda Civic'); ?></option>
                        <option>2</option>
                        <option>3</option>
                    </select>

                    <label class="form-label">Data:</label>
                    <input type="date" name="data" value="<?php echo htmlspecialchars($agendamento['data'] ?? ''); ?>">

                    <label class="form-label">Hora:</label>
                    <select class="form-select mb-3">
                        <option><?php
                                $horarios = ['08:00', '09:00', '10:00'];
                                foreach ($horarios as $hora) {
                                    $selected = ($agendamento['hora'] ?? '') === $hora ? 'selected' : '';
                                    echo "<option value=\"$hora\" $selected>$hora</option>";
                                }
                                ?>/option>
                    </select>

                    <label class="form-label">Funcionário:</label>
                    <select class="form-select mb-3">
                        <option value=" selected">Selecione um funcionário</option>
                        <option> <?php foreach ($funcionarios as $funcionario): ?>
                        <option value="<?= htmlspecialchars($funcionario['id']); ?>"
                            <?= ($funcionario['id'] == $agendamento['funcionario_id']) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($funcionario['nome']); ?>
                        </option>
                    <?php endforeach; ?></option>
                    <option>Maria</option>
                    </select>

                    <button type="submit" class="btn btn-agendar">Agendar </button>
                </form>
            </div>
            <div class="conteiner" style="display: flex; justify-content: center; text-align: center; text-align: center;">
                <a href="<?= BASE_URL ?>index.php?url=menu" class="btn-voltar">VOLTAR</a>
            </div>
        </article>
    </section>

    <?php
    if (!empty($agendamentos) && is_array($agendamentos)) {
        foreach ($agendamentos as $agendamento) {
            $statusClass = '';
            switch ($agendamento['status_agendamento']) {
                case 'Em análise':
                    $statusClass = 'status-analise';
                    break;
                case 'Cancelado':
                    $statusClass = 'status-cancelado';
                    break;
                case 'Concluído':
                    $statusClass = 'status-concluido';
                    break;
            }
        }
    } ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>