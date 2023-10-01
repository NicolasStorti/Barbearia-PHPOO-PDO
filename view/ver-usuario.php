<?php

require_once __DIR__ . '/inicio-html.html';

use Senac\Projeto\Entity\Usuario;


/** @var Usuario $usuario */

?>

<?php require_once __DIR__ . '/navbar-usuario.php'; ?>

<section id="sessao-sistema">
    <div class="container">
        <div class="row">
            <div class="col-md-7 m-auto informacoes">
                <h1 class="text-center mb-3">Minhas Informações</h1>
                <p><strong>Meu nome: </strong><?= $usuario->getNome() ?></p>
                <p><strong>Data de Nascimento: </strong><?= date('d/m/Y', strtotime($usuario->getDataNascimento())) ?></p>
                <p><strong>Telefone: </strong><?= $usuario->getTelefone() ?></p>
                <p><strong>Email: </strong><?= $usuario->getEmail() ?></p>
                <a href="/editar-usuario?id=<?= $usuario->getId() ?>" class="btn btn-brand rounded-0">Editar Meu Perfil</a>
            </div>
        </div>
    </div>
</section>



<?php require_once __DIR__ . '/footer.php'; ?>
<?php require_once __DIR__ . '/fim-html.html'; ?>