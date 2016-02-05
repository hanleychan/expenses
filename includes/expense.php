<?php

class Expense extends IncomeExpenseObject {
    protected static $table_name = "expenses";
    protected static $db_fields = array('id', 'userID', 'amount', 'typeID', 'description', 'date');
}

?>
