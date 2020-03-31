<?php
    class Toplist {
        private $conn;
        private $table_matches = 'Matches';
        private $table_bets = 'Bets';
        private $table_betters = 'Betters';

        // public $bets_LiveBetPoints;
        // public $betters_BetterNick;
        // public $bets_BetterID;
        // public $betters_BetterID;
        // public $matches_MatchID;
        // public $bets_MatchID;
        // public $matches_Status;
        // public $TotPoints;

        
        public function __construct($db) {
            $this->conn = $db;
        }

        //READ TOPLIST
        public function read(){
            $query = 'SELECT SUM(bets.LiveBetPoints) AS TotPoints, betters.BetterID, betters.BetterNick FROM ' . $this->table_bets . ' AS bets JOIN ' . $this->table_betters  . ' AS betters ON . bets.BetterID = betters.BetterID JOIN ' . $this->table_matches . ' AS matches ON matches.MatchID = bets. MatchID WHERE matches.Status = "färdig"
            GROUP BY betters.BetterID
            ORDER BY TotPoints DESC';
            
            // 'SELECT MatchID, MatchName, MatchDate, Status FROM ' . $this->table . ' WHERE Status = "kommande" ORDER BY MatchDate';



            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;            
        }
    }

?>