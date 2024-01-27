<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

include_once "../config/database.php";
include_once "../objects/category.php";

$database = new Database();
$db = $database->getConnection();

$category = new Category($db);

$stmt = $category->read();
$num = $stmt->rowCount();

if($num > 0){
    $categories_arr = array();
    $categories_arr["records"] = array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $category_item = array(
            "id" => $id,
            "name" => $name,
            "description" => $description
        );
       array_push($categories_arr["records"], $category_item);

        
    }
    echo json_encode($categories_arr);
    http_response_code(200);
}else{
    http_response_code(404);
    echo json_encode(array("message" => "Категории не найдены"), JSON_UNESCAPED_UNICODE);

}