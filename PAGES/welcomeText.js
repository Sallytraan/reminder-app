"use strict";

function welcomeText(){
    //Hamna högst upp på sidan
    scroll(0,0)  
  
    //Töm nuvarande innehåll i wrapper
    wrapper.innerHTML = "";
  
    wrapper.innerHTML = `
    <div id="wrapperWelcomeIntro">

   <div id="welcomeTextCircleOne"></div>

   <div id="welcomeTextCircleTwo"></div>

    <div id="welcomeWhiteWrapper">
    <div id="welcomeTitleIntro">Welcome to Reminder</div>
    <p id="welcomeIntroduction">Here is an introduction of all the wonderful things you can do on this app!</p>

    <div id="welcomeIconParent">

     <div class=welcomePage wp1"> 
     <div><img class="showMoreImg iconBlack" src="ICONS_BLACK/profile-icon.svg"></div> 
     <div class="introWrapper">
     <p>Create tasks fast and easy</p>
     <p>Input tasks are sorted depending on your priority</p>
     </div>
     </div>

     <div class="welcomePage wp2"> 
     <div><img class="showMoreImg iconBlack" src="ICONS_BLACK/timer-icon.svg"></div> 
     <div class="introWrapper">
     <p>Focus timer</p>
     <p>Set a focus timer to help you get your tasks done</p>
     </div>
     </div>

     <div class="welcomePage wp3">  
     <div><img class="showMoreImg iconBlack" src="ICONS_BLACK/trophy-icon.svg"></div> 
     <div class="introWrapper">
     <p>Task milestone</p>
     <p>Keep track on how many tasks you've completed throughout the week!</p>
     </div>
     </div>

     <div class="welcomePage wp4"> 
     <div><img class="showMoreImg iconBlack" src="ICONS_BLACK/custom-icon.svg"></div> 
     <div class="introWrapper">
     <p>Custom themes</p>
     <p>Choose the theme you like and start your wonderful day</p>
     </div>
     </div>
     
     </div>
     <button id="continueToSignUp"> <a href="../todo/ADMIN/sign-up.php">Continue</a></button>

    </div>



    </div>
    </div>
    `;



    
}

//     <button id="continueToSignUp"><a href="../ADMIN/sign-up.php">Continue</a></button>