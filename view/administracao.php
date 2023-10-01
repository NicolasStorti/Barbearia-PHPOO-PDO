<?php
use Senac\Projeto\Entity\Agendamento;
use Senac\Projeto\Entity\Barbeiro;
use Senac\Projeto\Entity\Servico;
use Senac\Projeto\Entity\Usuario;

require_once __DIR__ . '/inicio-html.html';

/** @var Agendamento[] $agendamentos */
?>
<?php require_once __DIR__ . '/navbar-barbeiro.php'; ?>

<section id="sessao-sistema">
    <div class="container">
        <div class="row">
            <div class="col-md-12 m-auto">
                <h1 class="text-center mb-3">Horários Agendados</h1>
                <div class="table-responsive">
                    <table class="table table-light table-hover text-center">
                        <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Data</th>
                            <th>Hora</th>
                            <th>Serviço</th>
                            <th>Descrição</th>
                            <th>Barbeiro</th>
                            <th>Alterar/Excluir</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($agendamentos as $agendamento): ?>
                            <tr>
                                <td><?= $agendamento->getNomeUsuario() ?></td>
                                <td><?= date('d/m/Y', strtotime($agendamento->getData())) ?></td>
                                <td><?= $agendamento->getHora() ?></td>
                                <td><?= $agendamento->getNomeServico() ?></td>
                                <td><?= $agendamento->getDescricaoServico() ?></td>
                                <td><?= $agendamento->getNomeBarbeiro() ?></td>
                                <td>
                                    <a href="/edit-agendamento?id=<?= $agendamento->getId() ?>"
                                       class="btn btn-secondary rounded-0 btn-table">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="/excluir-agendamento?id=<?= $agendamento->getId() ?>"
                                       class="btn btn-danger rounded-0 btn-table">
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


