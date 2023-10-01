<?php

use Senac\Projeto\Entity\Servico;

require_once __DIR__ . '/inicio-html.html';

/** @var Servico[] $servicos */

?>

<?php require_once __DIR__ . '/navbar-barbeiro.php'; ?>

<section id="sessao-sistema">
    <div class="container">
        <div class="row">
            <div class="col-md-12 m-auto text-center">
                <h1 class="text-center mb-3">Serviços Cadastrados</h1>
                <div class="table-responsive">
                    <table class="table table-light table-hover text-center">
                        <thead>
                        <tr>
                            <th>Nome do Serviço</th>
                            <th>Descrição</th>
                            <th>Preço</th>
                            <th>Barbeiro</th>
                            <th>Alterar/Excluir</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($servicos as $servico): ?>
                            <tr>
                                <td><?= $servico->getNome() ?></td>
                                <td><?= $servico->getDescricao() ?></td>
                                <td><?= $servico->getPreco() ?></td>
                                <td><?= $servico->getNomeBarbeiro() ?></td>
                                <td>
                                    <a href="/edit-servico?id=<?= $servico->getId() ?>" class="btn btn-secondary rounded-0 btn-table">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="/delete-servico?id=<?= $servico->getId() ?>" class="btn btn-danger rounded-0 btn-table">
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
<?php require_once __DIR__ . '/fim-html.html'; ?>