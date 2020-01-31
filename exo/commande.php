<?php

$numero_commande = $_GET['id'];
$price_ht = 0;

function multiple($q, $p)
{
    $r = $q * $p;
    return $r;
}

$sql6 = "SELECT
            productName,
            priceEach,
            quantityOrdered

         FROM orderdetails  
         INNER JOIN products ON orderdetails.productCode = products.productCode
         WHERE orderNumber= ? 
         ORDER BY productName asc";
$query6 = $pdo->prepare($sql6);
$query6->execute(array($numero_commande));
$produits = $query6->fetchAll();

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


echo "<div class='wrapper'> 


<h1>Détails de commande</h1>

<a href='index.php?action=commandes'>Retourner à l'accueil</a><br>";


//CLIENT
if ($line3 == false) {
    echo "<tr>Il n'y a aucun client attribué à ce numéro de commande </tr>";
} else {
    echo "<div class=\"client\" style=\"text-align: right;\">
<div class='titre'>" . $line3['customerName'] . "</div><br>
<div><a href='index.php?action=client&id=" . $line3['customerNumber'] . "'>" . $line3['contactFirstName'] . " " . $line3['contactLastName'] . "</a></div><br>
<div>" . $line3['addressLine1'] . "</div><br>
<div>" . $line3['city'] . " , " . $line3['postalCode'] . "</div><br>
</div>";
}
echo "<hr>";

echo "<br><div class='center titre'>Commande n° " . $numero_commande . " : </div><br>";

if ($produits == false) {

    echo "<tr>Il n'y a aucune commande d'attribué au n° " . $numero_commande . "</tr>";

} else {

    echo "<div class='tableau'>
    <table class='standard-table'>
        <thead>
        <tr>
            <th>Produit</th>
            <th class='money-column'>Prix unitaire</th>
            <th>Quantité</th>
            <th class='money-column'>Prix total</th>
        </tr>
        </thead>
        <tbody>";

    foreach ($produits as $data) {

        echo "<tr>";
        echo "<td>" . $data['productName'] . "</td>";
        echo "<td class='money-column'>" . $data['priceEach'] . "€</td>";
        echo "<td>" . $data['quantityOrdered'] . "</td>";
        //echo "<td>" . $line['status'] . "</td>";
        echo "<td class='money-column'>" . multiple($data['priceEach'], $data['quantityOrdered']) . "€</td>";
        echo " </tr>";
        $price_ht = $price_ht + multiple($data['priceEach'], $data['quantityOrdered']);
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




