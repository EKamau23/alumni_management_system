<?php

namespace App\Models;

class Profile {
    private $conn;
    private $table_name = "profiles";

    public $id;
    public $user_id;
    public $name;
    public $email;
    public $phone;
    public $address;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create or update profile
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET user_id=:user_id, name=:name, email=:email, phone=:phone, address=:address
                  ON DUPLICATE KEY UPDATE name=:name, email=:email, phone=:phone, address=:address";
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->address = htmlspecialchars(strip_tags($this->address));

        // bind values
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":address", $this->address);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Read profile by user ID
    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);

        // bind user_id
        $stmt->bindParam(1, $this->user_id);
        $stmt->execute();

        return $stmt;
    }
}
?>
