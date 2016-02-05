<?php
require_once("../includes/initialize.php");
require_once(ROOT_PATH . "vendor/autoload.php");

// Redirect to main page if user is already logged in
if($session->isLoggedIn()) {
    header("Location: " . BASE_URL . "main/");
    exit;
}

// process login form data
if(isset($_POST["submit"])) {
    $username = trim(strtolower($_POST["username"]));
    $password = $_POST["password"];

    // authenticate, login and redirect user to main page
    if($user=User::authenticate($username, $password)) {
        $session->login($user);
        header("Location: " . BASE_URL . "main/");
        exit;
    }
    else {
        $session->setMessage("Invalid username or password.");
    }

}

$page = "login";

require_once("login.html.php");

?>

