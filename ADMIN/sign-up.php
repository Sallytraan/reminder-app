<?php
require_once "../INCLUDES/header.php";

function allUsers(){
    $json = file_get_contents("../API/users.json");
    $data = json_decode($json, true);
    $allUsers = $data;

    return $allUsers;
}

function addUser($postInfo){
    //nycklar för den nya hunden
    $newUser = [
        "username" => $postInfo["username"],
        "email" => $postInfo["email"],
        "password" => $postInfo["password"],  
        "pictures" => "welcome.img",
        "color-scheme" => 0  
    ];
    //foreachen räknar ut den nya hundens id utifrån vilka som redan finns
    $highestID = 0;

    $allUsers = allUsers();
    foreach($allUsers as $user){
        if ($user["id"] > $highestID){
            $highestID = $user["id"];
        }
    }

    //ID:et av den nya hunden
    $newUser["id"] = $highestID + 1;
    //lägg till hund i db.json
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
    }
}

?>

<form method="POST" action="sign-up.php">
<div id="signInForm">
    <h1>Create an account</h1>
    <input type="text" name="username" placeholder="Username">
    <input type="text" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <input type="password" name="password" placeholder="Confirm password">
    <button id="sign-up-button">Sign in</button>
    </div>
    <?php
//Error eller info om tilllagd hund
    if (isset($error)) { ?>
        <p class="error">Write something!</p>
    <?php } ?>
</form>
