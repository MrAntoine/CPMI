<?php


echo "<br><h2>Mon super Loto </h2><br>";

$grilleloto = [];
$erreur = 0;

while (count($grilleloto) < 6) {
    //On genère le nombre aléatoire
    $nombre = rand(1, 49);

    // On vérifie si il est présent dans le tableau
    if (in_array($nombre, $grilleloto)) {
        $erreur ++;

    } else {
        array_push($grilleloto, $nombre);
    }


}
//print_r($grilleloto);
sort($grilleloto);
if ($erreur) {
    echo "Il y a " . $erreur . " fois un nombre déjà présent dans le tableau ";
}

echo "<table><tr>";

foreach ($grilleloto as $value) {
    echo "<td>" . $value . "</td>";
}

echo "</tr></table>";


?>
