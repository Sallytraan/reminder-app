<?php
//error_reporting(-1);
session_start();
$userName = json_encode($_SESSION["username"], JSON_PRETTY_PRINT);
?>


<!DOCTYPE html>
<html lang="en">
<head>

<?php 
    $theUser = $_SESSION["username"];
    ?>


<!-- </head> head stängs i header.php -->
<body>


    <div id="contractWrapper">
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
<a href="../index.php">SIGN HERE</a>
</body>
</html>

