<?php

require_once(__DIR__ . '/../../config/config.php');

$titulo = 'Menu Principal - ki-oficina';
?>

<!DOCTYPE html>
<html lang="pt-br">

<?php
require_once(__DIR__ . '/template/head.php');

?>


<body>
    <header>
        <a href="index.php"><img src="<?php echo BASE_URL; ?>assets/img/logo-kioficina.png" alt="logo-kioficina"></a>
    </header>

    <section class="menu">
        <div class="space"></div>
        <article class="site">
            <h2>Bem vindo á ki-oficina!</h2>
            <p>Olá, <?php echo $nome_cliente ?>!</p>
            <div class="space"></div>
            <div class="box_links">
                <a href="<?php echo BASE_URL; ?>index.php?url=agendamento"><button>agendamento</button></a>
            </div>
            <div class="box_links">
                <a href="<?php echo BASE_URL; ?>index.php?url=listar_servico"><button>listar serviço</button></a>
            </div>
            <div class="box_links">
                <a href="<?php echo BASE_URL; ?>index.php?url=depoimento"><button>Depoimentos</button></a>
            </div>
            <div class="box_links">
                <a href="<?php echo BASE_URL; ?>index.php?url=perfil"><button>Perfil</button></a>
            </div>
            <div class="box_links-sair">
                <a href="<?php echo BASE_URL; ?>index.php?url=login"><button>Sair</button></a>
            </div>
        </article>
    </section>

    <?php if (isset($_SESSION['mensagem'])): ?>
        <div id="mensagem-sucesso" class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['mensagem'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
        <?php unset($_SESSION['mensagem']); ?>
    <?php endif; ?>

    <script>
        setTimeout(function() {
            var msg = document.getElementById('mensagem-sucesso');
            if (msg) {
                msg.classList.remove('show'); 
                msg.classList.add('fade'); 
                setTimeout(() => msg.remove(), 500); 
            }
        }, 4000);
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>