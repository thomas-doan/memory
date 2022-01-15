<?php
require_once('./Controller/Card.php');
require_once('./Controller/Grille.php');
require_once('./Controller/Securite.php');
require_once('./Controller/User.php');
require_once('./Database/DB_connection.php');
require_once('./Controller/Score.php');
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

//creation de l'objet User et
//creation de l'objet Score
if (isset($_SESSION['profil'])) {
    $id_session = $_SESSION['profil']['id'];
    $email_session = $_SESSION['profil']['email'];
    $_SESSION['objet_utilisateur'] = new User($email_session, $id_session);
    $_SESSION['objet_score'] = new score();
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
    <link rel="stylesheet" href="./public/css/footer.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>

<body>

    <header>
        <nav>
            <ul class="navigation">
                <li><a href="">Memory</a></li>
                <?php if (Securite::estConnecte()) : ?>
                    <li><a href="./view/top.php">Top 10</a></li>
                    <li><a href="./View/profil.php">Profil</a></li>
                    <li><a href="./View/deconnexion.php">Logout</a></li>
                <?php endif; ?>
                <?php if (!Securite::estConnecte()) : ?>
                    <li><a href="./View/connexion.php">Connexion</a></li>
                    <li><a href="./View/inscription.php">Inscription</a></li>
                <?php endif; ?>

            </ul>
        </nav>
    </header>
    <main>
        <?php require_once(__DIR__ . '/View/gestion_erreur.php'); ?>
        <?php if (isset($_SESSION['profil'])) { ?>
            <div class="boutons_jeux">
                <img src="./public/img/brain.png" alt="image cerveau" width='15%' height='15%'>

                <?php if (!isset($_SESSION['grille'])) { ?>


                    <form method='POST' action=''>
                        <p>Memory Game</p>
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
                                        <img src="<?= $value->dos_carte ?>" alt="carte de dos" width='80vw' height='80vh' class="dos">
                                    </button>
                                </form>
                            </div>
                        <?php } elseif ($value->etat_carte === 0) { ?>
                            <div>
                                <img src="<?= $value->face_carte ?>" alt="carte de face" width='80vw' height='80vh'>
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
            //affiche le temps réalisé.
            if (isset($_SESSION['victoire']) && isset($_SESSION['chrono_debut_jeu'])) {
            ?>

                <div id="victoire">
                    <p><?php $_SESSION['grille_jeu']->temps_realise_victoire() ?> </p>
                </div>
            <?php }
        } else { ?>

            <div class="wrapper">

                <div class="static-txt" data-aos="fade-down">Avez-vous le cerveau d'un</div>
                <ul class="dynamic-txts" data-aos="zoom-out" data-aos-duration="3000">
                    <li><span>Enfant ?</span></li>
                    <li><span>Adolescent ?</span></li>
                    <li><span>Adulte ?</span></li>
                    <li><span>Qui suis je ?</span></li>
                </ul>
                <p data-aos="zoom-out" data-aos-duration="3000">Connectez-vous pour débuter <span>Memory Game.</span> </p>

                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 360 216" style="enable-background:new 0 0 360 216;" xml:space="preserve" data-aos="fade-up">
                    <g>
                        <path class="st2" d="M62.8,117.2c0,0-7.8-0.6-11.6-1.3c-3.9-0.7-7.9-3-12.7-5.8s-6.3-0.2-7.8-5.3c0,0-0.4-1.3-1.9-2.2
			c-1.5-0.9-3.3-1.8-3.8-5.4c-0.4-3.6-1.6-2-1-4.1" />
                        <path class="st2" d="M28.2,93.8c0,0-6.1,1.6-5.8-5.3" />
                        <path class="st2" d="M33.8,91.8c0,0-4.9,3.6-6.5-1c-1.6-4.6-5.4,1-5.3-4.9c0.1-5.9,0.6-8.1,2.2-10.3c0,0-3.4,1.6-2.8-4.6
			c0,0-5.6,0.6-1.5-6.1s2.8-1.4,3.5-7.5s5.3-9.7,5.9-9.9c0.7-0.2,2.5-3.3,5.2-0.9" />
                        <path class="st2" d="M43.4,76.1c0,0-2.7,2.1-5.3,0c-2.6-2.1-4.1,0.3-5.1,0.9c-1,0.6-10.5,1.5-7.3-4s1-5.8,4.6-8.6
			c0,0-0.1-3.8,4.5-8.8s5.1-6.1,7-6.1c1.9,0.1,2.3,1.3,2.3,1.3" />
                        <path class="st2" d="M41.8,49.6c0,0-1.1-0.8,3.1-4.7s5.5-6.3,9.8-5.9" />
                        <path class="st2" d="M59.2,40.8c0,0-1.7,2-3,0.8c-1.3-1.2-2.8-2.7,0-5.8c2.8-3.1,6.8-3.9,7.9-3.6c0,0,8.8-7.2,14.7-7
			c0,0,2.7-0.6,4.3,0" />
                        <path class="st2" d="M79.8,37.9c0,0-0.8-1.8,1.3-3.9s1.1-4.6,0.6-5.4c-0.5-0.8,0.4-4.3,3.9-4.7s2.9-0.9,4-1
			c1.1-0.1,4.9-1.5,10.4,0.5c0,0,7.2-1.1,8.6,0.6c0,0,6.6,3.8,6.3,9.6s-8.2,11.7-10.4,15.1s-1.1,4.3-0.9,5.2
			c0.2,0.9,1.4,8.8,0.3,11.6c-1.1,2.8-1.2,4-0.3,6.2c0.8,2.2-0.6,4-0.8,5.2c-0.2,1.2-1,5.1,1.7,4.9c2.6-0.1-0.9,4.2-2.2,5.3
			c-1.3,1.1-2.4,2.6-2.4,2.6" />
                        <path class="st2" d="M141.2,48.3c-4.1-3.5,0.6-7.4-5.8-8.7c-6.3-1.3-6.5-4.8-6.5-4.8c-7.1-18-20.8-11.2-20.8-11.2" />
                        <path class="st2" d="M125.8,28.9c0,0,2.2-0.5,3.7,1c0,0,4.5,0.1,5.4,2.2c0.9,2.1,4.4,3.4,5.4,3.1s5,3,5.8,7s3.7,4.5,4,9" />
                        <path class="st2" d="M149.5,48.6c0,0,6.5,4,7.6,10.6s3.3,7.4,4.1,8.7s1.9,2.2,1,7.5c-1,5.2,1.9,6,1.2,10.9
			c-0.7,4.9-2.4,2.9-3.3,5.1c-0.9,2.2-3,7.1-5.8,8.2c0,0-4.3,4.5-8.4,5.8c-4.1,1.3-7.4,2.8-10.3,5.5c-2.8,2.7-8.2,2.2-9.5,1.4
			c0,0-4.7,6.6-14.9,9s-12,3.7-12,3.7s-4.7,2.9-9.3-0.5l-0.6-0.4" />
                        <path class="st2" d="M117.8,79.7c-2.3-2-3.9,1.4-4,1.9c-0.1,0.5-4,4.7-5.1,5.8s-8.7,7.5-14,10.6c-5.3,3.2-16.8,8.3-16.8,8.3
			c-1.9-0.3-2.5,1.5-3.1,1.7c-0.7,0.2-2.2,0-2.1,7.1c0.2,7.1,4.2,5.1,5,6.2c0.8,1.1,3.1,1.7,4.2,1.8c1.2,0.2,4.2,3.5,9.2,0
			c5-3.5,7.3-3.1,7.3-3.1" />
                        <path class="st2" d="M35.4,103.3c0,0,5.5-2.2,9.9,3.2s6.8,4.3,9.1,4.2s2.2-0.6,3.9-0.6s3.5,1.6,5.3-1c0,0,3.2,3.7,6.7,1.1
			c3.5-2.6,1.3-5.8,5.4-9.5c4.1-3.7,5.4-0.1,8.6-2.7c0,0,0.8-0.9,1.2-1.8" />
                        <path class="st2" d="M39.3,103c0,0-2.1-1.3-2.6-4.4" />
                        <path class="st2" d="M73,117.5c-16.6,5.5-8.5-7.5-8.5-7.5" />
                        <g>
                            <path class="st2" d="M134.9,86.4c-2.2,1-6.3,5.9-6.6,6.5c-0.3,0.6-8.1,9.9-11.6,8.8c-3.5-1.1-4.2,1.9-4.6,2.3s-2.3,3.3-5.6,5.2
				c-3.3,1.8-3.9,8.2-3.9,8.2" />
                            <path class="st2" d="M98.5,114.8c0,0,4.8-3.9,6.4-4.1" />
                        </g>
                        <g>
                            <path class="st2" d="M117.8,50.6c0,0-0.4,3.1-2.3,4c-1.9,0.9-1.2,3.3,0,6.4c1.2,3-2.3,7.5-3.6,7.8c-1.3,0.3-2.2,4.7-1.9,6.9
				c0.3,2.2-1.3,2.8-1.3,2.8" />
                            <path class="st2" d="M113.3,50c0,0,1.8,2.6,1.7,4.9" />
                        </g>
                        <path class="st3" d="M119.8,70.8c0,0,3-1,6-0.4c3,0.6,5.2,6.9,3.8,7.9c0,0-1.3,2.9-2.4,3.4" />
                        <g>
                            <path class="st3" d="M141.3,81.1c0,0,0.9-3.9,3.1-4.7c2.1-0.8,0-7.8-3.8-8.3c-3.9-0.5-5.3-8.1-5.2-14.2s-6.3-11.4-10.4-8.2" />
                            <path class="st3" d="M148.1,80.4c0,0-1.1-2.7-3.7-4" />
                        </g>
                        <g>
                            <path class="st2" d="M98.4,32.2c0,0,4.4,3.7-4,9.1c0,0-4.7,2-3.8,7.5s-3.7,5-5.2,8.8c-1.5,3.8,1.1,7.3,1.1,7.3" />
                            <path class="st2" d="M76.6,64.5c0,0,2.8-4.6,8.6-5.8" />
                        </g>
                        <path class="st3" d="M75.4,40.1c0,0-2.6,2.4-2.9,5.5c-0.4,3.1-2.7,8.1-4.6,8.8c-1.9,0.7-8.5-1-9.7,0c-1.2,1-0.7,8.3-2.3,13
			c-1.6,4.7-5.7,6.2-8.3,2.6" />
                        <path class="st2" d="M69.8,74.4c0,0-3.6,0.9-3.7,3.2c-0.1,2.4-1.7,5-4.3,5.6c-2.6,0.6-3.1,2.5-4.4,3s-4.3,1.2-5.3,7.4
			c0,0-5.3,0-8.6-5.5s-8.7-4.2-8.9-3.6" />
                        <path class="st3" d="M64.6,99.2c0,0,1.2-10,10.2-11.5c9-1.5,6.9-5.9,8.1-7.2s5.6-4.7,8.9-4.3" />
                        <path class="st2" d="M104.8,123c0,0,7.5,13.1,21,7.1c0,0,6.9-1.7,7-5.4c0,0,10.8-1.7,8.2-17.4" />
                        <path class="st3" d="M73.8,119.5c0,0-1.7,1.3,3.9,14.2c0,0,2.6,10.8,9.3,9.1c6.7-1.7,10.2-2.2,19.6-10.2" />
                        <path class="st3" d="M84.4,142.8c0,0,3.4,10,2.8,14.1s2.6,9.7,5,10.8s0.6,9.3,1.8,14.5c1.2,5.2,4.5,11.6,4.5,11.6
			s6.2,3.7,16.4-4.5c0,0-4.9-15.3-6.2-27.4s1.8-32.9,1.8-32.9" />
                        <line class="st3" x1="107.8" y1="122.2" x2="120.7" y2="131.6" />
                        <line class="st3" x1="110.3" y1="121.6" x2="123.1" y2="130.8" />
                        <line class="st3" x1="112.5" y1="120.8" x2="125" y2="130" />
                        <line class="st3" x1="115.1" y1="120.2" x2="128.1" y2="129.7" />
                        <line class="st3" x1="116.9" y1="119.5" x2="129.3" y2="128.5" />
                        <line class="st3" x1="118.7" y1="118.6" x2="131.2" y2="127.5" />
                        <line class="st3" x1="120.3" y1="117.8" x2="132.7" y2="126.5" />
                        <line class="st3" x1="121.6" y1="116.5" x2="132.9" y2="124.7" />
                        <line class="st3" x1="123.1" y1="115.5" x2="134.9" y2="124" />
                        <line class="st3" x1="124.3" y1="114.4" x2="136.6" y2="123" />
                        <line class="st3" x1="125.5" y1="113.2" x2="138" y2="121.8" />
                        <line class="st3" x1="128.1" y1="112.8" x2="139" y2="120.6" />
                        <line class="st3" x1="131.2" y1="113.2" x2="139.6" y2="119.1" />
                        <line class="st3" x1="132.7" y1="112.4" x2="140.6" y2="117.8" />
                        <line class="st3" x1="134.6" y1="111.7" x2="141" y2="116.2" />
                        <line class="st3" x1="136" y1="110.6" x2="141.3" y2="114.5" />
                        <line class="st3" x1="137.4" y1="109.4" x2="141.4" y2="112.4" />
                        <line class="st3" x1="138.4" y1="108.4" x2="141.5" y2="110.9" />
                        <line class="st3" x1="106" y1="123" x2="118.3" y2="132" />
                        <path class="st2" d="M25.8,99.6c0,0-6.2,1.4-8.6-5.7c-2.4-7-1.8-7.2-3.7-9.6s2-11.7,5-14.1" />
                        <path class="st2" d="M32.9,46c0,0,9.9-14.1,14.7-13.7" />
                        <path class="st2" d="M46.4,37.4c0,0,0.7-8,7.4-10.4s6.9-2.2,10.9-3.8s5-5.2,10.8-2.1" />
                        <path class="st2" d="M74.1,20.5c0,0,1.4-1.5,5.6-2.4c4.2-1,10.6-2.8,13.5,0c3,2.8,5.5,2.7,6.6,2.4c1.1-0.3,4.5,0,7.1,2.7" />
                    </g>
                    <g>
                        <path class="st4" d="M185,91.9c0,0-2.6-4.2-3.2-9.1c-0.6-4.8,2.6-5.2,2.6-5.2" />
                        <path class="st4" d="M217.2,31.4C205.5,34,193,51.2,193,51.2c-8.4,5.6-8,13.5-8,13.5s-4.9,8.9-2.9,15.1" />
                        <path class="st4" d="M273.4,25.2c0,0,3.7-1.9,20.2,6.2c16.4,8.1,12.8,12.8,12.8,12.8s7.2,2.7,8.9,7c1.7,4.3,4.7,4.5,5.6,6.3
			s4.5,7.8,0,16.5s-2,13.4-2,13.4" />
                        <path class="st4" d="M322.7,69.1c0,0,1.5,6.7,6,10.7c4.5,4,3.9,6.5,5.3,16.6s-3.3,14.4-3.3,14.4s0.8,2.4-3.6,7s-9.5,1.6-9.5,1.6
			l-3-2.2" />
                        <path class="st5" d="M255.4,124.3c-7.1,7.9-19.3-0.8-19.3-0.8c-10.3-6.5-7.3-9.9-7-11.3" />
                        <path class="st5" d="M264.5,94.7c-6.2-2.8-23.7,5.7-27.9,10.5c-4.2,4.8,18.6-11.1,23.3,2c0,0-9.2,4-4.8,17.4c0,0,2.8,13.1,12,8.7
			c0,0,6.7,5.4,8.6,12.9c1.9,7.4,3.7,16.5,6.2,21.5c2.5,5,8.1,21.4,8.4,25.3c0,0,10.2,1.9,15.5-1.3c0,0-6.4-13-7.6-22.5
			c-1.3-9.5-6.9-24.6-8.1-25.9c-1.3-1.3-13.2-24.9-15.9-33.7S270.7,97.4,264.5,94.7z" />
                        <path class="st4" d="M234.2,84.8c0,0-16.8-4.2-3.2-12.6c0,0,14-5.4,29.9,0.6c15.9,5.9,8.2,15.1,14.9,16.1
			c13.2,1.8,7.1-7.5,6.1-13.1S274,68.9,261,64.1c-13-4.8-18.8-4-21.8-3.1c-3,0.8-7.2,2.9-16.4,6.7c-9.2,3.7-14,16-5.6,18.5
			c8.4,2.5,14.8,0,16.1,0C233.4,86.2,234.7,85.8,234.2,84.8z" />
                        <path class="st4" d="M277.8,118.3c-3.2-7.6,2.9-25.4,13.2-23.6c10.3,1.7,10,4.6,19.4,14.7s0,17.8,0,17.8c0,4.2-3.3,6.6-13.1,8.1
			c-9.7,1.5-16.4-9.4-16.4-9.4l-0.9-2.2L277.8,118.3z" />
                        <path class="st5" d="M275.1,112.2c0,0-0.6-6.9,0.4-9.8c1-2.8-2.1-9.3-2.1-9.3s1.4-2.4,0.5-5" />
                        <path class="st5" d="M249.3,102.2c0,0,6.1,2.4,5.9,10" />
                        <path class="st5" d="M256.1,71.3c0,0-7,0.6-14.1,5.6c0,0-5.3,3.3-7.8,7.8" />
                        <path class="st4" d="M236.7,105.2c2.9-4.5,2.3-8.3,1.3-12c0,0-0.8-3.1-3-4.1c-2.2-0.9-3.2-2.6-3.2-2.6" />
                        <path class="st5" d="M238.8,103.2c0,0,2.5-7.4,2.5-12.1c0-4.7,1.3-7.8,5.8-12c0,0,3.9-3.6,9.1-2.8c5.2,0.7,7.4-2.4,7.4-2.4" />
                        <path class="st5" d="M251.1,84.8c0,0,2.1-2.3,4.3,0c2.2,2.3-0.6,3.7-1.5,3.4C253.2,87.9,250.1,87.8,251.1,84.8z" />
                        <path class="st5" d="M271.6,101.7c0,0-1.1-4-2.6-5.8c-1.5-1.8-1.2-3.5-1.5-4.7c-0.4-1.2-1.9-6,2.6-3.8c4.5,2.3,2.5,3.8,2,4.4
			s-1.4-0.5-2,0c0,0,0.8,1.7,2,2.4c1.2,0.7,2.9,6.1,1.4,6.1c-1.4,0,0,6.8,0,6.8" />
                        <path class="st5" d="M285.1,123.4c-0.3,8.8,8.6,9.2,10.7,9c2.1-0.3,10.5-1.7,14.7-5.2c4.2-3.5,4.1-7.8,3.8-11.6s-3.8-5.2-6.3-9
			c-2.6-3.9-8.6-9.1-8.6-9.1c-13.4-8.3-19.8,1.4-22.1,12.5c0,0-1.9,6.6,3.9,11L285.1,123.4z" />
                        <path class="st4" d="M309,113.9c0,0-4.4-1.3-10.4,1.1c-6,2.3-7.3,5.8-13.5,8.4" />
                        <path class="st5" d="M291.5,102.2c0,0-1.4,3.2-2.1,7.7c-0.8,4.5,1.6,7.3-0.3,11.3" />
                        <path class="st5" d="M300.1,126.8c0,0-1.2-5.1-8.3-7.6" />
                        <path class="st5" d="M300.9,105.2c0,0,2,4.5-0.6,9.2" />
                        <path class="st4" d="M298.6,115c3.5-0.4,3.8,2.5,3.8,2.5" />
                        <line class="st5" x1="280.9" y1="121" x2="284" y2="130" />
                        <line class="st5" x1="282.7" y1="122.3" x2="285.8" y2="131.3" />
                        <line class="st5" x1="286.5" y1="128.8" x2="287.8" y2="132.9" />
                        <line class="st5" x1="289.1" y1="131.1" x2="289.9" y2="134" />
                        <line class="st5" x1="291.2" y1="131.9" x2="291.8" y2="134.8" />
                        <line class="st5" x1="293.2" y1="132.3" x2="293.8" y2="135.3" />
                        <line class="st5" x1="295.1" y1="132.4" x2="295.7" y2="135.4" />
                        <line class="st5" x1="297.1" y1="132.2" x2="297.6" y2="135.2" />
                        <line class="st5" x1="299" y1="131.8" x2="299.5" y2="134.9" />
                        <line class="st5" x1="300.8" y1="131.4" x2="301.3" y2="134.5" />
                        <line class="st5" x1="302.7" y1="130.9" x2="303.2" y2="134" />
                        <line class="st5" x1="304.5" y1="130.3" x2="305" y2="133.5" />
                        <line class="st5" x1="306.3" y1="129.6" x2="306.7" y2="132.7" />
                        <line class="st5" x1="307.9" y1="128.9" x2="308.3" y2="131.7" />
                        <path class="st4" d="M279.5,42.9c0,0-5.8,1.8-5.1-4.8c1.1-10.4,4.5-10.1-4.2-14.8c-8.6-4.6-22,0-22,0c-12-1.2-7,1.5-13.4,1.9
			c-6.4,0.5-5.6,3-13.1,3.9s-4.5,8.9-4.5,8.9" />
                        <path class="st5" d="M207.5,65.2c0,0,3-1.7,3.2-6.3s12.2-2.2,17.8-7.2s13.4-6.6,13.4-6.6" />
                        <path class="st5" d="M300.1,86c0,0,6.5-1.4,6.4-12.1c0,0,0.3-3.5,7.9-8.7" />
                        <path class="st4" d="M274.6,63.2c0,0,0.1-8.2,4.9-3s11.6,5.4,10.4-7.7c0,0-3.6-8.9,5.3-9.4" />
                        <path class="st4" d="M321,102.2c0,0,1.4,9.7,9.6,8.6" />
                        <path class="st4" d="M197,83.5c0,0,3.1,3,6.8,1.3c0,0,10.6,14.3,18.1,11.8c0,0-6.5,6-14.3-0.8c-7.8-6.7-11.4-4.5-11.4-4.5
			c-3.5,0.1-9.3-2.2-11.2,0.6c-1.1,1.7-0.8,5.2,2.4,12.1c8.5,18.4,26.7,6.3,31.5,7.9s14.7-0.4,14.7-0.4s4.7-0.7,3.2-5.5" />
                        <path class="st5" d="M193.2,64.6c0,0,6.8,2.8,8.2-4.3c0,0,1.3-7.8,9.4-1.4" />
                        <path class="st4" d="M307.9,64.6c0,0-5.3,1.5-11.9,4.4c-6.6,3-6.1-11.3-6.1-11.3" />
                        <path class="st4" d="M245.2,38c0,0,8.4,9.6,13.2,0" />
                        <path class="st4" d="M265.1,35.8c0,0-0.7,6-9.1,5.2" />
                        <path class="st5" d="M260.6,50.7c0,0,5.2-1.8,8.3,1.8c3.1,3.6,4.1-2,10.6-2.2" />
                        <path class="st5" d="M252.2,53.7c0,0,5.9-1.5,11.3,1.5s8.6-1.9,8.6-1.9" />
                        <path class="st4" d="M309,92.5c0,0,4.2,4.4,7.9,4.4c0,0-2.7,3.9,0,10.1" />
                        <path class="st5" d="M228.6,108.5c0,0-4.3-0.5-6.4-4.5c0,0-6.7,5.5-18.4-3.8c0,0-2.7-3-7.8-0.9" />
                        <path class="st4" d="M210.8,49.4c0,0-5.7-4.2-17.8,1.8" />
                        <path class="st5" d="M285.1,105.2c0,0-1,1.9,0,4.6s3.4,2.8,4.6,6.4" />
                        <path class="st5" d="M294.2,120.3c0,0,4.1-0.3,9,3.2c0,0,2.1,1.6,3.5,2.1" />
                        <path class="st4" d="M304.5,113.6c0,0,2.8-0.6,2.7-2.9" />
                        <path class="st5" d="M282.7,107.7c0,0,0.9,1.5,2.4,2" />
                        <path class="st5" d="M284.3,111.5c0,0,1.5,1,2.5,0.7" />
                        <path class="st5" d="M285.6,110.7c0,0,1.1-2.4,1-3" />
                        <path class="st5" d="M287.8,113.1c0,0,0.2-2.1-0.6-3.4" />
                        <path class="st5" d="M298.6,105.8c0,0,2.1,2.3,3.1,3" />
                        <path class="st5" d="M303.2,107c0,0-0.9,2.6-1.5,2.8" />
                        <path class="st5" d="M304.5,109.8c0,0-1.8,1.8-3.2,2l-1.9-2" />
                        <path class="st5" d="M301.3,124.5c0,0-1.4-1.8-2-3.2" />
                        <path class="st5" d="M303.9,126.1c0,0-0.7-1.2-0.7-2.7" />
                        <path class="st5" d="M298.3,120.9c0,0,1.7-1,3-1" />
                        <path class="st5" d="M302,122.6c0,0,1-0.8,2.8-1.4" />
                        <path class="st5" d="M304.5,124.4c0,0,2-0.3,3.6,0" />
                        <path class="st5" d="M289.8,117.5c0,0,3-4.8,3.7-8.3c0,0,1.7-2,2.3-2.2" />
                        <path class="st5" d="M292.8,105.2c0,0,0.2,2.9,0.7,4.1" />
                        <path class="st5" d="M291.5,109.2c0,0-0.1,2.3,0.6,3.9c0.5,1.2,3.5-1.4,3.5-1.4" />
                        <path class="st5" d="M291.2,115.1c0,0,1.6,0.5,3.1,0" />
                        <path class="st5" d="M305.9,116.2c0,0-1.9,1.4-3.9,0.1" />
                        <path class="st5" d="M291.1,103.2c1.7-2.1,4-3.5,4-3.5" />
                        <path class="st5" d="M292.7,97.9c0,0,1.3,1.6,0.4,3.4" />
                        <path class="st5" d="M292.1,102.2c2.4-0.9,3.7,0,3.7,0" />
                        <path class="st5" d="M304.8,116.7c1.3-0.1,3.1,1.8,3.1,1.8" />
                        <path class="st5" d="M293.8,127.6c0,0,1.4-3.6-0.2-7.6" />
                        <path class="st5" d="M296,128.3c0,0-0.5-1.6-1.8-2.2" />
                        <path class="st5" d="M291.8,126.1c0,0,1.6,0.4,2.4-0.8" />
                        <path class="st5" d="M296,125.3c0,0-0.8-1.2-1.6-1.9" />
                        <path class="st5" d="M291.8,123.4c0,0,1.2-1.1,2.3-1.6" />
                        <path class="st5" d="M289.1,98.4c0,0,2.9,0.9,1.6,6.2" />
                        <path class="st4" d="M288.5,103.2c0,0,1,1.9,1.8,2.6" />
                        <path class="st5" d="M306.5,120.4c0,0-0.7-1.3-0.6-3.4" />
                        <path class="st4" d="M287.5,116.7c0,0,1.7-0.2,2.3,1.4" />
                    </g>
                </svg>
            </div>

        <?php
        } ?>

    </main>
    <?php require_once(__DIR__ . '/View/footer.php'); ?>

    <script>
        AOS.init({
            duration: 2000,
        })
    </script>
</body>

</html>