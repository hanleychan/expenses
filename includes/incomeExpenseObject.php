<?php
class IncomeExpenseObject extends Currency {
    public $id;
    public $userID;
    public $amount;
    public $typeID;
    public $description;
    public $date;
    const MAX_DESC_LENGTH = 30;
    const MAX_AMOUNT = 1000000000;

    /**
     * Returns whether an item description is valid
     */
    public static function isValidDescription($desc) {
        if(strlen(trim($desc)) <= static::MAX_DESC_LENGTH) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Returns the number of database entries that need to be updated based on
     * the current number of entries existing and the number of new entries entered
     */
    public static function numUpdates($numEntriesExisting, $numNewEntries) {
        if($numNewEntries >= $numEntriesExisting) {
            return $numEntriesExisting;
        }
        else {
            return $numNewEntries;
        }
    }

    /**
     * Returns the number of database entries that need to be deleted based on
     * the current number of entries existing and the number of new entries entered
     */
    public static function numDeletes($numEntriesExisting, $numNewEntries) {
        if($numEntriesExisting >= $numNewEntries) {
            return $numEntriesExisting - $numNewEntries;
        }
        else {
            return 0; 
        }
    }

    /**
     * Returns the number of database entires that need to be inserted based on
     * the current number of entries existing and the number of new entries entered
     */
    public static function numInsertions($numEntriesExisting, $numNewEntries) {
        if($numNewEntries > $numEntriesExisting) {
            return $numNewEntries - $numEntriesExisting;
        }
        else {
            return 0;
        }
    }
}

?>
