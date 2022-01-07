<?php


class Grille extends Card
{

    public $taille_grille;

    function __construct($taille_grille)
    {
        $this->taille_grille = $taille_grille;
    }

    public function creation_grille(...$objet_carte)
    {
        $resultat = array_merge($objet_carte);
        return $resultat;
    }

    public function melange_cartes_grille($grille)
    {

        shuffle($grille);
        $resultat = $grille;
        $_SESSION['grille'] = $resultat;
        return $resultat;
    }

    public function reset_session_jeu($grille_reset)
    {
        shuffle($grille_reset);
        $resultat = $grille_reset;
        $_SESSION['grille'] = $resultat;
        session_unset();
        return $resultat;
    }
}
