<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=utf-8");

include_once "../config/database.php";
include_once "../objects/product.php";

$database = new Database();
$db = $database->getConnection();
$product = new Product($db);

$data = json_decode(file_get_contents("php://input"));

$product->id = $data->id;

if ($product->delete()) {
    http_response_code(200);
    echo json_encode(array("message" => "Товар успешно удален"), JSON_UNESCAPED_UNICODE);
}else{
    http_response_code(503);
    echo json_encode(array("message" => "Невозможно удалить товар"), JSON_UNESCAPED_UNICODE);
}