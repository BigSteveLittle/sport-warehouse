<section class="featured">
    <h2 class="highlight-heading">Featured products</h2>
        <div class="product-wrapper">
        <?php foreach($itemRows as $row):
            $itemId = $row["itemId"];
            $itemName = $row["itemName"];
            $price = $row["price"];
            $salePrice = $row["salePrice"];
            $description = $row["description"];
            $photo = $row["photo"];
        ?>
            <a class="product product1" href="product-item.php?ID=<?= $itemId ?>">
                <article class="product<?= $itemId ?>">
                    <div class="product-image">
                        <img src="images/products/<?= $photo ?>" alt="<?= $itemName ?>">
                    </div>
                    <?php if($salePrice == null || $salePrice <= 0): ?>
                        <!--  Start: Product Pricing -->
                        <div class="product-price">
                            <p class="product-price__pricing"><span class="product-price__price">$<?= $price ?></span></p>
                        </div>
                        <!--  End: Product Pricing -->
                        <?php else: ?>
                        <!--  Start: On Sale Pricing -->
                        <div class="on-sale">
                            <p class="on-sale__pricing" ><span class="on-sale__price">$<?= $salePrice ?></span></p>
                            <p class="on-sale__markdown"><span class="on-sale__was upper-case">was</span> <span class="on-sale__markdown-price">$<?= $price ?></span></p>
                        </div>
                        <!--  End: On Sale Pricing -->
                    <?php endif; ?>
                    <h3 class="product-title"><?= $itemName ?></h3>
                </article>
            </a>
    <?php endforeach; ?>
        </div>
</section>