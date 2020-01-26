<?php
$fichier = fopen("taches.csv", "a");

$fruits = ['pomme',"poire","kiwi"];
fputcsv($fichier, $fruits);
fclose($fichier);


$fichier = fopen("taches.csv", "a+");
$tab=[];

while(true){
    $ligne = fgetcsv($fichier);
    if($ligne == false) {
        break;
    }else {
        array_push($tab,$ligne);
    }
}
fclose($fichier);
var_dump($tab);