<?php
    class Test {
        private $conn;
        private $table = 'Test';

        public $TestID;
        public $TestName;
        
        public function __construct($db) {
            $this->conn = $db;
        }

        //READ TESTS
        public function read(){
            $query = 'SELECT TestID, TestName FROM ' . $this->table . 'ORDER BY TestName';

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;            
        }

        //CREATE TEST
        public function create(){
            $query = 'INSERT INTO ' . $this->table . ' 
            SET
                TestID = :TestID,
                TestName = :TestName';

                $stmt = $this->conn->prepare($query);

                //CLEAN DATA
                $this->TestID = htmlspecialchars(strip_tags($this->TestID));
                $this->TestName = htmlspecialchars(strip_tags($this->TestName));
    
                //BIND DATA
                $stmt->bindParam(':TestID', $this->TestID);
                $stmt->bindParam(':TestName', $this->TestName);
    
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