<?php

namespace Senac\Projeto\Controllers\ServicoController;

use Senac\Projeto\Controllers\BarbeiroController\SessionBarbeiro;
use Senac\Projeto\Controllers\Controller;
use Senac\Projeto\Repository\ServicoRepository;

class EditServicoController implements Controller
{
    public function __construct(private ServicoRepository $servicoRepository,private SessionBarbeiro $sessionBarbeiro)
    {
    }

    public function processaRequisicao(): void
    {
        if (!$this->sessionBarbeiro->barbeiroAuthenticated()) {
            header('Location: /login-barbeiro');
            exit();
        }

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id === false || $id == null) {
            header('Location: /servicos?sucesso=0');
            exit();
        }
        $nome = filter_input(INPUT_POST, 'nome');
        if ($nome === false || $nome == null) {
            header('Location: /servicos?sucesso=0');
            exit();
        }
        $descricao = filter_input(INPUT_POST, 'descricao');
        if ($descricao === false || $descricao == null) {
            header('Location: /servicos?sucesso=0');
            exit();
        }
        $preco = filter_input(INPUT_POST, 'preco');
        if ($preco === false || $preco == null) {
            header('Location: /servicos?sucesso=0');
            exit();
        }

        $servico = $this->servicoRepository->find($id);
        $servico->setNome($nome);
        $servico->setDescricao($descricao);
        $servico->setPreco($preco);


        $success = $this->servicoRepository->update($servico);
        if ($success === false) {
            header('Location: /servicos?sucesso=0');
        } else {
            header('Location: /servicos?sucesso=1');
        }
    }
}