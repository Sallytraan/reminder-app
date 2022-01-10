<?php
//POST/PATCH/DELETE
$method = $_SERVER["REQUEST_METHOD"];

if ($method === "OPTIONS") {
    // Tillåt alla (origins) och alla headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    exit();
} 

// Alla är vällkommna
header("Access-Control-Allow-Origin: *");
/*
if ($method === "GET") {
    header("Content-Type: application/json");
    echo json_encode(["message" => "hej"]);
    exit();
}
*/
if ($method === "POST") {

}

if ($method === "DELETE") {

}

    //Behöver nytt användarnamn
    if ($rqstMethod === "PATCH") {
        if (isset($rqstData["username"], $_SESSION["username"])) {
            $users = loadJson("api/user.json");
            $newNameTag = $rqstData["username"];
            $foundUser = false;

            // DB BACKUP
            saveJson("api/users_backup.json", $users);


            foreach ($users as $key => $user) {
                if ($_SESSION["username"] == $user["username"]) {
                    $foundUser = true;
                    $users[$key]["username"] = $newNameTag;
                }
            }
            if ($foundUser) {
                saveJson("api/users.json", $users);
                statusCode(212);
            } else {
                statusCode(462);
            }
            ///DELETE INVENTORY ITEM
        } 
    }

?>