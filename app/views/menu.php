<?php

require_once('../../config/config.php');
$titulo = 'Menu Principal - ki-oficina';
?>

<!DOCTYPE html>
<html lang="pt-br">

<?php 
require_once('app/views/template/head.php')
?>


<body>
    <header>
        <a href="index.html"><img src="public/assets/img/logo-kioficina.png" alt="logo-kioficina"></a>
    </header>

    <section class="menu">
        <div class="space"></div>
        <article class="site">
            <h2>Bem vindo á ki-oficina!</h2>
            <p>Olá, joão silva!</p>
            <div class="space"></div>
            <div class="box_links">
                <a href="agendamento.html"><button>agendamento</button></a>
            </div>
            <div class="box_links">
                <a href="lista_agendameto.html"><button>listar serviço</button></a>
            </div>
            <div class="box_links">
                <a href="#"><button>Depoimentos</button></a>
            </div>
            <div class="box_links">
                <a href="#"><button>Perfil</button></a>
            </div>
            <div class="box_links-sair">
                <a href="#"><button>Sair</button></a>
            </div>
        </article>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>