<?php

class Product
{
    private $conn;
    private $table_name = "products";

    public $id;
    public $name;
    public $description;
    public $price;
    public $category_id;
    public $category_name;
    public $created;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {
        $query = "SELECT
        c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
        FROM " . $this->table_name . " p 
        LEFT JOIN
        categories c 
        ON p.category_id = c.id
        ORDER BY
        p.created DESC";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }
    function create()
    {
        $query = "INSERT into
        " . $this->table_name . "
        SET
        name=:name, description=:description, price=:price, category_id=:category_id, created=:created
        ";

        $stmt = $this->conn->prepare($query);
        //очистка
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":category_id", $this->category_id);
        $stmt->bindParam(":created", $this->created);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    function readOne()
    {
        $query = "SELECT
            c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
            FROM " . $this->table_name . " p 
            LEFT JOIN
            categories c 
            ON p.category_id = c.id
            WHERE p.id = ?
            LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row["name"];
        $this->description = $row["description"];
        $this->price = $row["price"];
        $this->category_id = $row["category_id"];
        $this->category_name = $row["category_name"];
        return $stmt;
    }
    function update()
    {
        $query = "UPDATE
        " . $this->table_name . "
        SET
        name=:name,
        description=:description,
        price=:price,
        category_id=:category_id
        WHERE id =:id
        ";

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":category_id", $this->category_id);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    function delete()
    {
        $query = "DELETE FROM 
        " . $this->table_name . " 
        WHERE id =:id 
        ";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $this->id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function search($keywords)
    {
        $query = "SELECT
        c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
        FROM " . $this->table_name . " p 
        LEFT JOIN
        categories c 
        ON p.category_id = c.id
        WHERE p.name LIKE ? or p.description LIKE ?  OR c.name LIKE ?
        ORDER BY
        p.created DESC";

        $stmt = $this->conn->prepare($query);
        $keywords = htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);
        $stmt->execute();
        return $stmt;
    }

    function readPaging($from_record_num, $records_per_pages)
    {
        $query = "SELECT 
        c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
        FROM " . $this->table_name . " p 
        LEFT JOIN
        categories c 
        ON p.category_id = c.id
        ORDER BY
        p.created DESC 
        LIMIT ?, ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_pages, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    function count()
    {
        $query = "SELECT COUNT(*) as total_rows fROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row["total_rows"];
    }
}
