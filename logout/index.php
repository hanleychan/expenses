<?php
require_once("../includes/initialize.php");
require_once(ROOT_PATH . "vendor/autoload.php");

// Redirect to login page if user is not logged in
if(!$session->isLoggedIn()) {
    header("Location: " . BASE_URL . "login/");
    exit;
}

// logout user and redirect to login page
$session->logout();
$session->setMessage("Logout success");
header("Location: " . BASE_URL . "login/");
exit;

?>
