<?php
if(isset($_POST["saveItem"])) {
    if(!isset($_POST["item"]) || !isset($_POST["price"]) || !isset($_POST["itemGroup"])) {
        $processItemError = true;
    }
    else {
        $item = trim($_POST["item"]);
        $price = trim($_POST["price"]);
        $group = intval(trim($_POST["itemGroup"]));
        $itemError = false;

        if(!WishlistItem::isValidItem($item)) {
            $itemError = true;
            $itemNameError = true;
        }

        if(!WishlistItem::isValidAmount($price)) {
            $itemError = true;
            $itemPriceError = true;
        }

        if(!WishlistGroup::isValidGroup($user->id, $group)) {
            $itemError = true;
            $itemGroupError = true;
        }

        if(!$itemError) {
            $newItem = new WishlistItem();
            $newItem->userID = $user->id;
            $newItem->item = $item;
            $newItem->groupID = $group;
            $newItem->price = WishlistItem::formatAmount($price);

            if(isset($wishlistItem)) {
                $newItem->id = $wishlistItem->id;
            }

            $newItem->save();
            header("Location: " . BASE_URL . "planner");
            exit;
        }
        else {
            $processItemError = true;
        }
    }

    if(isset($processItemError) && $processItemError === true) {
        $session->setMessage("Error processing item.");    
    }
}
else if(isset($_POST["deleteItem"])) {
    $wishlistItem->delete();
    header("Location: " . BASE_URL . "planner");
    exit;
}
?>
