<?php
    if(count($rows) > 0):
        $row = $rows[0];
?>
<form action="./update-category.php" method="post">
    <legend><?= $row["categoryName"] ?></legend>
    <fieldset>
        <p>
            <label for="categoryName">Category Name:</label>
                <input type="text" name="categoryName" id="categoryName" required value="<?= $row["categoryName"] ?>">
        </p>
            <input type="hidden" value="<?= $row["categoryId"] ?> " name="categoryId">
        <p>
            <input type="submit" name="submit" value="Update category">
        </p>
        <p><?= $message ?></p>
    </fieldset>
</form>
<?php else:
?>
    <p>Choose Edit or Delete.</p>
<?php endif; ?>