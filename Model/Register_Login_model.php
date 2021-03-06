<?php


class Register
{

    public static function connexion($email, $password)
    {   //secure les post d'injection sql ou script
        $email_secure = Securite::secureHTML($email);
        $password_secure = Securite::secureHTML($password);

        //verification email déjà existent
        if (Register::info_user($email_secure) == true) {
            //requete SQL
            $resultat = Register::info_user($email_secure);
            if (password_verify($password_secure, $resultat['password'])) {
                $_SESSION['profil']['email'] = $resultat['email'];
                $_SESSION['profil']['id'] = $resultat['id_utilisateur'];
                Toolbox::ajouterMessageAlerte("Connexion faite.", Toolbox::COULEUR_VERTE);
                header("Location: ../index.php");
                exit();
            } else {
                Toolbox::ajouterMessageAlerte("Mdp incorrect.", Toolbox::COULEUR_ROUGE);
                header("Location: ./connexion.php");
                exit();
            }
        } else {
            Toolbox::ajouterMessageAlerte("Email incorrect.", Toolbox::COULEUR_ROUGE);
            header("Location: ./connexion.php");
            exit();
        }
    }

    public static function register_utilisateur($login, $prenom, $nom, $email, $password)
    {
        //secure les post d'injection sql ou script
        $login_secure = Securite::secureHTML($login);
        $prenom_secure = Securite::secureHTML($prenom);
        $nom_secure = Securite::secureHTML($nom);
        $email_secure = Securite::secureHTML($email);
        $password_secure = Securite::secureHTML($password);

        if (filter_var($email_secure, FILTER_VALIDATE_EMAIL)) {
            if (Register::info_user($email_secure) == false) {
                //Hash password
                $password_hash = password_hash($password_secure, PASSWORD_BCRYPT);

                $req = "INSERT INTO utilisateurs (login, prenom, nom, email, password) VALUES (:login, :prenom, :nom, :email, :password )";
                $stmt = Database::connect_db()->prepare($req);
                $stmt->execute(array(
                    ":login" => $login_secure,
                    ":prenom" => $prenom_secure,
                    ":nom" => $nom_secure,
                    ":email" => $email_secure,
                    ":password" => $password_hash
                ));
                Toolbox::ajouterMessageAlerte("Le compte est créé!", Toolbox::COULEUR_VERTE);
                header("Location: ../index.php");
                exit();
            }
            if (Register::info_user($email_secure) == true) {
                Toolbox::ajouterMessageAlerte("L'email est déjà utilisé !", Toolbox::COULEUR_ROUGE);
                header("Location: ./inscription.php");
                exit();
            }
        } else {
            Toolbox::ajouterMessageAlerte("L'email n'est pas valide !", Toolbox::COULEUR_ROUGE);
            header("Location: ./inscription.php");
            exit();
        }
    }

    public static function info_user($email)
    {
        //secure les post d'injection sql ou script
        $email_secure = Securite::secureHTML($email);

        //requete sql
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
