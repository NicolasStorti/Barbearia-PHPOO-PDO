<?php

namespace Senac\Projeto\Controllers\UsuariosController;

use Senac\Projeto\Controllers\Controller;
use Senac\Projeto\Entity\Usuario;
use Senac\Projeto\Repository\UsuarioRepository;

class EditPerfilController implements Controller
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

        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $nome = filter_input(INPUT_POST, 'nome');
        $dataNascimento = filter_input(INPUT_POST, 'dataNascimento');
        $telefone = filter_input(INPUT_POST, 'telefone');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

        if (!$id || !$nome || !$dataNascimento || !$telefone || !$email) {
            header('Location: /ver-usuario?sucesso=0');
            exit();
        }
        $usuario = $this->usuarioRepository->find($id);

        $usuario->setNome($nome);
        $usuario->setDataNascimento($dataNascimento);
        $usuario->setTelefone($telefone);
        $usuario->setEmail($email);

        $success = $this->usuarioRepository->update($usuario);

        if ($success === false) {
            header('Location: /editar-usuario?sucesso=0');
        } else {
            header('Location: /ver-usuario?sucesso=1');
        }



    }
}
