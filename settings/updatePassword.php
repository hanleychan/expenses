<?php
$currentPassword = $_POST["currentPassword"];
$newPassword = $_POST["newPassword"];
$newPassword2 = $_POST["newPassword2"];

$user = User::findById($session->userID);
$username = $user->username;

if(User::authenticate($username, $currentPassword)) {
    $validPassword = User::isValidPassword($newPassword, $newPassword2);
    if($validPassword) {
        $user->password = password_hash($newPassword, PASSWORD_BCRYPT);
        $user->save();
        $session->setMessage("Password has been changed");
    }
}
else {
    $session->setMessage("Current password is incorrect.");
}

?>
