<?php
$incomeEntriesCounter = 0;
$expenseEntriesCounter = 0;

$incomeEntries = array();
$expenseEntries = array();

$inputErrors = false;

// process every income entry
while(isset($_POST["incomeDesc" . $incomeEntriesCounter]) || isset($_POST["incomeAmount" . $incomeEntriesCounter])) {
    $desc = trim($_POST["incomeDesc" . $incomeEntriesCounter]);
    $type = trim($_POST["incomeType" . $incomeEntriesCounter]);
    $amount = trim($_POST["incomeAmount" . $incomeEntriesCounter]);
    
    // Validate income description
    if(Income::isValidDescription($desc)) {
        $descError = false;
    }
    else {
        $descError = true;
        $inputErrors = true;
    }

    if(Income::isValidAmount($amount)) {
        $amountError = false;
    }
    else {
        $amountError = true;
        $inputErrors = true;
    }

    // Validate income type
    $typeError = true;
    $typeID = "";
    foreach($incomeTypes as $incomeType) {
        if($type === $incomeType->category) {
            $typeError = false;
            $typeID = $incomeType->id;
            break;
        }
    }

    if($desc !== "" || Income::formatAmount($amount) !== 0.0) {
        $incomeEntry = array(
            "desc" => $desc,
            "descError" => $descError,
            "type" => $type,
            "typeID" => $typeID,
            "typeError" => $typeError,
            "amount" => $amount,
            "amountError" => $amountError
        );
        array_push($incomeEntries, $incomeEntry);
    } 
    $incomeEntriesCounter++;
}

// process every expense entry
while(isset($_POST["expenseDesc" . $expenseEntriesCounter]) || isset($_POST["expenseAmount" . $expenseEntriesCounter])) {
    $desc = trim($_POST["expenseDesc" . $expenseEntriesCounter]);
    $type = trim($_POST["expenseType" . $expenseEntriesCounter]);
    $amount = trim($_POST["expenseAmount" . $expenseEntriesCounter]);

    // Validate expense description
    if(Expense::isValidDescription($desc)) {
        $descError = false;
    }
    else {
        $descError = true;
        $inputErrors = true;
    }

    if(Expense::isValidAmount($amount)) {
        $amountError = false;
    }
    else {
        $amountError = true;
        $inputErrors = true;
    }

    // Validate expense type
    $typeError = true;
    $typeID = "";
    foreach($expenseTypes as $expenseType) {
        if($type === $expenseType->category) {
            $typeError = false;
            $typeID = $expenseType->id;
            break;
        }
    }

    if($desc !== "" || Expense::formatAmount($amount) !== 0.0) {
        $expenseEntry = array(
            "desc" => $desc,
            "descError" => $descError,
            "type" => $type,
            "typeID" => $typeID,
            "typeError" => $typeError,
            "amount" => $amount,
            "amountError" => $amountError
        );
        array_push($expenseEntries, $expenseEntry);
    }
    $expenseEntriesCounter++;
}

// No errors - Insert/Update the database
if(!$inputErrors) {
    $numIncomeEntries = count($incomeEntries);
    $numIncomes = count($incomes);
    $numExpenseEntries = count($expenseEntries);
    $numExpenses = count($expenses);

    $numIncomeDeletes = Income::numDeletes($numIncomes, $numIncomeEntries);
    $numIncomeUpdates = Income::numUpdates($numIncomes, $numIncomeEntries);
    $numIncomeInserts = Income::numInsertions($numIncomes, $numIncomeEntries);
    $numExpenseDeletes = Expense::numDeletes($numExpenses, $numExpenseEntries);
    $numExpenseUpdates = Expense::numUpdates($numExpenses, $numExpenseEntries);
    $numExpenseInserts = Expense::numInsertions($numExpenses, $numExpenseEntries);

    for($ii = 0; $ii < $numIncomeDeletes; $ii++) {
        $income = array_pop($incomes);
        $income->delete();
    }

    for($ii = 0; $ii < $numIncomeEntries; $ii++) {
        if($ii <= ($numIncomeUpdates - 1)) {
            // update existing income entry if it has changed
            $income = $incomes[$ii];

            if(($incomeEntries[$ii]["desc"] !== $income->description) || 
                (intval($incomeEntries[$ii]["typeID"]) !== intval($income->typeID)) ||
                (floatval($incomeEntries[$ii]["amount"]) !== floatval($income->amount))) {
                    $income->description = $incomeEntries[$ii]["desc"];
                    $income->amount = Income::formatAmount($incomeEntries[$ii]["amount"]);
                    $income->typeID = $incomeEntries[$ii]["typeID"];
                    $income->save(array("amount", "description", "typeID"));
            }
        }
        else {
            // insert new income entry
            $income = new Income();
            $income->userID = $user->id;
            $income->amount = Income::formatAmount($incomeEntries[$ii]["amount"]);
            $income->date = $mySqlFormatedDate;
            $income->description = $incomeEntries[$ii]["desc"];
            $income->typeID = $incomeEntries[$ii]["typeID"]; 
            $income->save();
        }  
    } 

    for($ii = 0; $ii < $numExpenseDeletes; $ii++) {
        $expense = array_pop($expenses);
        $expense->delete();
    }

    for($ii = 0; $ii < $numExpenseEntries; $ii++) {
        if($ii <= ($numExpenseUpdates - 1)) {
            // update existing expense entry if it has changed
            $expense = $expenses[$ii];

            if(($expenseEntries[$ii]["desc"] !== $expense->description) || 
                (intval($expenseEntries[$ii]["typeID"]) !== intval($expense->typeID)) ||
                (floatval($expenseEntries[$ii]["amount"]) !== floatval($expense->amount))) {
                    $expense->description = $expenseEntries[$ii]["desc"];
                    $expense->amount = Expense::formatAmount($expenseEntries[$ii]["amount"]);
                    $expense->typeID = $expenseEntries[$ii]["typeID"];
                    $expense->save(array("amount", "description", "typeID"));
            }
        }
        else {
            // insert new expense entry
            $expense = new Expense();
            $expense->userID = $user->id;
            $expense->amount = Expense::formatAmount($expenseEntries[$ii]["amount"]);
            $expense->date = $mySqlFormatedDate;
            $expense->description = $expenseEntries[$ii]["desc"];
            $expense->typeID = $expenseEntries[$ii]["typeID"]; 
            $expense->save();
        }  
    } 

    // redirect back to the same day after processing the form
    header("Location: " . BASE_URL . "main/?month=$selectedMonth&day=$selectedDay&year=$selectedYear");
    exit;
}

// Update $incomes and $expenses so that they contain the modified entries
$incomes = Income::findBySql('SELECT * FROM incomes WHERE userID = "' . $user->id . '" AND date = "' . $mySqlFormatedDate . '" ORDER BY id');
$expenses = Expense::findBySql('SELECT * FROM expenses WHERE userID = "' . $user->id . '" AND date = "' . $mySqlFormatedDate . '"ORDER BY id');
?>
