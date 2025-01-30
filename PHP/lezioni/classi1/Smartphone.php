<?php

namespace classi1;

require_once 'dispositivo.php';

class Smartphone extends dispositivo
{
    public function __construct(protected string $marca, protected int $annoUscita, private float $prezzoUScita)
    {
        parent:: __construct($marca, $annoUscita);//costruttore della classe padre
    }

    public function getPrezzoUScita(): float
    {
        return $this->prezzoUScita;
    }

    public function setPrezzoUScita(float $prezzoUScita): void
    {
        $this->prezzoUScita = $prezzoUScita;
    }

    //metodo della classe padre implementato
    public function introduceYear(): string
    {
        return "Il dispositivo è stato rilasciato nel: {$this->annoUscita}";
    }
}