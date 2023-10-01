<?php

namespace Senac\Projeto\Controllers\AgendamentoController;

use Senac\Projeto\Controllers\{Controller, UsuariosController\SessionUsuarioController};
use Senac\Projeto\Repository\{AgendamentoRepository};
use Senac\Projeto\Entity\{Agendamento};

class NewAgendamentoController implements Controller
{
    public function __construct(private AgendamentoRepository $agendamentoRepository, private SessionUsuarioController $sessionUsuarioController)
    {
    }

    public function processaRequisicao(): void
    {
        $data = filter_input(INPUT_POST, 'data');
        if($data === false){
            header('Location: /dashboard?sucesso=0');
            exit();
        }
        $hora = filter_input(INPUT_POST, 'hora');
        if($hora === false){
            header('Location: /dashboard?sucesso=0');
            exit();
        }
        $barbeiroId = filter_input(INPUT_POST, 'barbeiroId');
        if($barbeiroId === false){
            header('Location: /dashboard?sucesso=0');
            exit();
        }
        $servicoId = filter_input(INPUT_POST, 'servicoId');
        if($servicoId === false){
            header('Location: /dashboard?sucesso=0');
            exit();
        }


        if (!$this->sessionUsuarioController->usuarioAuthenticated()) {
            header('Location: /');
            exit();
        }
        $barbeiro = $this->sessionUsuarioController->getUser();
        if ($barbeiro !== null) {
            $usuarioId = $barbeiro->getId();
        } else {
            header('Location: /');
            exit();
        }

        $id=null;

        $success = $this->agendamentoRepository->agendarHorario(new Agendamento($id,$data,$hora,$usuarioId,$barbeiroId,$servicoId));
        if($success === false){
            header('Location: /dashboard?sucesso=0');
        }else{
            header('Location: /dashboard?sucesso=1');
        }
    }
}