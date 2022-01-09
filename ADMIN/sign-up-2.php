<?php
session_start();
error_reporting(-1);
require_once "../functions.php";

// //samlar användardatan från formuläret in i $newEntry och använder 
// //funktionen "addEntry" för att spara datan i json-filen
if($_SERVER["REQUEST_METHOD"] == "POST" ){
    $data = loadJSON( __DIR__ . "../API/users.json");
    $file = $_FILES["dogImage"];

    //Kolla att de skickat med en bildfil och generera ett unikt 
    //namn för bilden
    if (isset($file) && $file["error"] != 4) {
        $filename = $file["name"];
        $tempname = $file["tmp_name"];
        $uniqueFilename = sha1(time().$filename);
        $size = $file["size"];

        if ($size > 4 * 1000 * 1000) {
            "<p class='feedbackMessage'> Filen får inte vara större än 4mb </p>";
            exit();
        }

        //Hämta filinformation & kolla vilken filtyp det är
        $info = pathinfo($filename);
        $extension = strtolower($info["extension"]);
        $imageName = $uniqueFilename.'.'.$extension;
    }
    else {
        $imageName = "";
    }
    
    $newEntry = [ 
        "id" => getMaxID($data, "id") + 1, 
        "username" => $_POST["username"],
        "email" => $_POST["email"],
        "password" => $_POST["password"],
        "image" => $imageName,//spara unika namnet på bilden som sökväg
        "color-scheme" => 0,
        "contract" => false
    ];   

    if(is_null($newEntry) ){
        header("Location: create.php?error=5");
        exit();
    }
    
    if (empty($newEntry["username"]) || empty($newEntry["email"]) || empty($newEntry["password"]) || empty($newEntry["passwordConfirm"])) {
        header("Location: create.php?error=1");
        exit();
    }

    if(empty($newEntry["dog"]["image"]) ){
        header("Location: create.php?error=6");
        exit();
    }

    if(strlen($newEntry["password"]) < 4) {
        header("Location: create.php?error=2");
        exit();
    }

    //Kopierar databasen till en backup-fil innan ändringen görs
    copy("../API/users.json", "../API/users_backup.json");

    //Spara bilden med unikt namn i mappen "userImages"
    move_uploaded_file($tempname, __DIR__ . "../userImages/$imageName");
    addEntry( __DIR__ . "../API/users.json", $newEntry);
    header("Location: ../sign-in.php?createdAccount");
    exit();
}
?> 

<!-- </head> stängs i header.php -->

    <div class="formWrapper">
        <form class="createAccount" action="sign-up-2.php" method="POST" enctype="multipart/form-data">
            <div class="welcomemessage"> 
            <?php // Kontrollera om "error" finns i vår URL
            if (isset($_GET["success"])) {
                echo '<div class="feedbackMessage"> <p> Användare skapad! Nu kan du </p> <a id="messageCreate" href="../sign-in.php">logga in</a> </p> </div>';
            } elseif (isset($_GET["error"])) {
                $error = $_GET["error"];

                // Felmeddelande
                if ($error == 1) {
                    echo '<p class="errorCreate">Alla fält måste vara ifyllda, testa igen.</p>';
                } elseif ($error == 2) {
                    echo '<p class="errorCreate">Lösenordet måste vara minst 4 tecken</p>';
                } elseif ($error == 3) {
                    echo '<p class="errorCreate"> Filen får inte vara större än 4mb</p>';
                } elseif ($error == 4) {
                    echo '<p class="errorCreate">E-postadressen används redan</p>';
                } elseif ($error == 6) {
                    echo '<p class="errorCreate">Ingen bild laddades upp, försök igen.</p>';
                } elseif ($error == 5) {
                    echo '<p class="errorCreate">Något gick fel, försök igen</p>';
                } 
            } else {
                echo '<h2> Welcome </h2> <p> Vänligen fyll i fälten nedan. </p>';
            } 
            ?> 
            </div> 
            <div id="dogowner"> 
                <h2 class="areasText"> Uppgiter om mig: </h2>
                <input type="text" name="username" class="createDetails" placeholder="Username" class="iconUserName inputIcon"><br>
                <input type="email" name="email" class="createDetails" class="iconEmail inputIcon" placeholder="Email."><br>
                <input type="password" name="password" class="createDetails" class="iconPassword inputIcon" placeholder="Password"><br>
                <input type="password" name="passwordConfirm" class="iconPassword inputIcon" placeholder="Confirm password"><br>

            </div> 
            

            </div> 
            <div id="dogPicDiv"> 
            <img id="output_image" src="../Images/dogavatar.jpeg"/>
                <h2> Ladda upp en profilbild </h2> 
                <input type="file" name="dogImage" accept="image/*" onchange="preview_image(event)">
            </div>                 
            <button class="createButton" type="submit">Create account</button>
        </form>
    </div>


    <script> 
    document.querySelector(".backToHomeCreate").addEventListener("click", function() {
        window.location.href = "../index.php";
    });

    function preview_image(event) {
        var reader = new FileReader();

        reader.onload = function(){
            var output = document.getElementById('output_image');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
    </script>