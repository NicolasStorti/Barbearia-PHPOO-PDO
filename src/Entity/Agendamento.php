<?php

namespace Senac\Projeto\Entity;

class Agendamento
{
    private ?int $id;
    private string $data;
    private string $hora;
    private ?int $usuarioId;
    private ?int $barbeiroId;
    private ?int $servicoId;
    private ?string $nomeUsuario;
    private ?string $nomeServico;
    private ?string $nomeBarbeiro;
    private ?string $descricaoServico;

    public function __construct(
        ?int $id,
        string $data,
        string $hora,
        ?int $usuarioId,
        ?int $barbeiroId,
        ?int $servicoId,
        ?string $nomeUsuario = null,
        ?string $nomeServico = null,
        ?string $nomeBarbeiro = null ,
        ?string $descricaoServico = null
    ) {
        $this->id = $id;
        $this->data = $data;
        $this->hora = $hora;
        $this->usuarioId = $usuarioId;
        $this->barbeiroId = $barbeiroId;
        $this->servicoId = $servicoId;
        $this->nomeUsuario = $nomeUsuario;
        $this->nomeServico = $nomeServico;
        $this->nomeBarbeiro = $nomeBarbeiro;
        $this->descricaoServico = $descricaoServico;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getData(): string
    {
        return $this->data;
    }

    public function setData(string $data): void
    {
        $this->data = $data;
    }

    public function getHora(): string
    {
        return $this->hora;
    }

    public function setHora(string $hora): void
    {
        $this->hora = $hora;
    }

    public function getUsuarioId(): ?int
    {
        return $this->usuarioId;
    }

    public function setUsuarioId(?int $usuarioId): void
    {
        $this->usuarioId = $usuarioId;
    }

    public function getBarbeiroId(): ?int
    {
        return $this->barbeiroId;
    }

    public function setBarbeiroId(?int $barbeiroId): void
    {
        $this->barbeiroId = $barbeiroId;
    }

    public function getServicoId(): ?int
    {
        return $this->servicoId;
    }

    public function setServicoId(?int $servicoId): void
    {
        $this->servicoId = $servicoId;
    }

    public function getNomeUsuario(): ?string
    {
        return $this->nomeUsuario;
    }

    public function setNomeUsuario(?string $nomeUsuario): void
    {
        $this->nomeUsuario = $nomeUsuario;
    }

    public function getNomeServico(): ?string
    {
        return $this->nomeServico;
    }

    public function setNomeServico(?string $nomeServico): void
    {
        $this->nomeServico = $nomeServico;
    }

    public function getNomeBarbeiro(): ?string
    {
        return $this->nomeBarbeiro;
    }

    public function setNomeBarbeiro(?string $nomeBarbeiro): void
    {
        $this->nomeBarbeiro = $nomeBarbeiro;
    }

    public function getDescricaoServico(): ?string
    {
        return $this->descricaoServico;
    }

    public function setDescricaoServico(?string $descricaoServico): void
    {
        $this->descricaoServico = $descricaoServico;
    }
}
