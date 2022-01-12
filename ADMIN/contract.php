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
        <link rel="stylesheet" href="../CSS/commonElements.css">
        <link rel="stylesheet" href="../CSS/focus.css">
        <link rel="stylesheet" href="../CSS/list.css">
        <link rel="stylesheet" href="../CSS/welcome.css">
        <link rel="stylesheet" href="../CSS/profile.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Yeseva+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet"> 
    </head>


<div id="contractWrapper">
    <div id="contractCircleOne"></div>
    <div id="contractCircleTwo"></div>
    <div id="contractCircleThree"></div>

    <h1 class="removeTextH1"><span class="contractTitleName"><?php echo $theUser;?></span>'s Contract</h1>
    <p class="removeTextP1">
    I, <span class="contractTextName"><?php echo $theUser;?></span>, promise to make the most of tomorrow. 
    I will always remember that I need to seize the moment. 
    It’s not the big things that will change my life, it’s the 
    small actions I take every day for a long period of time.
    </p>


    <p id="contractHint" class="removeTextP2">
    Hint: tap and hold the fingerprint to commit. Precomitting to a goal (via contracts like these) has been shown to inspire action and reduce procrationation. 
    </p>

<div id="signTheContract"></div>

<script>

let contract = document.querySelector("#signTheContract");


contract.addEventListener("mousedown", function() {

    contract.style.height="200px";
    contract.style.width="200px";
    contract.style.marginTop="0px";

    contract.style.backgroundRepeat="no-repeat";
    contract.style.backgroundPosition="center";

    setTimeout(function(){

        contract.style.backgroundImage="url(../IntroIcons/happyFace.svg)";
    }, 1200);

    //Fade In
    setTimeout(function(){
        window.location.href = "../index.php";
        contract.style.backgroundImage="url(../IntroIcons/happyFace.svg)";
    }, 1600);

});
</script>

</div>