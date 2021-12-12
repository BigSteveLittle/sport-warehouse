<form method="post" action="choose-frame-colour.php">
    <label for="theme">Select a Frame Colour:</label>
        <select id="theme" name="theme">
            <option value="styles">Black</option>
        <?php if($theme == "cyan-process.css"): ?>
            <option value="cyan-process" selected>Cyan Process</option>
            <?php else: ?>
            <option value="cyan-process">Cyan Process</option>
            <?php endif;
            if($theme == "pumpkin.css"): ?>
            <option value="pumpkin" selected>Pumpkin</option>
            <?php else: ?>
            <option value="pumpkin">Pumpkin</option>
            <?php endif; ?>
        </select>
        <br>
        <input type="submit" value="set" name="submit">
</form>