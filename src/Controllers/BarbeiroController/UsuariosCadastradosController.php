<?php

namespace Senac\Projeto\Controllers\BarbeiroController;

use Senac\Projeto\Controllers\Controller;
use Senac\Projeto\Repository\BarbeiroRepository;
use Senac\Projeto\Repository\UsuarioRepository;

class UsuariosCadastradosController implements Controller
{
    public function __construct(
        private UsuarioRepository $usuarioRepository,
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

        $usuarioRepository = new UsuarioRepository($pdo);

        $usuarios = $usuarioRepository->allUsers();

        require_once __DIR__ . '/../../../view/ver-usuarios-cadastrados.php';
    }


}