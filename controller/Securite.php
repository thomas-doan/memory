<?php

class Securite
{

    public static function secureHTML($chaine)
    {
        //première protection  contre injection sql.
        $resultat  = strip_tags($chaine);
        $resultat = htmlentities($resultat);
        $resultat = htmlspecialchars($resultat);

        return $resultat;
    }

    public static function estConnecte()
    {
        return (!empty($_SESSION['profil']));
    }
}
