<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json");

include_once "../config/database.php";
include_once "../objects/category.php";

$database = new Database();
$db = $database->getConnection();
$category = new Category($db);

$category->id = isset($_GET["id"]) ? $_GET["id"] : die();

$category->readOne();

if ($category->name !=NULL) {
    $categories_arr = array(
        "id" => $category->id,
        "name" => $category->name,
        "description" => $category->description
    );
    http_response_code(200);
    echo json_encode($categories_arr);
}else{
    http_response_code(400);
    echo json_encode(array("message" => "Категория не существует"), JSON_UNESCAPED_UNICODE);
}