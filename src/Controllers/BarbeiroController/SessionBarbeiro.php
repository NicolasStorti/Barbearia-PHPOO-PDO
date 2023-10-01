<?php

namespace Senac\Projeto\Controllers\BarbeiroController;

use Senac\Projeto\Entity\{Barbeiro};

class SessionBarbeiro
{
    public function __construct()
    {
        $this->startSession();
    }

    public function startSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function setBarbeiroSession(Barbeiro $barbeiro): void
    {
        $_SESSION['id'] = $barbeiro->getId();
        $_SESSION['nome'] = $barbeiro->getNome();
        $_SESSION['telefone'] = $barbeiro->getTelefone();
        $_SESSION['endereco'] = $barbeiro->getEndereco();
        $_SESSION['email'] = $barbeiro->getEmail();
        $_SESSION['senha'] = $barbeiro->getSenha();
    }
    public function getBarbeiro(): ?Barbeiro
    {
        if (isset($_SESSION['id'])) {
            return new Barbeiro(
                $_SESSION['id'],
                $_SESSION['nome'],
                $_SESSION['telefone'],
                $_SESSION['endereco'],
                $_SESSION['email'],
                $_SESSION['senha']
            );
        } else {
            return null;
        }
    }
    public function barbeiroAuthenticated(): bool
    {
        return isset($_SESSION['senha']);
    }

    public function logoutBarbeiro(): void
    {
        session_destroy();
    }
}