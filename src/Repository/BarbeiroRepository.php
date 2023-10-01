<?php

namespace Senac\Projeto\Repository;

use Senac\Projeto\Entity\Barbeiro;
use PDO;
use Exception;
use PDOException;

class BarbeiroRepository
{
    public function __construct(private \PDO $pdo)
    {

    }
    public function addBarbeiro(Barbeiro $barbeiro): bool
    {
        $sqlInsert = 'INSERT INTO barbeiros (nome, telefone, endereco, email, senha) VALUES (?, ?, ?, ?, ?);';
        $stmt = $this->pdo->prepare($sqlInsert);
        $stmt->bindValue(1, $barbeiro->getNome());
        $stmt->bindValue(2, $barbeiro->getTelefone());
        $stmt->bindValue(3, $barbeiro->getEndereco());
        $stmt->bindValue(4, $barbeiro->getEmail());

        $hashSenha = password_hash($barbeiro->getSenha(), PASSWORD_DEFAULT);
        $stmt->bindValue(5, $hashSenha);

        $result = $stmt->execute();

        $id = $this->pdo->lastInsertId();
        $barbeiro->setId($id);

        return $result;
    }
    public function verificaBarbeiro($email, $senha): ?Barbeiro
    {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM barbeiros WHERE email = ?');
            $stmt->bindValue(1, $email);
            $stmt->execute();
            $barbeiroData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($barbeiroData && password_verify($senha, $barbeiroData['senha'])) {
                return $this->hydrateBarbeiro($barbeiroData);
            } else {
                throw new Exception("Credenciais inválidas");
            }
        } catch (PDOException $e) {
            throw new Exception("Erro no banco de dados: " . $e->getMessage());
        }
    }

    public function allBarbeiros():array
    {
        $barbeiroList = $this->pdo->query('SELECT *FROM barbeiros;')->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(
            $this->hydrateBarbeiro(...),
            $barbeiroList
        );
    }

    public function find(int $id)
    {
        $stmt = $this->pdo->prepare('SELECT *FROM barbeiros WHERE id = ?;');
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        return $this->hydrateBarbeiro($stmt->fetch(PDO::FETCH_ASSOC));
    }
    public function hydrateBarbeiro(array $barbeiroData): Barbeiro
    {
        $barbeiro = new Barbeiro(
            $barbeiroData['id'],
            $barbeiroData['nome'],
            $barbeiroData['telefone'],
            $barbeiroData['endereco'],
            $barbeiroData['email'],
            $barbeiroData['senha']
        );

        return $barbeiro;
    }



}