<?php
require_once(ROOT_PATH . "includes/layouts/header.php");
?>

<div id="wrapper">
    <section id="register">
        <h2>Register:</h2>
        <?php
            $messages = $session->getMessages();
            if(!empty($messages)) {
                foreach($messages as $message) {
                    echo "<p id=\"message\">$message</p>";
                }
            }
        ?>
        <form action="./" method="post" id="registerForm">
            <label for="username">Username:</label><br>
            <input type="text" required id="username" name="username" value="<?php if(isset($username)) { echo htmlentities($username); } ?>" maxlength="12"><br>

            <label for="email">E-mail:</label><br>
            <input type="email" required id="email" name="email" value="<?php if(isset($email)) { echo htmlentities($email); } ?>"><br>

            <label for="password">Password:</label><br>
            <input type="password" required id="password" name="password" maxlength="50"><br>

            <label for="passwordConfirm">Confirm Password:</label><br>
            <input type="password" required id="passwordConfirm" name="passwordConfirm" maxlength="50"><br>

            <input type="submit" id="submit" name="submit" value="Register">
        </form>
    </section>
</div>

<?php
require_once(ROOT_PATH . "includes/layouts/footer.php");
?>

