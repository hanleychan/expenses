google.load("visualization", "1", {packages:["corechart"]});
google.load("visualization", "1.1", {packages:["table"]});
google.setOnLoadCallback(drawTotalChart);
google.setOnLoadCallback(drawIncomeChart);
google.setOnLoadCallback(drawExpensesChart);

/**
 * Draw the chart for income/expense data
 */
function drawTotalChart() {
    var data = new google.visualization.arrayToDataTable(totalChartArray);

    var formatter = new google.visualization.NumberFormat({
        prefix: '$'
    });
    formatter.format(data,1);
    var options = {
        sliceVisibilityThreshold: 0,
        title: totalTitle,
        chartArea: {left:30, top: 30, width: "80%", height: "70%"}
    };

    var chart = new google.visualization.PieChart(document.getElementById('totalChart'));

    chart.draw(data, options);
}

/**
 * Draw the chart for income data by categories
 */
function drawIncomeChart() {
    var data = new google.visualization.arrayToDataTable(incomeChartArray);

    var formatter = new google.visualization.NumberFormat({
        prefix: '$'
    });
    formatter.format(data,1);
    var options = {
      sliceVisibilityThreshold: 0,
      title: incomeTitle,
      chartArea: {left:30, top: 30, width: "80%", height: "70%"}
    };

    var chart = new google.visualization.PieChart(document.getElementById('incomeChart'));

    chart.draw(data, options);
}

/**
 * Draw the chart for expense data by categories
 */
function drawExpensesChart() {
    var data = new google.visualization.arrayToDataTable(expenseChartArray);

    var formatter = new google.visualization.NumberFormat({
        prefix: '$'
    });
    formatter.format(data,1);

    var options = {
      sliceVisibilityThreshold: 0,
      title: expensesTitle,
      chartArea: {left:30, top: 30, width: "80%", height: "70%"}
    };

    var chart = new google.visualization.PieChart(document.getElementById('expensesChart'));

    chart.draw(data, options);
}

/**
 * Redraw the charts when the browser is resized
 */
function resize() {
    drawTotalChart();
    drawIncomeChart();
    drawExpensesChart();
}

window.onresize = resize;
