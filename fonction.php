<?php

function tableau_objets_random($nombre_de_pair)
{
    $tableau_objets = [];

    $tblimage = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];
    shuffle($tblimage);

    for ($i = 0; $i < ($nombre_de_pair); $i++) {
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
