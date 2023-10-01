<?php

namespace Senac\Projeto\Controllers\BarbeiroController;

use Senac\Projeto\Controllers\{Controller};
use Senac\Projeto\Entity\{Barbeiro};
use Senac\Projeto\Repository\{BarbeiroRepository};

class FormBarbeiroController implements Controller
{
    public function __construct(private BarbeiroRepository $barbeiroRepository)
    {
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        /** @var ?Barbeiro $barbeiro */
        $barbeiro = null;

        if ($id !== false && $id !== null){
            $barbeiro = $this->barbeiroRepository->find($id);
        }

        require_once __DIR__ . '/../../../view/form-barbeiro.php';
    }
}