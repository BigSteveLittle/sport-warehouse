<form action="./insert-item.php" method="POST" enctype="multipart/form-data">
    <p>
        <label for="itemName">Item Name:</label>
            <input type="text" name="itemName" id="itemName" required>
    </p>
    <p>
        <label for="photo">Select image to upload:</label>
            <input type="file" name="photo" id="photo">
    </p>
    <p>
        <label for="price">Price:</label>
            <input type="text" name="price" id="price" required>
    </p>
    <p>
        <label for="salePrice">Sale Price:</label>
            <input type="text" name="salePrice" id="salePrice">
    </p>
    <p>
        <label for="description">Description:</label>
            <textarea type="text" name="description" id="description" required></textarea>
    </p>
    <p>
        <label for="featured">Featured:</label>
            <input type="number" name="featured" id="featured" required>
    </p>
    <p>
        <label for="categoryId">Category ID:</label>
            <select name="categoryId" id="categoryId" required>
                <?php foreach ($categoryRows as $row):
                $categoryId = $row["categoryId"];
                $categoryName = $row["categoryName"];
                ?>
                <option value="<?= $categoryId ?>"><?= $categoryName ?></option>
                <?php endforeach; ?>
            </select>
    </p>
    <p>
        <button type="submit" name="submit">Insert Item</button>
    </p>
    <p><?= $message ?></p>
</form>