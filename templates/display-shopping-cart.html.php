<section id="cart">
    <h2 class="highlight-heading">Your Shopping Cart</h2>
    <?php if (isset($_SESSION["cart"])):
        $cart = $_SESSION["cart"];
        $cartProducts = $cart->getProducts();
    ?>
    <div class="cart-flex-wrapper">
        <table>
            <thead>
                <tr>
                    <th colspan="4"><h3>Your Order</h3></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th></th>
                </tr>
                <?php foreach ($cartProducts as $product):
                    $itemName  = $product->getProductName();
                    $price = sprintf('%01.2f', $product->getPrice());
                    $itemId = $product->getProductId();
                    $qty = $product->getQuantity();
                ?>
                <tr>
                    <td><?= $itemName ?></td>
                    <td><?= $price ?></td>
                    <td><?= $qty ?></td>
                    <td><form action="./shopping-cart-sports-warehouse.php" method="POST">
                    <input type="submit" name="remove" value="Remove">
                    <input type="hidden" value="<?= $itemId ?>" name="itemId">
                    </form>
                    </td>
                </tr>
            </tbody>
        <?php endforeach; ?>
        </table>
        <div id="cart-summary">
            <h3>Order Summary</h3>
            <p class="total">Total: $<?= sprintf('%01.2f', $cart->calculateTotal()) ?></p>
            <form action="./checkout-sports-warehouse.php" method="POST">
                <button type="submit" name="checkout">Continue to checkout</button>
            </form>
        </div>
    </div>
    <?php endif; ?>
</section>