<section id="changePassword">
    <h2>Change Password</h2>
    <?php
        $messages = $session->getMessages();
        if(!empty($messages)) {
            foreach($messages as $message) {
                echo "<p id=\"message\">$message</p>";
            }
        }
    ?>
    <form action="./" method="post" id="changePasswordForm">
        <label for="currentPassword">Current Password: </label><br>
        <input type="password" id="currentPassword" name="currentPassword" maxlength="50" required><br>
        
        <label for="newPassword">New Password: </label><br>
        <input type="password" id="newPassword" name="newPassword" maxlength="50" required><br>

        <label for="newPassword2">Confirm Password: </label><br>
        <input type="password" id="newPassword2" name="newPassword2" maxlength="50" required><br>

        <input type="submit" id="updatePassword" name="updatePassword" value="Update">

    </form>
</section>
