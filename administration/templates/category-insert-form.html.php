<form action="./insert-category.php" method="POST">
    <p>
        <label for="categoryName">Category Name:</label>
            <input type="text" name="categoryName" id="categoryName" required>
    </p>
    <p>
        <button type="submit" name="submit">Insert Category</button>
    </p>
    <p><?= $message ?></p>
</form>