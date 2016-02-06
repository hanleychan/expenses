<?php

/**
 * Generate income fields and populate it with existing data
 */
function getIncomeEntries() {
    global $incomeTypes;
    global $incomes;
    global $incomeEntries;
    global $inputErrors;

    $result = "";

    $incomeIndex = 0;

    $numEntries = $inputErrors ? count($incomeEntries) : count($incomes);

    do {
        $result .= '<div class="incomeEntry"> ';
        $result .= '<label for="incomeDesc' . $incomeIndex . '" class="altDescLabel">Description: </label>';
        $result .= '<input type="text" id="incomeDesc' . $incomeIndex . '" name="incomeDesc' . $incomeIndex . '" class="desc';
        if($inputErrors && isset($incomeEntries[$incomeIndex])) {
            if($incomeEntries[$incomeIndex]["descError"]) {
                $result .= ' descError';
            }
        }
        $result .= '" placeholder="Description" maxlength="' . Income::MAX_DESC_LENGTH . '"';

        if($inputErrors && isset($incomeEntries[$incomeIndex])) {
            $result .= ' value="';
            $result .= htmlentities($incomeEntries[$incomeIndex]["desc"]);
            $result .= '"';
        }
        else if(isset($incomes[$incomeIndex])) {
            $result .= ' value="';
            $result .= htmlentities($incomes[$incomeIndex]->description);
            $result .= '"';
        }

        $result .= '> ';
        $result .= '<label for="incomeType' . $incomeIndex . '" class="altTypeLabel">Category: </label>';
        $result .= '<select id="incomeType' . $incomeIndex . '" name="incomeType' . $incomeIndex . '" class="type';
        if($inputErrors && isset($incomeEntries[$incomeIndex])) {
            if($incomeEntries[$incomeIndex]["typeError"]) {
                $result .= ' typeError';
            }
        }
        $result .= '"> ';
        foreach($incomeTypes as $incomeType) {
            $result .= '<option value="' . $incomeType->category . '"';

            if($inputErrors && isset($incomeEntries[$incomeIndex])) {
                if($incomeEntries[$incomeIndex]["type"] === $incomeType->category) {
                    $result .= "selected";
                }
            }
            else if(isset($incomes[$incomeIndex])) {
                if($incomes[$incomeIndex]->typeID === $incomeType->id) {
                    $result .= "selected";
                }
            }

            $result .= '>';
            $result .= $incomeType->category;
            $result .= '</option> ';
        }
        $result .= '</select> ';
        
        $result .= '<label for="incomeAmount' . $incomeIndex . '" class="altAmountLabel">Amount: </label>';             
        $result .= '<input type="text" maxlength="20" id="incomeAmount' . $incomeIndex . '" name="incomeAmount' . $incomeIndex . '" class="amount';
        if($inputErrors && isset($incomeEntries[$incomeIndex])) {
            if($incomeEntries[$incomeIndex]["amountError"]) {
                $result .= ' amountError';
            }
        }
        $result .= '" placeholder="Amount"';
        if($inputErrors && isset($incomeEntries[$incomeIndex])) {
            $result .= ' value="';
            $result .= htmlentities($incomeEntries[$incomeIndex]["amount"]);
            $result .= '"';
        }
        else if(isset($incomes[$incomeIndex])) {
            $result .= ' value="';
            $result .= htmlentities(Income::formatDisplayAmount($incomes[$incomeIndex]->amount));
            $result .= '"';
        }
        $result .= '> ';
        $result .= '<label class="removeLabel">Remove: </label>';
        $result .= '<button type="button" id="deleteIncomeButton' . $incomeIndex . '" name="deleteIncomeButton' . $incomeIndex . '" class="deleteButton" title="Delete"> ';
        $result .= '&#10006;';
        $result .= '</button> ';
        $result .= '<br> ';
        $result .= '</div> ';
        $incomeIndex++;
    } while($incomeIndex < $numEntries);
        
    return $result;
}

/**
 * Generate expense fields and populate it with existing data
 */
function getExpenseEntries() {
    global $expenseTypes;
    global $expenses;
    global $expenseEntries;
    global $inputErrors;

    $result = "";

    $expenseIndex = 0;

    $numEntries = $inputErrors ? count($expenseEntries) : count($expenses);

    do {
        $result .= '<div class="expenseEntry"> ';
        $result .= '<label for="expenseDesc' . $expenseIndex . '" class="altDescLabel">Description: </label>';
        $result .= '<input type="text" id="expenseDesc' . $expenseIndex . '" name="expenseDesc' . $expenseIndex . '" class="desc';
        if($inputErrors && isset($expenseEntries[$expenseIndex])) {
            if($expenseEntries[$expenseIndex]["descError"]) {
                $result .= ' descError';
            }
        }
        $result .= '" placeholder="Description" maxlength="' . Expense::MAX_DESC_LENGTH . '"';

        if($inputErrors && isset($expenseEntries[$expenseIndex])) {
            $result .= ' value="';
            $result .= htmlentities($expenseEntries[$expenseIndex]["desc"]);
            $result .= '"';
        }
        else if(isset($expenses[$expenseIndex])) {
            $result .= ' value="';
            $result .= htmlentities($expenses[$expenseIndex]->description);
            $result .= '"';
        }

        $result .= '> ';
        $result .= '<label for="expenseType' . $expenseIndex . '" class="altTypeLabel">Category: </label>';
        $result .= '<select id="expenseType' . $expenseIndex . '" name="expenseType' . $expenseIndex . '" class="type';
        if($inputErrors && isset($expenseEntries[$expenseIndex])) {
            if($expenseEntries[$expenseIndex]["typeError"]) {
                $result .= ' typeError';
            }
        }
        $result .= '"> ';
        foreach($expenseTypes as $expenseType) {
            $result .= '<option value="' . $expenseType->category . '"';

            if($inputErrors && isset($expenseEntries[$expenseIndex])) {
                if($expenseEntries[$expenseIndex]["type"] === $expenseType->category) {
                    $result .= "selected";
                }
            }
            else if(isset($expenses[$expenseIndex])) {
                if($expenses[$expenseIndex]->typeID === $expenseType->id) {
                    $result .= "selected";
                }
            }

            $result .= '>';
            $result .= $expenseType->category;
            $result .= '</option> ';
        }
        $result .= '</select> ';

        $result .= '<label for="expenseAmount' . $expenseIndex . '" class="altAmountLabel">Amount: </label>';             
        $result .= '<input type="text" maxlength="20" id="expenseAmount' . $expenseIndex . '" name="expenseAmount' . $expenseIndex . '" class="amount';
        if($inputErrors && isset($expenseEntries[$expenseIndex])) {
            if($expenseEntries[$expenseIndex]["amountError"]) {
                $result .= ' amountError';
            }
        }
        $result .= '" placeholder="Amount"';
        if($inputErrors && isset($expenseEntries[$expenseIndex])) {
            $result .= ' value="';
            $result .= htmlentities($expenseEntries[$expenseIndex]["amount"]);
            $result .= '"';
        }
        else if(isset($expenses[$expenseIndex])) {
            $result .= ' value="';
            $result .= htmlentities(Expense::formatDisplayAmount($expenses[$expenseIndex]->amount));
            $result .= '"';
        }
        $result .= '> ';
        
        $result .= '<label class="removeLabel">Remove: </label>';
        $result .= '<button type="button" id="deleteExpenseButton' . $expenseIndex . '" name="deleteExpenseButton' . $expenseIndex . '" class="deleteButton" title="Delete"> ';
        $result .= '&#10006;';
        $result .= '</button> ';
        $result .= '<br> ';
        $result .= '</div> ';
        $expenseIndex++;
    }while($expenseIndex < $numEntries);
        
    return $result;
}

?>

<?php
    if(isset($canEdit) && $canEdit === true) {
?>
    <form action="#" method="post" id="incomeExpensesForm">
        <?php
            if(isset($inputErrors) && $inputErrors) {
        ?>
            <p id="dataInputError">
                Descriptions must be under 30 characters long.<br>
                Amounts have a maximum value of $1,000,000,000.00
            </p>
        
        <?php
            }
        ?>
        <h3>Income:</h3>
        <div id="incomeEntries">
            <div id="incomeHeadings">
                <label class="descLabel">Description</label> <label class="typeLabel">Category</label> <label class="amountLabel">Amount</label>
            </div>
            <?php echo getIncomeEntries(); ?>
        </div>
        <button type ="button" id="addIncomeFieldButton">+ Add Another</button><br>
        
        <h3>Expenses:</h3>
        <div id="expenseEntries">
            <div id="expenseHeadings">
                <label class="descLabel">Description</label> <label class="typeLabel">Category</label> <label class="amountLabel">Amount</label>
            </div>
            <?php echo getExpenseEntries(); ?>
        </div>    
        <button type = "button" id="addExpenseFieldButton">+ Add another</button><br>

        <div id="formControlButtons">
            <button type="button" id="cancel">Cancel</button>
            <input type="submit" id="save" name="save" value="Save">
        </div>
    </form>
<?php
    }
    else {
?>
<h3>Error:</h3>
<p>You can not edit the income/expenses data for this day yet.</p>
<?php
    }
?>
