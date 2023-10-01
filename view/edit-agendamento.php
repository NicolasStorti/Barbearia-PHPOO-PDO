<?php
use Senac\Projeto\Entity\Agendamento;

require_once __DIR__ . '/inicio-html.html';

/** @var Agendamento|null $agendamento */
?>
<?php require_once __DIR__ . '/navbar-barbeiro.php'; ?>

<section id="sessao-sistema">
    <div class="container">
        <div class="row">
            <div class="col-md-6 m-auto">
                <h1 class="text-center mb-3">Editar Agendamento</h1>

                <?php if (isset($agendamento)): ?>
                    <form method="POST" action="">
                        <input type="hidden" name="id" value="<?= $agendamento->getId() ?>">
                        <div class="mb-3">
                            <label for="data" class="form-label">Data:</label>
                            <input type="date" id="data" name="data" class="form-control rounded-0" value="<?= $agendamento->getData() ?>">
                        </div>

                        <div class="form-group mb-4">
                            <label for="hora">Hora:</label>
                            <select class="form-control rounded-0" id="hora" name="hora" required>
                                <option value="" disabled selected>Selecione a hora</option>
                                <?php
                                $selectedHora = $agendamento ? date('H:i', strtotime($agendamento->getHora())) : '';

                                $horaInicial = strtotime('09:00');
                                $horaFinal = strtotime('19:00');
                                $intervalo = 60 * 60;

                                while ($horaInicial <= $horaFinal) {
                                    $horaFormatada = date('H:i', $horaInicial);

                                    if ($horaFormatada !== '12:00') {
                                        $selected = ($selectedHora === $horaFormatada) ? 'selected' : '';
                                        echo "<option value=\"$horaFormatada\" $selected>$horaFormatada</option>";
                                    }

                                    $horaInicial += $intervalo;
                                }
                                ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-brand rounded-0">Salvar Alterações</button>
                    </form>
                <?php else: ?>
                    <p>Agendamento não encontrado.</p>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/footer.php'; ?>

<?php require_once __DIR__ . '/fim-html.html'; ?>


