<?php

namespace classi;

use Volonteer;

require_once 'Volonteer.php';

class Student extends Person implements Volonteer
{
    public function __construct(string $name, ?int $age = 0, ?string $email = null, private string $school)
    {
        parent::__construct($name, $age, $email);//viene richiamato il costruttore padre
    }

    public function studentPresentation(): string
    {
        //return "My name is {$this->name} and my school is {$this->school}";
        return parent::introduce() . "My school is {$this->school}"; //riutilizzo del metodo della classe padre
    }

    public function toDo(): string
    {
        return "My name is $this->name and I'm  a blood donator";
    }
}