<?php

class User_model
{

    public function sql_modifier_profil($login_secure, $prenom_secure, $nom_secure, $email_secure, $id)
    {
        $req = "UPDATE utilisateurs set login = :login, prenom = :prenom, nom = :nom, email = :email WHERE id_utilisateur = :id";
        $stmt = Database::connect_db()->prepare($req);
        $stmt->execute(array(
            ":login" => $login_secure,
            ":prenom" => $prenom_secure,
            ":nom" => $nom_secure,
            ":email" => $email_secure,
            ":id" => $id
        ));
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    public function sql_modifier_profil_sans_email($login_secure, $prenom_secure, $nom_secure, $id)
    {
        $req = "UPDATE utilisateurs set login = :login, prenom = :prenom, nom = :nom WHERE id_utilisateur = :id";
        $stmt = Database::connect_db()->prepare($req);
        $stmt->execute(array(
            ":login" => $login_secure,
            ":prenom" => $prenom_secure,
            ":nom" => $nom_secure,
            ":id" => $id
        ));
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }
}
