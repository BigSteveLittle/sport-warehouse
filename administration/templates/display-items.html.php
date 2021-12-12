<p><a href="./insert-item.php">Add a new item</a>.</p>
<table>
    <tr>
        <th>Item ID</th>
        <th>Item Name</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach($itemRows as $row):
        $itemId = $row["itemId"];
        $itemName = $row["itemName"];
    ?>
    <tr>
        <td><?= $itemId ?></td>
        <td><?= $itemName ?></td>
        <td><a class="update" href="./update-item.php?id=<?= $itemId ?>">Edit</a></td>
        <td><a class="delete" href="./delete-item.php?id=<?= $itemId ?>">Delete</a></td>
    </tr>
    <?php endforeach; ?>
</table>
<p><?= $message ?></p>
<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/deleteConfirm.js"></script>