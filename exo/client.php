<h2>Détails du client</h2>

<a href="index.php?action=commandes">Retourner à la liste des commandes</a>

<?php

$client_id = $_GET['id'];
$price_ht = 0;

function multiple($q, $p)
{
    $r = $q * $p;
    return $r;
}


// Commandes
$sql = "SELECT * FROM orders WHERE customerNumber=?";
$query = $pdo->prepare($sql);
$query->execute(array($client_id));
$line = $query->fetch();

// Commandes
$sql2 = "SELECT * FROM customers WHERE customerNumber=?";
$query2 = $pdo->prepare($sql2);
$query2->execute(array($client_id));
$line2 = $query2->fetch();

// Commandes details
$sql3 = "SELECT * FROM orderdetails WHERE orderNumber=?";
$query3 = $pdo->prepare($sql3);
$query3->execute(array($line['orderNumber']));
$line3 = $query3->fetch();

// Commandes details
$sql4 = "SELECT * FROM products WHERE productCode=?";
$query4 = $pdo->prepare($sql4);
$query4->execute(array($line3['productCode']));
$line4 = $query4->fetch();


echo "<div class='wrapper'> ";

if ($line2 == false) {

    echo "<tr>Il n'y a aucun client attribué à ce numéro client : " . $client_id . "</tr> <br>";

} else {

    echo "<span>Client : " . $line2['contactLastName'] . " " . $line2['contactFirstName'] . "</span><br>";
    echo "<span>" . $line2['addressLine1'] . "</span><br>
<span>" . $line2['city'] . ", " . $line2['postalCode'] . "</span><br>
<span> Société : " . $line2['customerName'] . "</span><br>";
}

if ($line == false) {

    echo "<br>Le client n'a pas encore effectué de commande :(<br>";

} else {

    echo "<div class='center titre'>Commandes :</div>";

    echo "<div class='tableau'>
    <table class='standard-table'>
        <thead>
        <tr>
            <th>Commande n° :</th>
            <th>Commandé le :</th>
            <th>Produit</th>
            <th>Prix </th>
            <th>Quantité</th>
            <th>Statut</th>
        </tr>
        </thead>
        <tbody>";

    while ($line = $query->fetch()) {

        echo "<div class='product'>";
        echo "<tr>";
        echo "<td><a href='index.php?action=commande&id=" . $line['orderNumber'] . "'>" . $line['orderNumber'] . "</a></td>";
        echo "<td>" . $line['orderDate'] . "</td>";
        echo "<td>" . $line4['productName'] . "</td>";
        echo "<td>" . ($line3['priceEach'] * $line3['quantityOrdered']) . "€</td>";
        echo "<td>" . $line3['quantityOrdered'] . "</td>";
        echo "<td>" . $line['status'] . "</td>";
        echo " </tr>";
        echo "</div>";
    }
}
echo " </tbody></table></div>";

?>




