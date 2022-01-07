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