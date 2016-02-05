<?php
if(isset($_POST["saveGroup"])) {
    if(!isset($_POST["groupName"])) {
        $processGroupError = true;
    }
    else {
        $groupName = trim(ucwords(strtolower($_POST["groupName"])));
        $groupError = false;

        if(!WishlistGroup::isValidGroupName($groupName)) {
            $groupError = true;
        }

        if(WishlistGroup::doesGroupExist($user->id, $groupName)) {
            if(!isset($wishlistGroup) || (isset($wishlistGroup) && $groupName !== $wishlistGroup->groupName)) {
                $groupError = true;
                $groupExists = true;
            }
        }

        if(!$groupError) {
            if($groupName !== $wishlistGroup->groupName) {
                $newWishlistGroup = new WishlistGroup();
                $newWishlistGroup->userID = $user->id;
                $newWishlistGroup->groupName = $groupName;

                if(isset($wishlistGroup)) {
                    $newWishlistGroup->id = $wishlistGroup->id;
                }

                $newWishlistGroup->save();
            }
            header("Location: " . BASE_URL . "planner/?manageGroups");
            exit;
        }
        else {
            $processGroupError = true;
        }
    }

    if(isset($processGroupError) && $processGroupError === true) {
        $session->setMessage("Error processing group.");
        if(isset($groupExists) && $groupExists === true) {
            $session->setMessage("Group already exists.");
        }
    }
}
else if(isset($_POST["deleteGroup"])) {
    // check if the group is empty
    if(WishlistItem::hasItemWithGroup($user->id, $wishlistGroup->id)) {
        $wishlistGroup->delete();
        header("Location: " . BASE_URL . "planner/?manageGroups");
        exit;
    }
    else {
        $session->setMessage("Error: There are still some items belonging to this group.");
    }
}
?>
