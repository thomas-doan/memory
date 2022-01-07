<?php
require('Card.php');
session_start();

$casque = new Card(1, "./img/dos.png", "./img/casque.png", 1);
$clou = new Card(1, "./img/dos.png", "./img/clou.png", 2);
$crayon = new Card(1, "./img/dos.png", "./img/crayon.png", 3);
$ecran = new Card(1, "./img/dos.png", "./img/ecran.png", 4);
$ecran2 = new Card(1, "./img/dos.png", "./img/ecran2.png", 5);
$livre_rouge_ouvert = new Card(1, "./img/dos.png", "./img/livre_rouge_ouvert.png", 6);

$casque_v2 = new Card(1, "./img/dos.png", "./img/casque.png", 7);
$clou_v2 = new Card(1, "./img/dos.png", "./img/clou.png", 8);
$crayon_v2 = new Card(1, "./img/dos.png", "./img/crayon.png", 9);
$ecran_v2 = new Card(1, "./img/dos.png", "./img/ecran.png", 10);
$ecran2_v2 = new Card(1, "./img/dos.png", "./img/ecran2.png", 11);
$livre_rouge_ouvert_v2 = new Card(1, "./img/dos.png", "./img/livre_rouge_ouvert.png", 12);

if (!isset($_SESSION['grille']) && isset($_POST['initialiser_jeu'])) {

    $grille_jeu = new Grille($_POST['initialiser_jeu']);
    $grille = $grille_jeu->creation_grille($casque, $clou, $crayon, $ecran, $ecran2, $livre_rouge_ouvert, $casque_V2, $clou_V2, $crayon_V2, $ecran_V2, $ecran2_V2, $livre_rouge_ouvert_V2);
    $grille_melanger = $grille_jeu->melange_cartes_grille($grille);
    $_SESSION['grille'] = $grille_melanger;
}

if (isset($_POST['relancer_jeu'])) {

    $grille_jeu = new Grille($_POST['relancer_jeu']);
    $grille = $grille_jeu->creation_grille($casque, $clou, $crayon, $ecran, $ecran2, $livre_rouge_ouvert, $casque_V2, $clou_V2, $crayon_V2, $ecran_V2, $ecran2_V2, $livre_rouge_ouvert_V2);
    $grille_melanger = $grille_jeu->reset_session_jeu($grille);
    $_SESSION['grille'] = $grille_melanger;
}

if (isset($_POST['submit'])) {
    echo "test ok";
};
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

            foreach ($_SESSION['grille'] as $value) {

                if ($value->etat_carte == 1) { ?>
                    <div>
                        <form method='POST' action=''>
                            <input type="hidden" name="id_carte" value="<?= $value->id_carte ?>" />
                            <input type="hidden" name="etat_carte" value="<?= $value->etat_carte ?>" />
                            <input type="hidden" name="face_carte" value="<?= $value->face_carte ?>" />
                            <button type='submit' name="submit">
                                <img src="<?= $value->dos_carte ?>" alt="carte de dos" width='60vw' height='60vh'>
                            </button>
                        </form>
                    </div>
                <?php } else { ?>
                    <div>
                        <img src="<?= $value->face_carte ?>" alt="carte de dos" width='60vw' height='60vh'>
                    </div>

            <?php
                }
            }; ?>
        </div>




    </main>
    <footer>

    </footer>

</body>

</html>