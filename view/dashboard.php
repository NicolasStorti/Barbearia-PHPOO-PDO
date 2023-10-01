<?php
use Senac\Projeto\Entity\Agendamento;
use Senac\Projeto\Entity\Barbeiro;
use Senac\Projeto\Entity\Servico;

require_once __DIR__ . '/inicio-html.html';

/** @var ?Servico $servico */
/** @var ?Agendamento $agendamento */
/** @var ?Barbeiro $barbeiros */
/** @var Barbeiro[] $barbeiros */
/** @var Servico[] $servicos */
?>
<?php require_once __DIR__ . '/navbar-usuario.php'; ?>

<section id="sessao-sistema">
    <div class="container">
        <div class="row">
            <div class="col-md-6 m-auto">
                <h1 class="text-center mb-3">Agende Seu Horário</h1>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="data">Data:</label>
                        <input type="date" class="form-control rounded-0" id="data" name="data" value="<?= $agendamento ? $agendamento->getData() : '' ?>" required>
                    </div>

                    <div class="form-group">
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

                    <div class="mb-3">
                        <label for="barbeiroId" class="form-label">Barbeiro:</label>
                        <select class="form-select rounded-0" id="barbeiroId" name="barbeiroId">
                            <?php foreach ($barbeiros as $barbeiro) : ?>
                                <option value="<?= $barbeiro->getId() ?>" <?= ($barbeiro && $barbeiro->getId() == $barbeiro->getId() ) ? 'selected' : '' ?>>
                                    <?= $barbeiro->getNome() ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="servicoId" class="form-label">Serviço:</label>
                        <select class="form-select rounded-0" id="servicoId" name="servicoId">
                            <?php foreach ($servicos as $servico) : ?>
                                <option value="<?= $servico->getId() ?>" <?= ($servico && $servico->getId() == $servico->getId() ) ? 'selected' : '' ?>>
                                    <?= $servico->getNome() . ' - ' . $servico->getDescricao() ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-brand rounded-0">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/footer.php'; ?>

<?php require_once __DIR__ . '/fim-html.html'; ?>
