"use strict";

toDo();

function toDo(){
    //Hamna högst upp på sidan
    scroll(0,0)  

    // hämtar API:n (listan med tasks)
    fetch("/API/ongoingList.json")
      .then(response => response.json())
      .then(json => taskData(json));

    fetch ("/API/finishedList.json")
        .then(response => response.json())
        .then(json => finishedTaskData(json));
  
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

    wrapper.innerHTML = `
    <div id="toDoWrapper">
        <h3>To Do</h3>
        <div id="ongoing">
        </div>
        <div id='addTask'>
            <a href="/PAGES/create-task.php"><img src='/ICONS_BLACK/add-icon.svg' alt='list'></a>
        </div>

        <div id="progressBar">
            <p class="compTaskCount"></p>
            <p><img src="../ICONS_BLACK/trophy-icon.svg"></p>
        </div>
        <div id="completed">
            <h3>Completed</h3>
        </div>
    </div>
    `;

    // gör att man kan se innehållet från json.
    function taskData(json) {
        console.log(json); // radera
        
        let ongoingArray = json;
        let ongoingWrapper = document.getElementById("ongoing");

        // ska göra ongoing-array men med for-loop

        ongoingArray.forEach(obj => {
            if (obj.user == ID) {
                // vi vill komma åt 'task' + 'date'
                let div = document.createElement("div");
                
                div.innerHTML = `
                    <div class="taskBox">
                        <div class="taskText">
                            <p class="task"> ${obj.task}</p>            
                            <p class="date"> ${obj.date} </p>
                        </div>
                        
                        <div class="taskButtons">
                            <a href="/API/deleteTaskFromUser.php?id=${obj.id}"><img class="removeIcon" src='../ICONS_BLACK/remove-icon.svg' alt='remove'></a>
                            <a href="/API/moveTaskToFinished.php?id=${obj.id}"><img class="clearIcon" src='/ICONS_BLACK/check-icon.svg' alt='checkmark'></a>
                        </div>
                    </div>`;
    
                ongoingWrapper.append(div);   
            }

            let taskBox = document.querySelector(".taskBox");

                if (obj.priority === 0) {
                    taskBox.style.backgroundColor = "#FFA19B";
                } else if (obj.priority === 1) {
                    taskBox.style.backgroundColor = "#FFD79B";
                } else {
                    taskBox.style.backgroundColor = "#9BFFB7";
                }

        });
    } 

    function finishedTaskData(json) {
        let completedArray = json;
        let completedWrapper = document.getElementById("completed");
        let taskCounter = document.querySelector(".compTaskCount");
        taskCounter.innerHTML = completedArray.length;
        console.log(completedArray);

        completedArray.forEach(obj => {            
            if (obj.user == ID) {
                let div = document.createElement("div");
                
                div.innerHTML = `
                    <div class="completedTaskBox">
                        <div class="taskText">
                            <p class="task"> ${obj.task}</p>            
                            <p class="date"> ${obj.date} </p>
                        </div>
                    </div>`;
    
                completedWrapper.append(div);            
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
        <p>______</p>
        <p> ${randomQuote.author} </p>`;

        document.getElementById("toDoWrapper").prepend(quoteDiv);
    }); 
}
