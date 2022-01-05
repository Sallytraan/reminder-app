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

    ongoingArray.forEach(obj => {
        console.log(obj); // ska visa alla objekt i arrayen. Kollar för säkerhets skull.

        // vi vill komma åt 'task' + 'date'
        let div = document.createElement("div");
        div.innerHTML = `
        <div class="taskWrapper">
            <div class="taskBox">
                <p class="task"> ${obj.task}</p>
                <img class="icon" src='../ICONS_BLACK/pencil-icon.svg' alt='edit'>
                <img class="icon" src='/ICONS_BLACK/check-icon.svg' alt='checkmark'>
            </div>
            <p class="date"> ${obj.date} </p>
        </div>`;

        ongoingWrapper.append(div);
    });

    // gör att navven ändrar färg.
    navList.classList.add("selectedNav");
    navFocus.classList.remove("selectedNav");
    navProfile.classList.remove("selectedNav");
}

// kollar om datat från JSON-filen kom. FUNGERADE HEHE.
console.log(TASK_DATA["ongoing"].length);
