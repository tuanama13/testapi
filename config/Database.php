<?php
    class Database{
        private $host = '139.99.114.112';
        private $db_name = 'ofieldwe_main';
        private $username = 'ofieldwe_main';
        private $password = 'ambrosius13';
        private $conn;

        public function connect()
        {
            $this->conn = null;

            try {
                $this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->db_name,$this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
               echo 'Connection Error : '. $e->getMessage(); 
            }

            return $this->conn;
        }
    }
