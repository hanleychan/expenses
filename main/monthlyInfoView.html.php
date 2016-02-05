<?php

$incomeEachDay = array();
$expenseEachDay = array();
$totalEachDay = array();
for($ii = 0; $ii < $daysInSelectedMonth;$ii++) {
    $incomeEachDay[$ii] = 0;
    $expenseEachDay[$ii] = 0;
    $totalEachDay[$ii] = 0;
}


foreach($incomes as $income) {
    $day = date("j", strtotime($income->date));
    $incomeEachDay[$day-1] += $income->amount;
    $totalEachDay[$day-1] += $income->amount;
}

foreach($expenses as $expense) {
    $day = date("j", strtotime($expense->date));
    $expenseEachDay[$day-1] += $expense->amount;
    $totalEachDay[$day-1] -= $expense->amount;
}

?>

<h3><?php echo $selectedMonthName . " " . $selectedYear ?></h3>

<table>
    <tr>
        <th></th>
        <th>Income</th>
        <th>Expenses</th>
        <th>Net</th>
    </tr>
    <?php
        for($ii = 1; $ii <= $daysInSelectedMonth; $ii++) {
    ?>
        <tr>
            <td><a href="<?php echo BASE_URL . "main/?month=$selectedMonth&day=$ii&year=$selectedYear"; ?>"><?php echo $selectedMonthName . " " . $ii; ?></a></td>
            <td><?php echo htmlentities(Income::formatDisplayAmount($incomeEachDay[$ii-1])); ?></td>
            <td><?php echo htmlentities(Expense::formatDisplayAmount($expenseEachDay[$ii-1])); ?></td>
            <td><?php echo htmlentities(IncomeExpenseObject::formatDisplayAmount($totalEachDay[$ii-1])); ?></td>
        </tr>
    <?php
        }
    ?>
</table>
