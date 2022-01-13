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

    public static function register_utilisateur($login, $prenom, $nom, $email, $password)
    {
        //secure les post d'injection sql ou script
        $login_secure = Securite::secureHTML($login);
        $prenom_secure = Securite::secureHTML($prenom);
        $nom_secure = Securite::secureHTML($nom);
        $email_secure = Securite::secureHTML($email);
        $password_secure = Securite::secureHTML($password);
        if (Register::verif_email($email_secure) == false) {
            //Hash password
            $password_hash = password_hash($password_secure, PASSWORD_BCRYPT);

            $req = "INSERT INTO utilisateurs (login, password) VALUES (:login, :prenom, :nom, :email, :password )";
            $stmt = Database::connect_db()->prepare($req);
            $stmt->execute(array(
                ":login" => $login_secure,
                ":prenom" => $prenom_secure,
                ":nom" => $nom_secure,
                ":email" => $email_secure,
                ":password" => $password_hash,
            ));
            Toolbox::ajouterMessageAlerte("Le compte est créé!", Toolbox::COULEUR_VERTE);
            header("Location: ../index.php");
            exit();
        }
        if (Register::verif_email($email_secure) == true) {
            Toolbox::ajouterMessageAlerte("Le login est déjà utilisé !", Toolbox::COULEUR_ROUGE);
        }
    }

    public static function verif_email($email)
    {
        //secure les post d'injection sql ou script
        $email_secure = Securite::secureHTML($email);

        $req = "SELECT * FROM utilisateurs WHERE email = :email";
        $stmt = Database::connect_db()->prepare($req);
        $stmt->execute(array(
            ":email" => $email_secure
        ));
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }
}
