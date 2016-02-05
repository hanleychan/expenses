<?php

define("MIN_USERNAME_LENGTH", 6);
define("MAX_USERNAME_LENGTH", 12);
define("MIN_PASSWORD_LENGTH", 6);
define("MAX_PASSWORD_LENGTH", 50);

class User extends DatabaseObject {
    public $id;
    public $username;
    public $email;
    public $password;
    protected static $table_name = "users";
    protected static $db_fields=array('id', 'username', 'email', 'password');

    /**
     * Returns whether the password and confirmation password are valid
     */
    public static function isValidPassword($password="", $passwordConfirm="") {
        global $session;

        // Check if the password and confirmation passwords are the same
        if($password !== $passwordConfirm) {
            $session->setMessage("Passwords must match.");
            $error = true;
        }

        
        // Check if the password is between the required number of characters
        if(strlen($password) < MIN_PASSWORD_LENGTH || strlen($password) > MAX_PASSWORD_LENGTH) {
            $session->setMessage("Passwords must be between " . MIN_PASSWORD_LENGTH . " - " . MAX_PASSWORD_LENGTH . " characters long.");
            $error = true;
        }

        if(isset($error) && $error === true) {
            return false;
        }
        else {
            return true;
        }
    }

    /**
     * Checks whether user registration data is all valid
     */  
    public static function isValidRegistrationData($username="", $email="", $password="", $passwordConfirm="") {
        global $session;

        // lowercase and strip white space from the user inputted username and email
        $username = strtolower(trim($username));
        $email = strtolower(trim($email));
        $error = false;

        // Check if all of the required fields are filled in 
        if(empty($username) || empty($email) || empty($password) || empty ($passwordConfirm)) {
            $session->setMessage("All fields must be filled in.");
            $error = true;
        }

        // Check if the username already exists
        if(self::fieldValueExists("username", $username)) {
            $session->setMessage("The chosen username already exists.");
            $error = true;
        }

        // Check if the username only contains letters, numbers and underscores and is
        // between 6 and 12 characters
        if(!preg_match("/^[a-zA-Z0-9_]{" . MIN_USERNAME_LENGTH . "," . MAX_USERNAME_LENGTH . "}$/",$username)) {
            $session->setMessage("Usernames must contain only letters, numbers, and underscores and be between " . MIN_USERNAME_LENGTH . " - " . MAX_USERNAME_LENGTH . " characters long");
            $error = true;
        }

        if(!self::isValidPassword($password, $passwordConfirm)) {
            $error = true;
        }    

        // Check if the email already exists
        if(self::fieldValueExists("email", $email)) {
            $session->setMessage("The chosen email address already exists.");
            $error = true;
        }

        // Error: email not valid
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $session->setMessage("The chosen email address has an invalid format.");
            $error = true;
        }

        return $error ? false : true;
    }

    /**
     * Authenticates and fetches the user data is the username and password are correct
     */
    public static function authenticate($username, $password) {
        global $session;
        
        $sql = "SELECT * FROM users WHERE username = ? LIMIT 1"; 
        $user = self::findBySQL($sql, array($username));
        
        if(!empty($user)) {
            if(password_verify($password, $user[0]->password)) {
                return $user[0];
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }
}

?>
