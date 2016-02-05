<?php
require_once("includes/initialize.php");
require_once(ROOT_PATH . "vendor/autoload.php");

if($session->isLoggedIn()) {
    header("Location: " . BASE_URL . "main/");
    exit;
}
else {
    header("Location: " . BASE_URL . "login/");
    exit;
}

?>

    <a href="<?php echo BASE_URL ?>register">+ Register</a>
