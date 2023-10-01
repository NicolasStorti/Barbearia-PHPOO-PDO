<?php

namespace Senac\Projeto\Controllers\BarbeiroController;

use Senac\Projeto\Controllers\{Controller};
use Senac\Projeto\Repository\{BarbeiroRepository};
use Senac\Projeto\Repository\AgendamentoRepository;
use Senac\Projeto\Repository\UsuarioRepository;
use Senac\Projeto\Repository\ServicoRepository;

class AdmBarbeiroController implements Controller
{
    public function __construct(
        private BarbeiroRepository $barbeiroRepository,
        private SessionBarbeiro $sessionBarbeiro,
        private AgendamentoRepository $agendamentoRepository,
        private UsuarioRepository $usuarioRepository,
        private ServicoRepository $servicoRepository
    )
    {
    }
    public function processaRequisicao(): void
    {
        if (!$this->sessionBarbeiro->barbeiroAuthenticated()) {
            header('Location: /login-barbeiro');
            exit();
        }

        $agendamentos = $this->agendamentoRepository->allAgenda();

        require_once __DIR__ . '/../../../view/administracao.php';
    }
}