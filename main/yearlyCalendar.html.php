<?php
    $decade =  $selectedYear - substr($selectedYear, 3, 1);
?>
<div id="calendar">
    <h4 id="calendarHeading">
        <img src="<?php echo BASE_URL . "images/leftArrow.png"; ?>" alt="prevMonth" id="prevCalendar">
        <span id="calendarHeadingText"><?php echo $decade; ?></span>
        <img src="<?php echo BASE_URL . "images/rightArrow.png"; ?>" alt="nextMonth" id="nextCalendar">  
    </h4> 
    <ul id="years">
        <?php
            for($ii = $decade; $ii <= ($decade + 9); $ii++) {
        ?>
                <li<?php if(intval($selectedYear) === $ii) echo ' id="currentYear"'; ?>><a href="<?php echo BASE_URL . "main/?view=yearly&year=$ii"; ?>"><?php echo $ii; ?></a></li>
        <?php
            }
        ?>
                <li></li>
                <li></li>
    </ul>
</div>
