<?php
//POST/PATCH/DELETE
require_once "../functions.php";

$method = $_SERVER["REQUEST_METHOD"];
$contentType = $_SERVER["CONTENT_TYPE"];

// data från json
$userData = loadJson("users.json");
$userOngoingTask = loadJson("ongoingList.json");

if ($method === "OPTIONS") {
    // Tillåt alla (origins) och alla headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    exit();
} 

// Alla är vällkommna
header("Access-Control-Allow-Origin: *");

/* if ($contentType !== "application/json") {
    send(
        ["message" => "Bad request. You're missing 'Content-Type'."],
        400
    );
} */

// något som finns i datorn idk.
$data = file_get_contents("php://input");
$requestData = json_decode($data, true);
/*
if ($method === "GET") {
    header("Content-Type: application/json");
    echo json_encode(["message" => "hej"]);
    exit();
}
*/


if ($method === "POST") {
    if ($contentType == "application/json") {

    }
    // skapar variabler
    $id = $requestData["id"];
    $userName = $requestData["username"];
    $email = $requestData["email"];
    $password = $requestData["password"];
    $image = $requestData["pictures"];
    $colorScheme = $requestData["color-scheme"];
    $_SESSION["contract"] = true;

    if (!isset($email, $password)) {
        if (!$_SESSION["contract"]) {
            send(
                ["message" => "Bad request. The contract is not signed."],
                400
            );
        }

        send(
            ["message" => "Bad request. There is one or more keys missing."],
            400
        );
    } else {
        send(
            ["message" => "great."]
        );
    }

    if (isset($id)) {
        send(
            ["message" => "The user 'id' is not allowed."],
            400
        );
    }
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