<?php

namespace Senac\Projeto\Entity;

class Servico
{
    private ?int $id;
    private string $nome;
    private string $descricao;
    private float $preco;
    private int $barbeiroId;
    private ?string $nomeBarbeiro;

    public function __construct(?int $id, string $nome, string $descricao, float $preco, int $barbeiroId,?string $nomeBarbeiro = null)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->preco = $preco;
        $this->barbeiroId = $barbeiroId;
        $this->nomeBarbeiro = $nomeBarbeiro;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }

    public function getPreco(): float
    {
        return $this->preco;
    }

    public function setPreco(float $preco): void
    {
        $this->preco = $preco;
    }

    public function getBarbeiroId(): int
    {
        return $this->barbeiroId;
    }

    public function setBarbeiroId(int $barbeiroId): void
    {
        $this->barbeiroId = $barbeiroId;
    }
    public function getNomeBarbeiro(): ?string
    {
        return $this->nomeBarbeiro;
    }
    public function setNomeBarbeiro(?string $nomeBarbeiro)
    {
        $this->nomeBarbeiro = $nomeBarbeiro;
    }


}