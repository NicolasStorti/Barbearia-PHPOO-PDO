<?php require_once __DIR__ . '/inicio-html.html'; ?>
<?php require_once __DIR__ . '/nav-login.php'; ?>

<section id="agradecimento">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-12">
                <h1>Agradecemos o seu Contato</h1>
                <p>É pelo reconhecimento de clientes como você que nos esforçamos para fazer o melhor trabalho. Obrigado.</p>
            </div>
            <div class="col-lg-12">
                <h3 class="h5">Você será redirecionado para Home em 5 segundos.</h3>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/footer.php'; ?>

<script type="text/javascript">
    setTimeout(function () {
        window.location.href = "/";
    }, 5000);
</script>

<?php require_once __DIR__ . '/fim-html.html'; ?>

