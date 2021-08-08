<?php
require_once "../../settings.php";
require_once BASE_DIR . "/template/navbar.php";

if (!Me::IsLoggedIn()) {
    http_response_code(403);
    exit("Error: User not logged in");
}

$current_password = POST("current_password", true, false);
$password = POST("password", true, false);
$confirm_password = POST("confirm_password", true, false);

if ($password !== $confirm_password) {
    http_response_code(400);
    exit("Error: Password and confirm password do not match");
}

if (!Me::GetUser()->ChangePassword($current_password, $password, $err_message)) {
    http_response_code(400);
    exit("Error: {$err_message}");
}

http_response_code(302);
header("Location: /user/settings.php");
