<?php
require('./Controller/Card.php');
require('./Controller/Grille.php');

session_start();

if (!isset($_SESSION['grille']) && isset($_POST['initialiser_jeu'])) {

    $grille_jeu = new Grille($_POST['initialiser_jeu']);
    $grille_jeu->melange_cartes_grille();
    $_SESSION['grille_jeu'] = $grille_jeu;
}

if (isset($_POST['relancer_jeu'])) {

    $grille_jeu = new Grille($_POST['relancer_jeu']);
    $grille_melanger = $grille_jeu->reset_session_jeu();
}

if (isset($_POST['submit'])) {

    $test = $_SESSION['grille'][$_POST['position']]->verifier_couple_carte($_SESSION['grille'][$_POST['position']], $_POST['position']);
}

if (isset($_SESSION['refresh']) && $_SESSION['refresh'] == 1) {

    header("refresh: 1; index.php");
}

if (isset($_SESSION['grille'])) {
    $_SESSION['grille_jeu']->victoire();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memory Game</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./public/css/accueil.css">
    <link rel="stylesheet" href="./public/css/header.css">
</head>

<body>

    <header>
        <nav>
            <ul class="navigation">
                <li><a href="">Home</a></li>
                <li><a href="">Top10</a></li>
                <li><a href="./View/profil.php">Profil</a></li>
                <li><a href="./View/connexion.php">Connexion</a></li>
                <li><a href="./View/inscription.php">Inscription</a></li>
                <li><a href="./View/deconnexion.php">Deconnexion</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?php require_once(__DIR__ . '/View/gestion_erreur.php'); ?>
        <div class="boutons_jeux">
            <?php if (!isset($_SESSION['grille'])) { ?>


                <form method='POST' action=''>
                    <select name="initialiser_jeu">

                        <option value="">Choisir vos nombres de paires</option>
                        <?php for ($i = 3; $i <= 12; $i++) {
                        ?>
                            <option value=<?= $i ?>><?= $i ?></option>
                        <?php } ?>

                    </select>
                    <button type='submit'>
                        OK
                    </button>
                </form>


            <?php
            }
            if (isset($_SESSION['grille'])) { ?>
                <form method='POST' action=''>
                    <button type='submit' name='relancer_jeu' value='12'>
                        Reinitialiser memory
                    </button>
                </form>
            <?php
            } ?>

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
        <?php

        if (isset($_SESSION['victoire']) && isset($_SESSION['chrono_debut_jeu'])) { ?>

            <div id="victoire">
                <p><?php $_SESSION['grille_jeu']->temps_realise_victoire() ?> </p>
            </div>
        <?php }
        ?>




    </main>
    <footer>

    </footer>

</body>

</html>