<?php
class Database {

    private $db_host = "localhost";
    private $db_name = "test";
    private $db_user = "root";
    private $db_pass = "root";
    public $conn;

    public function connect(){
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=".$this->db_host.";dbname=".$this->db_name, $this->db_user, $this->db_pass);
            return $this->conn;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>