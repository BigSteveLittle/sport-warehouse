<section>
	<!-- Begin PHP code block.  -->
		<?php if($missingFields): ?>
			<p class="error"><span class="required">&#9758;</span> Please supply the missing information and a valid email.</p>
		<?php endif; ?>
	<!-- End PHP code block.  -->
<h2 class="highlight-heading">Checkout</h2>
	<form id="checkout" action="./checkout-sports-warehouse.php" method="POST">
		<fieldset>
			<legend>NOTE: fields with a <span class="required">&#9758;</span> are</legend>
				<p>
					<label for="ch-firstName" <?= validateField("ch-firstName", $missingFields) ?>><span class="required">&#9758;</span> Your first name: </label>
						<input type="text" name="ch-firstName" id="ch-firstName" placeholder="Engelbert" value="<?= setValue("ch-firstName") ?>" required>
				</p>
				<p>
					<label for="ch-lastName" <?= validateField("ch-lastName", $missingFields) ?>><span class="required">&#9758;</span> Your last name: </label>
						<input type="text" name="ch-lastName" id="ch-lastName" placeholder="Humperdink" value="<?= setValue("ch-lastName") ?>" required>
				</p>
				<p>
					<label for="ch-address" <?= validateField("ch-address", $missingFields) ?>><span class="required">&#9758;</span> Your Address:</label>
						<input type="text" id="ch-address" name="ch-address" placeholder="101 Rodeo Drive, MEADOWBANK NSW 2114" value="<?= setValue("ch-address") ?>" required>
				</p>
				<p>
					<label for="ch-phone" <?= validateField("ch-phone", $missingFields) ?>>Phone:</label>
						<input type="text" id="ch-phone" name="ch-phone" placeholder="0402 536 853 / 02 1234 4321" value="<?= setValue("ch-phone") ?>">
				</p>
				<p>
					<label for="ch-email" <?= validateField("ch-email", $missingFields) ?>><span class="required">&#9758;</span> Email:</label>
						<input type="text" id="ch-email" name="ch-email" placeholder="mynextalbumis@gmail.com" value="<?= setValue("ch-email") ?>" required>
				</p>
		</fieldset>
		<fieldset>
			<legend>Payment</legend>
				<p>
					<label for="ch-creditcard" <?= validateField("ch-creditcard", $missingFields) ?>><span class="required">&#9758;</span> Credit card number:</label>
						<input type="text" id="ch-creditcard" name="ch-creditcard" placeholder="6666999966669999" value="<?= setValue("ch-creditcard") ?>" required>
				</p>
				<p>
					<label for="ch-card-name" <?= validateField("ch-card-name", $missingFields) ?>><span class="required">&#9758;</span> Name on card:</label>
						<input type="text" id="ch-card-name" name="ch-card-name" placeholder="Engelbert Humperdink" value="<?= setValue("ch-card-name") ?>" required>
				</p>
				<p>
					<label for="ch-expiry" <?= validateField("ch-expiry", $missingFields) ?>><span class="required">&#9758;</span> Expiry date:</label>
						<input type="text" id="ch-expiry" name="ch-expiry" placeholder="01/24" value="<?= setValue("ch-expiry") ?>" required>
				</p>
				<p>
					<label for="ch-csv" <?= validateField("ch-csv", $missingFields) ?>><span class="required">&#9758;</span> CSV:</label>
						<input type="text" id="ch-csv" name="ch-csv" placeholder="123" value="<?= setValue("ch-csv") ?>" required>
				</p>
				<p><button type="submit" name="ch-pay">Confirm payment</button></p>
		</fieldset>
	</form>
</section>