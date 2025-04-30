<!DOCTYPE html>
<html lang="pt-br">

<?php
require_once('app/views/template/head.php')
?>
<style>
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
</style>

<body>
    <div class="container">
        <h2>Redefinir Senha</h2>
        <form action="/api/resetarSenha" method="POST">
            <input type="hidden" name="token" value="<?= htmlspecialchars($_GET['token'] ?? '') ?>">

            <label for="nova_senha">Nova Senha:</label>
            <input type="password" name="nova_senha" id="nova_senha" required>

            <input type="submit" value="Salvar Nova Senha">
        </form>
    </div>
</body>

</html>