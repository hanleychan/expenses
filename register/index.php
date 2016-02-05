<?php
require_once("../includes/initialize.php");
require_once(ROOT_PATH . "vendor/autoload.php");

// redirect to main page if user is already logged in
if($session->isLoggedIn()) {
    header("Location: " . BASE_URL . "main/");
    exit;
}

if(isset($_POST["submit"])) {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $passwordConfirm= $_POST["passwordConfirm"];

    // Add the user to the database if no problem with all the data
    if(User::isValidRegistrationData($username, $email, $password, $passwordConfirm)) {
        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->password = password_hash($password, PASSWORD_BCRYPT);
        $user->save();

        // Create default income/expense categories
        $incomeCategories = array("Work", "Other");
        $expenseCategories = array("Food", "Home", "Clothing", "Entertainment", "Transportation", "Other");

        foreach($incomeCategories as $category) {
            $incomeType = new IncomeType();
            $incomeType->userID = $user->id;
            $incomeType->category = $category;
            $incomeType->save();
        }

        foreach($expenseCategories as $category) {
            $expenseType = new ExpenseType();
            $expenseType->userID = $user->id;
            $expenseType->category = $category;
            $expenseType->save();
        }
        
        // Create default wishlist group
        $wishlistGroup = new WishlistGroup();
        $wishlistGroup->userID = $user->id;
        $wishlistGroup->groupName = "General";
        $wishlistGroup->save();

        $session->setMessage("Registration complete.");

        header("Location: " . BASE_URL . "login/");
        exit;
    }
}

$page = "register";

require_once("register.html.php");
?>

