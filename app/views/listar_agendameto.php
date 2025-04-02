<?php

require_once('../../config/config.php');
$titulo = 'Listar agendamento- ki-oficina';
?>

<!DOCTYPE html>
<html lang="pt-br">

<?php
require_once('app/views/template/head.php')
?>

<body>
    <section class="lista">
        <article class="site">
            <div class="box_list">
                <h2>lista de agendamento</h2>
                <div class="box_status">
                    <p><span class="destaque">Veículo:</span> Honda Motor Co. Ltd. - Honda Civic</p>
                    <p><span class="destaque">Funcionário:</span> Fernanda Oliveira</p>
                    <p><span class="destaque">Data Agenda:</span> 29/08/2024 11:00</p>
                    <p class="status_concluido">STATUS: concluído</p>
                </div>
                <div class="box_status">
                    <p><span class="destaque">Veículo:</span> Honda Motor Co. Ltd. - Honda Civic</p>
                    <p><span class="destaque">Funcionário:</span> Juliana Mendes</p>
                    <p><span class="destaque">Data Agenda:</span> 28/02/2025 11:00</p>
                    <p class="status_cancelado">STATUS: cancelado</p>
                </div>
                <div class="box_status">
                    <p><span class="destaque">Veículo:</span> Honda Motor Co. Ltd. - Honda Civic</p>
                    <p><span class="destaque">Funcionário:</span> Juliana Mendes</p>
                    <p><span class="destaque">Data Agenda:</span> 28/02/2025 11:00</p>
                    <p class="status_analise">STATUS: cancelado</p>
                </div>
                <a href="menu.html" class="btn">Voltar</a>
            </div>
        </article>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>