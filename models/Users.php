<?php
    class User
    {
        private $conn;
        private $table = 'table_user';

        // User Properties
        public $id_user;
        public $email_user;
        public $password_user;
        public $name_user;
        public $tlp_user;
        public $address_user;
        public $api_key_user;
        public $hit;


        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function read()
        {
            $query = 'SELECT * FROM table_user';

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        public function read_single()
        {
            $query = 'SELECT * FROM table_user WHERE id_user = ?';

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->email_user = $row['email_user'];
            $this->password_user = $row['password_user'];
            $this->name_user = $row['name_user'];
            $this->tlp_user = $row['tlp_user'];
            $this->address_user = $row['address_user'];
            $this->api_key_user = $row['api_key_user'];
            $this->hit = $row['hit'];

            // return $stmt;
        }
    }
    