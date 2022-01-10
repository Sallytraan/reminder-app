<?php
session_start();
error_reporting(-1);

require_once "../functions.php";

$loggedInID = $_SESSION["id"];
$UserName = $_SESSION["username"];

?>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST" ){
    $data = loadJson("../API/users.json");



    $updateProfile = [
        "id" => $loggedInID,
        "username" => $_POST["username"]
    ]; 


    if (empty($updateProfile["first_name"])) {
        header("Location: update.php?error=2");
        exit();
    }

    //Kopierar databasen till en backup-fil innan ändringen görs
    copy("../API/users.json", "../API/users_backup.json");


    $json = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents("../API/users.json", $json);

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
                <p>Förnamn</p><input class="updateFields" type="text" name="username" placeholder="<?php echo $UserName ?>" value ="<?php echo $UserName ?>"><br>
                
                  
            </div>

            <button type="submit" class="update-button">Spara</button>
            </div>
        </form>
    </div> 
