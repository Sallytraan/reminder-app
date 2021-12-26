"use strict";

let transitionDuration = 350;

navList.addEventListener("click", () => {
    wrapper.style.opacity = 0;

    //Fade In
    setTimeout(function(){
        toDo();
        wrapper.style.opacity = 1;
    }, transitionDuration);
});
    
navFocus.addEventListener("click", () => {
    wrapper.style.opacity = 0;

    //Fade In
    setTimeout(function(){
        theTimer();
        wrapper.style.opacity = 1;
    }, transitionDuration);
});
    
navProfile.addEventListener("click", () => {
    wrapper.style.opacity = 0;

    //Fade In
    setTimeout(function(){
        theProfile();
        wrapper.style.opacity = 1;
    }, transitionDuration);
});
    


