"use strict";

function imageChange(){
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
    <form id="registerForm" action="/createUser.php" method="POST" enctype="multipart/form-data">
            <div id="uploadpicture">
                <input type="file" name="image" id="file" onchange="loadfile(event)">
                <label for="file">
                    Ladda upp en profilbild
                </label>
                <img id="prePic">
</form>


    </div>
    `;


    function loadfile(event){
        var output=document.getElementById("prePic");
        document.getElementById("prePic").classList.add("show")
        output.src=URL.createObjectURL(event.target.files[0]);
    }

    
}

