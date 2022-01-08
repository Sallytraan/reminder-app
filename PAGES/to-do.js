"use strict";

toDo();

function toDo(){
    //Hamna högst upp på sidan
    scroll(0,0)  
  
    // Uppdaterar naven

    navList.classList.add("navListSelected");
    navList.classList.remove("navListBlack");

    navFocus.classList.remove("navFocusSelected");
    navFocus.classList.add("navFocusBlack");

    navProfile.classList.remove("navProfileSelected");
    navProfile.classList.add("navProfileBlack");

    //Töm nuvarande innehåll i wrapper
    wrapper.innerHTML = "";
    
    // gör att navven ändrar färg.
    navList.classList.add("selectedNav");
    navFocus.classList.remove("selectedNav");
    navProfile.classList.remove("selectedNav");
    
    // hämtar API:n (listan med tasks)
    fetch("/API/list.json")
        .then(response => response.json())
        .then(json => taskData(json));

    function taskData(json) {
        console.log(json.ongoing[1]);   
        
        // kunna nå de två olika arrayerna i list.json. De tar inte med json när den uppdaterar. 'delete-knappen' funkar men inte denna sen... varför?
        // är det för ongoing-json inte längre är en array? konstigt
        let ongoingArray = json.ongoing;
        let completedArray = json.finished;

        wrapper.innerHTML = `
            <div id="toDoWrapper">
                <h3>To Do</h3>
                <div id="ongoing">
                </div>
                <div id='addTask'>
                    <a href="/PAGES/create-task.php"><img src='/ICONS_BLACK/add-icon.svg' alt='list'></a>
                </div>

                <div id="progressBar">
                    <p> ${completedArray.length - 1}</p>
                    <p><img src="../ICONS_BLACK/trophy-icon.svg"></p>
                </div>
                <div id="completed">
                    <h3>Completed</h3>
                </div>
            </div>
            `;

        let ongoingWrapper = document.getElementById("ongoing");

        ongoingArray.forEach(obj => {
            //console.log(obj); // ska visa alla objekt i arrayen. Kolla för säkerhets skull.
            
            if (obj.user == ID) {
                // vi vill komma åt 'task' + 'date'
                let div = document.createElement("div");
                
                // TA BORT CREATE-TASK FÖR JAG LYCKAS INTE MED SKITET
                div.innerHTML = `
                    <div class="taskBox">
                        <div class="taskText">
                            <p class="task"> ${obj.task}</p>            
                            <p class="date"> ${obj.date} </p>
                        </div>
                        
                        <div class="taskButtons">
                            <a href="/PAGES/create-task.php?id=${obj.id}"><img class="editIcon" src='../ICONS_BLACK/pencil-icon.svg' alt='edit'></a>
                            <a href="/ADMIN/delete.php?id=${obj.id}"><img class="removeIcon" src='../ICONS_BLACK/remove-icon.svg' alt='remove'></a>
                            <img class="clearIcon" src='/ICONS_BLACK/check-icon.svg' alt='checkmark'>
                        </div>
                    </div>`;
    
                ongoingWrapper.append(div);            
            }
        });
    } 

    // funktion som randomiserar mellan "max"-siffran.
    function getRandomInt(max) {
        return Math.floor(Math.random() * max);
    }

    // hämtar quotes från någonstans.
    fetch("https://type.fit/api/quotes")
    .then(response => {
        return response.json();
    })
    .then(data => {
        //console.log(data);
        let quoteDiv = document.createElement("div");
        quoteDiv.classList.add("quoteBox");

        let randomNumbers = getRandomInt(200);
        let randomQuote = data[randomNumbers];

        quoteDiv.innerHTML = `
        <p> “${randomQuote.text}”</p>
        <p> ______</p>
        <p> ${randomQuote.author} </p>`;

        document.getElementById("toDoWrapper").prepend(quoteDiv);
    }); 
}
