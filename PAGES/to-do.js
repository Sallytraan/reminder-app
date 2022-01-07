"use strict";

toDo();

function toDo(){
    //Hamna högst upp på sidan
    scroll(0,0)  
  
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
        console.log(json);   
        
        // kunna nå de två olika arrayerna i list.json
        let ongoingArray = json["ongoing"];
        let completedArray = json["finished"];

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
    
                div.innerHTML = `
                    <div class="taskBox">
                        <div class="taskText">
                            <p class="task"> ${obj.task}</p>            
                            <p class="date"> ${obj.date} </p>
                        </div>
                        
                        <div class="taskButtons">
                            <img class="editIcon" src='../ICONS_BLACK/pencil-icon.svg' alt='edit'>
                            <img class="removeIcon" src='../ICONS_BLACK/remove-icon.svg' alt='remove'>
                            <img class="clearIcon" src='/ICONS_BLACK/check-icon.svg' alt='checkmark'>
                        </div>
                    </div>`;
    
                ongoingWrapper.append(div);            
            }

            let removeButton = document.querySelector(".removeIcon");
            console.log(removeButton);

            removeButton.addEventListener("click", () => {
                console.log(obj);
            })

        });
    }

    // går igenom arrayen och checkar om id är samma som usern i task-arrayen --> deletea innehållet?? Hur gör man det genom JS, kolla 'DELETE', borde finnas.
    
    // radera object från ongoing-arrayen. Vet inte hur man ska göra lol....
    let removeButton = document.querySelector(".removeIcon");
    /* removeButton.addEventListener("click", () => {
        // let click = document.querySelector(".editIcon").nextElementSibling;
        let objText = document.querySelector(".task");
        // console.log(objText.innerHTML);

        ongoingArray.forEach(obj => {
            if (objText.innerHTML == obj.task) {
                console.log(obj.task);
            }
        })

        //console.log(click);
        /* ongoingArray.forEach(obj => {
            if (ID === obj.user) {
                console.log(obj);
            }
        }) 
    }); */

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
