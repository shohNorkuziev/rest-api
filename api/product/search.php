<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json");

include_once "../config/database.php";
include_once "../objects/product.php";

$database = new Database();
$db = $database->getConnection();
$product = new Product($db);

$keywords = isset($_GET["s"]) ? $_GET["s"] : "";

$stmt = $product->search($keywords);
$num = $stmt->rowCount();

if($num > 0){
    $products_arr = array();
    $products_arr["records"] = array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $product_item = array(
            "id" => $id,
            "name" => $name,
            "description" => $description,
            "price" => $price,
            "category_id" => $category_id,
            "category_name" => $category_name,
        );
       array_push($products_arr["records"], $product_item);

        
    }
    echo json_encode($products_arr);
    http_response_code(200);
}else{
    http_response_code(404);
    echo json_encode(array("message" => "Товары не найдены"), JSON_UNESCAPED_UNICODE);

}
