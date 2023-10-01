<?php

namespace Senac\Projeto\Controllers\AgendamentoController;

use Senac\Projeto\Controllers\Controller;
use Senac\Projeto\Entity\Agendamento;
use Senac\Projeto\Repository\AgendamentoRepository;
use Senac\Projeto\Controllers\BarbeiroController\SessionBarbeiro;

class EditFormAgendamentoController implements Controller
{
    public function __construct(private AgendamentoRepository $agendamentoRepository,private SessionBarbeiro $sessionBarbeiro)
    {
    }

    public function processaRequisicao(): void
    {
        if (!$this->sessionBarbeiro->barbeiroAuthenticated()) {
            header('Location: /login-barbeiro');
            exit();
        }

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        /** @var ?Agendamento $agendamento */

        if ($id !== false && $id !== null){
            $agendamento = $this->agendamentoRepository->find($id);
        }

        require_once __DIR__ . '/../../../view/edit-agendamento.php';
    }
}