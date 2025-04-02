

<!DOCTYPE html>
<html lang="pt-br">

<?php
require_once('app/views/template/head.php')
?>

<body>
    <section class="agendamento">
        <article class="site">
            <div class="space"></div>
            <h2>faça seu agendamento</h2>
            <div class="form-conteiner">
                <form>
                    <label class="form-label">veiculo:</label>
                    <select class="form-select mb-3">
                        <option selected>1</option>
                        <option>2</option>
                        <option>3</option>
                    </select>

                    <label class="form-label">Data:</label>
                    <input type="date" class="form-control mb-3">

                    <label class="form-label">Hora:</label>
                    <select class="form-select mb-3">
                        <option>08:00</option>
                        <option>09:00</option>
                        <option>10:00</option>
                    </select>

                    <label class="form-label">Funcionário:</label>
                    <select class="form-select mb-3">
                        <option value=" selected">Selecione um funcionário</option>
                        <option>João</option>
                        <option>Maria</option>
                    </select>

                    <button type="submit" class="btn btn-agendar">Agendar </button>
                </form>
            </div>
        </article>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>