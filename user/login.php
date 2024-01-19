<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=utf-8");

include_once "../config/database.php";
include_once "../objects/user.php";

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

$user->email = $data->email;
$email_exists = $user->emailExists();

include_once "../config/core.php";
include_once "../libs/php-jwt-main/src/BeforeValidException.php";
include_once "../libs/php-jwt-main/src/ExpiredException.php";
include_once "../libs/php-jwt-main/src/JWT.php";
include_once "../libs/php-jwt-main/src/SignatureInvalidException.php";
include_once "../libs/php-jwt-main/src/Key.php";

use \Firebase\JWT\JWT;

if ($email_exists && password_verify($data->password, $user->password)) {
    $token = array(
        "iss" => $iss,
        "aud" => $aud,
        "iat" => $iat,
        "nbf" => $nbf,
        "data" => array(
            "id" => $user->id,
            "firstname" => $user->firstname,
            "lastname" => $user->lastname,
            "email" => $user->email
        )
    );

    http_response_code(200);

    $jwt = JWT::encode($token , $key, 'HS256');
    echo json_encode(array("message" => "Успешный вход в систему", "jwt" => $jwt));
}else{
    http_response_code(404);
    echo json_encode(array("message" => "Ошибка входа"), JSON_UNESCAPED_UNICODE);
}