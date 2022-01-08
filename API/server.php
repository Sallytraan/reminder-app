<?php
session_start();
require_once "functions.php";
//fil för serverhantering. Här sker alla GET, POST, 
//PATCH och DELETE.


$rqstMethod = $_SERVER["REQUEST_METHOD"];
$contentType = $_SERVER["CONTENT_TYPE"];

$data = file_get_contents("php://input");
$rqstData = json_decode($data, true);


// Alla är välkommna
header("Access-Control-Allow-Origin: *");

//TODO
//lägg till kontroll om användarnamn redan finns.
//ändra nycklar till SESSION, där det sker inloggning 
//och när vi behöver klla om någon är inloggad
if ($contentType == "application/json") {


    //Ändra användarnamn
    //Behöver nytt användarnamn
    if ($rqstMethod === "PATCH") {
        if (isset($rqstData["contract"])) {
            $users = loadJson("users.json");
            $theContract = $rqstData["contract"];

                saveJson("api/user.json", $users);

            ///DELETE INVENTORY ITEM
        } 
    }









} else {
    statusCode(405);
}
