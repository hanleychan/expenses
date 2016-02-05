<?php
define("BASE_URL", "/money/");
define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"] . "/money/");

date_default_timezone_set('America/Vancouver');

require_once(ROOT_PATH . "includes/helpers.php");
require_once(ROOT_PATH . "includes/db_config.php");
require_once(ROOT_PATH . "includes/database.php");
require_once(ROOT_PATH . "includes/session.php");
require_once(ROOT_PATH . "includes/databaseObject.php");
require_once(ROOT_PATH . "includes/user.php");
require_once(ROOT_PATH . "includes/currency.php");
require_once(ROOT_PATH . "includes/incomeExpenseTypeObject.php");
require_once(ROOT_PATH . "includes/incomeType.php");
require_once(ROOT_PATH . "includes/expenseType.php");
require_once(ROOT_PATH . "includes/incomeExpenseObject.php");
require_once(ROOT_PATH . "includes/income.php");
require_once(ROOT_PATH . "includes/expense.php");
require_once(ROOT_PATH . "includes/wishlistItem.php");
require_once(ROOT_PATH . "includes/wishlistGroup.php");
?>
