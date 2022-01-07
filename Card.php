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
}
