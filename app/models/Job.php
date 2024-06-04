<?php

namespace App\Models;

class Job {
    private $conn;
    private $table_name = "jobs";

    public $id;
    public $title;
    public $description;
    public $posted_by;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create a new job
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET title=:title, description=:description, posted_by=:posted_by";
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));

        // bind values
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":posted_by", $this->posted_by);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Read all jobs
    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}
?>
