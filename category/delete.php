<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header("Content-Type: application/json; charset=utf-8");

include_once "../config/database.php";
include_once "../objects/category.php";

$database = new Database();
$db = $database->getConnection();
$category = new Category($db);

$data = json_decode(file_get_contents("php://input"));

$category->id = $data->id;

if ($category->delete()) {
    http_response_code(200);
    echo json_encode(array("message" => "Категория успешно удалена"), JSON_UNESCAPED_UNICODE);
}else{
    http_response_code(503);
    echo json_encode(array("message" => "Невозможно удалить категорию"), JSON_UNESCAPED_UNICODE);
}