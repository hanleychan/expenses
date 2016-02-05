<?php

/**
 * Returns the total value of all items displayed
 */
function totalAmount() {
    global $wishlistItems;

    $total = 0;
    foreach($wishlistItems as $wishlistItem) {
        $total += $wishlistItem->price; 
    }

    return $total;
}

?>
    <section id="wishlist">
        <h2>Wishlist:</h2>

        <nav>
            <form id="changeDisplayGroup" action="./" method="get">
                <label for="display">Display: </label>
                <select id="display" name="display">
                    <option value="All Items">All Items</option>
                    <?php
                        foreach($wishlistGroups as $wishlistGroup) {
                    ?>
                    <option value="<?php echo htmlentities($wishlistGroup->groupName); ?>"<?php if(isset($displayGroup) && $displayGroup === $wishlistGroup->groupName) echo " selected"; ?>><?php echo htmlentities($wishlistGroup->groupName); ?></option>
                    <?php
                        }
                    ?>
                                
                </select>
                <input type="submit" id="displaySubmit" value="Go">
            </form>
            <p><a href="?manageGroups">Manage Groups</a></p>
            <p><a href="?addItem">Add an Item</a></p>
        </nav>
        
        <h3><?php echo htmlentities($display) . " (" . count($wishlistItems) . "): " . htmlentities(WishlistItem::formatDisplayAmount(totalAmount())); ?></h3>
        <?php
            if(!empty($wishlistItems)) {
        ?>
            <form action="./" method="get">
                <input type="hidden" name="display" value="<?php echo $display; ?>">
                <ul id="wishlistItemsSort">
                    <li>Sort:</li>
                    <li>
                        <select id="sortBy" name="sortBy">
                            <option value="added">Order by:</option>
                            <option value="added"<?php if(isset($_GET["sortBy"]) && $_GET["sortBy"] === "added") echo " selected"; ?>>Added</option>
                            <option value="item"<?php if(isset($_GET["sortBy"]) && $_GET["sortBy"] === "item") echo " selected"; ?>>Item</option>
                            <option value="price"<?php if(isset($_GET["sortBy"]) && $_GET["sortBy"] === "price") echo " selected"; ?>>Price</option>
                            <option value="group"<?php if(isset($_GET["sortBy"]) && $_GET["sortBy"] === "group") echo " selected"; ?>>Group</option>
                        </select>
                    </li>
                    <li>
                        <select id="sortOrder" name="sortOrder">
                            <option value="asc"<?php if(isset($_GET["sortOrder"]) && $_GET["sortOrder"] === "asc") echo " selected"; ?>>Ascending</option>
                            <option value="desc"<?php if(isset($_GET["sortOrder"]) && $_GET["sortOrder"] === "desc") echo " selected"; ?>>Descending</option> 
                        </select>
                    </li>
                    <li>
                        <button>Go</button>
                    </li>
                </ul>

                <ul id="wishlistItems">
                    <li>
                        <span id="addedHeading">#</span>
                        <span id="itemHeading">Item</span>
                        <span id="priceHeading">Price</span>
                        <span id="groupHeading">Group</span>
                    </li>
                    
                    <?php
                        foreach($wishlistItems as $wishlistItem) {
                    ?>
                        <li>
                            <span class="added"><?php echo htmlentities($wishlistItem->added); ?></span>
                            <span class="item"><a href="?item=<?php echo $wishlistItem->id; ?>"><?php echo htmlentities($wishlistItem->item); ?></a></span>
                            <span class="price"><?php echo htmlentities(WishlistItem::formatDisplayAmount($wishlistItem->price)); ?></span>
                            <span class="group"><?php echo htmlentities($wishlistItem->groupName); ?></span>
                        </li>
                    <?php
                        }
                    ?>
                </ul>
            </form>
        <?php
            }
            else {
        ?>
            <p>You have not added any items.</p>
        <?php
            }
        ?>
    </section>
