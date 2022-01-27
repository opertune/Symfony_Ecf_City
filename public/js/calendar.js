window.addEventListener("load", function () {
    showCalendar()
    // display month name if french
    monthName(year, month)
});

const month_fr = ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre']
let year = 2022
// jan = 00
let month = 00
let day = []

// Return first day in a month (Sunday - Saturday : 0 - 6)
function firstDayInMonth() {
    return new Date(year, month, 1).getDay()
}

// Previous month
function previous() {
    month--
    if (month < 00) {
        month = 11
    }
    monthName(year, month)
}

// Next month
function next() {
    month++
    if (month > 11) {
        month = 00
    }
    monthName(year, month)
}

// Display month name
function monthName(year, month) {
    document.getElementById("month").innerHTML = month_fr[new Date(year, month, 1).getMonth()] + " " + year
    // Delete previous month tbody
    document.getElementById("calendar").removeChild(document.getElementById("tbody"))
    showCalendar()
}

// Return number of day in a month
function dateInMonth(month, year) {
    return new Date(year, month, 0).getDate()
}

// Display calendar
function showCalendar() {
    let fDay = firstDayInMonth()
    // Number of day in a month
    let max = dateInMonth(month + 1, year)

    // Create new table body
    let tbody = document.createElement("tbody")
    tbody.id = "tbody"
    document.getElementById("calendar").appendChild(tbody)

    // Create 6 tr in tbody
    for (i = 1; i <= 6; i++) {
        let tr = document.createElement("tr")
        tr.id = "tr" + i
        tr.className = "calendarTr"
        document.getElementById("tbody").appendChild(tr)
    }

    let id = 1
    for (i = 1; i < max + fDay; i++) {
        // if firstday = saturday
        if (fDay == 0) {
            fDay = 7
        }

        // Create blank td 
        if (i < fDay) {
            let td_void = document.createElement("td")
            td_void.id = "tdvoid" + i
            td_void.className = "calendarTdVoid"
            td_void.innerHTML = ""
            document.getElementById("tr" + id).appendChild(td_void)
        } else {// Create box for every day
            // every day in month
            let td = document.createElement("td")
            td.id = i - fDay + 1
            td.className = "calendarTd"
            td.innerHTML = "<div id=\"" + td.id + "\"class=\"container\" data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\" onclick=\"\"><div class=\"col\">" + td.id + "</div>"

            document.getElementById("tr" + id).appendChild(td)
        }
        // Change tr id
        if (i % 7 == 0) {
            id++
        }
    }
}
