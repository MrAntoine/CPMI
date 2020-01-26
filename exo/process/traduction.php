<?php

function traduire($mot, $sens)
{
//var_dump($sens);
    $mot = htmlentities(strtolower($_POST['mot']));

    $library = [
        'cat' => 'chat',
        'dog' => 'chien',
        'fish' => 'poisson',
        'cow' => 'vache'
    ];

    switch ($sens) {
        case "en-fr":
            if (array_key_exists($mot, $library) == true) {
                $resultat = "<b>" . $mot . "</b> se dit <b>" . $library[$mot] . "</b> en français";
            } else {
                $resultat = "je ne connais pas le mot " . $mot;
            }
            break;

        case "fr-en":
            if (in_array($mot, $library) == true) {
                $resultat = "<b>" . $mot . "</b> se dit <b>" . array_search($mot, $library) . "</b> en anglais";
            } else {
                $resultat = "Je ne connais pas le mot " . $mot;
            }
            break;

        default:
            $resultat = "je ne connais que le francais et l'anglais";
    }
    echo $resultat;
    return $resultat;
}


if (isset($_POST['mot'])) {
    traduire($_POST['mot'], $_POST['lang']);
} else {
    return "Veuillez saisir un mot";
}

// revoir la sécurité
