<?php
class WishlistGroup extends databaseObject {
    public $id;
    public $userID;
    public $groupName;
    const MAX_GROUP_LENGTH = 15;
    protected static $table_name = "wishlistgroups";
    protected static $db_fields = array('id', 'userID', 'groupName');

    /**
     * Returns whether a group exists for a user
     */
    public static function isValidGroup($userID, $groupID) {
        $sql = "SELECT * FROM wishlistgroups WHERE id = ? AND userID = ?";
        $paramArray = [$groupID, $userID];
        $result = self::findBySql($sql, $paramArray);
        if($result) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Returns whether a group name is a valid name
     */
    public static function isValidGroupName($groupName) {
        if(trim($groupName) === "") {
            return false;
        }
        if(strlen($groupName) >= self::MAX_GROUP_LENGTH) {
            return false;
        }

        return true;
    }

    /**
     * Returns whether the name of a group already exists for a user
     */
    public static function doesGroupExist($userID, $groupName) {
        $sql = "SELECT * FROM wishlistgroups WHERE userID = ? AND groupName = ?";
        $paramArray = array($userID, $groupName);

        if(self::findBySql($sql, $paramArray)) {
            return true;
        }
        else {
            return false;
        }
    }
}

?>
