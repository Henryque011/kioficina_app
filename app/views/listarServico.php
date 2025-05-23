<!DOCTYPE html>
<html lang="pt-br">

<?php
require_once('template/head.php');
?>

<body>
    <section class="lista_serv">
        <article class="site">
            <div class="box_list">
                <h2>lista de serviços</h2>
                <?php
                if (!empty($servicos) && is_array($servicos)) {
                    foreach ($servicos as $servico) {
                        $statusClass = '';
                        switch ($servico['status_ordem']) {
                            case 'Em análise':
                                $statusClass = 'status-analise';
                                break;
                            case 'Em andamento':
                                $statusClass = 'status-andamento';
                                break;
                            case 'Concluído':
                                $statusClass = 'status-concluido';
                                break;
                        }
                ?>
                        <div class="box_status">
                            <p><span class="destaque">Data de Entrada:</span><?= date('d/m/Y/ h:i', strtotime($servico['data_abertura_ordem'])) ?></p>
                            <p><span class="destaque">Previsão de Saída:</span><?= date('d/m/Y/ h:i', strtotime($servico['data_fechamento_ordem'])) ?></p>
                            <p><span class="destaque">Marca:</span><?= $servico['nome_marca'] ?></p>
                            <p><span class="destaque">Modelo:</span><?= $servico['nome_modelo'] ?></p>
                            <p><span class="destaque">Chassi:</span><?= $servico['chassi_veiculo'] ?></p>
                            <p><span class="destaque">Observação:</span><?= $servico['obs_ordem'] ?></p>
                            <p><span class="destaque">Total:</span><?= $servico['valor_total_ordem'] ?></p>
                            <p class="status_servico"><?= $servico['status_ordem'] ?></p>
                        </div>
                <?php
                    }
                } else {
                    echo "<p>Nenhuma ordem de serviço encontrada.<p>";
                }
                ?>
                <button class="button-servico"><a href="<?php echo BASE_URL; ?>index.php?url=menu">VOLTAR</a></button>
            </div>
        </article>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>