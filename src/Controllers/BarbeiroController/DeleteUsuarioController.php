<?php

namespace Senac\Projeto\Controllers\BarbeiroController;

use Senac\Projeto\Controllers\Controller;
use Senac\Projeto\Repository\UsuarioRepository;

class DeleteUsuarioController implements Controller
{
    public function __construct(private UsuarioRepository $usuarioRepository, private SessionBarbeiro $sessionBarbeiro)
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

        $success = $this->usuarioRepository->remove($id);
        if($success === false){
            header('Location: /usuarios-cadastrados?sucesso=0');
        }else{
            header('Location: /usuarios-cadastrados?sucesso=1');
        }
    }
}