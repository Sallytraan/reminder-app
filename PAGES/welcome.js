"use strict";

welcomePage();

document.querySelector("#createAccount").addEventListener('click', ()=> {

  welcomeText();
});

function welcomePage(){
  //Hamna högst upp på sidan
  scroll(0,0)  

  //Töm nuvarande innehåll i wrapper
  wrapper.innerHTML = "";

  wrapper.innerHTML = `
  <div id="wrapperSignInSignUp">
  <div id="welcomeTitle">Welcome to Reminder!</div>
  <div id="welcomeContainer">
     <button><a href="../ADMIN/sign-in.php">Sign in</a></button>
     <button id="createAccount">Create an account</button>
  </div>
  </div>
  `;
}

