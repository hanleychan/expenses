<?php
$user = User::findById($session->userID);
$incomeTypes = IncomeType::findBySql('SELECT * FROM incometypes WHERE userID = "' . $user->id . '" ORDER BY id');
$expenseTypes = ExpenseType::findBySql('SELECT * FROM expensetypes WHERE userID = "' . $user->id . '" ORDER BY id');

// Fetch income and expense data based on the current view
if($view === "daily") {
    $incomes = Income::findBySql('SELECT * FROM incomes WHERE userID = "' . $user->id . '" AND date = "' . $mySqlFormatedDate . '" ORDER BY id');
    $expenses = Expense::findBySql('SELECT * FROM expenses WHERE userID = "' . $user->id . '" AND date = "' . $mySqlFormatedDate . '" ORDER BY id');
}
else if($view === "monthly" || $view === "yearly") {
    $incomes = Income::findBySql('SELECT * FROM incomes WHERE userID = "' . $user->id . '" AND date BETWEEN "' . $mySqlFormatedDateStart . '" AND "' . $mySqlFormatedDateEnd . '"');
    $expenses = Expense::findBySql('SELECT * FROM expenses WHERE userID = "' . $user->id . '" AND date BETWEEN "' . $mySqlFormatedDateStart . '" AND "' . $mySqlFormatedDateEnd . '"');
}
else if($view === "allTime") {
    $incomes = Income::findBySql('SELECT * FROM incomes WHERE userID = "' . $user->id . '" ORDER BY date');
    $expenses = Expense::findBySql('SELECT * FROM expenses WHERE userID = "' . $user->id . '" ORDER BY date');
}
?>
