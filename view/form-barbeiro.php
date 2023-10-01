<?php
require_once __DIR__ . '/inicio-html.html';

use Senac\Projeto\Entity\Barbeiro;
?>
<?php require_once __DIR__ . '/nav-login.php';?>

<section id="sessao-sistema">
    <div class="container">
        <div class="row">
            <div class="col-md-6 m-auto">
                <h1 class="text-center mb-3">Cadastro de Barbeiro</h1>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" class="form-control rounded-0" id="nome" name="nome"
                               value="<?= $barbeiro ? $barbeiro->getNome() : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone:</label>
                        <input type="text" class="form-control rounded-0" id="telefone" name="telefone"
                               value="<?= $barbeiro ? $barbeiro->getTelefone() : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="endereco" class="form-label">Endereço:</label>
                        <input type="text" class="form-control rounded-0" id="endereco" name="endereco"
                               value="<?= $barbeiro ? $barbeiro->getEndereco() : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control rounded-0" id="email" name="email"
                               value="<?= $barbeiro ? $barbeiro->getEmail() : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha:</label>
                        <input type="password" class="form-control rounded-0" id="senha" name="senha"
                               value="<?= $barbeiro ? $barbeiro->getSenha() : '' ?>">
                    </div>

                    <button class="btn btn-brand rounded-0" type="submit" id="btn">
                        Salvar
                    </button>
                    <a href="/login-barbeiro">Login Barbeiro</a>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/footer.php';?>
<?php require_once __DIR__ . '/fim-html.html'; ?>
