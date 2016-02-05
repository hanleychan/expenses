<?php
require_once("../includes/initialize.php");
require_once(ROOT_PATH . "vendor/autoload.php");

// Redirect to login page if user is not logged in
if(!$session->isLoggedIn()) {
    header("Location: " . BASE_URL . "login/");
    exit;
}

require_once("setPageView.php");
require_once("setDates.php");
require_once("fetchIncomeExpenseData.php");

// Process input/expenses form input data
if($view === "daily" && $subView === "info" && isset($_POST["save"])) {
    require_once("processInput.php");
}

require_once("main.html.php");
?>

