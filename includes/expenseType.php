<?php
class ExpenseType extends IncomeExpenseTypeObject {
    protected static $table_name = "expensetypes";
    protected static $db_fields = array('id','userID','category');
}

?>
