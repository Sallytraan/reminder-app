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

if ($method === "GET") {
    header("Content-Type: application/json");
    echo json_encode(["message" => "hej"]);
    exit();
}

if ($method === "POST") {

}

if ($method === "DELETE") {

}


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

/*
$changeTheContract = function(){

    $json = file_get_contents("../API/users.json");
    $data = json_decode($json, true);
    $allUsers = $data;

    foreach ($companies as $index => $company) {
        if ($allUsers["id"] == $_SESSION["id"]) {
            $found = true;
            if ($found = true){
                $allUsers["contract"] = true;
            }
        }
    }
}*/
?>