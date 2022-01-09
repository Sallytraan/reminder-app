<?php
session_start();
error_reporting(-1);



require_once  "../functions.php";
$loggedInID = $_SESSION["id"];
$sitterInfo = idInfoSitter($_SESSION["id"]);
$sitterFirstName = $sitterInfo["username"];
$sitterEmail = $sitterInfo["email"];
$sitterPassword = $sitterInfo["password"];
$sitterImage = $sitterInfo["image"];
?>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST" ){
    $data = loadJSON(__DIR__ . "/../dogsitter/dogsitter.json");

    $imageUrl = $sitterImage;
    $file = $_FILES["newImageToUpload"];

    if (isset($file) && $file["error"] != 4) {
        $file = $_FILES["newImageToUpload"];
        $filename = $file["name"];
        $tempname = $file["tmp_name"];
        $uniqueFilename = sha1(time().$filename);
        $size = $file["size"];

        if ($size > 4 * 1000 * 1000) {
            header("Location: update.php?error=1");
            exit();
        }

        //Hämta filinformation & kolla vilken filtyp det är
        $info = pathinfo($filename);
        $extension = strtolower($info["extension"]);
        //Spara bilden med unikt namn i mappen "userImages"
        move_uploaded_file($tempname, __DIR__ . "/../userImages/$uniqueFilename.$extension");
        $imageUrl = $uniqueFilename.'.'.$extension;
    }

    if (!array_key_exists("areas", $_POST) || !array_key_exists("days", $_POST)) {
        header("Location: update.php?error=2");
        exit();
    }

    $updateProfile = [
        "id_sitter" => $loggedInID,
        "first_name" => $_POST["firstName"],
        "last_name" => $_POST["lastName"],
        "email" => $_POST["email"],
        "password" => $_POST["password"],
        "image" => $imageUrl //spara unika namnet på bilden som sökväg
    ]; 

    for ($i=0; $i < count($data); $i++) { 
        $currData = $data[$i];
        $currUser = $currData["id_sitter"];
        if($loggedInID === $currUser){
            $data[$i] = $updateProfile;
        }
    }

    if (empty($updateProfile["first_name"]) || empty($updateProfile["last_name"]) || empty($updateProfile["email"]) || empty($updateProfile["password"]) || empty($updateProfile["location"]) || empty($updateProfile["cost"]) || empty($updateProfile["days"]) || empty($updateProfile["areas"])|| empty($updateProfile["extraInfo"])) {
        header("Location: update.php?error=2");
        exit();
    }

    //Kopierar databasen till en backup-fil innan ändringen görs
    copy("dogsitter.json", "dogsitter_backup.json");

    $json = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents(__DIR__ . "/../dogsitter/dogsitter.json", $json);

    header("Location: update.php?error=3");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ändra uppgifter</title>

<!-- </head> stängs i header.php -->
<body>
    <?php if (isset($_GET["error"])) {
            $error = $_GET["error"];

            // Felmeddelande
            if ($error == 1) {
                echo "<h1 id='h2-update'> Filen får inte vara större än 4mb</h1>";
            } elseif ($error == 2) {
                echo "<h1 id='h2-update'>Alla fält måste vara ifyllda, försök igen</h1>";
            } elseif ($error == 3) {
                echo  "<h1 id='h2-update'> Profil Uppdaterad! </h1> ";
            } 
        } else {
            echo "<h2  id='titleUpdate'>Här kan du ändra din profil!</h2>";
        } 
    ?>
    
    <div class="form">
        <form class="update-account" action="update.php" method="POST" enctype="multipart/form-data">
            <div id="dogsitter-form"> 
                <p>Förnamn</p><input class="updateFields" type="text" name="firstName" placeholder="<?php echo $sitterFirstName ?>" value ="<?php echo $sitterFirstName ?>"><br>
                <p>Efternamn</p><input type="text" class="updateFields" name="lastName" placeholder="<?php echo $sitterLastName ?>" value="<?php echo $sitterLastName ?>"><br>
                <p>Email</p><input type="email" class="updateFields" name="email" placeholder="<?php echo $sitterEmail ?>" value="<?php echo $sitterEmail ?>"><br>
                <p>Lösenord</p><input type="text" class="updateFields" name="password" placeholder="Skriv Nytt Lösenord" value="<?php echo $sitterPassword ?>" minlength="4" required><br>
                
                  
            </div>



            <div class="uploadImageUpdate"> 
                <h2 class="h2-update"> Ladda upp en ny profilbild </h2> 
                <input type="file" name="newImageToUpload" id="fileToUpload">
            </div> 
            <div class="update-button-wrapper">
            <button type="submit" class="update-button">Spara</button>
            </div>
        </form>
    </div> 
