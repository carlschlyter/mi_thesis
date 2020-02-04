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
            $query = 'SELECT MatchID, MatchName, MatchDate, Status FROM ' . $this->table . ' WHERE Status = "kommande" ORDER BY MatchDate';

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;            
        }
    }
?>

   