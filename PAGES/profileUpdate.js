"use strict";

function profileUpdate(){
    //Hamna högst upp på sidan
    scroll(0,0)  
  
    navList.classList.remove("navListSelected");
    navList.classList.add("navListBlack");
    
    navFocus.classList.remove("navFocusSelected");
    navFocus.classList.add("navFocusBlack");

    navProfile.classList.add("navProfileSelected");
    navProfile.classList.remove("navProfileBlack");
    
    //Töm nuvarande innehåll i wrapper
    wrapper.innerHTML = "";
  

    
    wrapper.innerHTML = `
    <div id="theProfileWrapper">
        <div id="profileImage"> </div>
        <div><span id="userNameChange"></span><span>'s profil</span></div>
        <button class="changeSettingsButton"> Change settings </button>

        <div id="colorModes"> 

          <div class="colorContainers">
            <p> Dark <br>Mode</p>
            <div class="darkMode colorCircles"></div>
          </div>

          <div class="colorContainers">
            <p> Light <br>Mode</p>
            <div class="lightMode colorCircles"></div>
          </div>

          <div class="colorContainers">
            <p> Pink <br>Mode</p>
            <div class="pinkMode colorCircles"></div>
          </div>
        </div>

    </div>
    `;

    //document.getElementById("userImage").src = USER_IMAGE;
          document.querySelector(".changeSettingsButton").addEventListener("click", function() {
        window.location.href = "../PAGES/update.php";
    });
  
    fetch("../API/users.json")
    .then(response => response.json())
    .then(json => data(json));

    function data(json) {
        console.log(json);

        json.forEach(obj => {
        
          if (obj.id == ID){
            document.querySelector("#userNameChange").innerHTML=obj.username;
            document.querySelector("#profileImage").innerHTML= `
            <img id="profileImage" src="userImages/${obj.image}">
            `;
            

                //CHANGE NAMETAG 
//tar emot befintligt namn, samt det nya namnet.
function requestChangeUserName(nameTag, newNameTag){
    nameTag = obj.username;
    const data = {"username": nameTag, "username": newNameTag};
    const req = new Request("../API/api.php", {
        method: "PATCH",
        body: JSON.stringify(data),
        headers: {"Content-type": "application/json"}
    });
    fetch(req).then(response => getStatusCode(response));
}

requestChangeUserName(obj.username, "Anna");
             }

      });
    }
    

}


