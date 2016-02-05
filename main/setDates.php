<?php
if($view === "daily") {
    // Check if a specified date was entered.  If not then set the day as the current day
    if(isset($_GET["day"]) && isset($_GET["month"]) && isset($_GET["year"])) {
        // Check if the specified date entered is a valid date
        if(checkdate(intval($_GET["month"]), intval($_GET["day"]), intval($_GET["year"])) && isValidYear(intval($_GET["year"]))) {
            $date = mktime(0,0,0,intval($_GET["month"]), intval($_GET["day"]), intval($_GET["year"]));
            $selectedDay = date("j",$date);
            $selectedMonth = date("n", $date);
            $selectedYear = date("Y", $date); 
        }
        else {
            // Invalid date selected
            $invalidDate = true;
            require_once(ROOT_PATH . "includes/layouts/output.html.php");
            exit;
        }
    }
    else {
        // set selected date to todays date
        $selectedDay = date("j",time());
        $selectedMonth = date("n", time());
        $selectedYear = date("Y",time());
    }
    $selectedDate = mktime(0,0,0, $selectedMonth, $selectedDay, $selectedYear);
    
    // Cannot edit income expense date if the selected date is in the future
    if($selectedDate > time()) {
        $canEdit = false;
    }
    else {
        $canEdit = true;
    }

    $daysInSelectedMonth = cal_days_in_month(CAL_GREGORIAN, $selectedMonth, $selectedYear);
    $mySqlFormatedDate = $selectedYear . "-" . $selectedMonth . "-" . $selectedDay;
    $selectedMonthName = getMonthsArray()[$selectedMonth-1];
}
else if($view === "monthly") {
    // Check if a specified date was entered. If not then set the month as the current month
    if(isset($_GET["month"]) && isset($_GET["year"])) {
        // Check if the specified date entered is a valid date
        if(isValidMonth(intval($_GET["month"])) && isValidYear(intval($_GET["year"]))) {
            $selectedMonth = intval($_GET["month"]);
            $selectedYear = intval($_GET["year"]);
        }
        else {
            $invalidDate = true;
            require_once(ROOT_PATH . "includes/layouts/output.html.php");
            exit;
        }
    }
    else {
        $selectedMonth = date("n", time());
        $selectedYear = date("Y",time());
    }
    $selectedDate = mktime(0,0,0, $selectedMonth, 1, $selectedYear);
    $daysInSelectedMonth = cal_days_in_month(CAL_GREGORIAN, $selectedMonth, $selectedYear);
    $mySqlFormatedDateStart = $selectedYear . "-" . $selectedMonth . "-1";
    $mySqlFormatedDateEnd = $selectedYear . "-" . $selectedMonth . "-" . $daysInSelectedMonth;
    $selectedMonthName = getMonthsArray()[$selectedMonth-1];
}
else if($view === "yearly") {
    // Check if a specified date was entered. If not then set the month as the current month
    if(isset($_GET["year"])) {
        if(isValidYear(intval($_GET["year"]))) {
            $selectedYear = intval($_GET["year"]);
        }
        else {
            $invalidDate = true;
            require_once(ROOT_PATH . "includes/layouts/output.html.php");
            exit;
        }
    }
    else {
        $selectedYear = date("Y", time());
    }
    $selectedDate = mktime(0,0,0,1,1,$selectedYear);
    $mySqlFormatedDateStart = $selectedYear . "-1-1"; // Jan 1
    $mySqlFormatedDateEnd = $selectedYear . "-12-31";  // Dec 31  
}

?>
