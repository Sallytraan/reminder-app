"use strict";

welcomePage();

function welcomePage(){
  //Hamna högst upp på sidan
  scroll(0,0)  

  //Töm nuvarande innehåll i wrapper
  wrapper.innerHTML = "";

  wrapper.style.marginTop="0px"

  wrapper.innerHTML = `
  <div id="welcomeTitle">Welcome to Reminder!</div>
  `;
}