<?php
require_once(ROOT_PATH . "includes/layouts/header.php");
?>

<div id="wrapper">
    <?php
        if($view === "changePassword") {
            require_once("changePassword.html.php");
        }
    ?>
</div>

<?php
require_once(ROOT_PATH . "includes/layouts/footer.php");
?>
