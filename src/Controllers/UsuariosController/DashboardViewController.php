<?php

namespace Senac\Projeto\Controllers\UsuariosController;

use Senac\Projeto\Controllers\{Controller};
use Senac\Projeto\Repository\{BarbeiroRepository, UsuarioRepository, ServicoRepository};
use PDO;
class DashboardViewController implements Controller
{
    public function __construct(
        private UsuarioRepository $usuarioRepository,
        private SessionUsuarioController $sessionUsuarioController,
        private BarbeiroRepository $barbeiroRepository)
    {
    }

    public function processaRequisicao(): void
    {
        global $pdo;
        if (!$this->sessionUsuarioController->usuarioAuthenticated()) {
            header('Location: /login');
            exit();
        }

        $servicoRepository = new ServicoRepository($pdo);
        $barbeiroRepository = new BarbeiroRepository($pdo);

        $barbeiros = $this->barbeiroRepository->allBarbeiros();

        $servicos = $servicoRepository->allServicos();
        require_once __DIR__ . '/../../../view/dashboard.php';
    }
}