<?php
    class Post {
        private $conn;
        private $table = 'Matches';

        public $matchid;
        public $matchname;
        
        public function __construct($db) {
            $this->conn = $db;
        }

        public function Read(){
            $query = 'SELECT MatchID, MatchName FROM' . $this->table;

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
        }
    }
