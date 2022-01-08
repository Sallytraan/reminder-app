<?php
//POST/PATCH/DELETE

// Skicka ut JSON till en användare
function send($data, $statusCode = 200) {
    header("Content-Type: application/json");
    http_response_code($statusCode);
    $json = json_encode($data);
    echo $json;
    exit();
}

// laddar ner json till associative array.
function loadJson($filename) {
    $json = file_get_contents($filename);
    return json_decode($json, true);
}

// gör om det nya associative array och sparar i db som json.
function saveJson($filename, $data) {
    $json = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($filename, $json);
}

//Hittar det högsts id:et
function theHighestId($array)
{
    $userID = 0;
    foreach ($array as $obj) {
        if ($obj["id"] > $userID) {
            $userID = $obj["id"];
        }
    }
    $userID = $userID + 1;
    return $userID;
}


function changeTheContract(){

    if (isset($_SESSION["id"])) {

    $id = $_SESSION["id"];
    $data = json_decode(file_get_contents("API/users.json"), true);
    $allUsers = $data;

    foreach ($allUsers as $key => $value) {
        if ($allUsers["id"] == $_SESSION["id"]) {
            $found = true;
            if ($found = true){
                $allUsers["contract"] = true;
                header("Location:/index.php");
                exit();
            }
        }
    }
}
}  
$changeTheContract = changeTheContract();



function changeIt(){
    $found = false;
    $newContract = null;
    $theUsers = loadJson("../API/users.json");

    foreach ($theUser as $index => $user){
        if($user["id"] == $_SESSION["id"]){
            $found = true;

            $user["contract"] = true;
            $theUsers[$index] = $user;
            $newContract = $user;

            
            break;
        }
    } 
    saveJson("../API/users.json", $theUsers);
    send($newContract);
}

function idk(){
    $newUser["id"] = $highestID + 1;
    $_SESSION["id"] = $newUser["id"];
    $_SESSION["username"] = $newUser["username"];
    //lägg till user i db.json
    $data = json_decode(file_get_contents("../API/users.json"), true);
    array_push($data, $newUser);
    $json = json_encode($data, JSON_PRETTY_PRINT);
}





?>