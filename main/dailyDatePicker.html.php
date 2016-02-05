    <form action="./" method="GET" id="datePickForm">
        <label id="datePickerHeading">Date:</label>
        <select id="monthPicker" name="month" class="dailyDatePicker">
            <?php
                $months = getMonthsArray();
                for($ii=1;$ii<=count($months);$ii++) {
            ?>
            <option <?php echo "value=\"$ii\""; if($months[$ii-1]==date("F",$selectedDate)) { echo ' selected'; }; ?>><?php echo $months[$ii-1]; ?></option>
            <?php } ?>
        </select>
        <select id="dayPicker" name="day" class="dailyDatePicker">
            <?php
                for($ii=1;$ii<=$daysInSelectedMonth;$ii++) {                    
            ?>
            <option <?php echo "value=\"$ii\""; if($ii==$selectedDay) echo ' selected'; ?>><?php echo $ii; ?></option>
            <?php
                }
            ?>
        </select>
        <select id="yearPicker" name="year" class="dailyDatePicker">
            <?php 
                $years = getYearsArray();
                foreach($years as $year) { 
            ?>
            <option <?php echo "value=\"$year\""; if($year==$selectedYear) echo ' selected'; ?>><?php echo $year; ?></option>
            <?php } ?>
        </select>
        <input type="submit" value="Go">
    </form>
