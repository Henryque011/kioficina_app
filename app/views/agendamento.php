<!DOCTYPE html>
<html lang="pt-br">

<?php
require_once('template/head.php')
?>


<body>
    <section class="agendamento">
        <article class="site">
            <?php if (!empty($_SESSION['msg_sucess'])): ?>
                <div class="alert alert-success">
                    <?= $_SESSION['msg_sucess'] ?>
                </div>
                <?php unset($_SESSION['msg_sucess']); ?>
            <?php endif; ?>

            <?php if (!empty($_SESSION['msg_erro'])): ?>
                <div class="alert alert-danger">
                    <?= $_SESSION['msg_erro'] ?>
                </div>
                <?php unset($_SESSION['msg_erro']); ?>
            <?php endif; ?>

            <div class="space"></div>
            <h2>faça seu agendamento</h2>

            <div class="container">

                <form method="POST">
                    <div>
                        <label for="id_veiculo">Veículo:</label>
                        <select name="id_veiculo" id="id_veiculo" required>
                            <option value="">Selecione o veículo</option>
                            <?php foreach ($veiculos as $veiculo): ?>
                                <option value="<?= $veiculo['id_veiculo'] ?>"><?= $veiculo['nome_modelo'] ?> - <?= $veiculo['cor_veiculo'] ?> - <? $veiculo['ano_veiculo'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label for="data_agenda">Data:</label>
                        <input type="date" name="data_agenda" id="data_agenda" value="<?= date('Y-m-d') ?>" required>
                    </div>

                    <div>
                        <label for="hora_agenda">Hora:</label>
                        <select name="hora_agenda" id="hora_agenda" required>
                            <option value="">Selecione a hora</option>
                            <option value="08:00">08:00</option>
                            <option value="09:00">09:00</option>
                            <option value="10:00">10:00</option>
                            <option value="11:00">11:00</option>
                            <option value="12:00">12:00</option>
                            <option value="13:00">13:00</option>
                            <option value="14:00">14:00</option>
                            <option value="15:00">15:00</option>
                            <option value="16:00">16:00</option>
                            <option value="17:00">17:00</option>
                        </select>
                    </div>

                    <div>
                        <label>Funcionário:</label>
                        <select name="id_funcionario" id="id_funcionario" required>
                            <option value="">Selecione o funcionário</option>
                            <?php foreach ($funcionarios as $funcionario): ?>
                                <option value="<?= $funcionario['id_funcionario'] ?>"><?= $funcionario['nome_funcionario'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div>
                        <input type="submit" value="Agendar" class="btn-agenda"">
                    </div>
                </form>
            </div>
            <div class=" box" style="display: flex; justify-content: center; text-align: center; text-align: center;">
                        <a href="<?= BASE_URL ?>index.php?url=menu" class="btn-voltar">VOLTAR</a>
                    </div>

                    <div class="box" style="display: flex; justify-content: center; text-align: center; text-align: center;">
                        <a href="" class="btn-listAgenda">listar agenda</a>
                    </div>

        </article>
    </section>

    <script>
        setTimeout(function() {
            const alertBox = document.getElementById('msg-alert');
            if (alertBox) {
                alertBox.style.transition = "opacity 0.5s ease";
                alertBox.style.opacity = 0;
                setTimeout(() => alertBox.remove(), 500);
            }
        }, 5000);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>