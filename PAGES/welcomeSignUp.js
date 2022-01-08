"use strict";

function welcomeSignUp(){
    //Hamna högst upp på sidan
    scroll(0,0)  
  
    //Töm nuvarande innehåll i wrapper
    wrapper.innerHTML = "";
  
    wrapper.innerHTML = `
    <div id="wrapperWelcomeIntro">

    <div id="signInWrapper">
 <div id="signUpCircleOne"></div>
 <div id="signUpCircleTwo"></div>
 <div id="signUpCircleThree"></div>
 <div class="signUpSignInWhiteWrapper">

 <form method="POST" action="../ADMIN/sign-up-2.php" enctype="multipart/form-data">>
    <div class="signInForm">
      <h1>Create an account</h1>

      <div id="uploadpicture">
      <input type="file" name="image" id="file" onchange="loadfile(event)">
      <label for="file">
          Ladda upp en profilbild
      </label>
      <img id="prePic">

      <input type="text" name="username" placeholder="Username" class="iconUserName inputIcon">
      <input type="text" name="email" placeholder="Email" class="iconEmail inputIcon">
      <input type="password" name="password" placeholder="Password" class="iconPassword inputIcon">
      <input type="password" name="passwordConfirm" placeholder="Confirm password" class="iconPassword inputIcon">
      <button class="signUpSignInButton">Create an account</button>
       <div id="signUpSignInOption">
        <p>Already have an account? <br> <a href="../ADMIN/sign-in.php">Sign in</a></p>
</div>
    </div>
</div>
</div>

    </div>
    `;


    function loadfile(event){
        var output=document.getElementById("prePic");
        document.getElementById("prePic").classList.add("show")
        output.src=URL.createObjectURL(event.target.files[0]);
    }
}

