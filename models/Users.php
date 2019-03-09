<?php
    class User
    {
        private $conn;
        private $table = 'table_user';

        // User Properties
        public $id_user;
        public $email_user;
        public $password_user;
        public $nama_user;
        public $kontak_user;
        public $tgl_bergabung_user;
        public $api_key_user;


        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function read()
        {
            $query = "SELECT * FROM table_user";

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
            $this->nama_user = $row['nama_user'];
            $this->kontak_user = $row['kontak_user'];
            $this->tgl_bergabung_user = $row['tgl_bergabung_user'];
            $this->api_key_user = $row['api_key_user'];

            // return $stmt;
        }

        public function create()
        {
            $query = 'INSERT INTO table_user SET 
                email_user = :email_user,
                password_user = :password_user,
                nama_user = :nama_user,
                kontak_user = :kontak_user,
                api_key_user = :api_key_user';

            $stmt = $this->conn->prepare($query);
            
            // Clean Data
            $this->email_user = htmlspecialchars(strip_tags($this->email_user));
            $this->password_user = htmlspecialchars(strip_tags($this->password_user));
            $this->nama_user = htmlspecialchars(strip_tags($this->nama_user));
            $this->kontak_user = htmlspecialchars(strip_tags($this->kontak_user));
            $this->api_key_user = htmlspecialchars(strip_tags($this->api_key_user));

            $stmt->bindParam(':email_user', $this->email_user);
            $stmt->bindParam(':password_user', $this->password_user);
            $stmt->bindParam(':nama_user', $this->nama_user);
            $stmt->bindParam(':kontak_user', $this->kontak_user);
            $stmt->bindParam(':api_key_user', $this->api_key_user);
            
            
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
                    nama_user = :nama_user,
                    kontak_user = :kontak_user     
                    
                WHERE 
                    id_user = :id AND
                    api_key_user = :api_key_user ';

            $stmt = $this->conn->prepare($query);
            
            // Clean Data
            $this->email_user = htmlspecialchars(strip_tags($this->email_user));
            $this->password_user = htmlspecialchars(strip_tags($this->password_user));
            $this->nama_user = htmlspecialchars(strip_tags($this->nama_user));
            $this->kontak_user = htmlspecialchars(strip_tags($this->kontak_user));   
            $this->id_user = htmlspecialchars(strip_tags($this->id_user));
            $this->api_key_user = htmlspecialchars(strip_tags($this->api_key_user));

            $stmt->bindParam(':email_user', $this->email_user);
            $stmt->bindParam(':password_user', $this->password_user);
            $stmt->bindParam(':nama_user', $this->nama_user);
            $stmt->bindParam(':kontak_user', $this->kontak_user);
            $stmt->bindParam(':id', $this->id_user);
            $stmt->bindParam(':api_key_user', $this->api_key_user); 

            
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

            $stmt->bindParam(':id', $this->id_user,PDO::PARAM_INT); 

            if ($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->execute());
 
            return false;
        }
    }
    