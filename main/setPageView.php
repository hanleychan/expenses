<?php
// Determine view
if(isset($_GET["view"])) {
    if($_GET["view"] === "monthly") {
        $view = "monthly";
    }    
    else if($_GET["view"] === "yearly") {
        $view = "yearly";
    }
    else if($_GET["view"] === "allTime") {
        $view = "allTime";
    }
    else {
        $view = "daily";
    }
}
else {
    $view = "daily";
}

// Determine subview
if(isset($_GET["subView"])) {
    if($_GET["subView"] === "summary") {
        $subView = "summary";
    }
    else {
        $subView = "info";
    }
}
else {
    $subView = "info";
}

$page = "main";
?>
