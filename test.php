<?php
session_start();
/* var_dump($_POST); */
/* var_dump($_SESSION['position_case']); */



$tbl_affiche_carte_dos = [
    [0, 0, 0, 0],
    [0, 0, 0, 0],
    [0, 0, 0, 0],
    [0, 0, 0, 0],
];

function afficher_tableau($tbl_zero)
{
    //transfert de donnée -> tableau //
    $premier_tbl = $tbl_zero;

    $valeur = "";

    $clos = "
     height: 3rem;
    width: 3rem;
    padding: 1rem;
    margin: 0.2rem;
    background-color: blue;
    border: none;
    border-radius: 10%;' 
    ";

    //algo qui recup la valeur des matrices et la position //

    for ($i = 0; $i < count($premier_tbl); $i++) {

        echo '<div class="ensemble_valeur">';

        for ($j = 0; $j < count($premier_tbl[$i]); $j++) {

            $valeur = $premier_tbl[$j][$i];
            echo $valeur;
            echo " $i" . " $j";
            if ($premier_tbl[$j][$i] === 0) {

                echo  "<div><form method='POST' action=''>
             <button type='submit' style='$clos'
        
            name ='$i$j' value='$i$j'>
             </button> 
             </form></div>";
            } else {
                $transfert = afficher_img($valeur);
                echo "<div><img src=$transfert width='60vw' height='50vh'></div>";
            }
        }
        echo "</div>";
    }
}

function retourner_carte(/* $position_carte */)
{

    $ligne = 3;
    $colonne = 2;
    $tbl_affiche_carte_dos[$ligne][$colonne] = $_SESSION['tbl'][$ligne][$colonne];
    afficher_tableau($tbl_affiche_carte_dos);
}





/*        if ($tableau[$j][$i] == 0) {


            echo  "<div class='bouton choix$valeur'><form method='POST' action=''>
             <button type='submit' class='choixTOTO$valeur' name = 'valeur_$valeur'>
             </button> 
             </form></div>";
        } else {
            $transfert = afficher_img($valeur);
            echo "<div><img src=$transfert width='60vw' height='50vh'></div>";
        } */


function afficher_img($valeurtbl)
{
    $chemin = "./img/";
    switch ($valeurtbl) {
        case 1:
            $chemin = $chemin . "casque.png";
            break;
        case 2:
            $chemin = $chemin . "clou.png";
            break;
        case 3:
            $chemin = $chemin . "crayon.png";
            break;
        case 4:
            $chemin = $chemin . "ecran.png";
            break;
        case 5:
            $chemin = $chemin . "ecran2.png";
            break;
        case 6:
            $chemin = $chemin . "livre_rouge_ouvert.png";
            break;
        case 7:
            $chemin = $chemin . "marteau.png";
            break;
        case 8:
            $chemin = $chemin . "micro.png";
            break;
        case 9:
            $chemin = $chemin . "outil.png";
            break;
        case 10:
            $chemin = $chemin . "pinceau.png";
            break;
        case 11:
            $chemin = $chemin . "sci.png";
            break;
        case 12:
            $chemin = $chemin . "stylo.png";
            break;

        default:
            "warning";
    }

    return $chemin;
}

function melange_valeur_tableau($tableau_melanger)
{

    shuffle($tableau_melanger);
    shuffle($tableau_melanger[1]);
    shuffle($tableau_melanger[2]);
    shuffle($tableau_melanger[0]);
    shuffle($tableau_melanger[3]);

    $nouveau_tbl_melanger = $tableau_melanger;

    return $nouveau_tbl_melanger;
}

if (!isset($_SESSION['tbl'])) {
    $tableau_initialise = [

        [1, 2, 1, 5],
        [4, 1, 0, 5],
        [0, 3, 4, 6],
        [3, 1, 2, 6],
    ];

    //  fct shuffle les nombres du tableau
    $_SESSION['tbl'] = melange_valeur_tableau($tableau_initialise);
} else {
    $_SESSION['tbl'];
}

if (isset($_POST)) {
    $_SESSION['position_case'] = $_POST;
    /*     array_push($_SESSION['position_case'], $_POST); */
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container_tbl">
        <?php
        echo "<br>";
        var_dump($_SESSION['position_case']);
        echo "<br>";

        /* retourner_carte($_SESSION['position_case']);  */
        retourner_carte();
        afficher_tableau($tbl_affiche_carte_dos) ?>
    </div>


    <div>
        <p class="toto first44">super test 1</p>
        <p class="toto second45">super test 1</p>

        <?php
        echo "<pre>";
        var_dump($_SESSION['tbl']);

        echo "</pre>";

        ?>
    </div>


</body>

</html>




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