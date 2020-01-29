
<a href="index.php?action=interactionDB">Retourner aux modifications DB</a>

<?php

$client_id = $_GET['id'];



// EDIT
$sql2 = "INSERT INTO users WHERE customerNumber=?";
$query2 = $pdo->prepare($sql2);
$query2->execute(array($client_id));
$line2 = $query2->fetch();

// RECEPERER
$sql3 = "INSERT INTO users WHERE orderNumber=?";
$query3 = $pdo->prepare($sql3);
$query3->execute(array($line['orderNumber']));
$line3 = $query3->fetch();

// DELETE
$sql4 = "INSERT INTO users WHERE productCode=?";
$query4 = $pdo->prepare($sql4);
$query4->execute(array($line3['productCode']));
$line4 = $query4->fetch();


/*
function add($societe,$nom,$prenom,$tel,$adresse,$cp,$ville,$pays){

    // ADD
    $sql = "SELECT * FROM users VALUES (NULL,'?','?','?','?','?','?','?','?')";
    $query = $pdo ->prepare($sql);
    $query->execute(array($societe,$nom,$prenom,$tel,$adresse,$cp,$ville,$pays));
    return "ok";
}
*/

//if(isset($_POST["add"])) {
        // ADD
        $sql = "INSERT INTO customers (customerNumber,customerName,contactFirstName, contactLastName, phone, addressLine1, postalCode, city, country ) VALUES (9999,'?','?','?','?','?','?','?','?')";
        $query = $pdo ->prepare($sql);
        $query->execute(array($_POST["societe"],$_POST["nom"],$_POST["prenom"],$_POST["phone"],$_POST["adress"],$_POST["cp"],$_POST["city"],$_POST["country"]));
        return "ok";

//}



/*
if(isset($_POST["edit"])) {
    edit();
}


if(isset($_POST["delete"])) {
    delete();
}


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




