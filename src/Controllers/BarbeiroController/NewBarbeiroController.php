<?php

namespace Senac\Projeto\Controllers\BarbeiroController;

use Senac\Projeto\Controllers\{Controller};
use Senac\Projeto\Entity\{Barbeiro};
use Senac\Projeto\Repository\{BarbeiroRepository};

class NewBarbeiroController implements Controller
{
    public function __construct(private BarbeiroRepository $barbeiroRepository)
    {

    }
    public function processaRequisicao(): void
    {
        $nome = filter_input(INPUT_POST, 'nome');
        if($nome === false){
            header('Location: /cadastro-barbeiro?sucesso=0');
            exit();
        }
        $telefone = filter_input(INPUT_POST, 'telefone');
        if ($telefone === false){
            header('Location: /cadastro-barbeiro?sucesso=0');
        }
        $endereco = filter_input(INPUT_POST, 'endereco');
        if ($endereco === false){
            header('Location: /cadastro-barbeiro?sucesso=0');
        }
        $email = filter_input(INPUT_POST, 'email');
        if ($email === false){
            header('Location: /cadastro-barbeiro?sucesso=0');
        }
        $senha = filter_input(INPUT_POST, 'senha');
        if ($senha === false){
            header('Location: /cadastro-barbeiro?sucesso=0');
        }

        $id = null;
        $success = $this->barbeiroRepository->addBarbeiro(New Barbeiro($id,$nome,$telefone, $endereco,$email,$senha));

        if($success === false){
            header('Location: /cadastro-barbeiro?sucesso=0');
        }else{
            header('Location: /login-barbeiro');
        }
    }
}