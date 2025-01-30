<?php


namespace classi;
class Person
{


    const  PREFERD_COLOR = 'green';
    //creazione degli attributi dell'oggetto e creazione del costruttore (automaticamente)
    //altrimenti si necessita della dichiarazione manuale degli attributi dell'oggetto e del costruttore con relativo contenuto
    public function __construct(protected string $name, private ?int $age = 0, private ?string $email = null)
    { //php8.0 | se metto ? posso dare null come parametro al costruttore e non ottenere alcun errore


    }


    public function getName(): string
    {
        return $this->name;
    }


    public function setName(string $name): void
    {
        $this->name = $name;
    }


    public function getAge(): int
    {
        return $this->age;
    }


    public function setAge(int $age): void
    {
        $this->age = $age;
    }


    public function getEmail(): string
    {
        return $this->email;
    }


    public function setEmail(string $email): void
    {
        $this->email = $email;
    }


    public function introduce(): string
    {
        return "Hi, my name is {$this->name}, I am {$this->age} years old and my email is {$this->email}.\n
       My prefered color is " . self::PREFERD_COLOR; //self consente di richiamare le costanti
    }


}

