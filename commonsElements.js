"use strict";

let transitionDuration = 250;

navList.addEventListener("click", () => {
    //Fade out
    wrapper.style.opacity = 0.6;
    logotyp.style.opacity = 0.6;

    //Fade In
    setTimeout(function(){
        toDo();
      wrapper.style.opacity = 1;
      logotyp.style.opacity = 1;
    }, transitionDuration);
});
    
navFocus.addEventListener("click", () => {
    //Fade out
    wrapper.style.opacity = 0.3;
    logotyp.style.opacity = 0.3;

    //Fade In
    setTimeout(function(){
        theTimer();
        wrapper.style.opacity = 1;
        logotyp.style.opacity = 1;
    }, transitionDuration);
});
    
navProfile.addEventListener("click", () => {
    wrapper.style.opacity = 0.3;
    logotyp.style.opacity = 0.3;

    //Fade In
    setTimeout(function(){
        theProfile();
        wrapper.style.opacity = 1;
        logotyp.style.opacity = 1;
    }, transitionDuration);
});
    


