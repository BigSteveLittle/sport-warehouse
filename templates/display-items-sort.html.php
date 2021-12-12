<h2 class="highlight-heading">All Products Sorting</h2>
<table class="all-items-sort">
    <tr>
        <th> </th>
        <th><a href="products-sports-warehouse.php?sort=item.itemName">Product</a></th>
        <th><a href="products-sports-warehouse.php?sort=price">Price</a></th>
        <th><a href="products-sports-warehouse.php?sort=categoryName">Category</a></th>
    </tr>
    <?php foreach($itemRows as $row):
        $itemId = $row["itemId"];
        $itemName = $row["itemName"];
        $price = $row["price"];
        $salePrice = $row["salePrice"];
        $description = $row["description"];
        $categoryName = $row["categoryName"];
        $photo = $row["photo"];
    ?>
    <tr>
        <td><a href="product-item.php?ID=<?= $itemId ?>"><img src="images/products/<?= $photo ?>" alt="<?= $itemName ?>"></a></td>
        <td><a href="product-item.php?ID=<?= $itemId ?>"><?= $itemName ?></a></td>
        <?php if($salePrice == null || $salePrice <= 0): ?>
        <td class="product-price"><a href="product-item.php?ID=<?= $itemId ?>"><span class="product-price__price"><?= $price ?></span></a></td>
        <?php else: ?>
        <td class="on-sale"><a href="product-item.php?ID=<?= $itemId ?>"><span class="on-sale-text">On Sale</span><br><span class="on-sale__price"><?= $salePrice ?></span><br><span class="on-sale__markdown-price">$<?= $price ?></span></a></td>
        <?php endif; ?>
    
        <td><?= $categoryName ?></td>
    </tr>
    <?php endforeach; ?>
</table>