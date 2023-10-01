<?php

namespace Senac\Projeto\Controllers\BarbeiroController;

use Senac\Projeto\Controllers\{Controller};
use Senac\Projeto\Repository\{BarbeiroRepository};

class LogoutBarbeiroController implements Controller
{
    public function __construct(private BarbeiroRepository $barbeiroRepository, private SessionBarbeiro $sessionBarbeiro)
    {
    }

    public function processaRequisicao(): void
    {
        $this->sessionBarbeiro->logoutBarbeiro();

        header('Location: /login-barbeiro');
        exit();
    }
}