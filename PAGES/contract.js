"use strict";
contractSite();

document.querySelector('.contractButton').addEventListener("mousedown", function(){
    setTimeout(() => {
        document.querySelector(".removeTextH1").style.display="none";
        document.querySelector(".removeTextP1").style.display="none";
        document.querySelector(".removeTextP2").style.display="none";
        document.querySelector("#contractWrapper").style.padding="0px";
        document.querySelector("#contractWrapper").style.margin="0px";
    }, 1000);

    changeContract;
});



function contractSite(){
    //Hamna högst upp på sidan
    scroll(0,0)  
  
    //Töm nuvarande innehåll i wrapper
    wrapper.innerHTML = "";
  
    wrapper.innerHTML = `
    <div id="contractWrapper">
    <h1 class="removeTextH1">My contract</h1>
    <p class="removeTextP1">
    I <span class="contractName"></span>promise to make the most of tomorrow. 
    I will always remember that I need to seize the moment. 
    It’s not the big things that will change my life, it’s the 
    small actions I take every day for a long period of time.
    </p>


    <p id="contractHint" class="removeTextP2">
    Hint: tap and hold the fingerprint to commit. Precomitting to a goal (via contracts like this) has been shown to inspire action and reduce procrationation. 
    </p>

    <button class="contractButton"><a href=""></a></button>
    </div>
    `;

    document.querySelector('.contractName').textContent = "";
    
}



