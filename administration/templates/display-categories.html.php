<p><a href="./insert-category.php">Add a new category</a>.</p>
<table>
    <tr>
        <th>Category ID</th>
        <th>Category Name</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach($categoryRows as $row):
        $categoryId = $row["categoryId"];
        $categoryName = $row["categoryName"];
    ?>
    <tr>
        <td><?= $categoryId ?></td>
        <td><?= $categoryName ?></td>
        <td><a class="update" href="./update-category.php?id=<?= $categoryId ?>">Edit</a></td>
        <td><a class="delete" href="./delete-category.php?id=<?= $categoryId ?>">Delete</a></td>
    </tr>
    <?php endforeach; ?>
</table>
<p><?= $message ?></p>
<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/deleteConfirm.js"></script>