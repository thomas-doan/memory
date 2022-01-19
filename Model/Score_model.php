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

    public function sql_dashboard_user($id)
    {
        $req = "SELECT MIN(temps_score) as min, nombre_pair,  AVG(temps_score) as moyenne FROM  score WHERE id_fk_utilisateur = :id GROUP BY nombre_pair";
        $stmt = Database::connect_db()->prepare($req);
        $stmt->execute(array(
            ":id" => $id
        ));
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }

    public function sql_affiche_score_top10($pair)
    {
        $req = "SELECT DISTINCT score.temps_score, score.nombre_pair, utilisateurs.login FROM score INNER JOIN utilisateurs ON score.id_fk_utilisateur = utilisateurs.id_utilisateur WHERE score.nombre_pair = :pair GROUP BY score.temps_score, score.id_fk_utilisateur   ORDER BY score.temps_score ASC LIMIT 0, 10;";
        $stmt = Database::connect_db()->prepare($req);
        $stmt->execute(array(
            ":pair" => $pair
        ));
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }
}
