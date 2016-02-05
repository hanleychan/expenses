<?php
require_once("../includes/initialize.php");
require_once(ROOT_PATH . "vendor/autoload.php");

$page = "settings";
$view = "changePassword";

if(isset($_POST["updatePassword"])) {
    require_once("updatePassword.php");
}

require_once("settings.html.php");
?>

