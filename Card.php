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

    public function retourner_carte($carte_cible)
    {
        $carte_cible->etat_carte = 0;
    }

    public function verifier_couple_carte($carte_cible)
    {

        $id_carte = $carte_cible->id_carte;
        $_SESSION['verif']["$id_carte"] = $carte_cible;

        $tableau_face_carte = [];
        if (count($_SESSION['verif']) == 1) {

            $_SESSION['verif']["$id_carte"]->etat_carte = 0;
        } elseif (count($_SESSION['verif']) == 2) {

            foreach ($_SESSION['verif'] as $value) {

                array_push($tableau_face_carte, $value->face_carte);
            }


            if ($tableau_face_carte[0] == $tableau_face_carte[1]) {


                $_SESSION['verif']["$id_carte"]->etat_carte = 0;
                unset($_SESSION['verif']);
                header("Refresh:0; ./index.php");
                exit();
            } else {


                $_SESSION['verif']["$id_carte"]->etat_carte = 0;
                header("Refresh:2 ; ./index.php");


                foreach ($_SESSION['verif'] as $value) {

                    $_SESSION['verif']["$value->id_carte"]->etat_carte = 1;
                }

                header("Refresh:1 ; ./index.php");
                unset($_SESSION['verif']);
            }
        }
    }
}
