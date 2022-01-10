<?php


class Grille extends Card
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
            ${'var' . $i} = new Card(1, './img/dos.png', "./img/$tblimage[0].png", $i);
            ${'var2' . $i} = new Card(1, './img/dos.png', "./img/$tblimage[0].png", $i);
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
        return $resultat;
    }

    public function reset_session_jeu()
    {
        $grille = $this->creation_grille();
        shuffle($grille);
        $resultat = $grille;
        $_SESSION['grille'] = $resultat;
        session_unset();
        return $resultat;
    }
}
