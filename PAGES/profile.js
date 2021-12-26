"use strict";

function theProfile(){
    //Hamna högst upp på sidan
    scroll(0,0)  
  
    //Töm nuvarande innehåll i wrapper
    wrapper.innerHTML = "";
  
    wrapper.innerHTML = `
    <div id="theProfileWrapper">
        <div id="profileImage"></div>
        <div><input type="text"></div>
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
    navList.classList.remove("selectedNav");
    navFocus.classList.remove("selectedNav");
    navProfile.classList.add("selectedNav");
}
