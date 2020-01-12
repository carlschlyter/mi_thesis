<?php
class Database {
    private $host = 'localhost';
    private $dbname = 'praktik_projektet';
    private $charset = 'utf8';
    private $username = 'root';
    private $password = 'root';
    private $conn;
    
    public function connect(){
        $this->conn = null;

        try {
          $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname, ';charset=' . $this->charset,$this->username,$this->password);
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
        } catch(PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }
}

// mysql:host=localhost;dbname=praktik_projektet,root, root