<?php
    $months = getMonthsArray();
?>

<div id="calendar">
    <h4 id="calendarHeading">
        <img src="<?php echo BASE_URL . "images/leftArrow.png"; ?>" alt="prevMonth" id="prevCalendar">
        <span id="calendarHeadingText"><?php echo "$selectedYear"; ?></span>
        <img src="<?php echo BASE_URL . "images/rightArrow.png"; ?>" alt="nextMonth" id="nextCalendar">  
    </h4>
    <ul id="months">
        <?php
            for($ii = 1; $ii <= count($months); $ii++) {
        ?>  
            <li<?php if($selectedMonth === $ii) echo ' id="currentMonth"'; ?>><a href="<?php echo BASE_URL . "main/?view=monthly&month=$ii&year=$selectedYear" ?>"><?php echo substr($months[$ii-1],0,3); ?></a></li>
        <?php
            }
        ?>
    </ul>
</div>
