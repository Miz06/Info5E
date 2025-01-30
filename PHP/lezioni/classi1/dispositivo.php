<?php

namespace classi1;
class dispositivo
{
    public function __construct(protected string $marca, protected int $annoUscita)
    {

    }

    public function getMarca(): string
    {
        return $this->marca;
    }

    public function setMarca(string $marca): void
    {
        $this->marca = $marca;
    }

    public function getAnnoUscita(): int
    {
        return $this->annoUscita;
    }

    public function setAnnoUscita(int $annoUscita): void
    {
        $this->annoUscita = $annoUscita;
    }

    //metodo implementato
    public function introduceMarca(): string
    {
        return "Il dispositivo appartiene alla marca: {$this->marca}";
    }

    //metodo non implementato
    public function introduceYear()
    {

    }

}