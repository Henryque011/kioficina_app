<?php

require_once('config/config.php');
$titulo = 'Login - ki-oficina';
?>

<!DOCTYPE html>
<html lang="pt-br">

<?php
require_once('app/views/template/head.php')
?>

<body>
    <header>
        <a href="index.html"><img src="<?php echo BASE_URL; ?>public/assets/img/logo-kioficina.png" alt="logo-kioficina"></a>
    </header>
    <div class="space"></div>
    <section class="login">
        <article class="site">
            <h1>Login</h1>
            <div class="space"></div>
            <div class="box">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">E-mail:</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="">

                        <div class="form-group">
                            <label for="exampleInputPassword1">senha:</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="">
                        </div>
                        <div class="form-button">
                            <button type="submit" class="btn btn-primary">Entrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </article>
    </section>
    <a href="menu.html" target="_blank"></a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/bedd2811b0.js" crossorigin="anonymous"></script>
</body>

</html>