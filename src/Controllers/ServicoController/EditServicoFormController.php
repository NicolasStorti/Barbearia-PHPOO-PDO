<?php

namespace Senac\Projeto\Controllers\ServicoController;

use Senac\Projeto\Controllers\BarbeiroController\SessionBarbeiro;
use Senac\Projeto\Controllers\Controller;
use Senac\Projeto\Entity\Servico;
use Senac\Projeto\Repository\BarbeiroRepository;
use Senac\Projeto\Repository\ServicoRepository;

class EditServicoFormController implements Controller
{
    public function __construct(
        private ServicoRepository $servicoRepository,
        private BarbeiroRepository $barbeiroRepository,
        private SessionBarbeiro $sessionBarbeiro
    )
    {
    }

    public function processaRequisicao(): void
    {
        if (!$this->sessionBarbeiro->barbeiroAuthenticated()) {
            header('Location: /login-barbeiro');
            exit();
        }

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        /** @var ?Servico $servico */

        if ($id !== false && $id !== null){
            $servico = $this->servicoRepository->find($id);
        }

        require_once __DIR__ . '/../../../view/edit-servico.php';
    }
}