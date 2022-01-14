<?php
session_start();
//error_reporting(-1);
require_once "../functions.php";

if (!isset($_SESSION["id"])) {
    header("Location: ../index.php");
    exit();
}

$data = loadJson("../API/users.json");
$loggedInID = $_SESSION["id"];

// funktion för att hämta en id:s hela objekt.
function getUser($id) {
    $allUsers = loadJson("../API/users.json");
    foreach ($allUsers as $user) {
        if ($user["id"] == $id) {
            return $user;
        }
    }
}

// variabel.
$userInfo = getUser($loggedInID);
$currentUsername = $userInfo["username"];
$currentEmail = $userInfo["email"];
$currentProfile = $userInfo["image"];
$thePassword = $userInfo["password"];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $userData = loadJson("../API/users.json");
    $imageInfo = $currentProfile;
    $file = $_FILES["newFile"];

    if (isset($file) && $file["error"] != 4) {
        $file = $_FILES["newFile"];
        $filename = $file["name"];
        $uniqueFilename = sha1(time().$filename);
        $tempname = $file["tmp_name"];
        $size = $file["size"];

        if ($size > 4 * 1000 * 1000) {
            header("Location: update.php?error=1");
            exit(); 
        }

        // checkar filinformationen
        $fileInfo = pathinfo($filename);
        $ext = strtolower($fileInfo["extension"]);
        
        move_uploaded_file($tempname, "../userImages/$uniqueFilename.$ext");
        $imageInfo = $uniqueFilename . "." . $ext;
    }

    // det som ersätter infon i users.json
    $updateProfile = [
        "id" => $loggedInID,
        "username" => $_POST["username"],
        "email" => $_POST["email"],
        "password" => $thePassword,
        "image" => $imageInfo,
        "color-scheme" => intval($_POST["mode"]) // ändrar färgschemat
    ]; 

    for ($i = 0; $i < count($userData); $i++) { 
        $currData = $userData[$i];
        $currUser = $currData["id"];
        if($loggedInID === $currUser){
            $userData[$i] = $updateProfile;
        }
    }

    if (empty($updateProfile["username"]) || empty($updateProfile["email"])) {
        header("Location: update.php?error=2");
        exit();
    }

    //Kopierar databasen till en backup-fil innan ändringen görs
    copy("../API/users.json", "../API/users_backup.json");
    saveJson("../API/users.json", $userData);
    
    header("Location: update.php?saved");
    exit();
}
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
        <link rel="icon" href="../INCLUDES/reminder_logotyp.svg">
    </head>
    <body>
        <header>
            <?php
            if (isset($_SESSION["id"])) {
                $id = $_SESSION["id"];
                echo " <p id='logotyp'> Reminder </p>";
            }

            if (isset($_GET["error"])) {
                $error = $_GET["error"];

                // Felmeddelande
                if ($error == 1) {
                    echo "<h2 class='popUpText'> The file can't be bigger than 4 mb.</h2>";
                } elseif ($error == 2) {
                    echo "<h2 class='popUpText'>All the fields need to be filled in. Try again.</h2>"; 
                } else {
                    echo "<h2 id='titleUpdate'>Change your information.</h2>";
                }
            }
            
            if (isset($_GET["saved"])) {
                echo "<h2 id='alonePopUp'>Information saved!</h2>";
            }
            ?>
        <div id="theProfileWrapper">    
            <form class="changeUserInfo" action="update.php" method="POST" enctype="multipart/form-data">
                <div class="uploadImageUpdate"> 
                    <h3 class="imageTitle"> Change profile picture</h3>
                    <input type="file" name="newFile" id="uploadFile">
                </div> 
                <div>
                    <input class="changeField" type="text" name="username" placeholder="Username" value ="<?php echo $currentUsername ?>">
                </div>
                <div>
                    <input class="changeField" type="text" name="email" placeholder="Email" value ="<?php echo $currentEmail ?>">
                </div>

                <div id="colorMode">
                    <input type="radio" name="mode" class="colorScheme" value="0">
                    <label for="0">0</label>
                    <p id="light"> Light Mode </p>
                    <input type="radio" name="mode" class="colorScheme" value="1">
                    <label for="1">1</label>
                    <p id="dark"> Dark Mode </p>
                </div>

                <div class="buttonBox">
                    <button type="submit" class="submitUpdate">Save</button>
                    <button type="submit" class="submitUpdate"><a href="../index.php">back</a></button>
                </div>
            </form>
        </div>
</body>
</html> 
        