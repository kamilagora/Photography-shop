<?php
require_once "../../settings.php";
require_once BASE_DIR . "/template/navbar.php";

if (!Me::IsLoggedIn()) {
    http_response_code(403);
    exit("Error: User not logged in");
}

$email = POST("email", true);


if (!Me::GetUser()->ChangeEmail($email, $err_message)) {
    http_response_code(400);
    exit("Error: {$err_message}");
}

http_response_code(302);
header("Location: /user/settings.php");
