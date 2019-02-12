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
            $query = 'SELECT * FROM table_user WHERE hit != 0';

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

        public function create()
        {
            $query = 'INSERT INTO table_user SET 
                email_user = :email_user,
                password_user = :password_user,
                name_user = :name_user,
                tlp_user = :tlp_user,
                address_user = :address_user,
                api_key_user = :api_key_user,
                hit = :hit';

            $stmt = $this->conn->prepare($query);
            
            // Clean Data
            $this->email_user = htmlspecialchars(strip_tags($this->email_user));
            $this->password_user = htmlspecialchars(strip_tags($this->password_user));
            $this->name_user = htmlspecialchars(strip_tags($this->name_user));
            $this->tlp_user = htmlspecialchars(strip_tags($this->tlp_user));
            $this->address_user = htmlspecialchars(strip_tags($this->address_user));
            $this->api_key_user = htmlspecialchars(strip_tags($this->api_key_user));
            $this->hit = htmlspecialchars(strip_tags($this->hit));

            $stmt->bindParam(':email_user', $this->email_user);
            $stmt->bindParam(':password_user', $this->password_user);
            $stmt->bindParam(':name_user', $this->name_user);
            $stmt->bindParam(':tlp_user', $this->tlp_user);
            $stmt->bindParam(':address_user', $this->address_user);
            $stmt->bindParam(':api_key_user', $this->api_key_user);
            $stmt->bindParam(':hit', $this->hit);

            
            if ($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->execute());
 
            return false;
        }

        public function update()
        {
            $query = 'UPDATE table_user 
                SET 
                    email_user = :email_user,
                    password_user = :password_user,
                    name_user = :name_user,
                    tlp_user = :tlp_user,
                    address_user = :address_user,
                    api_key_user = :api_key_user,
                    hit = :hit
                WHERE 
                    id_user = :id';

            $stmt = $this->conn->prepare($query);
            
            // Clean Data
            $this->email_user = htmlspecialchars(strip_tags($this->email_user));
            $this->password_user = htmlspecialchars(strip_tags($this->password_user));
            $this->name_user = htmlspecialchars(strip_tags($this->name_user));
            $this->tlp_user = htmlspecialchars(strip_tags($this->tlp_user));
            $this->address_user = htmlspecialchars(strip_tags($this->address_user));
            $this->api_key_user = htmlspecialchars(strip_tags($this->api_key_user));
            $this->hit = htmlspecialchars(strip_tags($this->hit));
            $this->id_user = htmlspecialchars(strip_tags($this->id_user));

            $stmt->bindParam(':email_user', $this->email_user);
            $stmt->bindParam(':password_user', $this->password_user);
            $stmt->bindParam(':name_user', $this->name_user);
            $stmt->bindParam(':tlp_user', $this->tlp_user);
            $stmt->bindParam(':address_user', $this->address_user);
            $stmt->bindParam(':api_key_user', $this->api_key_user);
            $stmt->bindParam(':hit', $this->hit);
            $stmt->bindParam(':id', $this->id_user); 

            
            if ($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->execute());
 
            return false;
        }

        public function delete()
        {
             $query = 'DELETE FROM table_user 
                WHERE 
                    id_user = :id';

            $stmt = $this->conn->prepare($query);
            
            $this->id_user = htmlspecialchars(strip_tags($this->id_user));

            $stmt->bindParam(':id', $this->id_user); 

            if ($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->execute());
 
            return false;
        }
    }
    