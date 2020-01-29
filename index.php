<link rel="stylesheet" type="text/css" href="style.css" media="screen"/>

<?php
include("config/actions.php");
include("config/bd.php");
include("config/config.php");

session_start();
ob_start();
?>


<nav>

    <h1>Cours PHP CPMI</h1>

    <form method="post" action="index.php?action=loto">
        <button type="submit">Loto</button>
    </form>

    <form method="post" action="index.php?action=interactionDB">
        <button type="submit">DB Interact</button>
    </form>

    <form method="post" action="index.php?action=test">
        <button type="submit">Test</button>
    </form>

    <form method="post" action="index.php?action=formulaire">
        <button type="submit">Formulaire</button>
    </form>

    <form method="post" action="index.php?action=ages">
        <button type="submit">Ages</button>
    </form>

    <form method="post" action="index.php?action=traducteur">
        <button type="submit">Traducteur</button>
    </form>

    <form method="post" action="index.php?action=traducteur2">
        <button type="submit">Traducteur2</button>
    </form>

    <form method="post" action="index.php?action=fichiers">
        <button type="submit">Fichiers</button>
    </form>

    <form method="post" action="index.php?action=databse">
        <button type="submit">Database</button>
    </form>

    <form method="post" action="index.php?action=commandes">
        <button type="submit">Commandes</button>
    </form>

</nav>

<?php


// Quelle est l'action à faire ?
if (isset($_GET["action"])) {
    $action = $_GET["action"];
} else {
    $action = "";
}
// Est ce que cette action existe dans la liste des actions
if (array_key_exists($action, $listeDesActions) == false) {
    echo "Page introuvable";
} else {
    include($listeDesActions[$action]); // Oui, on la charge
}
ob_end_flush(); // Je ferme le buffer, je vide la mémoire et affiche tout ce qui doit l'être

?>