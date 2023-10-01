<?php

namespace Senac\Projeto\Controllers\ServicoController;

use Senac\Projeto\Controllers\{Controller, BarbeiroController\SessionBarbeiro};
use Senac\Projeto\Repository\{ServicoRepository, BarbeiroRepository};
use Senac\Projeto\Entity\{Servico};

class FormServicoController implements Controller
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
        $servico = null;

        if ($id !== false && $id !== null){
            $servico = $this->servicoRepository->find($id);
        }
        $barbeiros = $this->barbeiroRepository->allBarbeiros();
        require_once __DIR__ . '/../../../view/form-servico.php';
    }
}
