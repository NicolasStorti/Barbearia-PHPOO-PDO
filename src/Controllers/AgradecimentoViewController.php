<?php

namespace Senac\Projeto\Controllers;

class AgradecimentoViewController implements Controller
{
    public function processaRequisicao(): void
    {
        require_once __DIR__ . '/../../view/agradecimento.php';
    }
}