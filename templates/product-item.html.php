        <?php 
            $itemId = $itemRow["itemId"];
            $itemCategoryId = $itemRow["categoryId"];
            // $categoryName = $_GET["categoryName"];
            $itemName = $itemRow["itemName"];
            $price = $itemRow["price"];
            $salePrice = $itemRow["salePrice"];
            $description = $itemRow["description"];
            $photo = $itemRow["photo"];
        ?>
        <div class="content-wrapper">
            <article class="product-item product<?= $itemId ?>">
                <div class="product-image">
                    <img src="images/products/<?= $photo ?>" alt="<?= $itemName ?>">
                </div>
                <h2 class="product-title"><?= $itemName ?></h2>
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
                    <h3>Description</h3>
                        <p><?= $description ?></p>
                        <p>
                            <form action="product-item.php" method="POST">
                                <p><label for="qty<?= $itemId ?>">Quantity:</label>
                                <input class="qty" type="number" id="qty<?=$itemId?>" name="qty" value="1">
                                </p>
                                <p><input class="buy" type="submit" name="buy" value="Add to cart"></p>
                                <input type="hidden" value="<?=$itemId?>" name="itemId">
                            </form>
                        </p>
            </article>
        </div>