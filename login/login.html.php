<?php
require_once(ROOT_PATH . "includes/layouts/header.php");
?>

<div id="wrapper">
    <section id="login">
        <h2>Login:</h2>
        <?php
            $messages = $session->getMessages();
            if(!empty($messages)) {
                foreach($messages as $message) {
                    echo "<p id=\"message\">$message</p>";
                }
            }
        ?>
        <form action="./" method="post" id="loginForm">
            <label for="username">Username:</label><br>
            <input type="text" name="username" id="username" value="" maxlength="12" required><br>
            
            <label for="password">Password:</label><br>     
            <input type="password" name="password" id="password" value="" maxlength="50" required><br>
            
            <input type="submit" id="submit" name="submit" value="Login">
        </form>

    </section>
</div>

<?php
require_once(ROOT_PATH . "includes/layouts/footer.php");
?>
