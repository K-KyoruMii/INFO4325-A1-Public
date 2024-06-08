<?php
    
    /* connection2 is used for database handling. 
       All examination data is handled through this class */

    class Database {
        private $host = 'localhost';
        private $dbname = 'examData';
        private $username = 'mgs_user';
        private $password = 'pa55word';
        private $conn;
    
        public function connect() {
            $this->conn = null;
    
            try {
                
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname, $this->username, $this->password);
                
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo 'Connection Error: ' . $e->getMessage();
            }
    
            return $this->conn;
        }
    }

?>