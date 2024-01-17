<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Methods: POST");

include_once "../config/database.php";
include_once "../objects/user.php";

$database = new Database();
$db =$database->getConnection();
$user = new User($db);

$data = json_decode(file_get_contents("php://input"));
if(
    !empty($data->firstname) &&
    !empty($data->lastname) &&
    !empty($data->email) &&
    !empty($data->password)
    ){
        $user->firstname = $data->firstname;
        $user->lastname = $data->lastname;
        $user->email = $data->email;
        $user->password = $data->password;
        $user->created = date("Y-m-d H:i:s");
        if ($user->create()) {
            http_response_code(201);
            echo json_encode(array("message" => "Пользователь создан"), JSON_UNESCAPED_UNICODE);
        }
    }else{
            http_response_code(400);
            echo json_encode(array("message" => "Невозможно создать пользователя данные не полные"), JSON_UNESCAPED_UNICODE);
        }