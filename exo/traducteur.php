<link rel="stylesheet" type="text/css" href="traducteur.css" media="screen"/>

<div class="content">

    <h2>Mon super traducteur : </h2>

    <form method="post">
        <label>Choisir le sens de la traduction : </label>
        <select name="lang">
            <option value="en-fr">EN to FR</option>
            <option value="fr-en">FR to EN</option>
        </select>
        <input type="text" name="mot" placeholder="Mot a traduire" required>
        <button type="submit">Traduire</button>
    </form>

    <?php
    include 'exo/process/traduction.php';
    ?>

</div>

