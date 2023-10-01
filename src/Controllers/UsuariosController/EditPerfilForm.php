<?php

namespace Senac\Projeto\Controllers\UsuariosController;

use Senac\Projeto\Controllers\Controller;
use Senac\Projeto\Entity\Usuario;
use Senac\Projeto\Repository\UsuarioRepository;

class EditPerfilForm implements Controller
{
    public function __construct(private UsuarioRepository $usuarioRepository, private SessionUsuarioController $sessionUsuarioController)
    {
    }

    public function processaRequisicao(): void
    {
        if (!$this->sessionUsuarioController->usuarioAuthenticated()) {
            header('Location: /');
            exit();
        }

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        /** @var ?Usuario $usuario */
        $usuario = null;
        if ($id === false || $id === null) {
            header('Location: /editar-usuario?sucesso=0');
            exit();
        }

        $usuario = $this->usuarioRepository->find($id);

        if ($usuario === null) {
            header('Location: /editar-usuario?sucesso=0');
            exit();
        }

        require_once __DIR__ . '/../../../view/edit-perfil-usuario.php';
    }
}
