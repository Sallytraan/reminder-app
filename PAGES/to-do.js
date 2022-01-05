"use strict";
toDo();

function toDo(){
    //Hamna högst upp på sidan
    scroll(0,0)  
  
    //Töm nuvarande innehåll i wrapper
    wrapper.innerHTML = "";

    // kanske ändra i header så att all JSON går i en array. Sen i js fixa så att det blir en loop som kommer åt infon för att sedan skapa en ny <div> för varje task???.
  
    wrapper.innerHTML = `
    <div id="toDoWrapper">
        <div id="ongoing">
            <h3>To Do</h3>
            <div class="taskBox">
                <p class="task"></p>
            </div>
        </div>

        <div id="completed">
            <h3>Completed</h3>
        </div>
    </div>
    `;

    // gör att navven ändrar färg.
    navList.classList.add("selectedNav");
    navFocus.classList.remove("selectedNav");
    navProfile.classList.remove("selectedNav");

    // för att det inte ska uppkomma kaninöron.
    document.querySelector('.task').textContent = TASK;
}
