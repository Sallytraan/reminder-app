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
        <p></p>
    </div>
    `;
    navList.classList.add("selectedNav");
    navFocus.classList.remove("selectedNav");
    navProfile.classList.remove("selectedNav");
}

// document.querySelector("#navList > img").style.color = "fill: white";
