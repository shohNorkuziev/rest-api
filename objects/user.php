<?php

class User
{
    private $conn;
    private $table_name = "users";

    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $created;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {
        $query = "SELECT
        id,
        firstname,
        lastname,
        email,
        password,
        created FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function create()
    {
        $query = "INSERT INTO 
        " . $this->table_name . "
        SET firstname:firstname, 
        lastname:lastname, 
        email:email, 
        password:password, 
        created:created
        ";

        $stmt = $this->conn->prepare($query);

        $this->firstname = htmlspecialchars(strip_tags($this->name));
    }
}
