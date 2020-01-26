<?php

$ages = [
    'Pierre' => 5,
    'Jean' => 10,
    'Jack' => 8,
    'Louis' => 20
];

//var_dump($ages);

foreach ($ages as $cle => $valeur) {
    echo "<br>" . $cle . " a " . $valeur . " ans <br>";

    if ($valeur > 18) {
        echo $cle . " est majeur <br>";
    } else {
        echo $cle . " est mineur <br>";
    }
};




$dico = [
    'cat' => 'chat',
    'cat' => 'chat',
    'cat' => 'chat',
    'cat' => 'chat'
];


$moten = array_search ("cat",$dico);
echo $moten; // Vers EN


echo $dico ['cat']; // vers FR

//array_search
//array_key_exists

