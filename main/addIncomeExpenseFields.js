const INCOME_FIELDS_LIMIT = 15;
const EXPENSE_FIELDS_LIMIT = 15;
const MAX_DESC_LENGTH = 30;

var addIncomeButton = document.getElementById("addIncomeFieldButton");
var addExpenseButton = document.getElementById("addExpenseFieldButton");
var cancelButton = document.getElementById("cancel");
var incomeEntriesDiv = document.getElementsByClassName("incomeEntry");
var expenseEntriesDiv = document.getElementsByClassName("expenseEntry");
var incomeFieldCounter = getNumIncomeFields();
var expenseFieldCounter = getNumExpenseFields();
var incomeTypes = getIncomeTypes();
var expenseTypes = getExpenseTypes();

/**
 * Returns the number of income fields
 */
function getNumIncomeFields() {
    return incomeEntriesDiv.length;
}

/**
 * Returns the number of expense fields
 */
function getNumExpenseFields() {
    return expenseEntriesDiv.length;
}

/**
 * Return all income/expense categories
 */
function getCategories(entryType) {
    var categoriesSelectElement;
    var categories = [];

    if(entryType === "income") {
        categoriesSelectElement = document.getElementById("incomeType0");
    }
    if(entryType === "expense") {
        categoriesSelectElement = document.getElementById("expenseType0");
    }

    for(var ii = 0;ii < categoriesSelectElement.children.length;ii++) {
        categories.push(categoriesSelectElement.children[ii].getAttribute("value"));
    }

    return categories;
}

/**
 * Return all income categories
 */
function getIncomeTypes() {
    return getCategories("income");
}

/**
 * Return all expense categories
 */
function getExpenseTypes() {
    return getCategories("expense");
}

/**
 * Generates a new income/expense entry
 */
function createEntry(entryType) {
    if(entryType === "income" && incomeFieldCounter >= INCOME_FIELDS_LIMIT) {
        alert("The limit number of allowed income entries has been reached");
        return false;
    }
    else if(entryType === "expense" && expenseFieldCounter >= EXPENSE_FIELDS_LIMIT) {
        alert("The limit number of allowed expense entries has been reached");
        return false;
    }
    else {
        var altDescLabel = document.createElement("label");
        var altTypeLabel = document.createElement("label");
        var altAmountLabel = document.createElement("label");
        var removeLabel = document.createElement("label");
        var div = document.createElement("div");
        var desc = document.createElement("input");
        var type = document.createElement("select");
        var amount = document.createElement("input");
        var deleteButton = document.createElement("button");
        var entryHolderName;
        
        altDescLabel.innerHTML = "Description: ";
        altDescLabel.classList.add("altDescLabel");
        altTypeLabel.innerHTML = "Category: ";
        altTypeLabel.classList.add("altTypeLabel");
        altAmountLabel.innerHTML = "Amount: ";
        altAmountLabel.classList.add("altAmountLabel");
        removeLabel.innerHTML = "Remove: ";
        removeLabel.classList.add("removeLabel");
        desc.setAttribute("type", "text");
        desc.setAttribute("placeholder", "Description");
        desc.setAttribute("maxlength", MAX_DESC_LENGTH);
        amount.setAttribute("type", "text");
        amount.setAttribute("placeholder", "Amount");
        amount.setAttribute("maxlength", "20");
        desc.classList.add("desc");
        type.classList.add("type");
        amount.classList.add("amount");
        deleteButton.innerHTML = "&#10006;";
        deleteButton.setAttribute("type","button");
        deleteButton.setAttribute("title", "Delete");
        deleteButton.classList.add("deleteButton");

        if(entryType === "income") {
            entryHolderName = "incomeEntries";

            div.classList.add("incomeEntry");
            
            for(var ii = 0;ii < incomeTypes.length;ii++) {
                type.innerHTML += '<option value="' + incomeTypes[ii] + '">' + incomeTypes[ii] + "</option>";
            }
            incomeFieldCounter++;
        }
        if(entryType === "expense") {
            entryHolderName = "expenseEntries";

            div.classList.add("expenseEntry");

            for(var ii = 0;ii < expenseTypes.length;ii++) {
                type.innerHTML += '<option value="' + expenseTypes[ii] + '">' + expenseTypes[ii] + "</option>";
            }
            expenseFieldCounter++;
        }

        div.appendChild(altDescLabel);
        div.appendChild(desc);
        div.appendChild(document.createTextNode(" "));
        div.appendChild(altTypeLabel);
        div.appendChild(type);
        div.appendChild(document.createTextNode(" "));
        div.appendChild(altAmountLabel);
        div.appendChild(amount);
        div.appendChild(document.createTextNode(" "));
        div.appendChild(removeLabel);
        div.appendChild(deleteButton);
        div.appendChild(document.createElement("br"));

        var holder = document.getElementById(entryHolderName);
        holder.appendChild(div);

        if(entryType === "income") {
            reorderEntryIds("income");
        }
        if(entryType === "expense") {
            reorderEntryIds("expenses");
        }

        deleteButton.onclick = bindDeleteButton;
    }
}

/**
 * Generate a new income entry
 */
function createIncomeEntry() {
    createEntry("income");
}

/**
 * Generates a new expense entry
 */
function createExpenseEntry() {
    createEntry("expense");
}

/**
 * Binds a delete button to delete an income or expense entry
 */
function bindDeleteButton() {
    var entryDiv = this.parentNode;
    var entryHolderDiv = entryDiv.parentNode;
    var entryType = entryHolderDiv.getAttribute("id");

    if(entryType === "incomeEntries") {
        incomeFieldCounter--;   
        if(incomeFieldCounter === 0) {
            createEntry("income");
        }
    }
    if(entryType === "expenseEntries") {
        expenseFieldCounter--;
        if(expenseFieldCounter === 0) {
            createEntry("expense");
        }
    }

    entryHolderDiv.removeChild(entryDiv);
    
    if(entryType === "incomeEntries") {
        reorderEntryIds("income");   
    }
    if(entryType === "expenseEntries") {
        reorderEntryIds("expenses");   
    }
}

/**
 * Rearrages the ids of the income/expense entries when an entry is either deleted or inserted
 */
function reorderEntryIds(entriesType) {
    var entriesToReorder;
    if(entriesType === "income") {
        entriesToReorder = document.getElementsByClassName("incomeEntry");
    }
    if(entriesType === "expenses") {
        entriesToReorder = document.getElementsByClassName("expenseEntry");
    }

    for(var ii=0;ii<entriesToReorder.length;ii++) {
        var desc;
        var type;
        var amount;
        var deleteButton;

        altDescLabel = entriesToReorder[ii].querySelector("label.altDescLabel");
        altTypeLabel = entriesToReorder[ii].querySelector("label.altTypeLabel");
        altAmountLabel = entriesToReorder[ii].querySelector("label.altAmountLabel");
        desc = entriesToReorder[ii].querySelector("input.desc");     
        type = entriesToReorder[ii].querySelector("select.type");
        amount = entriesToReorder[ii].querySelector("input.amount");
        deleteButton = entriesToReorder[ii].querySelector("button.deleteButton");

        if(entriesType === "income") {
            altDescLabel.setAttribute("for", "incomeDesc"+ii);
            desc.setAttribute("id", "incomeDesc"+ii);
            desc.setAttribute("name", "incomeDesc"+ii);
            altTypeLabel.setAttribute("for", "incomeType"+ii);
            type.setAttribute("id", "incomeType"+ii);
            type.setAttribute("name", "incomeType"+ii);
            altAmountLabel.setAttribute("for", "incomeAmount"+ii);
            amount.setAttribute("id","incomeAmount"+ii);
            amount.setAttribute("name","incomeAmount"+ii);
            deleteButton.setAttribute("id","deleteIncomeButton"+ii);
            deleteButton.setAttribute("name","deleteIncomeButton"+ii);
        }
        if(entriesType === "expenses") {
            altDescLabel.setAttribute("for", "expenseDesc"+ii);
            desc.setAttribute("id","expenseDesc"+ii);
            desc.setAttribute("name","expenseDesc"+ii);
            altTypeLabel.setAttribute("for", "expenseType"+ii);
            type.setAttribute("id","expenseType"+ii);
            type.setAttribute("name","expenseType"+ii);
            altAmountLabel.setAttribute("for", "expenseAmount"+ii);
            amount.setAttribute("id","expenseAmount"+ii);
            amount.setAttribute("name","expenseAmount"+ii);
            deleteButton.setAttribute("id","deleteExpenseButton"+ii);
            deleteButton.setAttribute("name","deleteExpenseButton"+ii);
        }
    }
}

addIncomeButton.onclick = createIncomeEntry;
addExpenseButton.onclick = createExpenseEntry;

// Reload the page when the cancel button is clicked
cancelButton.onclick = function() {
    location.reload();
};

for(var ii=0;ii<incomeEntriesDiv.length;ii++) {
    incomeEntriesDiv[ii].querySelector("button.deleteButton").onclick = bindDeleteButton;
}

for(var ii=0;ii<expenseEntriesDiv.length;ii++) {
    expenseEntriesDiv[ii].querySelector("button.deleteButton").onclick = bindDeleteButton;
}

