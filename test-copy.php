<?php
session_start();
if (!isset($_SESSION['tbl'])) {
    $tableau = [];

    $_SESSION['tbl'] = $tableau;
}

function afficher_tableau()
{

    /*  $premier_tbl = [

        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 0, 0],
    ]; */


    $tableau = [

        [1, 2, 1, 5],
        [4, 1, 0, 5],
        [0, 3, 4, 6],
        [3, 1, 2, 6],
    ];

    shuffle($tableau);
    shuffle($tableau[1]);
    shuffle($tableau[2]);
    shuffle($tableau[0]);
    shuffle($tableau[3]);

    $valeur = "";

    for ($i = 0; $i < count($tableau); $i++) {
        echo '<div class="ensemble_valeur">';
        for ($j = 0; $j < count($tableau[$i]); $j++) {

            $valeur = $tableau[$j][$i];
            /*   echo $valeur; */
            /* echo " $i" . " $j"; */
            if ($tableau[$j][$i] !== null) {
                echo  "<div><form method='POST' action=''>
             <button type='submit' class='bouton choix$valeur'>
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
        <?php afficher_tableau() ?>
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