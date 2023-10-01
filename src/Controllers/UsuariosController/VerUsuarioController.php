<?php

namespace Senac\Projeto\Controllers\UsuariosController;

use Senac\Projeto\Controllers\Controller;
use Senac\Projeto\Repository\UsuarioRepository;


class VerUsuarioController implements Controller
{
    public function __construct(private UsuarioRepository $usuarioRepository, private SessionUsuarioController $sessionUsuarioController)
    {
    }

    public function processaRequisicao(): void
    {
        if (!$this->sessionUsuarioController->usuarioAuthenticated()) {
            header('Location: /login');
            exit();
        }
        $usuario = $this->sessionUsuarioController->getUser();
        if ($usuario !== null) {
            $nome = $usuario->getNome();
        } else {
            header('Location: /login');
            exit();
        }

        $usuarios = $this->sessionUsuarioController->getUser();
        require_once __DIR__ . '/../../../view/ver-usuario.php';
    }
}