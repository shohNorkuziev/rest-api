<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=utf-8");

include_once "../config/database.php";
include_once "../objects/user.php";

$database = new Database();
$db =$database->getConnection();
$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

$user->id = $data->id;
$user->firstname  = $data->firstname ;
$user->lastname = $data->lastname;
$user->email = $data->email;
$user->password = $data->password;

if ($user->update()) {
    http_response_code(201);
    echo json_encode(array("message" => "Пользователь успешно обновлен"), JSON_UNESCAPED_UNICODE);
}else{
    http_response_code(503);
    echo json_encode(array("message" => "Невозможно обновить пользователя"), JSON_UNESCAPED_UNICODE);
}