<?php

//percorso associato ad argomento e periodo dell'anno

class Percorso
{
    public function __construct(private string $percorso, private string $argomento, private int $data){

    }

    public function getPercorso(): string
    {
        return $this->percorso;
    }

    public function setPercorso(string $percorso): void
    {
        $this->percorso = $percorso;
    }

    public function getArgomento(): string
    {
        return $this->argomento;
    }

    public function setArgomento(string $argomento): void
    {
        $this->argomento = $argomento;
    }

    public function getData(): int
    {
        return $this->data;
    }

    public function setData(int $data): void
    {
        $this->data = $data;
    }


}