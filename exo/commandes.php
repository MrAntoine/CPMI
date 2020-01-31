<h1>Bons de commande</h1>


<?php


$sql = "SELECT orderNumber, orderDate, shippedDate, status FROM orders ORDER BY orderNumber";
$query = $pdo->prepare($sql);
$query->execute();
$line = $query->fetch();


echo "<div class='wrapper'> 
<table class='standard-table'>
    <thead>
    <tr>
        <th>Commande</th>
        <th>Date de commande</th>
        <th>Date de livraison</th>
        <th>Statut</th>
    </tr>
    </thead>
    <tbody>";

if ($line == false) {

    echo "<tr>>Il n'y a aucune commande</tr>";

} else {

    while ($line = $query->fetch()) {

        echo "<tr>";
        echo "<td><a href='index.php?action=commande&id=" . $line['orderNumber'] . "'>" . $line['orderNumber'] . "</a></td>";
        echo "<td>" . $line['orderDate'] . "</td>";
        echo "<td>" . $line['shippedDate'] . "</td>";
        echo "<td>" . $line['status'] . "</td>";
        echo " </tr>";
    }

}
echo " </tbody></table></div>";

?>



