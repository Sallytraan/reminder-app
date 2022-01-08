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
        <div id="profileImage"></div>
        <button id="uploadProfileImage"><a href="/PAGES/change-image.php">Change profile picture</a></button>
        <div><span id="userNameChange">${USER}'s profil</span></div>
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

        <button id="signOutButton"><a href="../ADMIN/sign-out.php">Sign out</a></button>
    </div>
    `;


}

