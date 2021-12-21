"use strict";
toDo();

function toDo(){
    //Hamna högst upp på sidan
    scroll(0,0)  
  
    //Töm nuvarande innehåll i wrapper
    wrapper.innerHTML = "";
  
    wrapper.innerHTML = `
    <div id="toDoWrapper">
        <h1>LIST</h1>
    </div>
    `;
}

document.getElementById("navList").style.backgroundColor = "grey";
// document.querySelector("#navList > img").style.color = "fill: white";
