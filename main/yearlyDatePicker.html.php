    <form action="./" method="GET">
        <label>Date selector</label>
        <select id="yearPicker" name="year" class="yearlyDatePicker">
            <?php 
                $years = getYearsArray();
                foreach($years as $year) { 
            ?>
            <option <?php echo "value=\"$year\""; if($year==$selectedYear) echo ' selected'; ?>><?php echo $year; ?></option>
            <?php } ?> 
        </select>
        <input type="hidden" name="view" value="yearly">
        <input type="submit" value="Go">
    </form>
