<?php

namespace Senac\Projeto\Controllers\BarbeiroController;

use Senac\Projeto\Controllers\{Controller};
use Senac\Projeto\Repository\{BarbeiroRepository};
use Exception;

class LoginBarberController implements Controller
{
    private BarbeiroRepository $barbeiroRepository;
    private SessionBarbeiro $sessionBarbeiro;
    public function __construct(BarbeiroRepository $barbeiroRepository, SessionBarbeiro $sessionBarbeiro)
    {
        $this->barbeiroRepository = $barbeiroRepository;
        $this->sessionBarbeiro = $sessionBarbeiro;
    }

    public function processaRequisicao(): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $email = $_POST["email"];
            $senha = $_POST["senha"];

            try {
                $barbeiro = $this->barbeiroRepository->verificaBarbeiro($email, $senha);
                if ($barbeiro) {

                    $this->sessionBarbeiro->startSession();

                    $this->sessionBarbeiro->setBarbeiroSession($barbeiro);

                    header('Location: /administracao');
                    exit();
                } else {
                    header('Location: /login-barbeiro?sucesso=0');
                }
            } catch (Exception $e) {
                header('Location: /login-barbeiro?sucesso=0');
            }
        }
    }
}