<?php
function generateGroupOptions($itemGroupID) {
    global $wishlistGroups;
    
    $output = "";
    foreach($wishlistGroups as $wishlistGroup) {
        if($wishlistGroup->groupName !== "General") {
            $output .= '<option value="' . htmlentities($wishlistGroup->id) . '"';
            
            if($itemGroupID === $wishlistGroup->id) {
                $output .= ' selected';
            }
             
            $output .= '>' . htmlentities($wishlistGroup->groupName) . '</option>';
        }
        else {
            $tempOutput = '<option value=' . htmlentities($wishlistGroup->id) . '"';
            if($itemGroupID === $wishlistGroup->id || $itemGroupID === "") {
                $tempOutput .= ' selected';
            }
            $tempOutput .= '>' . htmlentities($wishlistGroup->groupName) . '</option>';
            $output = $tempOutput . $output;
        }
    }
    return $output;
}
?>
<section id="wishlist">
    <?php
        if(isset($wishlistItem) || isset($invalidItem)) {
    ?>
        <h1>Edit Item:</h1>
    <?php
            
        }
        else {
    ?>
        <h1>Add Item:</h1>
    <?php
        }
        if(isset($invalidItem) && $invalidItem === true) {
            echo "<p>Error: Invalid Item</p>";
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
                    if(isset($itemError) && isset($_POST["item"])) {
                        $itemNameValue = htmlentities($_POST["item"]);
                    }
                    else if(isset($wishlistItem) && isset($_GET["item"])) {
                        $itemNameValue = htmlentities($wishlistItem->item);
                    }
                    else {
                        $itemNameValue="";
                    }

                    if(isset($itemError) && isset($_POST["price"])) {
                        $itemPriceValue = htmlentities($_POST["price"]);
                    }
                    else if(isset($wishlistItem) && isset($_GET["item"])) {
                        $itemPriceValue = htmlentities(WishlistItem::formatDisplayAmount($wishlistItem->price));
                    }
                    else {
                        $itemPriceValue = "";
                    }
                    
                    if(isset($itemError) && isset($_POST["itemGroup"])) {
                        $itemGroupValue = htmlentities($_POST["itemGroup"]);
                    }
                    else if(isset($wishlistItem) && isset($_GET["item"])) {
                        $itemGroupValue = htmlentities($wishlistItem->groupID);
                    }
                    else {
                        $itemGroupValue = "";
                    }
                ?>

                <label for="item" id="itemLabel">Item:</label>
                <input type="text" id="item" name="item" value="<?php echo $itemNameValue; ?>" maxlength="<?php echo WishlistItem::MAX_ITEM_LENGTH; ?>"<?php if(isset($itemNameError)) echo ' class="itemError"'; ?>><br>

                <label for="price" id="priceLabel">Price:</label>
                <input type="text" id="price" name="price" value="<?php echo $itemPriceValue; ?>" maxlength="20"<?php if(isset($itemPriceError)) echo ' class="itemError"'; ?>><br>

                <label for="itemGroup" id="groupLabel">Group:</label>
                <select id="itemGroup" name="itemGroup"<?php if(isset($itemGroupError)) echo ' class="itemError"'; ?>>
                    <?php
                        echo generateGroupOptions($itemGroupValue);
                    ?>
                </select><br>

                <input type="submit" id="saveItem" name="saveItem" value="Save">

                <?php
                    if(isset($wishlistItem)) {
                ?>
                    <h3>Delete Item: <input type="submit" id="deleteItem" name="deleteItem" value="Delete"></h3>
                <?php
                    }
                ?>
            </form>
    <?php
        }
    ?>
    <p><a href="<?php echo BASE_URL . "planner";?>">Return to wishlist</a></p>
</section>
