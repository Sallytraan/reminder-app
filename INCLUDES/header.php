<?php
//error_reporting(-1);
session_start();
// require_once __DIR__ . "/API/api.php";
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
    </head>
    <body>
        <header>
        <?php
$data = json_decode(file_get_contents("API/users.json"), true);
$sessionID = $_SESSION["id"];

// kollar om man är inloggad + kontrakt = visar headern för användaren.
if (isset($_SESSION["id"])) {
    $id = $_SESSION["id"];

                $dataUsers = loadJson("../API/users.json");
                foreach ($dataUsers as $key => $value) {
                    if ($id === $value["id"]) {
                        echo "
                        <p> LOGGAN HÄR! </p>
                        ";
                    }
                }
            }
            ?>
            
<?php
            $data = json_decode(file_get_contents("API/users.json"), true);
            $sessionID = $_SESSION["id"];

            // kollar om man är inloggad + kontrakt = visar headern för användaren.
            if (isset($_SESSION["id"])) {
                $id = $_SESSION["id"];

                foreach ($data as $key => $value) {
                    if ($id == $value["id"]) {
                        // göra if-sats för bara inloggning har tillgång till anv.
                        if ($value["contract"]) {
                            echo "
                            <p> LOGGAN HÄR! </p>";                
                        }                          
                    }
                }  
            }

    $sessionID = $_SESSION["id"];
    $userName = $_SESSION["username"];
    

    echo "<script> const ID = $id </script>";
    echo "<script> const USER_NAME = $userName </script>";
            ?>
        </header>
        <main id="wrapper">

