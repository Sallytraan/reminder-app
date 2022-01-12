"use strict";

function theProfile(){
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

    <div id="profileCircleOne"></div>
    <div id="profileCircleTwo"></div>
    <div id="profileCircleThree"></div>

      <div id="profileBox"> </div>
      <div><span id="userNameChange"></span><span id="userNameText">'s profile</span></div>
      <button class="changeSettingsButton"> Change settings </button>

      <button id="signOutButton"><a href="../ADMIN/sign-out.php">Sign out</a></button>
    </div>
    `;


    // <button id="signOutButton"><a href="../ADMIN/sign-out.php">Sign out</a></button>

    //document.getElementById("userImage").src = USER_IMAGE;
        document.querySelector(".changeSettingsButton").addEventListener("click", function() {
        window.location.href = "../PAGES/update.php";
        /*profileUpdate();*/
    });
  
    fetch("../API/users.json")
    .then(response => response.json())
    .then(json => data(json));

    function data(json) {
        json.forEach(obj => {
        
          if (obj.id == ID){
            document.querySelector("#userNameChange").innerHTML=obj.username;
            document.querySelector("#profileBox").innerHTML= `
            <img id="profileImage" src="userImages/${obj.image}">
            `;
            
             }
      });
    }
    

}


