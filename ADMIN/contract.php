<?php
//error_reporting(-1);
session_start();
?>


<?php 
    $theUser = $_SESSION["username"];
?>

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="414, initial-scale=1.0">
        <title>Reminder</title>
        <link rel="stylesheet" href="../todo/CSS/commonElements.css">
        <link rel="stylesheet" href="../todo/CSS/focus.css">
        <link rel="stylesheet" href="../todo/CSS/list.css">
        <link rel="stylesheet" href="../todo/CSS/welcome.css">
        <link rel="stylesheet" href="../todo/CSS/profile.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Yeseva+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet"> 
    </head>


<div id="contractWrapper">

    
    <h1 class="contractTextH1"><span class="contractTitleName"><?php echo $theUser;?></span>'s Contract</h1>
    
    <div class="x2">
        <div class="cloud"></div>
    </div>

    <p class="contractTextP1">

    I, <span class="contractTextName"><?php echo $theUser;?></span>, promise to make the most of tomorrow. 
    I will remember that the secret of getting ahead is getting started.
    It’s not the big things that will change my life, it’s the 
    small actions I take every day for a long period of time.
    </p>

    <div class="x3">
        <div class="cloud"></div>
    </div>

    <div class="x4">
        <div class="cloud"></div>
    </div>


    <p id="contractHint" class="removeTextP2">
    Hint: tap and hold the fingerprint to commit. Precomitting to a goal (via contracts like these) has been shown to inspire action and reduce procrationation. 
    </p>

    <div id="signTheContract"></div>
    <div class="x5">
        <div class="cloud"></div>
    </div>

    <div class="x1">
        <div class="cloud"></div>
    </div>
</div>
<script>

let contract = document.querySelector("#signTheContract");


contract.addEventListener("mousedown", function() {

    contract.style.height="240px";
    contract.style.width="240px";
    contract.style.marginTop="0px";

    contract.style.backgroundRepeat="no-repeat";
    contract.style.backgroundPosition="center";


    //Fade In
    setTimeout(function(){
        window.location.href = "../index.php";
        
    }, 1600);

});
</script>

</div>