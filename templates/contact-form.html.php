        
        <section>
            <h2 class="highlight-heading">Contact Sports Warehouse</h2>
                <section class="form-intro">
                <p>If you have any questions, we would love to hear from you. </p>
                <h3>Contact Sports Warehouse</h3>
                <p><span class="bold">Phone:</span> <a href="tel:=61222223333">+61 2 2222 3333</a> <br>
                    <span class="bold">Email:</span> <a href="mailto:support@sportswarehouse.bigstevelittle.com">support@sportswarehouse.bigstevelittle.com</a> </p>
                    <p>
                    <span class="bold">Address:</span> <br>
                    123 Soccer Street <br>
                    SYDNEY NSW 2000 </p>
                <!-- Begin PHP code block.  -->
                    <?php if($missingFields): ?>
                        <p class="error"><span class="required">&#9758;</span> Please supply the missing information and a valid email.</p>
                    <?php endif; ?>
                <!-- End PHP code block.  -->
                <h4>Contact Form</h4>
                </section>
                <form id="contact-form" action="contact-sports-warehouse.php" method="POST">
                    <fieldset>
                        <legend>NOTE: fields with a <span class="required">&#9758;</span> are required</legend>
                            <p>
                                <label for="cf-firstName" <?= validateField("cf-firstName", $missingFields) ?>><span class="required">&#9758;</span> Your first name: </label>
                                    <input type="text" name="cf-firstName" id="cf-firstName" placeholder="First name" value="<?= setValue("cf-firstName") ?>" required>
                            </p>
                            <p>
                                <label for="cf-lastName" <?= validateField("cf-lastName", $missingFields) ?>><span class="required">&#9758;</span> Your last name: </label>
                                    <input type="text" name="cf-lastName" id="cf-lastName" placeholder="Last name" value="<?= setValue("cf-lastName") ?>" required>
                            </p>
                            <p>
                                <label for="cf-phone">Your contact number: </label>
                                    <input type="tel" name="cf-phone" id="cf-phone" placeholder="0402 536 853" value="<?= setValue("cf-phone") ?>">
                            </p>
                            <p>
                                <label for="cf-email" <?= validateField("cf-email", $missingFields) ?>><span class="required">&#9758;</span> Your email: </label>
                                    <input type="email" name="cf-email" id="cf-email" placeholder="name@gmail.com" value="<?= setValue("cf-email") ?>" required>
                            </p>
                            <p>
                                <label for="cf-question"><span class="required">&#9758;</span> Your questions: </label>
                                <span class="error-message"></span>
                                    <textarea name="cf-question" id="cf-question" placeholder="What brand of toilet paper do you use?" rows="4" cols="50" required minlength="10"> <?= setValue("cf-question") ?></textarea>
                            </p>
                    </fieldset>
                        <p>
                            <button type="submit" name="cf-submitButton" id="cf-submitButton" value="Send Details">Submit</button>
                            <button type="reset" name="cf-resetButton" id="cf-resetButton" value="Reset Form">Reset</button>
                        </p>
                </form>
        </section>