<?php
require_once(ROOT_PATH . "includes/layouts/header.php");
?>

<div id="wrapper">
    <?php
        if($view === "wishlist") {
            if(isset($_GET["addItem"]) || isset($_GET["item"])) {
                require_once("item.html.php");

            }
            else if(isset($_GET["manageGroups"])) {
                require_once("manageGroups.html.php");
            }
            else if(isset($_GET["addGroup"]) || isset($_GET["group"])) {
                require_once("group.html.php");
            }
            else {
                require_once("showWishlist.html.php");
            }
        }
        else if($view === "tools") {
            if(isset($_GET["expensesPlanner"])) {
                $expensePlanner = true;
                require_once("expensesPlanner.html.php");
            }
            else {
                require_once("showTools.html.php");
            }
        }
    ?>
</div>

<?php
if(isset($expensePlanner)) {
?>
<script type="text/javascript" src="expensePlanner.js"></script>
<?php
}


require_once(ROOT_PATH . "includes/layouts/footer.php");
?>
