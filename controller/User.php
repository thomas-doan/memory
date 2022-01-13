<?php
require(__DIR__ . "/../Database/DB_connection.php");

class User
{
    protected $id;
    protected $email;

    public function __construct($email, $id)
    {
        $this->email = $email;
        $this->id = $id;
    }
}
