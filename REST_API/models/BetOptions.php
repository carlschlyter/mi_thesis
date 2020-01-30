<?php
    class BetOptions{
        private $conn;
        private $table = 'Matches';

        public $matchid;
        public $matchname;
        public $matchdate;

        public function __construct($db){
            $this->conn = $db;
        }

        public function read(){
            $query = 'SELECT MatchID, MatchName, MatchDate FROM' . $this->table . 'ORDER BY MatchDate DESC';

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
        }
    }

    ?>