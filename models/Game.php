<?php
    class Game {
        private $conn;
        private $table = 'Matches';

        public $MatchID;
        public $MatchName;

        
        public function __construct($db) {
            $this->conn = $db;
        }

        public function read(){
            $query = 'SELECT MatchID, MatchName FROM ' . $this->table;

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;            
        }
    }
?>

   