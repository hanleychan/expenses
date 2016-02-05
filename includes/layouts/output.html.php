<?php
require_once(dirname(__DIR__) . "/initialize.php");
require_once("header.php");
?>

<div id="wrapper">
    <section id="output">
        <?php 
            if(isset($invalidDate) && $invalidDate === true) { 
        ?>
            <h1>Error:</h1>
            <p>An invalid date was specified.</p>
        <?php
            }
            else {
        ?>
            <h1>Error:</h1>
            <p>An error has occurred.</p>
        <?php
            }
        ?>
        <p><a href="<?php echo BASE_URL ?>">Return to main page.</a></p>
    </section>
</div>

<?php
require_once("footer.php");
?>


