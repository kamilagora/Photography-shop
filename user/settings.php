<?php

require_once "../settings.php";
require_once BASE_DIR . "/template/navbar.php";

if (!Me::IsLoggedIn()) {
    http_response_code(403);
    exit("Error: User already logged out");
}


?>

<!DOCTYPE html>
<html lang="en">


<head>

    <?php require_once BASE_DIR . "/template/header.php" ?>
</head>

<body>

    <div style="height: 100px"></div>
    <div class="container">

        <div class="mb-3 card">
            <div class="card-body">

                <div class="form-group">
                    <label for="user_id">ID:</label>
                    <input id="user_id" class="form-control" type="text" value="<?= Me::GetUser()->GetData()["id"] ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="username">Username:</label>
                    <input id="username" class="form-control" type="text" value="<?= Me::GetUser()->GetData()["username"] ?>" readonly>
                </div>

            </div>
        </div>

        <form class="card" method="post" action="/api/user/saveEmail.php">


            <div class="card-body">
                <div class="form-group">
                    <label for="Email">Email:</label>
                    <input id="Email" class="form-control" type="email" name="email" value="<?= Me::GetUser()->GetData()["email"] ?>" required>
                </div>
            </div>

            <div class="card-footer">

                <button class="btn btn-primary float-right" type="submit">Save</button>

            </div>
        </form>

        <form class="card" method="post" action="/api/user/savePassword.php">


            <div class="card-body">
                <div class="form-group">
                    <label for="current_password">Current Password:</label>
                    <input id="current_password" class="form-control" type="password" name="current_password" required>
                </div>
                <div class="form-group">
                    <label for="password">New Password:</label>
                    <input id="password" class="form-control" type="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password:</label>
                    <input id="confirm_password" class="form-control" type="password" name="confirm_password" required>
                </div>
            </div>

            <div class="card-footer">

                <button class="btn btn-primary float-right" type="submit">Save</button>

            </div>
        </form>



        <form class="card" method="post" action="/api/user/closeAccount.php">
            <div class="card-body">

                <button class="btn btn-danger" type="submit">Close my account</button>

            </div>
        </form>
    </div>

    <?php require_once BASE_DIR . "/template/footer.php" ?>
</body>

</html>