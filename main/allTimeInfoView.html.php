<?php
$incomeEachYear = array();
$expenseEachYear = array();
$totalEachYear = array();
$numIncomes = count($incomes);
$numExpenses = count($expenses);

if($numIncomes !== 0 && $numExpenses === 0) {
    $firstYear = date("Y", strtotime($incomes[0]->date));
    $lastYear = date("Y", strtotime($incomes[$numIncomes-1]->date));
}
else if($numIncomes === 0 && $numExpenses !== 0) {
    $firstYear = date("Y", strtotime($expenses[0]->date));
    $lastYear = date("Y", strtotime($expenses[$numExpenses-1]->date));
}
else if($numIncomes !== 0 && $numExpenses !== 0) {
    $firstYear = ($incomes[0]->date <= $expenses[0]->date) ? date("Y", strtotime($incomes[0]->date)) : date("Y", strtotime($expenses[0]->date));
    $lastYear = ($incomes[$numIncomes-1]->date >= $expenses[$numExpenses-1]->date) ? date("Y", strtotime($incomes[$numIncomes-1]->date)) : date("Y", strtotime($expenses[$numExpenses-1]->date));
}
else {
    // set to current year if no data has been set
    $lastYear = $firstYear = date("Y", time());
}

if($lastYear < date("Y", time())) {
    $lastYear = date("Y", time());
}

for($ii = $firstYear; $ii <= $lastYear; $ii++) {
    $incomeEachYear[$ii] = 0;
    $expenseEachYear[$ii] = 0;
    $totalEachYear[$ii] = 0;
}

for($ii = 0; $ii < $numIncomes; $ii++) {
    $year = date("Y", strtotime($incomes[$ii]->date));    
    $incomeEachYear[$year] += $incomes[$ii]->amount;
    $totalEachYear[$year] += $incomes[$ii]->amount;
}

for($ii = 0; $ii < $numExpenses; $ii++) {
    $year = date("Y", strtotime($expenses[$ii]->date));    
    $expenseEachYear[$year] += $expenses[$ii]->amount;
    $totalEachYear[$year] -= $expenses[$ii]->amount;
}

?>
<h3>All Time</h3>

<table>
    <tr>
        <th></th>
        <th>Income</th>
        <th>Expenses</th>
        <th>Net</th>
    </tr>
    <?php
        for($ii = $firstYear; $ii <= $lastYear; $ii++) {
    ?>
        <tr>
            <td><a href="<?php echo BASE_URL . "main/?view=yearly&year=$ii"; ?>"><?php echo $ii; ?></a></td>
            <td><?php echo htmlentities(Income::formatDisplayAmount($incomeEachYear[$ii])); ?></td>
            <td><?php echo htmlentities(Expense::formatDisplayAmount($expenseEachYear[$ii])); ?></td>
            <td><?php echo htmlentities(IncomeExpenseObject::formatDisplayAmount($totalEachYear[$ii])); ?></td>
        </tr>
    <?php
        }
    ?>
</table>
