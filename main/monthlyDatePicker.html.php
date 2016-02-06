    <form action="./" method="GET">
        <label id="datePickerHeading">Date:</label>
        <input type="hidden" name="view" value="monthly">
        <select id="monthPicker" name="month" class="monthlyDatePicker">
            <?php
                $months = getMonthsArray();
                foreach($months as $monthIndex => $monthName) {
            ?>
                <option value="<?php echo ($monthIndex + 1) ?>"<?php if($selectedMonth == ($monthIndex + 1)) { echo " selected"; } ?>><?php echo $monthName ?></option> 
            <?php
                }
            ?>
        </select>
        <select id="yearPicker" name="year" class="monthlyDatePicker">
            <?php
                $years = getYearsArray();
                foreach($years as $year) {
            ?>
                <option value="<?php echo $year; ?>"<?php if($year == $selectedYear) echo " selected"; ?>><?php echo $year; ?></option>
            <?php
                }
            ?>
        </select>
        <input type="submit" value="Go">
    </form>
