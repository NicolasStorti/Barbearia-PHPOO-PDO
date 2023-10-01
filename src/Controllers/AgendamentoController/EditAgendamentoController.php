<?php

namespace Senac\Projeto\Controllers\AgendamentoController;

use Senac\Projeto\Controllers\BarbeiroController\SessionBarbeiro;
use Senac\Projeto\Controllers\Controller;
use Senac\Projeto\Repository\AgendamentoRepository;
use Senac\Projeto\Repository\UsuarioRepository;

class EditAgendamentoController implements Controller
{
    public function __construct(
        private AgendamentoRepository $agendamentoRepository,
        private SessionBarbeiro       $sessionBarbeiro,
        private UsuarioRepository     $usuarioRepository
    )
    {
    }

    public function processaRequisicao(): void
    {
        if (!$this->sessionBarbeiro->barbeiroAuthenticated()) {
            header('Location: /login-barbeiro');
            exit();
        }

        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if ($id === false || $id == null) {
            header('Location: /administracao?sucesso=0');
            exit();
        }
        $data = filter_input(INPUT_POST, 'data');
        if ($data === false || $data == null) {
            header('Location: /administracao?sucesso=0');
            exit();
        }
        $hora = filter_input(INPUT_POST, 'hora',);
        if ($hora === false || $hora == null) {
            header('Location: /administracao?sucesso=0');
            exit();
        }
        $agendamento = $this->agendamentoRepository->find($id);


        $agendamento->setData($data);
        $agendamento->setHora($hora);

        $result = $this->agendamentoRepository->update($agendamento);

        if ($result) {
            header('Location: /administracao?sucesso=1');
            exit();
        } else {
            header('Location: /administracao?sucesso=0');
            exit();
        }
    }


}
