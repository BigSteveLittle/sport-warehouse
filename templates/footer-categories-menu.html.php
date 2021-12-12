<nav class="footer__product-nav footer-full-menu">
    <h2>Product categories</h2>
        <ul>
<!-- Assign Values to variables. -->
<?php foreach($categoryRows as $row):
    $categoryName = $row["categoryName"];
    $categoryId = $row["categoryId"];
?>
                <!-- Get the id of the category and display the data. -->
                <li><a href="items-by-category.php?categoryId=<?= $categoryId ?>"><?= $categoryName ?></a></li>
                <!-- Close the 'foreach' loop. -->
                <?php endforeach; ?>
            </ul>
        </nav>