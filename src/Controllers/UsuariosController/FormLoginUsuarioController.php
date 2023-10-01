<?php

namespace Senac\Projeto\Controllers\UsuariosController;

use Senac\Projeto\Controllers\{Controller};

class FormLoginUsuarioController implements Controller
{
    public function processaRequisicao(): void
    {
        require_once __DIR__ . '/../../../view/form-login.php';
    }
}