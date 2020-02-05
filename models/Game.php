<?php
    class Game {
        private $conn;
        private $table = 'Matches';

        public $MatchID;
        public $MatchName;
        public $GoalsHome;
        public $GoalsAway;
        public $WinningTeam;
        public $MatchDate;
        public $Status;

        
        public function __construct($db) {
            $this->conn = $db;
        }

        //READ GAMES
        public function read(){
            $query = 'SELECT MatchID, MatchName, MatchDate, Status FROM ' . $this->table . ' WHERE Status = "kommande" ORDER BY MatchDate';

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;            
        }

        //CREATE GAME
        public function create(){
            $query = 'INSERT INTO ' . $this->table . ' 
            SET
                MatchID = :MatchID,
                MatchName = :MatchName,
                GoalsHome = :GoalsHome,
                GoalsAway = :GoalsAway,
                WinningTeam = :WinningTeam,
                MatchDate = :MatchDate,
                Status = :Status';

                $stmt = $this->conn->prepare($query);

                //CLEAN DATA
                $this->MatchID = htmlspecialchars(strip_tags($this->MatchID));
                $this->MatchName = htmlspecialchars(strip_tags($this->MatchName));
                $this->GoalHome = htmlspecialchars(strip_tags($this->GoalsHome));
                $this->GoalsAway = htmlspecialchars(strip_tags($this->GoalsAway));
                $this->WinningTeam = htmlspecialchars(strip_tags($this->WinningTeam));
                $this->MatchDate = htmlspecialchars(strip_tags($this->MatchDate));
                $this->Status = htmlspecialchars(strip_tags($this->Status));
    
                //BIND DATA
                $stmt->bindParam(':MatchID', $this->MatchID);
                $stmt->bindParam(':MatchName', $this->MatchName);
                $stmt->bindParam(':GoalsHome', $this->GoalsHome);
                $stmt->bindParam(':GoalsAway', $this->GoalsAway);
                $stmt->bindParam(':WinningTeam', $this->WinningTeam);
                $stmt->bindParam(':MatchDate', $this->MatchDate);
                $stmt->bindParam(':Status', $this->Status);
    
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

   