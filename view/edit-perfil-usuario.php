<?php
use Senac\Projeto\Entity\Usuario;

require_once __DIR__ . '/inicio-html.html';
/** @var Usuario|null $usuario */
?>
<?php require_once __DIR__ . '/navbar-usuario.php';?>

<section id="sessao-sistema">
    <div class="container">
        <div class="row">
            <div class="col-md-6 m-auto">
                <h1 class="text-center mb-3">Editar Meu Perfil</h1>
                <form action="" method="post">
                    <input type="hidden" name="id" id="id" value="<?= $usuario->getId() ?>">

                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" class="form-control rounded-0" id="nome" name="nome" value="<?= $usuario->getNome() ?>">
                    </div>
                    <div class="mb-3">
                        <label for="dataNascimento" class="form-label">Data de Nascimento:</label>
                        <input type="date" class="form-control rounded-0" id="dataNascimento" name="dataNascimento" value="<?= $usuario->getDataNascimento() ?>">
                    </div>
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone:</label>
                        <input type="text" class="form-control rounded-0" id="telefone" name="telefone" value="<?= $usuario->getTelefone() ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control rounded-0" id="email" name="email" value="<?= $usuario->getEmail() ?>">
                    </div>

                    <button class="btn btn-brand rounded-0" type="submit" id="btn">
                        Salvar
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/footer.php'; ?>

<?php require_once __DIR__ . '/fim-html.html'; ?>
