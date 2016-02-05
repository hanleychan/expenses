<?php
require_once("../includes/initialize.php");
require_once(ROOT_PATH . "vendor/autoload.php");

// Redirect to login page if user is not logged in
if(!$session->isLoggedIn()) {
    header("Location: " . BASE_URL . "login/");
    exit;
}

require_once("setPageView.php");

if($view === "wishlist") {
    require_once("fetchWishlistData.php");
}

if(isset($_POST["saveItem"]) || isset($_POST["deleteItem"])) {
    require_once("processItem.php");
}

if(isset($_POST["saveGroup"]) || isset($_POST["deleteGroup"])) {
    require_once("processGroup.php");
}

require_once("planner.html.php");
?>

