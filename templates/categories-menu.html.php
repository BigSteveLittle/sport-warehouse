        <nav id="product-menu">
            <ul>
<!-- Assign Values to variables. -->
<?php foreach($categoryRows as $row):
    $categoryName = $row["categoryName"];
    $categoryId = $row["categoryId"];
?>
                <!-- Get the id of the category and display the data. -->
                <li><a href="items-by-category.php?categoryId=<?= $categoryId ?>?categoryName=<?= $categoryName ?>"><?= $categoryName ?></a></li>
                <!-- Close the 'foreach' loop. -->
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>
</header>
    <div class="content-wrapper">
        <main id="main-content">
            <?= $output ?>