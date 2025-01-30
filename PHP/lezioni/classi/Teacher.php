<?php


namespace classi;
class Teacher
{
    private static int $register = 0; //statico

    public function __construct(private string $name, private string $lastName)
    {
        self::$register++;
    }


    public function getLastName(): string
    {
        return $this->lastName;
    }


    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }


    public function getName(): string
    {
        return $this->name;
    }


    public function setName(string $name): void
    {
        $this->name = $name;
    }


    public static function getRegister(): int
    { //statico
        return self::$register;
    }


}

