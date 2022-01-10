<?php
// skicka alla json-funktioner hit

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


// Letar igenom api:n och kollar vilket det högsta 
// ID:et är, används sedan när man skapar konto
function getMaxID($data, $id){
    if( count($data) < 1 ) {
        return 0;
    }
    $column = array_column($data, $id);
    $maxID = max($column);
    return $maxID;
}

// Lägger till en ny hundägare eller hundvakt med data från formuläret
function addEntry ($filename, $entry) {
    $data = loadJSON($filename);
    array_push($data, $entry);
    saveJson($filename, $data);
}

//Uppdatera user
function updateUser ($filename, $entry) {
    $data = loadJSON($filename);
    array_push($data, $entry);
    saveJson($filename, $data);
}

function idInfoUser($id){
    $json = file_get_contents( __DIR__ . "/API/users.json");
    $data = json_decode($json, true);
    $allSitters = $data;
    foreach($allUsers as $user){
        if($user["id"] == $id){
            return $user;
        }
    }
}

/*
$changeTheContract = function(){

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
}*/
?>