<?php  
	class Mitra
    {
    	private $conn;

    	// Mitra Properties
    	public $id_mitra;
        public $email_mitra;
        public $password_mitra;
        public $nama_mitra;
        public $alamat_mitra;
        public $kontak_mitra;
        public $lat;
        public $lang;
        public $tgl_bergabung_mitra;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function read()
        {
            $query = 'SELECT * FROM table_mitra';

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

		public function read_single()
        {
            $query = 'SELECT * FROM table_mitra WHERE id_mitra = ?';

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->email_mitra = $row['email_mitra'];
            $this->password_mitra = $row['password_mitra'];
            $this->nama_mitra = $row['nama_mitra'];
            $this->alamat_mitra = $row['alamat_mitra'];
            $this->kontak_mitra = $row['kontak_mitra'];
            $this->lat = $row['lat'];
            $this->lang = $row['lang'];
            $this->tgl_bergabung_mitra = $row['tgl_bergabung_mitra'];
            
            // return $stmt;
        }


        public function create()
        {
            $query = 'INSERT INTO table_mitra 
            	SET 
                email_mitra = :email_mitra,
                password_mitra = :password_mitra,
                nama_mitra = :nama_mitra,
                alamat_mitra = :alamat_mitra,
                kontak_mitra = :kontak_mitra,
                lat = :lat,
                lang = :lang';

            $stmt = $this->conn->prepare($query);
            
            // Clean Data
            $this->email_mitra = htmlspecialchars(strip_tags($this->email_mitra));
            $this->password_mitra = htmlspecialchars(strip_tags($this->password_mitra));
            $this->nama_mitra = htmlspecialchars(strip_tags($this->nama_mitra));
            $this->alamat_mitra = htmlspecialchars(strip_tags($this->alamat_mitra));
            $this->kontak_mitra = htmlspecialchars(strip_tags($this->kontak_mitra));
            $this->lat = htmlspecialchars(strip_tags($this->lat));
            $this->lang = htmlspecialchars(strip_tags($this->lang));

            $stmt->bindParam(':email_mitra', $this->email_mitra);
            $stmt->bindParam(':password_mitra', $this->password_mitra);
            $stmt->bindParam(':nama_mitra', $this->nama_mitra);
            $stmt->bindParam(':alamat_mitra', $this->alamat_mitra);
            $stmt->bindParam(':kontak_mitra', $this->kontak_mitra);
            $stmt->bindParam(':lat', $this->lat);
            $stmt->bindParam(':lang', $this->lang);
            
            
            if ($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->execute());
 
            return false;
        }

        public function update()
        {
            $query = 'UPDATE table_mitra 
                SET 
                    email_mitra = :email_mitra,
	                password_mitra = :password_mitra,
	                nama_mitra = :nama_mitra,
	                alamat_mitra = :alamat_mitra,
	                kontak_mitra = :kontak_mitra,
	                lat = :lat,
	                lang = :lang                   
                WHERE 
                    id_mitra = :id';

            $stmt = $this->conn->prepare($query);
            
            // Clean Data
            $this->email_mitra = htmlspecialchars(strip_tags($this->email_mitra));
            $this->password_mitra = htmlspecialchars(strip_tags($this->password_mitra));
            $this->nama_mitra = htmlspecialchars(strip_tags($this->nama_mitra));
            $this->alamat_mitra = htmlspecialchars(strip_tags($this->alamat_mitra));
            $this->kontak_mitra = htmlspecialchars(strip_tags($this->kontak_mitra));
            $this->lat = htmlspecialchars(strip_tags($this->lat));
            $this->lang = htmlspecialchars(strip_tags($this->lang));


			$stmt->bindParam(':email_mitra', $this->email_mitra);
            $stmt->bindParam(':password_mitra', $this->password_mitra);
            $stmt->bindParam(':nama_mitra', $this->nama_mitra);
            $stmt->bindParam(':alamat_mitra', $this->alamat_mitra);
            $stmt->bindParam(':kontak_mitra', $this->kontak_mitra);
            $stmt->bindParam(':lat', $this->lat);
            $stmt->bindParam(':lang', $this->lang);
            $stmt->bindParam(':id', $this->id_mitra);
            
            if ($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->execute());
 
            return false;
        }


        public function delete()
        {
             $query = 'DELETE FROM table_mitra 
                WHERE 
                    id_mitra = :id';

            $stmt = $this->conn->prepare($query);
            
            $this->id_mitra = htmlspecialchars(strip_tags($this->id_mitra));

            $stmt->bindParam(':id', $this->id_mitra,PDO::PARAM_INT); 

            if ($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->execute());
 
            return false;
        }


    }