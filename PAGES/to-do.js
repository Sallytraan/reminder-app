"use strict";
toDo();

function toDo(){
    //Hamna högst upp på sidan
    scroll(0,0)  
  
    //Töm nuvarande innehåll i wrapper
    wrapper.innerHTML = "";

    wrapper.innerHTML = `
    <div id="toDoWrapper">
        <div id="ongoing">
            <h3>To Do</h3>
        </div>
        <div id='addTask'>
            <a href="/PAGES/create-task.php"><img src='/ICONS_BLACK/add-icon.svg' alt='list'></a>
        </div>

        <div id="completed">
            <h3>Completed</h3>
        </div>
    </div>
    `;

    let ongoingWrapper = document.getElementById("ongoing");
    let ongoingArray = TASK_DATA["ongoing"];
    let completedArray = TASK_DATA["finished"];

    ongoingArray.forEach(obj => {
        console.log(obj); // ska visa alla objekt i arrayen. Kollar för säkerhets skull.

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
    });

    // går igenom arrayen och checkar om id är samma som usern i task-arrayen --> deletea innehållet?? Hur gör man det genom JS, kolla 'DELETE', borde finnas.
    
    // radera object från ongoing-arrayen. Vet inte hur man ska göra lol....
    let removeButton = document.querySelector(".removeIcon");
    removeButton.addEventListener("click", event => {
        let click = event.target.parentElement.parentElement;
        console.log(click);
        /* ongoingArray.forEach(obj => {
            if (ID === obj.user) {
                console.log(obj);
            }
        }) */
    })


    // gör att navven ändrar färg.
    navList.classList.add("selectedNav");
    navFocus.classList.remove("selectedNav");
    navProfile.classList.remove("selectedNav");
}

// kollar om datat från JSON-filen kom. FUNGERADE HEHE.
console.log(TASK_DATA["ongoing"].length);
