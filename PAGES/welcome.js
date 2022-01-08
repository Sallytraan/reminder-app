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
  
   <div id="welcomeCircleOne"></div>

   <div id="welcomeCircleTwo"></div>

   <div id="welcomeCircleThree"></div>

   <div id="welcomeWhiteOneWrapper">

     <h1 class="welcomeTitle">Welcome!</h1>

   <div id="welcomeContainer">
     <button><a href="../ADMIN/sign-in.php">Sign in</a></button>
     <button id="createAccount">Create an account</button>
   </div>

   </div>
  </div>
  `;
}

