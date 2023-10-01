<?php

namespace Senac\Projeto\Repository;


use Senac\Projeto\Entity\Servico;
use PDO;
class ServicoRepository
{
    public function __construct(private \PDO $pdo)
    {

    }
    public function addServico(Servico $servico):bool
    {
        $sqlInsert = 'INSERT INTO servicos(nome, descricao, preco, barbeiroId) VALUES(?, ?, ?, ?)';
        $stmt = $this->pdo->prepare($sqlInsert);
        $stmt->bindValue(1, $servico->getNome());
        $stmt->bindValue(2, $servico->getDescricao());
        $stmt->bindValue(3, $servico->getPreco());
        $stmt->bindValue(4, $servico->getBarbeiroId());

        $result = $stmt->execute();

        $id = $this->pdo->lastInsertId();
        $servico->setId($id);

        return $result;
    }

    public function remove(int $id):bool
    {
        $sqlDelete = 'DELETE FROM servicos WHERE id = ?;';
        $stmt = $this->pdo->prepare($sqlDelete);
        $stmt->bindValue(1, $id);

        return $stmt->execute();
    }
    public function update(Servico $servico): bool
    {
        $sqlUpdate = 'UPDATE servicos SET nome = :nome, descricao = :descricao, preco = :preco, barbeiroId = :barbeiroId WHERE id = :id';
        $stmt = $this->pdo->prepare($sqlUpdate);
        $stmt->bindValue(':nome', $servico->getNome());
        $stmt->bindValue(':descricao', $servico->getDescricao());
        $stmt->bindValue(':preco', $servico->getPreco());
        $stmt->bindValue(':barbeiroId', $servico->getBarbeiroId());
        $stmt->bindValue(':id', $servico->getId(), PDO::PARAM_INT);

        return $stmt->execute();
    }
    public function allServicos(): array
    {
        $sql = 'SELECT servicos.*, barbeiros.nome AS nome_barbeiro FROM servicos LEFT JOIN barbeiros ON servicos.barbeiroId = barbeiros.id';
        $stmt = $this->pdo->query($sql);
        $servicos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(
            fn($servicoData) => $this->hydrateServico($servicoData),
            $servicos
        );
    }


    public function find(int $id)
    {
        $stmt = $this->pdo->prepare('SELECT *FROM servicos WHERE id = ?;');
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        return $this->hydrateServico($stmt->fetch(PDO::FETCH_ASSOC));
    }

    public function hydrateServico(array $servicoData): Servico
    {
        $servico = new Servico(
            $servicoData['id'],
            $servicoData['nome'],
            $servicoData['descricao'],
            $servicoData['preco'],
            $servicoData['barbeiroId']);

        if (array_key_exists('nome_barbeiro', $servicoData) && $servicoData['nome_barbeiro'] !== null) {
            $servico->setNomeBarbeiro($servicoData['nome_barbeiro']);
        }

        return $servico;
    }

}