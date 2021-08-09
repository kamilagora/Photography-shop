<?php

require_once "../settings.php";
require_once BASE_DIR . "/template/navbar.php";

?>

<!DOCTYPE html>
<html lang="en">


<head>

    <?php require_once BASE_DIR . "/template/header.php" ?>
</head>

<body>
    <form method="post" action="/api/auth/register.php">
        <div style="height: 100px"></div>
        <div class="container">
            <div class="form-group">
                <label for="username">Username:</label>
                <input id="username" class="form-control" type="text" maxlength="<?= USERNAME_MAX_LENGTH ?>" required name="username">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input id="email" class="form-control" type="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input id="password" class="form-control" type="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm password:</label>
                <input id="confirm_password" class="form-control" type="password" required name="confirm_password">
            </div>
            <div class="custom-control custom-checkbox mb-3">
                <input id="accept_tos" class="custom-control-input" type="checkbox" name="accept_tos" value="true" required>
                <label for="accept_tos" class="custom-control-label">I accept <a href="https://example.com" target="_blank">Terms of Service</a></label>
            </div>
            <button class=" btn btn-primary float-right" type="submit">Sign Up</button>
        </div>

    </form>

    <?php require_once BASE_DIR . "/template/footer.php" ?>
</body>

</html>