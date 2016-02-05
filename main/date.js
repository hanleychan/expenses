var dailyDatePicker = document.getElementsByClassName("dailyDatePicker");

/**
 * Returns the number of days of a specified month
 */
function numberOfDaysInMonth(month,year) {
    var date = new Date(year, month, 0);
    return date.getDate();
}

/**
 * Update selectable days to only show valid values when the month or year is changed (daily view)
 */
var updateSelectableDates = function() {
    var selectedMonth = document.getElementById("monthPicker");
    var selectedDay = document.getElementById("dayPicker");
    var selectedYear = document.getElementById("yearPicker");
    var numDaysInMonth = numberOfDaysInMonth(selectedMonth.value, selectedYear.value);

    var result = "";
    for(var ii=1;ii<=numDaysInMonth;ii++) {
        result += "<option";
        result += ' value = "' + ii + '"';
        if(selectedDay.value > numDaysInMonth) {
            if(ii == numDaysInMonth) {
                result += ' selected = "selected"';
            }
        }
        else {
            if(ii == selectedDay.value) {
                result += ' selected = "selected"';
            }
        }
        result += ">" + ii + "</option>";
    }
    selectedDay.innerHTML=result;
}

for(var ii=0;ii < dailyDatePicker.length;ii++) {
    dailyDatePicker[ii].onchange = updateSelectableDates;
}
