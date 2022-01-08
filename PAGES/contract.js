"use strict";
contractSite();


function contractSite(){
    //Hamna högst upp på sidan
    scroll(0,0)  
  
    //Töm nuvarande innehåll i wrapper
    wrapper.innerHTML = "";
  
    wrapper.innerHTML = `
    <div id="contractWrapper">
    <h1 class="removeTextH1"><span class="contractTitleName"></span>'s Contract</h1>
    <p class="removeTextP1">
    I, <span class="contractTextName"></span>, promise to make the most of tomorrow. 
    I will always remember that I need to seize the moment. 
    It’s not the big things that will change my life, it’s the 
    small actions I take every day for a long period of time.
    </p>


    <p id="contractHint" class="removeTextP2">
    Hint: tap and hold the fingerprint to commit. Precomitting to a goal (via contracts like these) has been shown to inspire action and reduce procrationation. 
    </p>


    <div id="contractButton"></div>

    </div>
    `;

    console.log(USER_DATA);

    document.getElementById('contractButton').addEventListener('click', function() {
  

    for (var i = 0; i < USER_DATA.length; i++) {
      if (USER_DATA[i].id == ID) {



        //CHANGE NAMETAG 
//tar emot befintligt namn, samt det nya namnet.

  const dataUser = {"contract": true};
  const req = new Request("../API/server.php", {
      method: "PATCH",
      body: JSON.stringify(dataUser),
      headers: {"Content-type": "application/json"}
  });








      }
    }
    


    


    console.log(USER_DATA);
   
    
    }); 
  
   
    





    // visar personen som ska skriva på kontraktet
    document.querySelector('.contractTitleName').textContent = USER;
    document.querySelector('.contractTextName').textContent = USER;


  }


