<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

include_once "../config/database.php";
include_once "../objects/user.php";

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$stmt = $user->read();
$num = $stmt->rowCount();

if ($num > 0) {
    $users_arr = array();
    $users_arr["records"] = array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $user_item = array(
            "id" => $id,
            "firstname" => $firstname,
            "lastname" => $lastname,
            "email" => $email,
            "password" => $password
        );
       array_push($users_arr["records"], $user_item);

        
    }
    echo json_encode($users_arr);
    http_response_code(200);
}else{
    http_response_code(404);
    echo json_encode(array("message" => "Товары не найдены"), JSON_UNESCAPED_UNICODE);

}