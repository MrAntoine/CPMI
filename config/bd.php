<?php

$host="localhost";
$db="classicmodels";
$user="root";
$passwd="root";


try {
    // On essaie de créer une instance de PDO.
    $pdo = new PDO("mysql:host=$host;port=3308;dbname=$db", $user, $passwd, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage() . "<br />";
    die(1);
}


?>