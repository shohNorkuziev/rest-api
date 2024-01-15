<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Methods: POST");

include_once "../config/database.php";
include_once "../objects/category.php";

$database = new Database();
$db =$database->getConnection();
$category = new Category($db);

$data = json_decode(file_get_contents("php://input"));
if(
    !empty($data->name) &&
    !empty($data->description)
    ){
        $category->name = $data->name;
        $category->description = $data->description;
        $category->created = date("Y-m-d H:i:s");
        if ($category->create()) {
            http_response_code(201);
            echo json_encode(array("message" => "Категория создана"), JSON_UNESCAPED_UNICODE);
        }
    }else{
            http_response_code(400);
            echo json_encode(array("message" => "Невозможно создать категорию данные не полные"), JSON_UNESCAPED_UNICODE);
        }