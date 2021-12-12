"use strict";

/*
goToPage(); //kallar på funktionen nedan.

function goToPage(){

//Hamna högst upp på sidan
scroll (0, 0);

//Töm nuvarande innehåll i wrapper
wrapper.innerHTML = “ ”;
}

*/

"use strict";

function contractSite(){
    //Hamna högst upp på sidan
    scroll(0,0)  
  
    //Töm nuvarande innehåll i wrapper
    wrapper.innerHTML = "";
  
    wrapper.innerHTML = `
    <div id="contractWrapper">
    <h1>MY CONTRACT</h1>

    <button id="continueToSignUp"><a href="">Continue</a></button>
    </div>
    `;


    
}

