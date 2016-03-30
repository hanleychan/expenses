<!DOCTYPE html>
<html>
    <head>
        <title>Expenses Manager</title>
        <meta charset="utf-8">
        <link rel="icon" href="<?php echo BASE_URL . "images/favicon.ico" ?>">
        <link rel="stylesheet" href="<?php echo BASE_URL . "stylesheets/normalize.css" ?>">
        <link rel="stylesheet" href="<?php echo BASE_URL . "stylesheets/main.css" ?>">
        <link rel="stylesheet" href="<?php echo BASE_URL . "stylesheets/responsive.css" ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    </head>
    <body>
        <header>
            <h1>Expenses Manager</h1>
            <nav id="topNavigation">
                <ul id="mainNavigation">
                    <?php
                        if($page === "main" || $page === "planner" || $page === "settings") {
                    ?>
                        <li<?php if($page === "main") echo ' id="selectedPage"';  ?>><a href="<?php echo BASE_URL; ?>">Main</a></li>
                        <li<?php if($page ==="planner") echo ' id="selectedPage"' ?>><a href="<?php echo BASE_URL . "planner/"?>">Planner</a></li>
                        <li<?php if($page ==="settings") echo ' id="selectedPage"' ?>><a href="<?php echo BASE_URL . "settings/" ?>">Settings</a></li>
                        <li><a href="<?php echo BASE_URL . "logout/" ?>">Logout</a></li>
                    <?php
                        }
                        else if($page === "login" || $page === "register") {
                    ?>
                        <li><a href="<?php echo BASE_URL . "login/"; ?>">Login</a></li>
                        <li><a href="<?php echo BASE_URL . "register/"; ?>">Register</a></li>
                    <?php
                        }
                    ?>
                </ul>                 
                <?php
                    if($page !== "login" && $page !== "register") {
                ?>
                <ul id="subNavigation">
                    <?php 
                        if($page === "main") { 
                    ?>
                        <li<?php if($view === "daily") echo ' id="selectedSubPage"'; ?>><a href="<?php echo BASE_URL . "main/?view=daily"; ?>">Daily</a></li>
                        <li<?php if($view === "monthly") echo ' id="selectedSubPage"'; ?>><a href="<?php echo BASE_URL . "main/?view=monthly"; ?>">Monthly</a></li>
                        <li<?php if($view === "yearly") echo ' id="selectedSubPage"'; ?>><a href="<?php echo BASE_URL . "main/?view=yearly"; ?>">Yearly</a></li>
                        <li<?php if($view === "allTime") echo ' id="selectedSubPage"'; ?>><a href="<?php echo BASE_URL . "main/?view=allTime"; ?>">All</a></li>
                    <?php
                        }
                        else if($page === "planner") {
                    ?>
                        <li<?php if($view === "wishlist") echo ' id="selectedSubPage"'; ?>><a href="<?php echo BASE_URL . "planner/?view=wishlist"; ?>">Wishlist</a></li>
                        <li<?php if($view === "tools") echo ' id="selectedSubPage"'; ?>><a href="<?php echo BASE_URL . "planner/?view=tools"; ?>">Tools</a></li>
                    <?php
                        }
                        else if($page === "settings") {
                    ?>
                        <li<?php if($view === "changePassword") echo ' id="selectedSubPage"'; ?>><a href="<?php echo BASE_URL . "settings/?view=changePassword"; ?>">Password</a></li>
                    <?php
                        }
                    ?>
                </ul>
                <?php
                    }
                ?>
            </nav>
        </header>
