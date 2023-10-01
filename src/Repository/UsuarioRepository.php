<?php

namespace Senac\Projeto\Repository;

use Exception;
use PDOException;
use Senac\Projeto\Entity\Usuario;
use PDO;
class UsuarioRepository
{
    public function __construct(private \PDO $pdo)
    {

    }

    public function addUsuario(Usuario $usuario): bool
    {
        $sqlInsert = 'INSERT INTO usuarios (nome, dataNascimento, telefone, email, senha) VALUES (?, ?, ?, ?, ?);';
        $stmt = $this->pdo->prepare($sqlInsert);
        $stmt->bindValue(1, $usuario->getNome());
        $stmt->bindValue(2, $usuario->getDataNascimento());
        $stmt->bindValue(3, $usuario->getTelefone());
        $stmt->bindValue(4, $usuario->getEmail());

        $hashSenha = password_hash($usuario->getSenha(), PASSWORD_DEFAULT);
        $stmt->bindValue(5, $hashSenha);

        $result = $stmt->execute();

        $id = $this->pdo->lastInsertId();
        $usuario->setId($id);

        return $result;
    }

    public function update(Usuario $usuario): bool
    {
        try {
            $sqlUpdate = 'UPDATE usuarios SET nome = :nome, dataNascimento = :dataNascimento, telefone = :telefone, email = :email  WHERE id = :id;';

            $stmt = $this->pdo->prepare($sqlUpdate);
            $stmt->bindValue(':nome', $usuario->getNome());
            $stmt->bindValue(':dataNascimento', $usuario->getDataNascimento());
            $stmt->bindValue(':telefone', $usuario->getTelefone());
            $stmt->bindValue(':email', $usuario->getEmail());

            $stmt->bindValue(':id', $usuario->getId(), PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

    public function remove(int $id): bool
    {
        $sqlDelete = 'DELETE FROM usuarios WHERE id = ?;';
        $stmt = $this->pdo->prepare($sqlDelete);
        $stmt->bindValue(1, $id);

        return $stmt->execute();
    }

    public function verificaUsuario(string $email, string $senha): ?Usuario
    {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE email = ?');
            $stmt->bindValue(1, $email);
            $stmt->execute();
            $usuarioData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuarioData && password_verify($senha, $usuarioData['senha'])) {
                return $this->hydrateUsuario($usuarioData);
            } else {
                throw new Exception("Credenciais inválidas");
            }
        } catch (PDOException $e) {
            throw new Exception("Erro no banco de dados: " . $e->getMessage());
        }
    }

    public function allUsers():array
    {
        $usuarioList = $this->pdo->query('SELECT *FROM usuarios;')->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(
            $this->hydrateUsuario(...),
            $usuarioList
        );
    }

    public function find(int $id)
    {
        $stmt = $this->pdo->prepare('SELECT *FROM usuarios WHERE id = ?;');
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        return $this->hydrateUsuario($stmt->fetch(PDO::FETCH_ASSOC));
    }
    public function hydrateUsuario(array $usuarioData): Usuario
    {
        $usuario = new Usuario($usuarioData['id'],$usuarioData['nome'], $usuarioData['dataNascimento'], $usuarioData['telefone'], $usuarioData['email'], $usuarioData['senha']);
        return $usuario;
    }


}