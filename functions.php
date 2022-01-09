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