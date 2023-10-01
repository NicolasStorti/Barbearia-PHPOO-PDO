<?php

namespace Senac\Projeto\Controllers\BarbeiroController;

use Senac\Projeto\Controllers\{Controller};

class FormBarbeiroLoginController implements Controller
{
    public function processaRequisicao(): void
    {
        require_once __DIR__ . '/../../../view/form-login-barbeiro.php';
    }
}