
<!DOCTYPE html>
<html lang="pt-br">

<?php
require_once('app/views/template/head.php')
?>

<body>
    <section class="perfil">
        <article class="site">
            <h2>meu perfil</h2>
            <div class="profile-container">
                <img src="public/assets/img/DLRE.jpg" alt="Foto de Perfil" class="profile-pic">
                <span class="add-icon"><i class="fas fa-plus"></i></span>
            </div>
            <div class="container">
                <form>
                    <div class="mb-2 text-start">
                        <label>Nome:</label>
                        <input type="text" class="form-control" value="João Silva">
                    </div>
                    <div class="mb-2 text-start">
                        <label>Email:</label>
                        <input type="email" class="form-control" value="joao.silva@email.com">
                    </div>
                    <div class="mb-2 text-start">
                        <label>Telefone:</label>
                        <input type="text" class="form-control" value="11987654321">
                    </div>
                    <div class="mb-2 text-start">
                        <label>Endereço:</label>
                        <input type="text" class="form-control" value="Rua das Flores, 123">
                    </div>
                    <div class="mb-2 text-start">
                        <label>Bairro:</label>
                        <input type="text" class="form-control" value="Mogi">
                    </div>
                    <div class="row mb-2">
                        <div class="col-7 text-start">
                            <label>Cidade:</label>
                            <input type="text" class="form-control" value="São Paulo">
                        </div>
                        <div class="col-5 text-start">
                            <label>Estado:</label>
                            <select class="form-select">
                                <option selected>SP</option>
                                <option>RJ</option>
                                <option>MG</option>
                                <option>ES</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-2 text-start">
                        <label>Alterar Senha (Opcional):</label>
                        <input type="password" class="form-control" placeholder="Nova senha">
                    </div>
                </form>
                <button type="submit" class="btn btn-custom mt-2">Salvar Alterações</button>
            </div>
            <button class="button-servico"><a href="<?php echo BASE_URL; ?>index.php?url=menu">VOLTAR</a></button>
        </article>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/bedd2811b0.js" crossorigin="anonymous"></script>
</body>

</html>