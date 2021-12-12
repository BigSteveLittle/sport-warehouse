<form action="./change-password.php" method="post">
    <fieldset>
        <legend>Create User</legend>
            <p>
                <label for="password1">New Password:</label>
                    <input type="password" id="password1" name="password1" required>
            </p>
            <p>
                <label for="password2">Repeat New Password:</label>
                    <input type="password" id="password2" name="password2" required>
            </p>
            <p>
                <input type="submit" value="Add new password">
            </p>
    </fieldset>
</form>
<p><?= $message ?></p>