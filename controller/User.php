<?php

require_once(__DIR__ . "/../Model/Register_Login_model.php");
class User
{
    public $id;
    public $email;

    public function __construct($email, $id)
    {
        $this->email = $email;
        $this->id = $id;
    }

    //afficher données utilisateurs

    public function info_user()
    {
        $resultat = Register::info_user($this->email);

        return $resultat;
    }

    //modifier les infos du profil
    public function modifier_profil_user()
    {
    }
}
