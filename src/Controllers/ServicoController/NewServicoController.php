<?php

namespace Senac\Projeto\Controllers\ServicoController;

use Senac\Projeto\Controllers\{BarbeiroController\SessionBarbeiro, Controller};
use Senac\Projeto\Entity\{Servico};
use Senac\Projeto\Repository\{ServicoRepository};

class NewServicoController implements Controller
{
    public function __construct(private ServicoRepository $servicoRepository, private SessionBarbeiro $sessionBarbeiro)
    {
    }

    public function processaRequisicao(): void
    {
        if (!$this->sessionBarbeiro->barbeiroAuthenticated()) {
            header('Location: /login-barbeiro');
            exit();
        }
        $nome = filter_input(INPUT_POST, 'nome');
        if($nome === false){
            header('Location: /servicos?sucesso=0');
            exit();
        }
        $descricao = filter_input(INPUT_POST, 'descricao');
        if ($descricao === false){
            header('Location: /servicos?sucesso=0');
        }
        $preco = filter_input(INPUT_POST, 'preco');
        if ($preco === false){
            header('Location: /servicos?sucesso=0');
        }
        $barbeiroId = filter_input(INPUT_POST, 'barbeiroId');
        if ($barbeiroId === false){
            header('Location: /servicos?sucesso=0');
        }


        $id = null;
        $success = $this->servicoRepository->addServico(new Servico($id,$nome,$descricao,$preco,$barbeiroId));
        if($success === false){
            header('Location: /cadastro-servico?sucesso=0');
        }else{
            header('Location: /cadastro-servico?sucesso=1');
        }

    }
}