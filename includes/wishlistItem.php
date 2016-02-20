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


    /**
     * Returns whether there exists any items belonging to a group for a user
     */
    public static function hasItemWithGroup($userID, $groupID) {
        $sql = 'SELECT * FROM wishlistitems WHERE userID = ? AND groupID = ?';
        $paramArray = array($userID, $groupID);
        $result = self::findBySql($sql, $paramArray);

        if($result) {
            return false;
        }
        else {
            return true;
        }
    }


    /**
     * Returns the number of wishlist items a user has
     */
    public static function getNumItems($userID) {
        $sql = 'SELECT * FROM wishlistitems WHERE userID = ?';
        $paramArray = array($userID);
        $result = self::findBySql($sql, $paramArray);

        return count($result);
    }
}

?>
