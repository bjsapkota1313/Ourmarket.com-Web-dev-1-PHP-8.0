<?php
require __DIR__ . '/../Router/Router.php';
require __DIR__ . '/../Models/Status.php';

//ini_set('display_errors', 'Off'); // turning off the displaying of errors to browser

$uri = trim($_SERVER['REQUEST_URI'], '/');

// assigning session in the entry point of app so that is available for entire app
session_set_cookie_params(1200); // 20 mins
session_start();

// whenever session is not set we make an array so that we can update in all over website
// When  user is not logged in also can store  use the shopping cart and login in later on
if (isset($_SESSION['cartItems'])) {
    $_SESSION['countShoppingCartItems'] = count($_SESSION['cartItems']);
} else {
    $_SESSION['cartItems'] = array();
    $_SESSION['countShoppingCartItems'] = 0; // making 0 whe Cart session is empty
}

$router = new Router();
$router->route($uri);
