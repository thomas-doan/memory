<?php


class Grille
{

    public $taille_grille;

    function __construct($taille_grille)
    {
        $this->taille_grille = $taille_grille;
    }

    function tableau_objets_random()
    {
        $tableau_objets = [];

        $tblimage = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];
        shuffle($tblimage);

        for ($i = 0; $i < ($this->taille_grille); $i++) {
            shuffle($tblimage);
            ${'var' . $i} = new Card(1, './public/img/dos.png', "./public/img/$tblimage[0].png", $i);
            ${'var2' . $i} = new Card(1, './public/img/dos.png', "./public/img/$tblimage[0].png", $i);
            array_push($tableau_objets, ${'var' . $i}, ${'var2' . $i});
            unset($tblimage[0]);
            shuffle($tableau_objets);
        };

        foreach ($tableau_objets as $key => $value) {
            $value->id_carte = $key;
        }

        return $tableau_objets;
    }

    public function creation_grille()
    {

        $resultat = array_merge($this->tableau_objets_random());
        return $resultat;
    }

    public function melange_cartes_grille()
    {

        $grille = $this->creation_grille();
        shuffle($grille);
        $resultat = $grille;
        $_SESSION['grille'] = $resultat;
        /* $debut = time(); */
        $_SESSION['chrono_debut_jeu'] = time();
        /*  $_SESSION['timer_reussite'] = new Timer(); */
        return $resultat;
    }

    public function victoire()
    {
        $tbl_reussite = [];
        foreach ($_SESSION['grille'] as $value) {
            array_push($tbl_reussite, $value->etat_carte);
        }

        if (count(array_flip($tbl_reussite)) == 1 && end($tbl_reussite) == "0") {
            $_SESSION['victoire'] = 1;
            $resultat = $_SESSION['victoire'];
            return $resultat;
        }
    }

    public function temps_realise_victoire()
    {
        $_SESSION['victoire'] = time();

        $_SESSION['resultat_temps_reussite'] = substr($_SESSION['victoire'] -  $_SESSION['chrono_debut_jeu'], 0, 10);
        echo "Victoire, memory réalisé en " . $_SESSION['resultat_temps_reussite'] . " secondes.";
        $temps = $_SESSION['resultat_temps_reussite'];
        $_SESSION['objet_score']->envoyer_score($_SESSION['profil']['id'], $temps, $this->taille_grille);
        unset($_SESSION['victoire']);
        unset($_SESSION['chrono_debut_jeu']);
    }

    public function reset_session_jeu()
    {


        unset($_SESSION['resultat_temps_reussite']);
        unset($_SESSION['grille']);
    }
}
