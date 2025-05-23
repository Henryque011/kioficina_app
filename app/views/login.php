<!DOCTYPE html>
<html lang="pt-br">

<?php
require_once('template/head.php')
?>

<body>
    <header>
        <a href="index.php"><img src="<?php echo BASE_URL; ?>assets/img/logo-kioficina.png" alt="logo-kioficina"></a>
    </header>
    <div class="space"></div>
    <section class="login">
        <article class="site">
            <h1>Login</h1>
            <div class="space"></div>
            <div class="box">
                <form action="<?php echo BASE_URL; ?>index.php?url=login/autenticar" method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">E-mail:</label>
                        <input type="email" class="form-control" id="email" name="email" required aria-describedby="emailHelp"
                            placeholder="">

                        <div class="form-group">
                            <label for="exampleInputPassword1">senha:</label>
                            <input type="password" class="form-control" id="senha" name="senha" required placeholder="">
                        </div>
                        <p><a href="<?php echo BASE_URL; ?>index.php?url=login/esqueciSenha">Esqueci a Senha<i class="fa-solid fa-key"></i></a></p>
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