<?php
require_once(__DIR__ . "/../Model/Score_model.php");
class Score
{

    public function __construct()
    {
        $this->Score_model = new Score_model();
    }

    public function envoyer_score($id, $score, $nb_pair)
    {
        $this->Score_model->sql_envoyer_score($id, $score, $nb_pair);
    }

    /*   public function afficher_Top 5(){
    
    } */

    public function affiche_score_user($id)
    {
        $resultat =  $this->Score_model->sql_afficher_score_user($id);
        return $resultat;
    }

    public function dashboard_user($id)
    {
        $resultat =  $this->Score_model->sql_dashboard_user($id);
        return $resultat;
    }

    public function affiche_score_top10()
    {
        $resultat = $this->Score_model->sql_affiche_score_top10();
        return $resultat;
    }
}
