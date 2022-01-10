<?php
require('Grille.php');
class Card
{
    //etat 1 = dos - etait 2 = retourner int
    public $etat_carte;
    // img background de dos string
    public $dos_carte;
    // img background de face string
    public $face_carte;
    //identifiant specifique carte int
    public $id_carte;

    public function __construct($etat_carte, $dos_carte, $face_carte, $id_carte)
    {
        $this->etat_carte = $etat_carte;
        $this->dos_carte = $dos_carte;
        $this->face_carte = $face_carte;
        $this->id_carte = $id_carte;
    }

    /*  */

    public function verifier_couple_carte($carte_cible, $position_grille)
    {

        $id_carte_objet = $carte_cible->id_carte;
        $_SESSION['verif']["$id_carte_objet"] = $carte_cible;

        $tableau_face_carte = [];
        if (count($_SESSION['verif']) == 1) {

            $this->voir_carte($_SESSION['verif'], $id_carte_objet);
        } elseif (count($_SESSION['verif']) == 2) {

            foreach ($_SESSION['verif'] as $value) {

                array_push($tableau_face_carte, $value->face_carte);
            }


            if ($tableau_face_carte[0] == $tableau_face_carte[1]) {

                $_SESSION['verif']["$id_carte_objet"]->etat_carte = 0;
                unset($_SESSION['verif']);
            } elseif ($tableau_face_carte[0] !== $tableau_face_carte[1]) {

                $this->voir_carte($_SESSION['grille'], $position_grille);
                $_SESSION['refresh'] = 1;
            }
        }
    }


    public function voir_carte($carte_a_retourner, $position_specifique_grille)
    {

        $carte_a_retourner["$position_specifique_grille"]->etat_carte = 0;
    }



    public function position_initial_deux_cartesv2($verif)
    {

        foreach ($verif as $value) {

            $verif["$value->id_carte"]->etat_carte = 1;
        }
    }
}
