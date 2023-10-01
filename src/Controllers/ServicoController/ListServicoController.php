<?php

namespace Senac\Projeto\Controllers\ServicoController;

use Senac\Projeto\Controllers\BarbeiroController\SessionBarbeiro;
use Senac\Projeto\Controllers\Controller;
use Senac\Projeto\Repository\BarbeiroRepository;
use Senac\Projeto\Repository\ServicoRepository;

class ListServicoController implements Controller
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
        global $pdo;
        if (!$this->sessionBarbeiro->barbeiroAuthenticated()) {
            header('Location: /login-barbeiro');
            exit();
        }

        $servicoRepository = new ServicoRepository($pdo);

        $servicos = $this->servicoRepository->allServicos();

        require_once __DIR__ . '/../../../view/servicos-cadastrados.php';
    }
}