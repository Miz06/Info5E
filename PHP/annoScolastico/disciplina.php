<?php

class disciplina
{ //array di percorsi

    public function __construct(private string $nome, array $percorsi)
    {
        $this->percorsi = $percorsi;
    }

    public function getPercorsi(): array
    {
        return $this->percorsi;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function setPercorsi(array $percorsi): void
    {
        $this->percorsi = $percorsi;
    }

}