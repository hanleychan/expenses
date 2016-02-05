<?php
    $totalIncome = 0;
    $totalExpenses = 0;
    $incomeTypeAmounts = array();
    $expenseTypeAmounts = array();

    foreach($incomeTypes as $incomeType) {
        array_push($incomeTypeAmounts, array("type"=>$incomeType->category, "id"=>$incomeType->id, "amount"=>0));
    }

    foreach($expenseTypes as $expenseType) {
        array_push($expenseTypeAmounts, array("type"=>$expenseType->category, "id"=>$expenseType->id, "amount"=>0));
    }

    foreach($incomes as $income) {
        $totalIncome += $income->amount;
        for($ii = 0; $ii < count($incomeTypeAmounts); $ii++) {
            if($income->typeID === $incomeTypeAmounts[$ii]["id"]) {
                $incomeTypeAmounts[$ii]["amount"] += $income->amount;
                break;
            }
        }
    }

    foreach($expenses as $expense) {
        $totalExpenses += $expense->amount;
        for($ii = 0; $ii < count($expenseTypeAmounts); $ii++) {
            if($expense->typeID === $expenseTypeAmounts[$ii]["id"]) {
                $expenseTypeAmounts[$ii]["amount"] += $expense->amount;
                break;
            }
        }
    }

    $netAmount = $totalIncome - $totalExpenses;

?>

<table id="totalSummaryTable">
    <tr>
        <th>Income</th>
        <th>Expenses</th>
        <th>Net</th>
    </tr>
    <tr>
        <td><?php echo htmlentities(Income::formatDisplayAmount($totalIncome)); ?></td>
        <td><?php echo htmlentities(Expense::formatDisplayAmount($totalExpenses)); ?></td>
        <td><?php echo htmlentities(IncomeExpenseObject::formatDisplayAmount($netAmount)); ?></td>
    </tr>
</table>
<div id="totalChart"></div>

<h3>Income</h3>
<table id="incomeSummaryTable">
    <tr>
        <th>Category</th>
        <th>Total</th>
    </tr>
    <?php
        foreach($incomeTypeAmounts as $incomeTypeAmount) {
    ?>
        <tr>
            <td><?php echo htmlentities($incomeTypeAmount["type"]); ?></td>
            <td><?php echo htmlentities(Income::formatDisplayAmount($incomeTypeAmount["amount"])); ?></td>
        </tr>
    <?php
        }
    ?>
</table>
<div id="incomeChart"></div>

<h3>Expenses</h3>
<table id="expensesSummaryTable">
    <tr>
        <th>Category</th>
        <th>Total</th>
    </tr>
    <?php
        foreach($expenseTypeAmounts as $expenseTypeAmount) {
    ?>
        <tr>
            <td><?php echo htmlentities($expenseTypeAmount["type"]); ?></td>
            <td><?php echo htmlentities(Expense::formatDisplayAmount($expenseTypeAmount["amount"])); ?></td>
        </tr>
    <?php
        }
    ?>
</table>
<div id="expensesChart"></div>

