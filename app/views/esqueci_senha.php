<!DOCTYPE html>
<html lang="pt-br">

<?php
require_once(__DIR__ . '/template/head.php');
?>

<body>

    <section class="esqueci_senha">
        <article class="site">
            <div class="container">

                <?php if (!empty($_SESSION['flash']) && is_array($_SESSION['flash'])): ?>
                    <div class="alert <?= $_SESSION['flash']['tipo'] ?>">
                        <?= $_SESSION['flash']['mensagem'] ?>
                    </div>
                    <?php unset($_SESSION['flash']); ?>
                <?php endif; ?>

                <h2>Recupear senha</h2>
                <form action="index.php?url=login/enviarRecuperacao" method="POST">
                    <label for="email">E-mail cadastrado:</label>
                    <input type="email" name="email" id="email" required>

                    <input type="submit" value="Enviar link" class="btn-link">
                </form>

            </div>
            <p><a href="<?php echo BASE_URL; ?>index.php?url=login/">voltar ao login</a></p>

        </article>
    </section>
</body>

</html>