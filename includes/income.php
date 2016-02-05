<?php

class Income extends IncomeExpenseObject {
    protected static $table_name = "incomes";
    protected static $db_fields = array('id', 'userID', 'amount', 'typeID', 'description', 'date');
}

?>
