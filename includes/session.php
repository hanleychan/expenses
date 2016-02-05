<?php

class Session {
    private $loggedIn = false;
    public $userID;
    public $messages;

    /**
     * Starts a session and loads login data and session messages
     */
    function __construct() {
        session_start();
        $this->checkLogin();
        if(isset($_SESSION["messages"])) {
            $this->messages = $_SESSION["messages"];
        }
    }

    /**
     * Returns whether the user is logged in
     */
    public function isLoggedIn() {
        return $this->loggedIn;
    }

    /**
     * Logs in a user by setting the session variable userID
     */
    public function login($user) {
        if($user) {
            $this->userID = $_SESSION["userID"] = $user->id;
            $this->loggedIn = true;
        }
    }

    /**
     * Logout a user by unsetting the session variable userID
     */
    public function logout() {
        unset($_SESSION["userID"]);
        unset($this->userID);
        $this->loggedIn = false;
    }

    /**
     * Returns whether the user is logged in by checking if the userID session variable is set
     */
    private function checkLogin() {
        if(isset($_SESSION["userID"])) {
            $this->userID = $_SESSION["userID"];
            $this->loggedIn = true;
        }
        else {
            unset($this->userID);
            $this->loggedIn = false;
        }
    }

    /**
     * Append a new session message
     */
    public function setMessage($msg="") {
        if(!empty($msg)) {
            $this->messages[] = $_SESSION["messages"][] = $msg;
        }
    }

    /**
     * Fetch all session messages
     */
    public function getMessages() {
        $messages = $this->messages;
        unset($this->messages);
        unset($_SESSION["messages"]);
        return $messages;
    }
}

$session = new Session();
?>
