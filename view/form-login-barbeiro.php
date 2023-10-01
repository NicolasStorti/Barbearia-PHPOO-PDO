<?php

require_once __DIR__ . '/inicio-html.html';

use Senac\Projeto\Entity\Barbeiro;

/** @var ?Barbeiro $barbeiro */

?>
<?php require_once __DIR__ . '/nav-login.php'; ?>

    <section id="sessao-sistema">
        <div class="container">
            <div class="row">
                <div class="col-md-6 m-auto">
                    <h1>Login Barbeiro</h1>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control rounded-0" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha:</label>
                            <input type="password" class="form-control rounded-0" id="senha" name="senha" required>
                        </div>
                        <div class="btn-login">
                            <button class="btn btn-brand rounded-0" type="submit" id="btn">
                                Entrar
                            </button>
                            <a href="/cadastro-barbeiro">Cadastro Barbeiro</a>
                            <a href="/login">Login Usuário <i class="bi bi-person-fill"></i></a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>


<?php require_once __DIR__ . '/footer.php'; ?>


<?php require_once __DIR__ . '/fim-html.html'; ?>