<?php
require('Card.php');
session_start();

$casque = new Card(1, "./img/dos.png", "./img/casque.png", 0);
$clou = new Card(1, "./img/dos.png", "./img/clou.png", 1);
$crayon = new Card(1, "./img/dos.png", "./img/crayon.png", 2);
$ecran = new Card(1, "./img/dos.png", "./img/ecran.png", 3);
$ecran2 = new Card(1, "./img/dos.png", "./img/ecran2.png", 4);
$livre_rouge_ouvert = new Card(1, "./img/dos.png", "./img/livre_rouge_ouvert.png", 5);
/// GENERATION DES DOUBLES CARTES ///
$casque_v2 = new Card(1, "./img/dos.png", "./img/casque.png", 6);
$clou_v2 = new Card(1, "./img/dos.png", "./img/clou.png", 7);
$crayon_v2 = new Card(1, "./img/dos.png", "./img/crayon.png", 8);
$ecran_v2 = new Card(1, "./img/dos.png", "./img/ecran.png", 9);
$ecran2_v2 = new Card(1, "./img/dos.png", "./img/ecran2.png", 10);
$livre_rouge_ouvert_v2 = new Card(1, "./img/dos.png", "./img/livre_rouge_ouvert.png", 11);


if (!isset($_SESSION['grille']) && isset($_POST['initialiser_jeu'])) {

    $grille_jeu = new Grille($_POST['initialiser_jeu']);
    $grille = $grille_jeu->creation_grille($casque, $clou, $crayon, $ecran, $ecran2, $livre_rouge_ouvert, $casque_v2, $clou_v2, $crayon_v2, $ecran_v2, $livre_rouge_ouvert_v2, $ecran2_v2);
    $grille_melanger = $grille_jeu->melange_cartes_grille($grille);
}

if (isset($_POST['relancer_jeu'])) {

    $grille_jeu = new Grille($_POST['relancer_jeu']);
    $grille = $grille_jeu->creation_grille($casque, $clou, $crayon, $ecran, $ecran2, $livre_rouge_ouvert, $casque_v2, $clou_v2, $crayon_v2, $ecran_v2, $livre_rouge_ouvert_v2, $ecran2_v2);
    $grille_melanger = $grille_jeu->reset_session_jeu($grille);
}

if (isset($_POST['submit'])) {

    $test = $_SESSION['grille'][$_POST['position']]->verifier_couple_carte($_SESSION['grille'][$_POST['position']], $_POST['position']);
}

if (isset($_SESSION['refresh']) && $_SESSION['refresh'] == 1) {

    header("refresh: 1; index.php");
}


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

            if (isset($_SESSION['grille'])) {
                foreach ($_SESSION['grille'] as $key => $value) {



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
                    $_SESSION['grille'][$_POST['position']]->position_initial_deux_cartesv2($_SESSION['verif']);
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