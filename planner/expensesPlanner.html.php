<section id="tools">
    <h2>Expenses Planner:</h2>
    <p>Enter your monthly expenses</p>
    <form id="expensesPlannerForm">

        <div id="content">
            <div id="incomeInput">
                <label>Income: </label>
                $ <input type="text" id="spendingLimitInput" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="10"><br>
                <input type="reset" id="reset">
            </div>

            <div id="expensesInput">
            </div>
            
            <div id="results">
                <h4>Summary:</h4>

                <div id="expensesSummary">
                </div>

                <p id="savings">Leftover: $0</p>
            </div>
        </div>

    </form> 
    <p id="return"><a href="<?php echo BASE_URL . "planner/?view=tools"; ?>">Return to Tools</a></p>
</section>

