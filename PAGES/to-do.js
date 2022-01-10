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
    <div id="toDoCircleOne"></div>
    <div id="toDoCircleTwo"></div>
        <div id="toDoBox">
            <h3>To Do</h3>
            <div id="sortButtons">
                <p id="date">date</p>
                <p id="priority">priority</p>
                <p id="aToZ">a › z</p>
            </div>
        </div>
        <div id="ongoing">
        </div>
        <div id='addTask'>
            <a href="/PAGES/create-task.php"><img src='/ICONS_BLACK/add-icon.svg' alt='list'></a>
        </div>

        <div id="progressBar">
            <p class="compTaskCount"></p>
            <p><img src="../ICONS_BLACK/trophy-icon.svg"></p>
        </div>
        <h3>Completed</h3>
        <div id="completed">
        </div>
    </div>
    `;

    // gör att man kan se innehållet från json.
    function taskData(json) {
        console.log(json); // radera
        
        let ongoingArray = json;
        let ongoingWrapper = document.getElementById("ongoing");

        showList(ongoingArray);
        document.getElementById("date").classList.add("chosen");
        // ska göra ongoing-array men med for-loop
        function showList(array) {
            document.querySelector("#ongoing").innerHTML="";
            
            array.forEach(obj => {
                if (obj.user == ID) {
                    // vi vill komma åt 'task' + 'date'
                    let div = document.createElement("div");
                    div.classList.add("taskBox");
                    
                    div.innerHTML = `
                        <div class="taskText">
                            <p class="task"> ${obj.task}</p>            
                            <p class="date"> ${obj.date} </p>
                        </div>
                            
                        <div class="taskButtons">
                            <a href="/API/deleteTaskFromUser.php?id=${obj.id}"><img class="removeIcon" src='../ICONS_BLACK/remove-icon.svg' alt='remove'></a>
                            <a href="/API/moveTaskToFinished.php?id=${obj.id}"><img class="clearIcon" src='/ICONS_BLACK/check-icon.svg' alt='checkmark'></a>
                        </div>`;

                    // vilken färg boxarna ska ha beroende på prioritering.
                    if (obj.priority === 0) {
                        div.style.backgroundColor = "#FFA19B";
                    } else if (obj.priority === 1) {
                        div.style.backgroundColor = "#FFD79B";
                    } else {                        
                        div.style.backgroundColor = "#9BFFB7";
                    } 
        
                    ongoingWrapper.append(div);   
                }
            });
        }

        // visar den med högst prioritet längst upp.
        document.getElementById("priority").addEventListener("click", () => {
            let priorityList = ongoingArray.sort((n1, n2) => n1.priority < n2.priority ? -1 : 1)
            
            document.getElementById("date").classList.remove("chosen");
            document.getElementById("aToZ").classList.remove("chosen");
            document.getElementById("priority").classList.add("chosen");
            
            document.getElementById("ongoing").style.opacity = 0;

            // fade in
            setTimeout(() =>{
                showList(priorityList);
                document.getElementById("ongoing").style.opacity = 1;
            }, 800);
        });

        // visar listan i bokstavsordning.
        document.getElementById("aToZ").addEventListener("click", () => {
            let alphabetList = ongoingArray.sort((n1, n2) => n1.task < n2.task ? -1 : 1)

            document.getElementById("date").classList.remove("chosen");
            document.getElementById("priority").classList.remove("chosen");
            document.getElementById("aToZ").classList.add("chosen");
            
            document.getElementById("ongoing").style.opacity = 0;

            // fade in
            setTimeout(() =>{
                showList(alphabetList);
                document.getElementById("ongoing").style.opacity = 1;
            }, 800);
        });

        // visar listan i bokstavsordning.
        document.getElementById("date").addEventListener("click", () => {
            let dateList = ongoingArray.sort((n1, n2) => n1.date < n2.date ? -1 : 1)
                
            document.getElementById("aToZ").classList.remove("chosen");
            document.getElementById("priority").classList.remove("chosen");
            document.getElementById("date").classList.add("chosen");

            document.getElementById("ongoing").style.opacity = 0;

            // fade in
            setTimeout(() =>{
                showList(dateList);
                document.getElementById("ongoing").style.opacity = 1;
            }, 800);
        });
    } 

    function finishedTaskData(json) {
        let completedArray = json;
        let completedWrapper = document.getElementById("completed");
        let taskCounter = document.querySelector(".compTaskCount");
        let taskCountArray = [];

        console.log(completedArray);

        completedArray.forEach(obj => {            
            if (obj.user == ID) {
                let div = document.createElement("div");
                div.classList.add("completedTaskBox");
                
                div.innerHTML = `
                    <div class="taskText">
                        <p class="task"> ${obj.task}</p>            
                        <p class="date"> ${obj.date} </p>
                    </div>`;

                if (obj.priority === 0) {
                    div.style.backgroundColor = "#FFA19B";
                } else if (obj.priority === 1) {
                    div.style.backgroundColor = "#FFD79B";
                } else {                        
                    div.style.backgroundColor = "#9BFFB7";
                }        
    
                completedWrapper.append(div);
                taskCountArray.push(obj.task);       
            }
        });

        taskCounter.innerHTML = taskCountArray.length;
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
