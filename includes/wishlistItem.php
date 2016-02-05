<?php
class WishlistItem extends Currency {
    public $id;
    public $userID;
    public $item;
    public $price;
    public $groupID;
    public $groupName;
    const MAX_ITEM_LENGTH = 20;

    protected static $table_name = "wishlistitems";
    protected static $db_fields = array('id', 'userID', 'item', 'price', 'groupID');

    /**
     * Returns whether an item's description is valid
     */
    public static function isValidItem($item) {
        if(strlen($item) > static::MAX_ITEM_LENGTH || trim($item) === "") {
            return false;
        }

        return true;
    }
}

?>
