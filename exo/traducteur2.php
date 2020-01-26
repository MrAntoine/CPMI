
    <?php if($result == null): ?>
        <form action="exo/process/traduction2.php" method="POST">
            <ul>
                <li>
                    <label for="word">Mot :</label>
                    <input type="text" id="word" name="word">
                </li>
                <li>
                    <label for="direction">Sens de traduction :</label>
                    <select id="direction" name="direction">
                        <option value="toEnglish">Français vers Anglais</option>
                        <option value="toFrench">Anglais vers Français</option>
                    </select>
                </li>
                <li>
                    <input type="submit" value="Traduire">
                </li>
            </ul>
        </form>
    <?php else: ?>
        <p><?= $result ?></p>
    <?php endif; ?>

