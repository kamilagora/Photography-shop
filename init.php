<?php

use Curl\Url;

require_once BASE_DIR . "/lib/Curl.php";
require_once BASE_DIR . "/lib/MysqliDb.php";
require_once BASE_DIR . "/include/auth.php";
require_once BASE_DIR . "/include/session.php";
require_once BASE_DIR . "/include/user.php";
require_once BASE_DIR . "/include/me.php";
require_once BASE_DIR . "/include/product.php";
require_once BASE_DIR . "/include/store.php";
require_once BASE_DIR . "/include/cart.php";

$database = new MysqliDb(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (Auth::LoginCookie($user_id)) {

    Me::SetUser(new User($user_id));
}

function GET(string $key, bool $required = false, bool $secure = true)
{

    if (!isset($_GET[$key])) {
        if ($required) {
            http_response_code(400);
            exit("GET parameter $key is required");
        } else {
            return null;
        }
    }

    $return_val = $_GET[$key];
    if ($secure) {
        $return_val = htmlentities($return_val);
    }

    return $return_val;
}

function POST(string $key, bool $required = false, bool $secure = true)
{
    if (!isset($_POST[$key])) {
        if ($required) {
            http_response_code(400);
        } else {
            return null;
        }
    }

    $return_val = $_POST[$key];
    if ($secure) {
        $return_val = htmlentities($return_val);
    }
    return $return_val;
}
