<?php
// On genère les variables OK
$tab=[];

// On doit mettre tout cas dans une boucle : tant que le tableau a une taille inférieur à 6 on refait les etapes.
while(count($tab) <6){

    $nombres=rand(1,99); // Une fois dans la boucle on génère le nombre aléatoire (dans la boucle car il faut que le nombre puisse se re-générer)


    //ensuite il faut vérifer si le nombre généré est dans le tableau,
    if( in_array($tab, $nombres)){

    }else {
        array_push ($tab, $nombres);
        // - Sinon on ajoute le nombre au tableau avec array_push
    }
}
// On trie
sort($tab);
// On affiche le résultat avec var_dump
var_dump ($tab);

?>

