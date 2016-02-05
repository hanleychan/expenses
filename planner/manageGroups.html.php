<section id="wishlist">
    <h1>Manage Groups:</h1>
    <p><a href="?addGroup">Add Group</a></p>
    <?php
        // If any groups exists other than the general group 
        if(count($wishlistGroups) !== 1) {
    ?>
            <ul>
            <?php
                foreach($wishlistGroups as $wishlistGroup) {
                    if($wishlistGroup->groupName !== "General") {
            ?>
                    <li><a href="?group=<?php echo htmlentities($wishlistGroup->id) ?>"><?php echo htmlentities($wishlistGroup->groupName); ?></a></li>
            <?php
                    }
                }
            ?>
            </ul>
    <?php
        }
        else {
    ?>
            <p>You have not created any groups.</p>
    <?php
        }
    ?>


    <p><a href="<?php echo BASE_URL . "planner";?>">Return to wishlist</a></p>
</section>
