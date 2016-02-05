<section id="wishlist">
    <?php
        if(isset($wishlistGroup) || isset($invalidGroup)) {
    ?>
            <h1>Edit Group: <?php if(isset($wishlistGroup)) echo htmlentities($wishlistGroup->groupName); ?></h1>
            <?php 
                if(isset($wishlistGroup)) {
            ?>
                    <h3>Rename Group:</h3>
            <?php
                }
            ?>
    <?php
        }
        else {
    ?>
            <h1>Add Group:</h1>
    <?php
        }
        if(isset($invalidGroup) && $invalidGroup === true) {
            echo "<p>Error: Invalid Group</p>";
        }
        else {
    ?>
            <?php
                $messages = $session->getMessages();
                if(!empty($messages)) {
                    foreach($messages as $message) {
                        echo "<p id=\"message\">$message</p>";
                    }
                }
            ?>
            
            <form action="" method="post">
                <?php
                    if(isset($groupError) && isset($_POST["groupName"])) {
                        $groupNameValue = htmlentities($_POST["groupName"]);
                    }
                    else if(isset($wishlistGroup) && isset($_GET["group"])) {
                        $groupNameValue = htmlentities($wishlistGroup->groupName);
                    }
                    else {
                        $groupNameValue = "";
                    }
                ?>
                <label for="groupName" id="groupNameLabel">Group Name:</label>
                <input type="text" id="groupName" name="groupName" value="<?php echo $groupNameValue; ?>" maxlength="<?php echo WishlistGroup::MAX_GROUP_LENGTH; ?>"<?php if(isset($groupError)) echo ' class="groupError"'; ?>><br>
                <input type="submit" id="saveGroup" name="saveGroup" value="Save">
            </form>

            <?php
                if(isset($wishlistGroup)) {
            ?>
                <h3>Delete Group:</h3>
                <p>Note: A group can only be deleted if there are no items assigned to it.</p>
                <form action="" method="post">
                    <input type="submit" id="deleteGroup" name="deleteGroup" value="Delete">
                </form>
            <?php
                }
            ?>
        <?php
            }
        ?> 
    <p><a href="<?php echo BASE_URL . "planner/?manageGroups" ?>">Return to manage groups</a></p>
</section>
