<?php

namespace Senac\Projeto\Controllers\ServicoController;

use Senac\Projeto\Controllers\BarbeiroController\SessionBarbeiro;
use Senac\Projeto\Controllers\Controller;
use Senac\Projeto\Repository\BarbeiroRepository;
use Senac\Projeto\Repository\ServicoRepository;

class DeleteServicoController implements Controller
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

        if ($id == null || $id == false){
            header('Location: /usuarios-cadastrados?sucesso=0');
            return;
        }

        $success = $this->servicoRepository->remove($id);
        if($success === false){
            header('Location: /servicos?sucesso=0');
        }else{
            header('Location: /servicos?sucesso=1');
        }
    }
}