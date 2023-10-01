<?php

namespace Senac\Projeto\Controllers\AgendamentoController;

use Senac\Projeto\Controllers\Controller;
use Senac\Projeto\Repository\AgendamentoRepository;
use Senac\Projeto\Controllers\BarbeiroController\SessionBarbeiro;

class DeleteAgendamentoController implements Controller
{
    public function __construct(private SessionBarbeiro $sessionBarbeiro, private AgendamentoRepository $agendamentoRepository)
    {
    }
    public function processaRequisicao(): void
    {
        if (!$this->sessionBarbeiro->barbeiroAuthenticated()) {
            header('Location: /login-barbeiro');
            exit();
        }

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id == null || $id == false){
            header('Location: /administracao?sucesso=0');
            return;
        }

        $success = $this->agendamentoRepository->remove($id);
        if($success === false){
            header('Location: /administracao?sucesso=0');
        }else{
            header('Location: /administracao?sucesso=1');
        }
    }
}