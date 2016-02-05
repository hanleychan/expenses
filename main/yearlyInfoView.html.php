<?php
    $incomeEachMonth = array();
    $expenseEachMonth = array();
    $totalEachMonth = array();

    for($ii = 0; $ii < 12; $ii++) {
        $incomeEachMonth[$ii] = 0;
        $expenseEachMonth[$ii] = 0;
        $totalEachMonth[$ii] = 0;
    }

    foreach($incomes as $income) {
        $month = date("n", strtotime($income->date));
        $incomeEachMonth[$month-1] += $income->amount;
        $totalEachMonth[$month-1] += $income->amount;
    }

    foreach($expenses as $expense) {
        $month = date("n", strtotime($expense->date));
        $expenseEachMonth[$month-1] += $expense->amount;
        $totalEachMonth[$month-1] -= $expense->amount;
    }
?>

<h3><?php echo $selectedYear; ?></h3>

<table>
    <tr>
        <th></th>
        <th>Income</th>
        <th>Expenses</th>
        <th>Net</th>
    </tr>
    <?php
        for($ii = 1; $ii <= 12; $ii++) {
    ?>
        <tr>
            <td><a href="<?php echo BASE_URL . "main/?view=monthly&month=$ii&year=$selectedYear"; ?>"><?php echo getMonthsArray()[$ii-1] ?></a></td>
            <td><?php echo htmlentities(Income::formatDisplayAmount($incomeEachMonth[$ii-1])); ?></td> 
            <td><?php echo htmlentities(Expense::formatDisplayAmount($expenseEachMonth[$ii-1])); ?></td> 
            <td><?php echo htmlentities(IncomeExpenseObject::formatDisplayAmount($totalEachMonth[$ii-1])); ?></td> 
        </tr>
    <?php
        }
    ?>
</table>
