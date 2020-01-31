<?php

$numero_commande = $_GET['id'];
$price_ht = 0;

function multiple($q, $p)
{
    $r = $q * $p;
    return $r;
}


$sql6 = "SELECT * FROM orders INNER JOIN customers ON customers.customerNumber = orders.customerNumber ORDER BY orderNumber";
$query6 = $pdo->prepare($sql6);
$query6->execute();
$line6 = $query6->fetch();

//var_dump($line6);


// DETAILS COMMANDES
$sql = "SELECT * FROM orderdetails WHERE orderNumber=?";
$query = $pdo->prepare($sql);
$query->execute(array($numero_commande));
$line = $query->fetch();

// COMMANDES
$sql2 = "SELECT * FROM orders WHERE orderNumber=?";
$query2 = $pdo->prepare($sql2);
$query2->execute(array($numero_commande));
$line2 = $query2->fetch();

// CLIENT
$sql3 = "SELECT * FROM customers WHERE customerNumber=?";
$query3 = $pdo->prepare($sql3);
$query3->execute(array($line2['customerNumber']));
$line3 = $query3->fetch();

// PRODUITS
$sql4 = "SELECT * FROM products WHERE productCode=?";
$query4 = $pdo->prepare($sql4);
$query4->execute(array($line['productCode']));
$line4 = $query4->fetch();


echo "<div class='wrapper'> 


<h1>Détails de commande</h1>

<a href='index.php?action=commandes'>Retourner à l'accueil</a>";




//CLIENT
echo "<div class=\"client\" style=\"text-align: right;\">
<div class='titre'>" . $line3['customerName'] . "</div><br>
<div><a href='index.php?action=client&id=" . $line3['customerNumber'] . "'>" . $line3['contactFirstName'] . " " . $line3['contactLastName'] . "</a></div><br>
<div>" . $line3['addressLine1'] . "</div><br>
<div>" . $line3['city'] . " , " . $line3['postalCode'] . "</div><br>
</div>";

echo"<hr>";

echo "<br><div class='center titre'>Commande n° " . $numero_commande . " : </div><br>";

if ($line == false) {

    echo "<tr>Il n'y a aucune commande d'attribué au n° " . $numero_commande . "</tr>";

} else {

    echo "<div class='tableau'>
    <table class='standard-table'>
        <thead>
        <tr>
            <th>Commandé le</th>
            <th>Produit</th>
            <th>Prix unitaire</th>
            <th>Quantité</th>
            <th>Prix total</th>
        </tr>
        </thead>
        <tbody>";

    while ($line = $query->fetch()) {

        echo "<tr>";
        echo "<td>" . $line2['orderDate'] . "</td>";
        echo "<td>" . $line4['productName'] . "</td>";
        echo "<td>" . $line['priceEach'] . "€</td>";
        echo "<td>" . $line['quantityOrdered'] . "</td>";
        //echo "<td>" . $line['status'] . "</td>";
        echo "<td>" . multiple($line['priceEach'], $line['quantityOrdered']) . "€</td>";
        echo " </tr>";
        $price_ht = $price_ht + multiple($line['priceEach'], $line['quantityOrdered']);
    }
    // PRIX
    echo "</tbody><table class='standard-table'>
        <tfoot>";

    echo "<tr><th> Total HT: </th>";
    echo "<th>" . number_format($price_ht, 2) . " €</th></tr>";

    echo "<tr><th> Total TVA(20%): </th>";
    echo "<th>" . number_format(multiple($price_ht, 0.2), 2) . " €</th></tr>";

    echo "<tr><th> Total TTC: </th>";
    echo "<th>" . number_format(multiple($price_ht, 1.2), 2) . " €</th></tr>";

}
echo "</tfoot></table></div></table>";

?>




