<?php

require_once __DIR__ . '/inicio-html.html';

use Senac\Projeto\Entity\Usuario;

/** @var Usuario[] $usuarios */

?>

<?php require_once __DIR__ . '/navbar-barbeiro.php';?>

<section id="sessao-sistema">
    <div class="container">
        <div class="row">
            <div class="col-md-12 m-auto text-center">
                <h1 class="text-center mb-3">Usuários Cadastrados</h1>
                <div class="table-responsive">
                    <table class="table table-light table-hover text-center">
                        <thead>
                        <tr>
                            <th>Usuário</th>
                            <th>Data de Nascimento</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Excluir</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td><?= $usuario->getNome() ?></td>
                                <td><?= date('d/m/Y', strtotime($usuario->getDataNascimento())) ?></td>
                                <td><?= $usuario->getTelefone() ?></td>
                                <td><?= $usuario->getEmail() ?></td>
                                <td>
                                    <a href="/excluir-usuario?id=<?= $usuario->getId() ?>" class="btn btn-danger rounded-0 btn-table">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</section>


<?php require_once __DIR__ . '/footer.php'; ?>
<?php require_once __DIR__ . '/fim-html.html';?>