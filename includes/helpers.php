<?php

define("START_YEAR", 1970);
define("END_YEAR", 2099);

/**
 * Returns an array containing all 12 month names
 */
function getMonthsArray() {
    $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"); 
    return $months;
}

/**
 * Returns an array containing the years from range START_YEAR to END_YEAR
 */
function getYearsArray() {
    $years = array();
    for($ii = START_YEAR; $ii <= END_YEAR; $ii++) {
        $years[] = $ii; 
    }
    return $years;
}

/**
 * Returns whether the numeric value of a month is valid (1-12)
 */
function isValidMonth($month) {
    if($month >= 1 && $month <= 12) {
        return true;
    }
    else {
        return false;
    }
}

/**
 * Returns whether a specified year is within START_YEAR and END_YEAR
 */
function isValidyear($year) {
    if($year >= START_YEAR && $year <= END_YEAR) {
        return true;
    }
    else {
        return false;
    }
}

?>
