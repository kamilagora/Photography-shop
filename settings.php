<?php

define('BASE_DIR', "C:/xampp/htdocs/");


//MysqliDb

define("DB_HOST", 'localhost');
define("DB_USER", 'root');
define("DB_PASS", null);
define('DB_NAME', 'mysite');

//Shop 

define("SHOP_CURRENCY", "PLN");

//Users

define('USERNAME_MAX_LENGTH', 32);

//Session

define("TOKEN_HASH_ALGO", "sha3-256");

//Auth 
define("SESSION_COOKIE_NAME", "session");
define('SESSION_EXPIRE_DAYS', 30);
define("PASS_HASH_ALG", PASSWORD_ARGON2I);

require_once BASE_DIR . "/init.php";
