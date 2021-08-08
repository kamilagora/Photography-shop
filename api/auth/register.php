<?php

require_once "../../settings.php";
require_once BASE_DIR . "../template/navbar.php";
require_once BASE_DIR . "../template/footer.php";


$username = POST("username", true);
$email = POST("email", true);
$password = POST("password", true, false);
$confirm_password = POST("confirm_password", true, false);
$accept_tos = POST("accept_tos", true);

if ($password !== $confirm_password) {
    http_response_code(400);
    exit("Error: Password and confirm password do not match");
}

if ($accept_tos !== "true") {
    http_response_code(400);
    exit("Error: Terms of Service not accepted");
}

if (!Auth::Register($username, $email, $password, $err_message)) {
    http_response_code(400);
    exit("Error: $err_message");
}

http_response_code(302);
header("Location:/auth/login.php");
