<?php

namespace Senac\Projeto\Controllers\UsuariosController;

use Senac\Projeto\Controllers\{Controller};
use Senac\Projeto\Entity\{Usuario};
use Senac\Projeto\Repository\{UsuarioRepository};

class NewUsuarioController implements Controller
{
    public function __construct(private UsuarioRepository $usuarioRepository)
    {
        
    }
    public function processaRequisicao(): void
    {
        $nome = filter_input(INPUT_POST, 'nome');
        if($nome === false){
            header('Location: /login?sucesso=0');
            exit();
        }
        $dataNascimento = filter_input(INPUT_POST, 'dataNascimento');
        if ($dataNascimento === false){
            header('Location: /login?sucesso=0');
        }
        $telefone = filter_input(INPUT_POST, 'telefone');
        if ($telefone === false){
            header('Location: /login?sucesso=0');
        }
        $email = filter_input(INPUT_POST, 'email');
        if ($email === false){
            header('Location: /login?sucesso=0');
        }
        $senha = filter_input(INPUT_POST, 'senha');
        if ($senha === false){
            header('Location: /login?sucesso=0');
        }

        $id = null;
        $success = $this->usuarioRepository->addUsuario(New Usuario($id,$nome,$dataNascimento,$telefone,$email,$senha));

        if($success === false){
            header('Location: /login?sucesso=0');
        }else{
            header('Location: /login?sucesso=1');
        }
    }
}