<?php
ob_start();
require_once "../INCLUDES/header.php";

function allUsers(){
    $json = file_get_contents("../API/users.json");
    $data = json_decode($json, true);
    $allUsers = $data;

    return $allUsers;
}

function addUser($postInfo){
    //nycklar för den nya usern
    $newUser = [
        "username" => $postInfo["username"],
        "email" => $postInfo["email"],
        "password" => $postInfo["password"],  
        "pictures" => "welcome.img",
        "color-scheme" => 0,
        "contract" => false
    ];
    //foreachen räknar ut den nya userns id utifrån vilka som redan finns
    $highestID = 0;

    $allUsers = allUsers();
    foreach($allUsers as $user){
        if ($user["id"] > $highestID){
            $highestID = $user["id"];
        }
    }

    //ID:et av den nya usern + användarnamn.
    $newUser["id"] = $highestID + 1;
    $_SESSION["id"] = $newUser["id"];
    $_SESSION["username"] = $newUser["username"];
    //lägg till user i db.json
    $data = json_decode(file_get_contents("../API/users.json"), true);
    array_push($data, $newUser);
    $json = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents("../API/users.json", $json);
}

//Kollar vad som är skrivet i våra inputs och skapar variabler med dess info
if (isset($_POST["username"], $_POST["email"], $_POST["password"], $_POST["passwordConfirm"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordConfirm = $_POST["passwordConfirm"];

    //Om inputsen är tomma skapas inte en ny user och ett error visas
    if ($username == "" || $email == "" || $password == "") {
        header("Location: /ADMIN/sign-up.php?error=1");
        exit();
    } elseif (!strpos($email, "@")){
        header("Location: /ADMIN/sign-up.php?error=2");
        exit();
    } elseif ($password !== $passwordConfirm){
        header("Location: /ADMIN/sign-up.php?error=3");
        exit();
    } elseif (strlen($password) < 3){
        header("Location: /ADMIN/sign-up.php?error=4");
        exit();
    }
    
    else {
        addUser($_POST);
        header("Location: /index.php");
    }
}

?>
<div id="signInWrapper">
 <div id="signUpCircleOne"></div>
 <div id="signUpCircleTwo"></div>
 <div id="signUpCircleThree"></div>
 <div class="signUpSignInWhiteWrapper">
 <form method="POST" action="sign-up.php">
    <div class="signInForm">
      <h1>Create an account</h1>

      <?php 
        // Om inloggning misslyckas.  
        if (isset($_GET["error"])) {
            $error = $_GET["error"];

            if ($error == 1) {
                echo "<p class='error'> You forgot to fill in everything!</p>";
            } elseif ($error == 2) {
                echo '<p class="error"> You have to write an email with a @ </p>';
            } elseif ($error == 3) {
                echo "<p class='error'> The password does not match </p>";
            } elseif ($error == 4) {
                echo "<p class='error'> Your password must be more than 3 letters long </p>";
            }
        } 
    ?>

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
    <?php
//Error
    if (isset($error)) { ?>
        <p class="error">Write something!</p>
    <?php } ?>
</form>
