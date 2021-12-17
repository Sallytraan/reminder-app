"use strict";
contractSite();

function contractSite(){
    //Hamna högst upp på sidan
    scroll(0,0)  
  
    //Töm nuvarande innehåll i wrapper
    wrapper.innerHTML = "";
  
    wrapper.innerHTML = `
    <div id="contractWrapper">
    <h1>My contract</h1>
    <p>
    I, <span class="contractName"></span>, promise to make the most of tomorrow. 
    I will always remember that I need to seize the moment. 
    It’s not the big things that will change my life, it’s the 
    small actions I take every day for a long period of time.
    </p>


    <button id="contractButton"><a href=""></a></button>
    </div>
    `;

    document.querySelector('.contractName').textContent = USER_NAME;
    
}

