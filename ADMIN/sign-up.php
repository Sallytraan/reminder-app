<?php
//error_reporting(-1);
session_start();
?>

<!DOCTYPE html>
<html lang="en">
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
        <link rel="icon" href="INCLUDES/reminder_logotyp.svg">
    </head>
    <body>
        <header>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" ){

$file = $_FILES["image"];
$json = file_get_contents("../API/users.json");
$data = json_decode($json, true);

function loadJson($filename) {
    $json = file_get_contents($filename);
    return json_decode($json, true);
}
    
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
        "password" => $postInfo["password"]
    ];

    //Kolla att de skickat med en bildfil och generera ett unikt 
    //namn för bilden
    if (isset($_FILES["image"])) {

            //variabler för bild-filen
            $profilePicture = $_FILES["image"];
            $filename = $profilePicture["name"];
            $tempname = $profilePicture["tmp_name"];
            $size = $profilePicture["size"];
            $error = $profilePicture["error"];


        // Hämta filinformation
        $info = pathinfo($filename);
        // Hämta ut filändelsen (och gör om till gemener)
        $ext = strtolower($info["extension"]);

        // Konvertera från int (siffra) till en sträng,
        // så vi kan slå samman dom nedan.
        $time = (string) time(); // Klockslaget i millisekunder
        // Skapa ett unikt filnamn med TID + FILNAMN
        $uniqueFilename = sha1("$time$filename");
        //Skickar bilden till vår mapp
       move_uploaded_file($tempname, "../userImages/$uniqueFilename.$ext");

        //när all info har kikats genom och kontrollerats, ska 
        //det läggas till i databasen. 

                    // Filen får inte vara större än ca 500kb
        if ($size > (0.5 * 1000 * 1000)) {
            statusCode(465);
            exit();
        }
    }
    else {
        $newUser["image"] = "";
    }

    //foreachen räknar ut den nya userns id utifrån vilka som redan finns
    $highestID = 0;

    $allUsers = allUsers();
    foreach($allUsers as $user){
        if ($user["id"] > $highestID){
            $highestID = $user["id"];
        }
    }

    // Kollar om det finns en användare som redan har samma email
    foreach($allUsers as $user){
        if ($user["email"] == $postInfo["email"]){
            header("Location: /ADMIN/sign-up.php?error=5");
            exit();
        }
    }

    //ID:et av den nya usern + användarnamn.
    $newUser["id"] = $highestID + 1;
    $newUser["image"] = "$uniqueFilename.$ext";


    $_SESSION["id"] = $newUser["id"];
    $_SESSION["username"] = $newUser["username"];
    $_SESSION["email"] = $newUser["email"];
    $_SESSION["image"] = "$uniqueFilename.$ext";
    
    //lägg till user i users.json
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
                        //Kopierar databasen till en backup-fil innan ändringen görs
                        copy("../API/users.json", "../API/users_backup.json");

        addUser($_POST);

            header("Location: contract.php");;
                exit();
    }
}
}

?>
<div id="signInWrapper">
 <div id="signUpCircleOne"></div>
 <div id="signUpCircleTwo"></div>
 <div id="signUpCircleThree"></div>
 <div class="signUpSignInWhiteWrapper">
 <form method="POST" action="sign-up.php" enctype="multipart/form-data">
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
            } elseif ($error == 5) {
                echo "<p class='error'> This email has already createn an account </p>";
            } 
        } 
    ?>

      <input type="text" name="username" placeholder="Username" class="iconUserName inputIcon">
      <input type="text" name="email" placeholder="Email" class="iconEmail inputIcon">
      <input type="password" name="password" placeholder="Password" class="iconPassword inputIcon">
      <input type="password" name="passwordConfirm" placeholder="Confirm password" class="iconPassword inputIcon">

        <div id="signUpImage"> 
            <img id="output_image" src="../IntroIcons/defaultUserImage.jpg"/>
                <h2> Upload a profile picture </h2> 
                <input type="file" name="image" accept="image/*" onchange="preview_image(event)" required>
        </div>                 


      <button class="signUpSignInButton">Create an account</button>
       <div id="signUpSignInOption">
        <p>Already have an account? <br> <a href="sign-in.php">Sign in</a></p>
 </div>
 </div>
 </div>
</div>

</form>

<script>
    function preview_image(event) {
        var reader = new FileReader();

        reader.onload = function(){
            var output = document.getElementById('output_image');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

