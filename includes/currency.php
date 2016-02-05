<?php
class Currency extends databaseObject {
    const MAX_AMOUNT = 1000000000;

    /**
     * Returns whether $amount is a valid number
     */
    public static function isValidAmount($amount) {
        // trim and strip commas and dollars sign from the amount
        $amount = trim($amount);
        $amount = str_replace(",", "", $amount);
        $amount = str_replace("$", "", $amount);

        if($amount === "") {
            $amount = 0;
        }

        if(is_numeric($amount) && $amount <= static::MAX_AMOUNT) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Returns the $amount rounded off to two decimal places
     */
    public static function formatAmount($amount=0) {
        // trim and strip commas and dollars sign from the amount
        $amount = trim($amount);
        $amount = str_replace(",", "", $amount);
        $amount = str_replace("$", "", $amount);

        if($amount === "") {
            $amount = 0;
        }

        if(is_numeric($amount)) {
            // round input amount to 2 decimal places
            $result = round($amount, 2); 
            return $result;
        }
        else {
            return false;
        }
    }

    /**
     * Inserts dollar sign and comma separators into $amount
     */
    public static function formatDisplayAmount($amount=0) {
        $amount = static::formatAmount($amount);

        if(is_numeric($amount)) {
            return "$" . number_format($amount, 2, ".", ",");
        }
        else {
            return false;
        }
    }
}

?>
