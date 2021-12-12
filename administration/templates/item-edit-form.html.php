<?php
    if(count($rows) > 0):
        $row = $rows[0];

        // Set the generic image file.
        $photo = "../images/products/sportsPlaceholder.png";
        //check if the image file exists
        if (file_exists("../images/products/".$row["photo"]) && strlen($row["photo"]) > 0) {
            $photo = "../images/products/" .$row["photo"];
        }
?>
<form action="./update-item.php" method="post" enctype="multipart/form-data">
    <h2><?= $row["itemName"] ?></h2>
    <fieldset>
        <p>
            <label for="itemName">Item Name:</label>
                <input type="text" name="itemName" id="itemName" required value="<?= $row["itemName"] ?>">
        </p>
        <p>
            <label for="photo">Photo:</label>
            <input type="file" name="photo" id="photo" value="<?= $row["photo"] ?>">
        </p>
        <p>
            <label for="price">Price:</label>
            <input type="text" name="price" id="price" required value="<?= $row["price"] ?>">
        </p>
        <p>
            <label for="salePrice">Sale Price:</label>
            <input type="text" name="salePrice" id="salePrice" value="<?= $row["salePrice"] ?>">
        </p>
        <p>
            <label for="description">Description:</label>
            <input type="text" name="description" id="description" required value="<?= $row["description"] ?>">
        </p>
        <p>
            <label for="featured">Featured:</label>
            <input type="text" name="featured" id="featured" required value="<?= $row["featured"] ?>">
        </p>
        <p>
        <label for="categoryId">Category ID:</label>
            <select name="categoryId" id="categoryId" required>
                <?php foreach ($categoryRows as $categoryRow):
                $categoryId = $categoryRow["categoryId"];
                $categoryName = $categoryRow["categoryName"];
                ?>
                <option value="<?= $categoryId ?>"><?= $categoryName ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <input type="hidden" value="<?= $row["itemId"] ?>" name="itemId">
        <input type="hidden" value="<?= $row["photo"] ?>" name="originalPhoto">
        <p>
            <input type="submit" name="submit" value="Update item">
        </p>
        <img class="photo" src="<?= $photo ?>" alt="<?= $row["itemName"] ?>">
        <p><?= $message ?></p>
    </fieldset>
</form>
<?php else:
?>
    <p>Choose Edit or Delete.</p>
<?php endif; ?>