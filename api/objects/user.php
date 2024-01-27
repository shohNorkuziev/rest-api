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
        created FROM " . $this->table_name . " WHERE id = ? ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row["id"];
        $this->firstname = $row["firstname"];
        $this->lastname = $row["lastname"];
        $this->email = $row["email"];
        $this->password = $row["password"];
        
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
        email=:email, 
        password=:password
        WHERE id =:id
        ";

        $stmt = $this->conn->prepare($query);

        $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        $this->lastname = htmlspecialchars(strip_tags($this->lastname));
        $this->email = htmlspecialchars(strip_tags($this->email));

        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);

        $stmt->bindParam(":firstname", $this->firstname);
        $stmt->bindParam(":password", $password_hash);
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

    function emailExists() {
        $query = 'SELECT
          u.id, u.firstname, u.lastname, u.email, u.password, u.created
          FROM '. $this -> table_name .' u 
          WHERE u.email = ?';
      
          $stmt = $this->conn->prepare($query);
      
          $this -> email = htmlspecialchars(strip_tags($this->email));
          $stmt -> bindParam(1, $this -> email);
      
          $stmt -> execute();
      
          $num = $stmt -> rowCount();
          if ($num > 0 ) {
            $row = $stmt -> fetch(PDO::FETCH_ASSOC);
            $this -> id = $row['id'];
            $this -> firstname = $row['firstname'];
            $this -> lastname = $row['lastname'];
            $this -> password = $row['password']; 
            
            return true;
          } else {
            return false;
          }
            
        }
      }

