<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=utf-8");

include_once "../config/database.php";
include_once "../objects/product.php";

$database = new Database();
$db =$database->getConnection();
$product = new Product($db);

$data = json_decode(file_get_contents("php://input"));

$product->id = $data->id;
$product->name = $data->name;
$product->description = $data->description;
$product->price = $data->price;
$product->id = $data->id;
$product->category_id = $data->category_id;

if ($product->update()) {
    http_response_code(201);
    echo json_encode(array("message" => "Товар успешно обновлен"), JSON_UNESCAPED_UNICODE);
}else{
    http_response_code(503);
    echo json_encode(array("message" => "Невозможно обновить товар"), JSON_UNESCAPED_UNICODE);
}