<?php
    class Bet_options{
        private $conn;
        private $table = 'Matches';

        public $matchid;
        public $matchname;
        public $matchdate;
        public $status;

        public function __construct($db){
            $this->conn = $db;
        }

        //Get Bet options ie matches to bet on
        public function view(){
            $query = 'SELECT MatchName FROM' . $this->table;

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
        }

    }