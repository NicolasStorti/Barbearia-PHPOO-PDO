<?php

namespace Senac\Projeto\Repository;

use Senac\Projeto\Entity\Agendamento;
use PDO;

class AgendamentoRepository
{
    public function __construct(private \PDO $pdo)
    {
    }

    public function agendarHorario(Agendamento $agendamento):bool
    {
        $sqlInsert = 'INSERT INTO agenda(data,hora,usuario_id,barbeiro_id,servico_id) VALUES(?, ?, ?, ?, ?);';
        $stmt = $this->pdo->prepare($sqlInsert);
        $stmt->bindValue(1, $agendamento->getData());
        $stmt->bindValue(2, $agendamento->getHora());
        $stmt->bindValue(3, $agendamento->getUsuarioId());
        $stmt->bindValue(4, $agendamento->getBarbeiroId());
        $stmt->bindValue(5, $agendamento->getServicoId());

        $result = $stmt->execute();
        $id = $this->pdo->lastInsertId();
        $agendamento->setId($id);

        return $result;
    }

    public function update(Agendamento $agendamento): bool
    {
        $sqlUpdate = 'UPDATE agenda SET data = :data, hora = :hora, usuario_id = :usuario_id, barbeiro_id = :barbeiro_id, servico_id = :servico_id WHERE id = :id';
        $stmt = $this->pdo->prepare($sqlUpdate);
        $stmt->bindValue(':data', $agendamento->getData());
        $stmt->bindValue(':hora', $agendamento->getHora());
        $stmt->bindValue(':usuario_id', $agendamento->getUsuarioId());
        $stmt->bindValue(':barbeiro_id', $agendamento->getBarbeiroId());
        $stmt->bindValue(':servico_id', $agendamento->getServicoId());
        $stmt->bindValue(':id', $agendamento->getId(), PDO::PARAM_INT);

        return $stmt->execute();
    }
    public function remove(int $id): bool
    {
        $sqlDelete = 'DELETE FROM agenda WHERE id = ?;';
        $stmt = $this->pdo->prepare($sqlDelete);
        $stmt->bindValue(1, $id);

        return $stmt->execute();
    }
    public function allAgenda(): array
    {
        $agendaList = $this->pdo->query('SELECT 
    agenda.*,
    usuarios.nome AS nome_usuario,
    barbeiros.nome AS nome_barbeiro,
    servicos.nome AS nome_servico,
    servicos.descricao AS descricao_servico
FROM agenda
INNER JOIN usuarios ON agenda.usuario_id = usuarios.id
INNER JOIN barbeiros ON agenda.barbeiro_id = barbeiros.id
INNER JOIN servicos ON agenda.servico_id = servicos.id
')->fetchAll(\PDO::FETCH_ASSOC);

        return array_map([$this, 'hydrateAgendamento'], $agendaList);
    }


    public function find(int $id)
    {
        $stmt = $this->pdo->prepare('SELECT *FROM agenda WHERE id = ?;');
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        return $this->hydrateAgendamento($stmt->fetch(PDO::FETCH_ASSOC));
    }
    public function hydrateAgendamento(array $agendaData): Agendamento
    {
        $agendamento = new Agendamento(
            $agendaData['id'],
            $agendaData['data'],
            $agendaData['hora'],
            $agendaData['usuario_id'],
            $agendaData['barbeiro_id'],
            $agendaData['servico_id']
        );

        if (array_key_exists('nome_usuario', $agendaData) && $agendaData['nome_usuario'] !== null) {
            $agendamento->setNomeUsuario($agendaData['nome_usuario']);
        }
        if (array_key_exists('nome_barbeiro', $agendaData) && $agendaData['nome_barbeiro'] !== null) {
            $agendamento->setNomeBarbeiro($agendaData['nome_barbeiro']);
        }

        if (array_key_exists('nome_servico', $agendaData) && $agendaData['nome_servico'] !== null) {
            $agendamento->setNomeServico($agendaData['nome_servico']);
        }
        if (array_key_exists('descricao_servico', $agendaData) && $agendaData['descricao_servico'] !== null) {
            $agendamento->setDescricaoServico($agendaData['descricao_servico']);
        }

        return $agendamento;
    }





}