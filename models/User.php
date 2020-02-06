<?php
    class User {
        private $conn;
        private $table = 'Users';

        public $UserID;
        public $FirstName;
        public $LastName;
        public $Email;
        public $UserName;
        public $PassWord;
        public $City;
        
        public function __construct($db) {
            $this->conn = $db;
        }

        //READ USERS
        public function read(){
            $query = 'SELECT UserID, FirstName, LastName, Email FROM ' . $this->table . ' ORDER BY LastName DESC';

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;            
        }

        //CREATE USER
        public function create(){
            $query = 'INSERT INTO ' . $this->table . ' 
            SET
                UserID = UUID(),
                FirstName = :FirstName,
                LastName = :LastName,
                Email = :Email,
                UserName = :UserName,
                PassWord = :PassWord,
                City = :City';

                $stmt = $this->conn->prepare($query);

                //CLEAN DATA
                // $this->UserID = htmlspecialchars(strip_tags($this->UserID));
                $this->FirstName = htmlspecialchars(strip_tags($this->FirstName));
                $this->LastName = htmlspecialchars(strip_tags($this->LastName));
                $this->Email = htmlspecialchars(strip_tags($this->Email));
                $this->UserName = htmlspecialchars(strip_tags($this->UserName));
                $this->PassWord = password_hash($this->PassWord, PASSWORD_DEFAULT);
                $this->City = htmlspecialchars(strip_tags($this->City));
    
                //BIND DATA
                // $stmt->bindParam(':UserID', $this->UserID);
                $stmt->bindParam(':FirstName', $this->FirstName);
                $stmt->bindParam(':LastName', $this->LastName);
                $stmt->bindParam(':Email', $this->Email);
                $stmt->bindParam(':UserName', $this->UserName);
                $stmt->bindParam(':PassWord', $this->PassWord);
                $stmt->bindParam(':City', $this->City);
    
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