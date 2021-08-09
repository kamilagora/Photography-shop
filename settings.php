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

#PayPal

define("PAYPAL_CLIENT", "AasEIP7mDcyAR9EnQK6FuyWIhmyJsMCHzJsh4Lql8EWXZnHcznuLg5YaB8dORHvcngzxOGerc09xYSBO");
define("PAYPAL_SECRET", "ENJZx3GIf_zwcDrbeqIPjzDWl2FHjHiL9k0JcRnb3aObtb33Q_piYixG_3wbFzcg7gni7yOiQTuLUumG");
define("PAYPAL_MODE", "SANDBOX");

define("PAYPAL_REDIRECT_SUCCESS", "http://localhost/paypal/process.php");
define("PAYPAL_REDIRECT_CANCEL", "http://localhost");

require_once BASE_DIR . "/init.php";
