<?php

require_once __DIR__ . '/inicio-html.html';

use Senac\Projeto\Entity\Servico;
use Senac\Projeto\Entity\Barbeiro;

/** @var ?Servico $servico */
/** @var Barbeiro[] $barbeiros */
?>
<?php require_once __DIR__ . '/navbar-barbeiro.php';?>
<section id="sessao-sistema">
    <div class="container">
        <div class="row">
            <div class="col-md-6 m-auto">
                <h1 class="text-center mb-3">Cadastro de Serviços</h1>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Serviço:</label>
                        <input type="text" class="form-control rounded-0" id="nome" name="nome" value="<?= $servico ? $servico->getNome() : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição:</label>
                        <input type="text" class="form-control rounded-0" id="descricao" name="descricao" value="<?= $servico ? $servico->getDescricao() : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="preco" class="form-label">Preço:</label>
                        <input type="text" class="form-control rounded-0" id="preco" name="preco" value="<?= $servico ? $servico->getPreco() : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="barbeiroId" class="form-label">Barbeiro:</label>
                        <select class="form-select rounded-0" id="barbeiroId" name="barbeiroId">
                            <?php foreach ($barbeiros as $barbeiro) : ?>
                                <option value="<?= $barbeiro->getId() ?>" <?= ($servico && $servico->getBarbeiroId() == $barbeiro->getId() ) ? 'selected' : '' ?>>
                                    <?= $barbeiro->getNome() ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
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