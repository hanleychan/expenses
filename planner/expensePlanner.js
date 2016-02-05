const MAX_SPENDING_LIMIT = 9999999999;
const MAX_SPENDING_PER_CATEGORY = 999999;

var expensesInputDiv = document.getElementById("expensesInput");
var spendingLimitInput = document.getElementById("spendingLimitInput");
var expensesInputDivChildren = expensesInputDiv.children;
var resetButton = document.getElementById("reset");

var mq = window.matchMedia("(min-width: 650px)");

var housingCategories = ["Housing", ["Rent", "rent"], ["Utilities","utilities"], ["Other", "otherHousing"]]; // ["Category", [label , id], ..]
var transportationCategories = ["Transportation", ["Car Payment", "carPayment"], ["Gas", "gas"], ["Public Transit", "publicTransit"], ["Taxi", "taxi"], ["Other", "otherTransporation"]];
var personalCategories = ["Personal", ["Personal Care", "personalCare"], ["Clothes", "clothes"], ["Other", "otherPersonal"]];
var foodCategories = ["Food", ["Groceries", "groceries"], ["Dining Out", "diningOut"], ["Other", "otherFood"]];
var entertainmentCategories = ["Entertainment", ["Movies", "movies"], ["Video Games", "videoGames"], ["Other", "otherEntertainment"]];
var educationCategories = ["Education", ["Tuition", "tuition"], ["Other", "otherEducation"]];
var otherCategories = ["Other", ["Other", "otherOther"]];

var categoryObjects = [];

function Category(category, label, id, value) {
    this.category = category;
    this.label = label;
    this.id = id;
    this.value = value;
}

/**
 * Generates a new expense field
 */
Category.prototype.generateExpenseField = function() {
    var result = "";
    result += '<label for="' + this.id + '">' + this.label + ': </label> ';
    result += '$ <input type="text" id="' + this.id + '" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="' + MAX_SPENDING_PER_CATEGORY.toString().length + '"><br> ';
    return result;
};

/**
 * Makes the summary info scroll with the page
 */
function scrollFunction() {
    var scrollPos = document.documentElement.scrollTop || document.body.scrollTop;
    if(mq.matches) {
        if (scrollPos > 250) {
            document.getElementById("results").style.position = "fixed";
            document.getElementById("results").style.top = "0%";
        } else {
            document.getElementById("results").style.position = "absolute";
            document.getElementById("results").style.top = "auto";
        }
    }
}

/**
 * Moves the summary info when the browser is resized
 */
function resizeFunction() {
    if(!mq.matches) {
        document.getElementById("results").style.position = "static";
    }
    else {
        document.getElementById("results").style.position = "absolute";
        document.getElementById("results").style.top = "auto";
    }
}

/**
 * Generates all fields for a category
 */
function generateExpensesFields(categoryArray) {
    expensesInputDiv.innerHTML += "<h4>" + categoryArray[0] + "</h4> ";
    for(var ii = 1; ii < categoryArray.length; ii++) {
        var category = new Category(categoryArray[0], categoryArray[ii][0], categoryArray[ii][1], 0);
        categoryObjects.push(category);

        expensesInputDiv.innerHTML += category.generateExpenseField();
    }
}

/**
 * Update the summary
 */
function updateSummary() {
    var leftover = document.getElementById("savings");
    var spendingLimit = parseInt(spendingLimitInput.value);
    var totalExpenses = 0;
    var netTotal;

    if(isNaN(spendingLimit)) {
        spendingLimit = 0;
    }

    for(var ii = 0; ii < categoryObjects.length; ii++) {
        totalExpenses += parseInt(categoryObjects[ii].value);
    }
    netTotal = spendingLimit - totalExpenses; 
    if(netTotal >= 0) {
        savings.innerHTML = "Leftover: $" + netTotal;
    }
    else {
        savings.innerHTML = "Leftover: -$" + (netTotal * -1);
    }
}

/**
 * Update the value of an expense
 */
function updateValue(categoryId, value) {
    for(var ii = 0; ii < categoryObjects.length; ii++) {
        if(categoryObjects[ii].id === categoryId) {
            categoryObjects[ii].value = value;
            break;
        }
    }
}

/**
 * Process data when the income input is changed
 */
spendingLimitInput.onchange = function() {
    var value;
    if(spendingLimitInput.value > MAX_SPENDING_LIMIT) {
        spendingLimitInput.value = MAX_SPENDING_LIMIT;
    }
    if(this.value < 0) {
        this.value = 0;
    }
    else if(this.value > MAX_SPENDING_LIMIT) {
        this.value = MAX_SPENDING_LIMIT;
    }

    updateSummary();
}

/**
 * Bind reset button to reset all form data
 */
resetButton.onclick = function() {
    for(var ii = 0; ii < categoryObjects.length; ii++) {
        categoryObjects[ii].value = 0;
    }
    document.getElementById("spendingLimitInput").value = 0;
    updateSummary();
};

window.onresize = resizeFunction;
window.onscroll = scrollFunction;

generateExpensesFields(housingCategories);
generateExpensesFields(transportationCategories);
generateExpensesFields(personalCategories);
generateExpensesFields(foodCategories);
generateExpensesFields(entertainmentCategories);
generateExpensesFields(educationCategories);
generateExpensesFields(otherCategories);

/**
 * Update the value of an expense and summary info when any expense input is changed
 */
for(var ii = 0; ii < expensesInputDivChildren.length;ii++) {
    if(expensesInputDivChildren[ii].tagName === "INPUT") {
        expensesInputDivChildren[ii].onchange = function() {
            if(this.value < 0) {
                this.value = 0;
            }
            else if(this.value > MAX_SPENDING_PER_CATEGORY) {
                this.value = MAX_SPENDING_PER_CATEGORY; 
            }

            this.value = Math.round(this.value * 100) / 100;
            updateValue(this.getAttribute("id"), this.value);
            updateSummary();
        };
    }
}

