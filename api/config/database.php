<?php

class Database
{
    private $host ="localhost";
    private $dbname ="api_db";
    private $username ="root";
    private $password ="";
    private $port ="3307";
    public $conn;

    public function getConnection()
    {
        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";port=" . $this->port, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Ошибка подключения" . $exception->getMessage();
        }
        return $this->conn;
    }
}