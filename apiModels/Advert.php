<?php
class Advert {
    private $conn;

    public $id;
    public $title;
    public $descr;
    public $price;
    public $photo;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function get_items($query) {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function get_item() {
        $stmt = $this->conn->prepare("SELECT * FROM adv WHERE id=?");
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}