<?php
    if(count($rows) > 0):
        $row = $rows[0];
?>
    <form action="./update-item.php" method="POST">
        <fieldset>
            <p>
                <label for="itemName">Item Name:</label>
                    <input type="text" name="itemName" id="itemName" required value="<?= $row["itemName"] ?>">
            </p>
                <input type="hidden" value="<? $row["itemId"] ?> " name="itemId">
                    <p><input type="submit" name="submit" value="Update item"></p>
            
        </fieldset>
    </form>
<?php else:
?>
    <p>Choose Edit or Delete.</p>
<?php endif; ?>
