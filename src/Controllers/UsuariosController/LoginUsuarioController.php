<?php

namespace Senac\Projeto\Controllers\UsuariosController;

use Senac\Projeto\Controllers\{Controller};
use Exception;
use Senac\Projeto\Repository\{UsuarioRepository};

class LoginUsuarioController implements Controller
{
    private sessionUsuarioController $sessionUsuarioController;
    private UsuarioRepository $usuarioRepository;


    public function __construct(UsuarioRepository $usuarioRepository, SessionUsuarioController $sessionUsuarioController)
    {
        $this->usuarioRepository = $usuarioRepository;
        $this->sessionUsuarioController = $sessionUsuarioController;
    }

    public function processaRequisicao(): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $senha = $_POST["senha"];

            try {
                $usuario = $this->usuarioRepository->verificaUsuario($email, $senha);
                if ($usuario) {

                    $this->sessionUsuarioController->startSession();

                    $this->sessionUsuarioController->setUserSession($usuario);

                    header('Location: /dashboard');
                    exit();
                } else {
                    header('Location: /login?sucesso=0');
                }
            } catch (Exception $e) {
                header('Location: /login?sucesso=0');
            }
        }
    }
}
