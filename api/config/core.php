<?php
//переменные пагинации и базовый урл адрес
ini_set("display_errors", 1);
error_reporting(E_ALL);

$home_url = "http://api/";

$page = isset($_GET["page"]) ? $_GET["page"] : 1;

$records_per_page = 5;

$from_record_num = ($records_per_page * $page) - $records_per_page;

$key = "secret_key";
$iss = "http://api.org";
$aud = "http://api.com";
$iat = 1356999524;
$nbf = 1357000000;