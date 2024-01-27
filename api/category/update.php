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
$category->name = $data->name;
$category->description = $data->description;
if (!empty($data->name) && !empty($data->description)) {
    $category->id = $data->id;
    $category->name = $data->name;
    $category->description = $data->description;
    if ($category->update()) {
        http_response_code(201);
        echo json_encode(array("message" => "Категория успешно обновлен"), JSON_UNESCAPED_UNICODE);
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Невозможно обновить категорию"), JSON_UNESCAPED_UNICODE);
    }
} else {
    http_response_code(400);
        echo json_encode(array("message" => "Невозможно обновить категорию данные не полные"), JSON_UNESCAPED_UNICODE);
}
