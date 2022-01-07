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
if (isset($_POST["username"], $_POST["email"], $_POST["password"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    //Om inputsen är tomma skapas inte en ny user och ett error visas
    if ($username == "" || $email == "" || $password == "") {
        $error = 1;
    } else {
        addUser($_POST);
        header("Location: /index.php");
    }
}

?>
<div id="signUpWrapper">
 <form method="POST" action="sign-up.php">
    <div class="signUpForm">
      <h1>Create an account</h1>
      <input type="text" name="username" placeholder="Username" class="iconUserName inputIcon">
      <input type="text" name="email" placeholder="Email" class="iconEmail inputIcon">
      <input type="password" name="password" placeholder="Password" class="iconPassword inputIcon">
      <input type="password" name="password" placeholder="Confirm password" class="iconPassword inputIcon">
      <button class="signUpSignInButton">Create an account</button>
      <p>Already have an account? <br> <a href="../ADMIN/sign-in.php">Sign in</a></p>
    </div>
</div>
    <?php
//Error
    if (isset($error)) { ?>
        <p class="error">Write something!</p>
    <?php } ?>
</form>
