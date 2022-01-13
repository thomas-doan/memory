<?php
require(__DIR__ . "/../Database/DB_connection.php");

class Register
{


    /*     public static function Connexion()
    {

        $login = $_POST['login'];
        $password = $_POST['password']; 
        $req = "SELECT * FROM utilisateurs WHERE login = :login";
        $req_prepare = Database::connexion_db()->prepare($req);
        $req_prepare->execute(array(
            ":login" => "$login"
        ));
        $resultat = $req_prepare->fetch();
        return $resultat;
        $_SESSION['login'] = $resultat['login'];
        $_SESSION['id'] = $resultat['id'];

        if (password_verify($_POST['password'], $resultat['password'])) {

            $msg2 =  'vous êtes connecté';
            header("refresh:2;url=index.php");
        } else {

            $msg =  'identifiant ou mot de pass incorrect';
        }
    } */

    /* public function register_utilisateur($login, $password)
    {
        //inscription utilisateurs

        //Hash password
        $password = password_hash($password, PASSWORD_BCRYPT);

        //Requete SQL
        $register = Database::connexion_db()->prepare("INSERT INTO utilisateurs (login, password) VALUES (:login, :password)");


        $register->bindValue(':login', $login, PDO::PARAM_STR);
        $register->bindValue(':password', $password, PDO::PARAM_STR);
        //PDO::PARAM_STR (int) Représente les types de données CHAR, VARCHAR ou les autres types de données sous forme de chaîne de caractères SQL.
        $register->execute();

        return $register;
    } */


    /*  public function verif_login($login)
    {
        //Login déjà pris

        $login = $_POST['login'];
        //Database::connexion_db()-> appel la bdd pour la requete 
        $result = Database::connexion_db()->prepare("SELECT * FROM utilisateurs WHERE login = ?");
        $result->execute(array($login));
        $user_data = $result->fetch();
        if ($user_data) {
            return true; // si l'utilisateurs est déjà pris return true
        } else {
            return false;
        }
    } */
}
