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
    <div style="height: 100px"></div>
    <div class="container">
        <form method="post" action="/api/auth/login.php">

            <div class="form-group">
                <label for="usernameOrEmail">Username or email:</label>
                <input id="usernameOrEmail" class="form-control" type="text" required name="usernameOrEmail">
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input id="password" class="form-control" type="password" name="password" required>
            </div>

            <button class=" btn btn-primary float-right" type="submit">Log In</button>
    </div>

    </form>

    <?php require_once BASE_DIR . "/template/footer.php" ?>
</body>

</html>