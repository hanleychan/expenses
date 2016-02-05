<?php
$user = User::findById($session->userID);

// fetch all wishlist items if not displaying data for a group, a single item or adding an item
if(!isset($_GET["item"]) && !isset($_GET["group"]) && !isset($_GET["addItem"])) {
    $showAllItems = true;

    // determine display order
    if(isset($_GET["sortBy"])) {
        if(trim(strtolower($_GET["sortBy"])) === "item") {
            $sortBy = "item";
        }
        else if(trim(strtolower($_GET["sortBy"])) === "price") {
            $sortBy = "price";
        }
        else if(trim(strtolower($_GET["sortBy"])) === "group") {
            $sortBy = "groupName";
        }
        else {
            $sortBy = "id";
        }
    }
    else {
        $sortBy = "id";
    }

    if(isset($_GET["sortOrder"])) {
        if(trim(strtolower($_GET["sortOrder"])) === "asc") {
            $sortOrder = "asc";
        }
        else {
            $sortOrder = "desc";
        }
    }
    else {
        $sortOrder = "desc";
    }

    // determine which group to display items from
    if(isset($_GET["display"])) {
        $displayGroup = trim(ucwords(strtolower($_GET["display"])));
        
        // check if display group exists
        if(WishlistGroup::doesGroupExist($user->id, $displayGroup)) {
            $display = $displayGroup;
            $showAllItems = false;


            $sql = 'SELECT wishlistitems.id as id, item, price, groupID, groupName FROM wishlistitems INNER JOIN wishlistgroups ON wishlistitems.groupID = wishlistgroups.id';
            $sql .= ' WHERE wishlistitems.userID = ? AND groupName = ?';
            $sql .= ' ORDER BY ' . $sortBy . ' ' . $sortOrder;
            $paramArray = array($user->id, $displayGroup);
            $wishlistItems = WishlistItem::findBySql($sql, $paramArray);
        }
    }

    if($showAllItems) {
        $display = "All Items";

        // fetch all items
        $sql = 'SELECT wishlistitems.id as id, item, price, groupID, groupName';
        $sql .= ' FROM wishlistitems INNER JOIN wishlistgroups ON wishlistitems.groupID = wishlistgroups.id';
        $sql .= ' WHERE wishlistitems.userID = ?';
        $sql .= ' ORDER BY ' . $sortBy . ' ' . $sortOrder;
        $paramArray = array($user->id);
        $wishlistItems = WishlistItem::findBySql($sql, $paramArray);
    }

    $wishlistItemsAddedOrder = array();
    foreach($wishlistItems as $wishlistItem) {
        $wishlistItemsAddedOrder[] = $wishlistItem->id;
    }

    sort($wishlistItemsAddedOrder);
    $wishlistItemsAddedOrder = array_flip($wishlistItemsAddedOrder);
    
    foreach($wishlistItems as $wishlistItem) {
        $wishlistItem->added = $wishlistItemsAddedOrder[$wishlistItem->id] + 1;
    }
}

// fetch a single item
if(isset($_GET["item"])) {
    $sql = 'SELECT wishlistitems.id as id, wishlistitems.userID as userID, item, price, groupID, groupName';
    $sql .= ' FROM wishlistitems INNER JOIN wishlistgroups';
    $sql .= ' ON wishlistitems.groupID = wishlistgroups.id';
    $sql .= ' WHERE wishlistitems.userID = "' . $user->id . '"';
    $sql .= ' AND wishlistitems.id = ? LIMIT 1'; 
    $paramArray = array(trim($_GET["item"]));
    $wishlistItems = WishlistItem::findBySql($sql, $paramArray);

    if(!$wishlistItems) {
        $invalidItem = true;
    }
    else {
        $wishlistItem = $wishlistItems[0];
    }
}

// fetch a group
if(isset($_GET["group"])) {
    $sql = 'SELECT * FROM wishlistgroups WHERE userID = ? AND id = ? LIMIT 1';
    $paramArray = array($user->id, $_GET["group"]);
    $wishlistGroups = WishlistGroup::findBySql($sql, $paramArray);

    if(!$wishlistGroups) {
        $invalidGroup = true;
    }
    else {
        $wishlistGroup = $wishlistGroups[0];
    }
}
else {
    // fetch all groups
    $wishlistGroups = WishlistGroup::findBySql('SELECT * FROM wishlistgroups WHERE userID = "' . $user->id . '" ORDER BY groupName ASC');
}
?>
