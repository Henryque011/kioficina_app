

<!DOCTYPE html>
<html lang="pt-br">

<?php
require_once('app/views/template/head.php')
?>

<body>
    <section class="depoimento">
        <article class="site">
            <h2>Deixe seu depoimento</h2>
            <div class="container">
                <div class="mb-3 text-start">
                    <label class="form-label fw-bold">Seu depoimento:</label>
                    <textarea class="form-control" rows="3"></textarea>
                </div>
                <div class="mb-3 text-start">
                    <label class="form-label fw-bold">Nota:</label>
                    <div class="stars">
                        <i class="fas fa-star" onclick="rate(1)"></i>
                        <i class="fas fa-star" onclick="rate(2)"></i>
                        <i class="fas fa-star" onclick="rate(3)"></i>
                        <i class="fas fa-star" onclick="rate(4)"></i>
                        <i class="fas fa-star" onclick="rate(5)"></i>
                    </div>
                </div>
                <button class="btn btn-custom w-100">Enviar Depoimento</button>
            </div>
            <button class="button-servico"><a href="<?php echo BASE_URL; ?>index.php?url=menu">VOLTAR</a></button>
            <!-- <button class="btn_cust">Voltar</button> -->
        </article>
    </section>

    <script>
        function rate(stars) {
            let starElements = document.querySelectorAll('.stars i');
            starElements.forEach((star, index) => {
                if (index < stars) {
                    star.classList.add('checked');
                } else {
                    star.classList.remove('checked');
                }
            });
        }
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/bedd2811b0.js" crossorigin="anonymous"></script>
</body>

</html>