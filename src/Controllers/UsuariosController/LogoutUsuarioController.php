<?php

namespace Senac\Projeto\Controllers\UsuariosController;

use Senac\Projeto\Controllers\{Controller};
use Senac\Projeto\Repository\{UsuarioRepository};

class LogoutUsuarioController implements Controller
{
    public function __construct(private UsuarioRepository $usuarioRepository, private SessionUsuarioController $sessionUsuarioController)
    {

    }

    public function processaRequisicao(): void
    {
        $this->sessionUsuarioController->logout();

        header('Location: /login');
        exit();
    }
}
