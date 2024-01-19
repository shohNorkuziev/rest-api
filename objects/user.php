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
        SET firstname=:firstname,  
        lastname=:lastname, 
        email=:email, 
        password=:password, 
        created=:created
        ";

        $stmt = $this->conn->prepare($query);

        $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        $this->lastname = htmlspecialchars(strip_tags($this->lastname));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);

        $stmt->bindParam(":firstname", $this->firstname);
        $stmt->bindParam(":lastname", $this->lastname);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $password_hash);
        $stmt->bindParam(":created", $this->created);

        if ($stmt->execute()) {
            return true;
        } return false;
    }

    function update()
    {
        $query = "UPDATE
        " . $this->table_name . "
        SET
        firstname=:firstname,
        lastname=:lastname,
        email=:email 
        WHERE id =:id
        ";

        $stmt = $this->conn->prepare($query);

        $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        $this->lastname = htmlspecialchars(strip_tags($this->lastname));
        $this->email = htmlspecialchars(strip_tags($this->email));

        $stmt->bindParam(":firstname", $this->firstname);
        $stmt->bindParam(":lastname", $this->lastname);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id =:id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
