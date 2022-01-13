<?php

class Securite
{

    public static function secureHTML($chaine)
    {
        //première protection  contre injection sql.
        $chaine  = strip_tags($input);
        $resultat = htmlentities($chaine);
        $resultat = htmlspecialchars($resultat);

        return $resultat;
    }

    public static function estConnecte()
    {
        return (!empty($_SESSION['profil']));
    }
}
