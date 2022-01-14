<?php

class Score_model
{

    public function sql_envoyer_score($id, $score, $nb_pair)
    {
        $req = "INSERT INTO score (id_fk_utilisateur, temps_score, nombre_pair, date) VALUES (:id_fk_utilisateur, :temps_score, :nombre_pair, CURRENT_TIMESTAMP  )";
        $stmt = Database::connect_db()->prepare($req);
        $stmt->execute(array(
            ":id_fk_utilisateur" => $id,
            ":temps_score" => $score,
            ":nombre_pair" => $nb_pair,
        ));
    }

    public function sql_afficher_score_user($id)
    {
        $req = "SELECT * FROM score WHERE id_fk_utilisateur = :id ORDER BY date DESC";
        $stmt = Database::connect_db()->prepare($req);
        $stmt->execute(array(
            ":id" => $id
        ));
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }
}
