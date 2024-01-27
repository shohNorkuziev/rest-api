<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json");

include_once "../config/database.php";
include_once "../objects/user.php";

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

$user->id = isset($_GET['id']) ? $_GET['id'] : die();

$user->read();

if ($user->firstname !=NULL) 
{
    $users_arr = array
    (
        "id" => $user->id,
        "firstname" => $user->firstname,
        "lastname" => $user->lastname,
        "email" => $user->email,
        "password" => $user->password
    );
    
    echo json_encode($users_arr);
    http_response_code(200);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Товары не найдены"), JSON_UNESCAPED_UNICODE);
}
