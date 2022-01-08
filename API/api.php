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
?>