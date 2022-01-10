<?php
require('Card.php');
session_start();

$casque = new Card(1, "./img/dos.png", "./img/0.png", 0);
$clou = new Card(1, "./img/dos.png", "./img/1.png", 1);
$crayon = new Card(1, "./img/dos.png", "./img/2.png", 2);
$ecran = new Card(1, "./img/dos.png", "./img/3.png", 3);
$ecran2 = new Card(1, "./img/dos.png", "./img/4.png", 4);
$livre_rouge_ouvert = new Card(1, "./img/dos.png", "./img/5.png", 5);
/// GENERATION DES DOUBLES CARTES ///
$casque_v2 = new Card(1, "./img/dos.png", "./img/0.png", 6);
$clou_v2 = new Card(1, "./img/dos.png", "./img/1.png", 7);
$crayon_v2 = new Card(1, "./img/dos.png", "./img/2.png", 8);
$ecran_v2 = new Card(1, "./img/dos.png", "./img/3.png", 9);
$ecran2_v2 = new Card(1, "./img/dos.png", "./img/4.png", 10);
$livre_rouge_ouvert_v2 = new Card(1, "./img/dos.png", "./img/5.png", 11);

$tbltest = [];
for ($i = 0; $i < (3 * 2); $i++) {
    for ($j = 0; $j < 3; $j++) {
        ${'var' . $i} = new Card(1, './img/dos.png', "./img/$j.png", $i);
        array_push($tbltest, ${'var' . $i});
    }
};
/* echo "<pre>";
    var_dump($tbltest);
    echo "</pre>";
    echo "<br>";
    echo "<br>";
    echo "<br>"; */


$tblobjet = [$casque, $clou, $crayon, $ecran, $ecran2, $livre_rouge_ouvert, $casque_v2, $clou_v2, $crayon_v2, $ecran_v2, $livre_rouge_ouvert_v2, $ecran2_v2];
/* shuffle($tbltest);
shuffle($tbltest);
shuffle($tbltest);
echo "<pre>";
var_dump($tblobjet);
echo "</pre>"; */

if (!isset($_SESSION['grille']) && isset($_POST['initialiser_jeu'])) {

    $grille_jeu = new Grille($_POST['initialiser_jeu']);
    $grille = $grille_jeu->creation_grille($tblobjet);
    $grille_melanger = $grille_jeu->melange_cartes_grille($grille);
}

if (isset($_POST['relancer_jeu'])) {

    $grille_jeu = new Grille($_POST['relancer_jeu']);
    $grille = $grille_jeu->creation_grille($tblobjet);
    /*     $grille = $grille_jeu->creation_grille($casque, $clou, $crayon, $ecran, $ecran2, $livre_rouge_ouvert, $casque_v2, $clou_v2, $crayon_v2, $ecran_v2, $livre_rouge_ouvert_v2, $ecran2_v2);
 */
    $grille_melanger = $grille_jeu->reset_session_jeu($grille);
}

if (isset($_POST['submit'])) {

    $test = $_SESSION['grille'][0][$_POST['position']]->verifier_couple_carte($_SESSION['grille'][0][$_POST['position']], $_POST['position']);
}

if (isset($_SESSION['refresh']) && $_SESSION['refresh'] == 1) {

    header("refresh: 1; index.php");
}

/* echo "<pre>";
var_dump($_SESSION['grille']);
echo "</pre>"; */

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <nav>
            <ul class="navigation">
                <li><a href="#banner">Home</a></li>
                <li><a href="#about">Top10</a></li>
                <li><a href="#menu">Connexion</a></li>
                <li><a href="#expert">inscription</a></li>
            </ul>
        </nav>
    </header>
    <main>

        <div class="boutons_jeux">
            <form method='POST' action=''>
                <button type='submit' name='initialiser_jeu' value='12'>
                    Débuter memory
                </button>
            </form>
            <form method='POST' action=''>
                <button type='submit' name='relancer_jeu' value='12'>
                    Reinitialiser memory
                </button>
            </form>
        </div>
        <div class="container_jeu">
            <?php

            if (isset($_SESSION['grille'][0])) {
                foreach ($_SESSION['grille'][0] as $key => $value) {



                    if ($value->etat_carte === 1) { ?>
                        <div>
                            <form method='POST' action=''>
                                <input type="hidden" name="position" value="<?= $key ?>" />
                                <input type="hidden" name="id_carte" value="<?= $value->id_carte ?>" />
                                <input type="hidden" name="etat_carte" value="<?= $value->etat_carte ?>" />
                                <input type="hidden" name="face_carte" value="<?= $value->face_carte ?>" />
                                <button type='submit' name="submit">
                                    <img src="<?= $value->dos_carte ?>" alt="carte de dos" width='60vw' height='60vh' class="dos">
                                </button>
                            </form>
                        </div>
                    <?php } elseif ($value->etat_carte === 0) { ?>
                        <div>
                            <img src="<?= $value->face_carte ?>" alt="carte de face" width='60vw' height='60vh'>
                        </div>

            <?php
                    }
                }
                if (isset($_SESSION['refresh']) && $_SESSION['refresh'] == 1) {
                    $_SESSION['grille'][0][$_POST['position']]->position_initial_deux_cartesv2($_SESSION['verif']);
                    $_SESSION['refresh'] = 0;
                    unset($_SESSION['verif']);
                }
            };



            ?>
        </div>




    </main>
    <footer>

    </footer>

</body>

</html>



<<<class get_html_translation_table <?php


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
                                                ${'var' . $i} = new Card(1, './img_chiffre/dos.png', "./img_chiffre/$tblimage[0].png", $i);
                                                ${'var2' . $i} = new Card(1, './img_chiffre/dos.png', "./img_chiffre/$tblimage[0].png", $i);
                                                array_push($tableau_objets, ${'var' . $i}, ${'var2' . $i});
                                                unset($tblimage[0]);
                                                shuffle($tableau_objets);
                                            };

                                            foreach ($tableau_objets as $key => $value) {
                                                $value->id_carte = $key;
                                            }

                                            return $tableau_objets;
                                        }

                                        public function creation_grille(...$objet_carte)
                                        {
                                            $resultat = array_merge($objet_carte);
                                            return $resultat;
                                        }

                                        public function melange_cartes_grille($grille)
                                        {

                                            shuffle($grille[0]);


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
