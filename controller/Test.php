<?php


class Test
{
    public $email;
    public $prenom;
    public $nom;
    public $password;

    public function __construct($email, $prenom, $nom, $password)
    {
        $this->email = $email;
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->password = $password;
    }
}
