<?php

namespace Senac\Projeto\Controllers\UsuariosController;

use Senac\Projeto\Controllers\{Controller};
use Senac\Projeto\Repository\{UsuarioRepository};
use Senac\Projeto\Entity\{Usuario};

class FormUsuarioController implements Controller
{
    public function __construct(private UsuarioRepository $usuarioRepository)
    {
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        /** @var ?Usuario $usuario */
        $usuario = null;

        if ($id !== false && $id !== null){
            $tarefa = $this->usuarioRepository->find($id);
        }

        require_once __DIR__ . '/../../../view/form-usuario.php';
    }
}