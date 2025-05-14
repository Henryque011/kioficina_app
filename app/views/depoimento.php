<!DOCTYPE html>
<html lang="pt-br">

<?php
require_once('template/head.php')
?>

<body>
    <section class="depoimento">
        <article class="site">
            <h2>Deixe seu depoimento</h2>

            <div class="container">
                <form method="POST" action="<?= BASE_URL ?>index.php?url=depoimento/enviarDepoimento">

                    <label for="descricao" class="descricao">Seu Depoimento:</label>
                    <textarea name="descricao" id="descricao" rows="4" required></textarea>

                    <label>Nota:</label>
                    <div class="stars">
                        <div class="stars">

                            <input type="radio" name="nota" id="star5" value="5"><label for="star5">★</label>
                            <input type="radio" name="nota" id="star4" value="4"><label for="star4">★</label>
                            <input type="radio" name="nota" id="star3" value="3"><label for="star3">★</label>
                            <input type="radio" name="nota" id="star2" value="2"><label for="star2">★</label>
                            <input type="radio" name="nota" id="star1" value="1" required><label for="star1">★</label>

                        </div>
                    </div>

                    <button type="submit" class="btn-custom">Enviar Depoimento</button>
                </form>
            </div>

            <a href="<?= BASE_URL ?>index.php?url=menu" class="btn-voltar">VOLTAR</a>
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