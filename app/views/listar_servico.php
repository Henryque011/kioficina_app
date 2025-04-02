<?php

require_once('../../config/config.php');
$titulo = 'Listar servicos - ki-oficina';
?>

<!DOCTYPE html>
<html lang="pt-br">

<?php
require_once('app/views/template/head.php')
?>

<body>
    <section class="lista_serv">
        <article class="site">
            <div class="box_list">
                <h2>lista de serviços</h2>
                <div class="box_status">
                    <p><span class="destaque">Data de Entrada:</span> 29/08/2024</p>
                    <p><span class="destaque">Previsão de Saída:</span> 29/08/2024</p>
                    <p><span class="destaque">Marca:</span> Honda Motor Co. Ltd.</p>
                    <p><span class="destaque">Modelo:</span> Honda Civic</p>
                    <p><span class="destaque">Chassi:</span> 8APVZBA17HB004321</p>
                    <p><span class="destaque">Observação:</span> Pintura completa realizada.</p>
                    <p><span class="destaque">Total:</span> R$ 1.800,00</p>
                    <p class="status_servico">STATUS: EM ANÁLISE</p>
                </div>
                <button class="button-servico"><a href="menu.html">VOLTAR</a></button>
            </div>
        </article>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>