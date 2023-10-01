<?php

namespace Senac\Projeto\Controllers\UsuariosController;

use Senac\Projeto\Entity\{Usuario};

class SessionUsuarioController
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

    public function setUserSession(Usuario $usuario): void
    {
        $_SESSION['id'] = $usuario->getId();
        $_SESSION['nome'] = $usuario->getNome();
        $_SESSION['dataNascimento'] = $usuario->getDataNascimento();
        $_SESSION['telefone'] = $usuario->getTelefone();
        $_SESSION['email'] = $usuario->getEmail();
        $_SESSION['senha'] = $usuario->getSenha();
    }

    public function getUser(): ?Usuario
    {
        if (isset($_SESSION['id'])) {
            return new Usuario(
                $_SESSION['id'],
                $_SESSION['nome'],
                $_SESSION['dataNascimento'],
                $_SESSION['telefone'],
                $_SESSION['email'],
                $_SESSION['senha']
            );
        } else {
            return null;
        }
    }

    public function usuarioAuthenticated(): bool
    {
        return isset($_SESSION['senha']);
    }

    public function logout(): void
    {
        session_destroy();
    }
}