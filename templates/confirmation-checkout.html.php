<?php if(isset($_GET["orderId"])): ?>
    <p>Thank you, your order number is <?= htmlspecialchars($_GET["orderId"]) ?></p>
<?php else: ?>
    <p>Something went wrong and the order was not placed</p>
<?php endif; ?>