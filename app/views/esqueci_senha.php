<!DOCTYPE html>
<html lang="pt-br">

<?php
require_once(__DIR__ . '/template/head.php');

?>

<body>
    <section class="esqueci_senha">
        <article class="site">
            <div class="container">
                <h2>Recupear senha</h2>
                <form action="index.php?url=login/enviarRecuperacao" method="POST">
                    <label for="email">E-mail cadastrado:</label>
                    <input type="email" name="email" id="email" required>

                    <input type="submit" value="Enviar link" class="btn-link">
                </form>
                <p><a href="<?php echo BASE_URL; ?>inde.php?url=login/login">voltar ao login</a></p>
            </div>
        </article>
    </section>
</body>

</html>