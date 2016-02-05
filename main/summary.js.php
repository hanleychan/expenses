<script type="text/javascript">
    var totalIncome = <?php echo htmlentities($totalIncome); ?>;
    var totalExpenses = <?php echo htmlentities($totalExpenses); ?>;
    var totalIncomeDisplayString = "<?php echo htmlentities(Income::formatDisplayAmount($totalIncome)); ?>";
    var totalExpensesDisplayString = "<?php echo htmlentities(Expense::formatDisplayAmount($totalExpenses)); ?>";
    var totalTitle = "Income/Expenses";
    var incomeTitle = "Income";
    var expensesTitle = "Expenses";

    var totalChartArray = [<?php echo '["Type", "Amount"], ["Income", totalIncome], ["Expenses", totalExpenses]'; ?>];
    var incomeChartArray = [["Category", "Amount"],
        <?php
            foreach($incomeTypeAmounts as $index => $incomeTypeAmount) {
                echo "['" . htmlentities($incomeTypeAmount["type"]) . "', " . htmlentities($incomeTypeAmount["amount"]) . "]";
                if($index !== count($incomeTypeAmounts) - 1) {
                    echo ", ";
                }
                
            }
        ?>
    ];
    var expenseChartArray = [["Category", "Amount"],
        <?php
            foreach($expenseTypeAmounts as $index => $expenseTypeAmount) {
                echo "['" . htmlentities($expenseTypeAmount["type"]) . "', " . htmlentities($expenseTypeAmount["amount"]) . "]";
                if($index !== count($expenseTypeAmounts) - 1) {
                    echo ", ";
                }
                
            }
        ?>
    ];
</script>

