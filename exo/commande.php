<h2>Détails de commande</h2>

<a href="index.php?action=commandes">Retourner à la liste des commandes</a>

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


echo "<div class='wrapper'> ";

echo "<span class='center titre'>Commande n° " . $numero_commande . " : </span>";

//CLIENT
echo "<div class=\"client\" style=\"text-align: right;\">
<span>" . $line3['customerName'] . "</span><br><br>
<span><a href='index.php?action=client&id=" . $line3['customerNumber'] . "'>" . $line3['contactLastName'] . " " . $line3['contactFirstName'] . "</a></span><br>
<span>" . $line3['addressLine1'] . "</span><br>
<span>" . $line3['city'] . " , " . $line3['postalCode'] . "</span><br>
</div>";

if ($line == false) {

    echo "<tr>Il n'y a aucune commande d'attribué au n° " . $numero_commande . "</tr>";

} else {

    echo "<div class='tableau'>
    <table class='standard-table'>
        <thead>
        <tr>
            <th>Commandé le :</th>
            <th>Produit</th>
            <th>Prix unitaire</th>
            <th>Quantité</th>
            <th>Prix total</th>
        </tr>
        </thead>
        <tbody>";

    while ($line = $query->fetch()) {

        echo "<div class='product'>";
        echo "<tr>";
        echo "<td>" . $line2['orderDate'] . "</td>";
        echo "<td>" . $line4['productName'] . "</td>";
        echo "<td>" . $line['priceEach'] . "€</td>";
        echo "<td>" . $line['quantityOrdered'] . "</td>";
        //echo "<td>" . $line['status'] . "</td>";
        echo "<td>" . multiple($line['priceEach'], $line['quantityOrdered']) . "€</td>";
        echo " </tr>";
        echo "</div>";


        /*

                echo "<tr><td> Statut : </td>";
                echo "<td>" . $line2['status'] . "</td></tr>";

                echo "<tr><td> Expédié le : </td>";
                echo "<td>" . $line2['shippedDate'] . "</td></tr>";

                echo "<tr><td> Numéro de commande : </td>";
                echo "<td>" . $line['orderLineNumber'] . "</td></tr>";
        */
        $price_ht = $price_ht + multiple($line['priceEach'], $line['quantityOrdered']);
    }

    // PRIX
    echo"</tbody></table> 
        <table class='standard-table prix'>";

    echo "<tr><td> Total HT: </td>";
    echo "<td>" . $price_ht . " €</td></tr>";

    echo "<tr><td> Total TVA(20%): </td>";
    echo "<td>" . multiple($price_ht, 0.2) . " €</td></tr>";

    echo "<tr><td> Total TTC: </td>";
    echo "<td>" . multiple($price_ht, 1.2) . " €</td></tr>";

}
echo "</table></div>";

?>




