<?php
$firstDayOfMonth = mktime(0,0,0, $selectedMonth, 1, $selectedYear);
$numBlanksBeforeFirstDay = date("w",$firstDayOfMonth);
$numBlanksAfterLastDay = 42 - $daysInSelectedMonth - $numBlanksBeforeFirstDay;
?>

<div id="calendar">
    <h4 id="calendarHeading">
        <img src="<?php echo BASE_URL . "images/leftArrow.png"; ?>" alt="prevMonth" id="prevCalendar">
        <span id="calendarHeadingText"><?php echo "$selectedMonthName $selectedYear"; ?></span>
        <img src="<?php echo BASE_URL . "images/rightArrow.png"; ?>" alt="nextMonth" id="nextCalendar">
    </h4>
    <ul id="weekdays">
        <li>Su</li>
        <li>Mo</li>
        <li>Tu</li>
        <li>We</li>
        <li>Th</li>
        <li>Fr</li>
        <li>Sa</li>
    </ul>
    <ul id="days">
        <?php
            for($ii = 0; $ii < $numBlanksBeforeFirstDay; $ii++ ) {
        ?>
            <li></li>
        <?php
            }
            for($ii = 1;$ii <= $daysInSelectedMonth; $ii++) {
        ?>
            <li<?php if($ii === intval($selectedDay)) echo ' id="currentDay"'; ?>><?php echo '<a href="?month=' . $selectedMonth . '&day=' . $ii . '&year=' . $selectedYear . '">' . $ii . '</a>'; ?></li>
        <?php
            }
            for($ii = 0; $ii < $numBlanksAfterLastDay; $ii++) {
        ?>  
            <li></li>
        <?php
            }
        ?>
    </ul>
</div>

