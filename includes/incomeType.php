<?php

class IncomeType extends IncomeExpenseTypeObject {
    protected static $table_name = "incometypes";
    protected static $db_fields = array('id','userID','category');
}

?>
