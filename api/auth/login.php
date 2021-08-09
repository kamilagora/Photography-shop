<?php

require_once "../../settings.php";

$usernameOrEmail = POST("usernameOrEmail", true);
$password = POST("password", true, false);

if (!Auth::Login($usernameOrEmail, $password, $err_message)) {
    http_response_code(400);
    exit("Error: $err_message");
}

http_response_code(302);
header("Location: /store.php");
