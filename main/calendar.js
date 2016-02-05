var calendar = document.getElementById("calendar");
var prevCalendar = document.getElementById("prevCalendar");
var nextCalendar = document.getElementById("nextCalendar");
var originalMonth = selectedMonth;
var originalDay = selectedDay;
var originalYear = selectedYear;
var decade = selectedYear - parseInt(selectedYear.toString().substr(3,3));

const MIN_YEAR = 1970;
const MAX_YEAR = 2099;
const MIN_DECADE = MIN_YEAR - parseInt(MIN_YEAR.toString().substr(3,3));
const MAX_DECADE = MAX_YEAR - parseInt(MAX_YEAR.toString().substr(3,3));

/**
 * Converts the numeric value of a month into its month name
 */
function monthNumberToName(monthNumber) {
    switch(monthNumber) {
        case 1:
            return "January";
        case 2:
            return "February";
        case 3: 
            return "March";
        case 4:
            return "April";
        case 5:
            return "May";
        case 6:
            return "June";
        case 7:
            return "July";
        case 8:
            return "August";
        case 9:
            return "September";
        case 10:
            return "October";
        case 11:
            return "November";
        case 12:
            return "December";
    }
}

/**
 * Updates the calendar heading (e.g. month name)
 */
function updateCalendarHeading(headingText) {
    var calendarHeading = document.getElementById("calendarHeading");
    var calendarHeadingText = document.getElementById("calendarHeadingText");
    var nextMonth = document.getElementById("nextCalendar");

    // remove old heading text
    calendarHeading.removeChild(calendarHeadingText);

    // Create new heading text and insert it in place of the old one
    var newHeadingText = document.createElement("span");
    newHeadingText.setAttribute("id", "calendarHeadingText");
    newHeadingText.innerHTML = headingText;
    calendarHeading.insertBefore(newHeadingText, nextCalendar);
}

/**
 * Updates all the days of the calendar (daily view)
 */
function updateDays(month, year) {
    var days = document.getElementById("days");
    var newDays = document.createElement("ul");

    // remove the old calendar days
    calendar.removeChild(days);

    var numDaysInMonth = numberOfDaysInMonth(selectedMonth, selectedYear);

    var numBlanksBeforeFirstDay = (new Date(selectedYear, (selectedMonth-1), 1)).getDay();
    var numBlanksAfterLastDay = 42 - numDaysInMonth - numBlanksBeforeFirstDay;
    newDays.setAttribute("id", "days");

    for(var ii = 0; ii < numBlanksBeforeFirstDay; ii++) {
        var emptyListElement = document.createElement("li");
        newDays.appendChild(emptyListElement);
        newDays.appendChild(document.createTextNode(" "));
    }

    for(var ii = 1; ii <= numDaysInMonth; ii++) {
        var dayListElement = document.createElement("li");
        var dayAnchor = document.createElement("a");
        
        dayAnchor.setAttribute("href", "?month=" + selectedMonth + "&day=" + ii + "&year=" + selectedYear);
        dayAnchor.innerHTML = ii;

        if(selectedYear == originalYear && selectedMonth == originalMonth && selectedDay == ii) {
            dayListElement.setAttribute("id", "currentDay");
        }

        dayListElement.appendChild(dayAnchor);

        newDays.appendChild(dayListElement);
        newDays.appendChild(document.createTextNode(" "));
    }

    for(var ii = 0; ii < numBlanksAfterLastDay; ii++) {
        var emptyListElement = document.createElement("li");
        newDays.appendChild(document.createTextNode(" "));
        newDays.appendChild(emptyListElement);
    }

    calendar.appendChild(newDays);
}

/**
 * Updates all the months in the calendar (monthly view)
 */
function updateMonths(year) {
    var months = document.getElementById("months");
  
    calendar.removeChild(months);

    var newMonths = document.createElement("ul");
    newMonths.setAttribute("id", "months");

    for(var ii = 1; ii <= 12; ii++) {
        var monthListElement = document.createElement("li");
        var monthAnchor = document.createElement("a");
        
        if(ii === originalMonth && selectedYear === originalYear) { 
            monthListElement.setAttribute("id", "currentMonth");
        }
        monthAnchor.setAttribute("href", "?view=monthly&month=" + ii + "&year=" + selectedYear);
        monthAnchor.innerHTML = monthNumberToName(ii).substring(0,3);
        monthListElement.appendChild(monthAnchor);

        newMonths.appendChild(monthListElement);
    }

    calendar.appendChild(newMonths);
}

/**
 * Updates all the years in the calendar (yearly view)
 */
function updateYears(decade) {
    var years = document.getElementById("years");
    calendar.removeChild(years);

    var newYears = document.createElement("ul");
    newYears.setAttribute("id", "years");

    for(var ii = decade; ii < decade+10; ii++) {
        var yearListElement = document.createElement("li");
        var yearAnchor = document.createElement("a");

        yearAnchor.setAttribute("href", "?view=yearly&year=" + ii);

        if(ii === originalYear) {
            yearListElement.setAttribute("id", "currentYear");
        }

        yearAnchor.innerHTML = ii;
        
        yearListElement.appendChild(yearAnchor);
        newYears.appendChild(yearListElement);
    }

    for(var ii = 0; ii < 2; ii++) {
        var emptyListElement = document.createElement("li");
        newYears.appendChild(emptyListElement);
    }

    calendar.appendChild(newYears);
}

/**
 * Fetches the days of the previous month and updates the calendar (daily view)
 */
function showPrevMonth() {
    var update = true;

    if(selectedMonth !== 1) {
        selectedMonth -= 1;
    }
    else {
        if(selectedYear !== MIN_YEAR) {
            selectedMonth = 12;
            selectedYear -= 1;
        }
        else {
            update = false;
        }
    }

    if(update === true) {
        updateCalendarHeading(monthNumberToName(selectedMonth) + " " + selectedYear);
        updateDays(selectedMonth, selectedYear);
    }
}

/**
 * Fetches the days of the next month and updates the calendar (daily view)
 */
function showNextMonth() {
    var update = true;

    if(selectedMonth !== 12) {
        selectedMonth += 1;
    }
    else {
        if(selectedYear !== MAX_YEAR) {
            selectedMonth = 1;
            selectedYear += 1;
        }
        else {
            update = false;
        }
    }

    if(update === true) {
        updateCalendarHeading(monthNumberToName(selectedMonth) + " " + selectedYear);
        updateDays(selectedMonth, selectedYear);
    }
}

/**
 * Fetches the months of the previous year and updates the calendar (monthly view)
 */
function showPrevYear() {
    var update = true;

    if(selectedYear !== MIN_YEAR) {
        selectedYear--;
    }
    else {
        update = false;
    }

    if(update === true) {
        updateCalendarHeading(selectedYear);
        updateMonths(selectedYear);
    }
}

/**
 * Fetches the months of the next year and updates the calendar (monthly view)
 */
function showNextYear() {
    var update = true;

    if(selectedYear !== MAX_YEAR) {
        selectedYear++;
    }
    else {
        update = false;
    }

    if(update === true) {
        updateCalendarHeading(selectedYear);
        updateMonths(selectedYear);
    }
}

/**
 * Fetches the years of the previous decade and updates the calendar (yearly view)
 */
function showPrevDecade() {
    var update = true;
    
    if(decade !== MIN_DECADE) {
        decade -= 10;
    }
    else {
        update = false;
    }

    if(update === true) {
        updateCalendarHeading(decade);
        updateYears(decade);
    }
}

/**
 * Fetches the years of the next decade and updates the calendar (yearly view)
 */
function showNextDecade() {
    var update = true;

    if(decade !== MAX_DECADE) {
        decade += 10;
    }
    else {
        update = false;
    }

    if(update === true) {
        updateCalendarHeading(decade);
        updateYears(decade);
    }
}

/**
 * Show the previous calendar based on the view
 */
function showPrevCalendar() {
    if(selectedMonth !== false && selectedDay !== false && selectedYear !== false) {
        showPrevMonth();
    }
    else if (selectedMonth !== false && selectedDay === false && selectedYear !== false) {
        showPrevYear();
    }
    else if (selectedMonth === false && selectedDay === false && selectedYear !== false) {
        showPrevDecade();
    }
}

/**
 * Show the next calendar based on the view
 */
function showNextCalendar() {
    if(selectedMonth !== false && selectedDay !== false && selectedYear !== false) {
        showNextMonth();
    }
    else if (selectedMonth !== false && selectedDay === false && selectedYear !== false) {
        showNextYear();
    }
    else if (selectedMonth === false && selectedDay === false && selectedYear !== false) {
        showNextDecade();
    }
}

prevCalendar.onclick = showPrevCalendar; 
nextCalendar.onclick = showNextCalendar;
