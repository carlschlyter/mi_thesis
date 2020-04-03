<?php
    class Bet {
        private $conn;
        private $table_bets = 'Bets';
        private $table_betters = 'Betters';
        private $table_matches = 'Matches';

        public $BetID;
        public $BetterID;
        public $BetterNick;
        public $MatchID;
        public $MatchName;
        public $GoalsHomeBet;
        public $GoalsAwayBet;
        public $WinningTeamBet;
        public $GoalsHomeAct;
        public $GoalsAwayAct;
        public $WinningTeamAct;
        public $LiveBetPoints;
        public $LiveBetPointsWinning;
        public $LiveBetPointsTotal;
        
        public function __construct($db) {
            $this->conn = $db;
        }

        //READ BETS
        public function read(){
            $query = 'SELECT matches.MatchID, matches.MatchName, matches.MatchDate, round(avg(bets.GoalsHomeBet)) AS GoalsHomeBetAvg, round(avg(bets.GoalsAwayBet)) AS GoalsAwayBetAvg FROM ' . $this->table_matches . ' AS matches 
            JOIN ' . $this->table_bets . ' AS bets ON matches.MatchID = bets.MatchID 
            JOIN ' . $this->table_betters . ' AS betters ON bets.BetterID = betters.BetterID
            WHERE matches.Status = "kommande"
            GROUP BY matches.MatchID
            ORDER by matches.MatchName';

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;            
        }

        //CREATE BET
        public function create(){
            $query = 'INSERT INTO ' . $this->table_bets . ' 
            SET
                BetID = UUID(),
                (SELECT BetterID FROM Betters WHERE ' . $this->BetterNick . ' = :BetterNick),
                (SELECT MatchID FROM Matches WHERE ' . $this->MatchName . ' = :MatchName),
                GoalsHomeBet = :GoalsHomeBet,
                GoalsAwayBet = :GoalsAwayBet,
                WinningTeamBet = :WinningTeamBet, ' .
                $this->GoalsHomeAct . ' = NULL, ' .
                $this->GoalsAwayAct . ' = NULL, ' .
                $this->WinningTeamAct . ' = NULL, ' . 
                $this->LiveBetPoints . ' = 0, ' .
                $this->LiveBetPointsWinning . ' = NULL, ' .
                $this->LiveBetPointsTotal . ' = NULL';

                $stmt = $this->conn->prepare($query);

                //CLEAN DATA
                $this->BetterNick = htmlspecialchars(strip_tags($this->BetterNick));
                $this->MatchName = htmlspecialchars(strip_tags($this->MatchName));
                $this->GoalsHomeBet = htmlspecialchars(strip_tags($this->GoalsHomeBet));
                $this->GoalsAwayBet = htmlspecialchars(strip_tags($this->GoalsAwayBet));
                $this->WinningTeamBet = htmlspecialchars(strip_tags($this->WinningTeamBet));

                //BIND DATA
                $stmt->bindParam(':BetterNick', $this->BetterNick);
                $stmt->bindParam(':MatchName', $this->MatchName);
                $stmt->bindParam(':GoalsHomeBet', $this->GoalsHomeBet);
                $stmt->bindParam(':GoalsAwayBet', $this->GoalsAwayBet);
                $stmt->bindParam(':WinningTeamBet', $this->WinningTeamBet);

                //EXECUTE QUERY
                if($stmt->execute()){
                    return true;
                }
    
                //PRINT ERROR IF SMTHNG GOES WRONG
                printf("Error: %s.\n", $stmt->error);
                return false;
            }
    }

?>