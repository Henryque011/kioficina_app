<!DOCTYPE html>
<html lang="pt-br">

<?php
require_once(__DIR__ . '/template/head.php');

?>

<!-- <style>
    body {
        font-family: Arial, sans-serif;
        padding: 30px;
        background: #f4f4f4;
        color: #333;
    }

    .container {
        max-width: 450px;
        margin: auto;
        background: #fff;
        padding: 25px;
        border-radius: 6px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    input[type="password"],
    input[type="submit"] {
        width: 100%;
        padding: 10px;
        margin-top: 10px;
    }

    input[type="submit"] {
        background: #0073e6;
        color: white;
        border: none;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background: #005bb5;
    }

    .alert {
        color: red;
        margin-top: 10px;
    }
</style> -->

<body>
    <section class="esqueci_senha">
        <article class="site">
            <div class="container">
                <h2>Recupear senha</h2>
                <form action="index.php?url=login/enviarRecuperacao" method="POST">
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" id="email" required>

                    <input type="submit" value="Enviar link de recuperação">
                </form>

            </div>
        </article>
    </section>

</body>

</html>