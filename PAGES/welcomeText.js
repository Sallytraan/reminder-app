"use strict";

function welcomeText(){
    //Hamna högst upp på sidan
    scroll(0,0)  
  
    //Töm nuvarande innehåll i wrapper
    wrapper.innerHTML = "";
  
    wrapper.innerHTML = `
    <div id="wrapperWelcomeIntro">
    <div id="welcomeTitleIntro">Welcome to Reminder!</div>
    <div id="welcomeText">

    <div class=welcomePage wp1"> 
    <div><img class="showMoreImg iconBlack" src="ICONS_BLACK/user_black.svg"></div> 
    <div class="introWrapper">
    <p>Create tasks fast and easy</p>
    <p>Input tasks are sorted depending on your priority</p>
    </div>
    </div>

    <div class="welcomePage wp2"> 
    <div><img class="showMoreImg iconBlack" src="ICONS_BLACK/timer_black.svg"></div> 
    <div class="introWrapper">
    <p>Focus timer</p>
    <p>Set a focus timer to help you get your tasks done</p>
    </div>
    </div>

    <div class="welcomePage wp3">  
    <div><img class="showMoreImg iconBlack" src="ICONS_BLACK/trophy_black.svg"></div> 
    <div class="introWrapper">
    <p>Task and timer milestones</p>
    <p>Get an weekly oversight on how much work you have put into your tasks</p>
    </div>
    </div>

    <div class="welcomePage wp4"> 
    <div><img class="showMoreImg iconBlack" src="ICONS_BLACK/hanger_black.svg"></div> 
    <div class="introWrapper">
    <p>Custom themes</p>
    <p>Choose the theme you like and start your wonderful day</p>
    </div>
    </div>


    </div>


    <button id="continueToSignUp"><a href="../ADMIN/sign-up.php">Continue</a></button>
    </div>
    `;


    
}

