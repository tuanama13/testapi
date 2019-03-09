<?php  
	
	/**
	 * 
	 */
	class Lapangan
	{

		private $conn;

        // Lapangan Field
        public $id_lapangan;
        public $id_mitra;
        public $harga_lapangan;
        public $foto_lapangan;
        public $nama_lapangan;

		
		function __construct($db)
		{
			$this->conn = $db;
		}


		public function read()
        {
            $query = "SELECT * FROM table_lapangan";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        public function read_single()
        {
            $query = 'SELECT * FROM table_lapangan WHERE id_lapangan = ?';

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id_lapangan = $row['id_lapangan'];
            $this->id_mitra = $row['id_mitra'];
            $this->harga_lapangan = $row['harga_lapangan'];
            $this->foto_lapangan = $row['foto_lapangan'];
            $this->nama_lapangan = $row['nama_lapangan'];
        }

        public function create()
        {
            $query = 'INSERT INTO table_lapangan SET 
               	id_mitra = :id_mitra,
                harga_lapangan = :harga_lapangan,
                foto_lapangan = :foto_lapangan,
                nama_lapangan = :nama_lapangan';

            $stmt = $this->conn->prepare($query);
            
            // Clean Data
            $this->id_mitra = htmlspecialchars(strip_tags($this->id_mitra));
            $this->harga_lapangan = htmlspecialchars(strip_tags($this->harga_lapangan));
            $this->foto_lapangan = htmlspecialchars(strip_tags($this->foto_lapangan));
            $this->nama_lapangan = htmlspecialchars(strip_tags($this->nama_lapangan));

            $stmt->bindParam(':id_mitra', $this->id_mitra);
            $stmt->bindParam(':harga_lapangan', $this->harga_lapangan);
            $stmt->bindParam(':foto_lapangan', $this->foto_lapangan);
            $stmt->bindParam(':nama_lapangan', $this->nama_lapangan);            
            
            if ($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->execute());
 
            return false;
        }

        public function update()
        {
            $query = 'UPDATE table_lapangan
                SET 
                    id_mitra = :id_mitra,
                    harga_lapangan = :harga_lapangan,
                    foto_lapangan = :foto_lapangan,
                    nama_lapangan = :nama_lapangan     
                    
                WHERE 
                    id_lapangan = :id';

            $stmt = $this->conn->prepare($query);
            
            // Clean Data
            $this->id_mitra = htmlspecialchars(strip_tags($this->id_mitra));
            $this->harga_lapangan = htmlspecialchars(strip_tags($this->harga_lapangan));
            $this->foto_lapangan = htmlspecialchars(strip_tags($this->foto_lapangan));
            $this->nama_lapangan = htmlspecialchars(strip_tags($this->nama_lapangan));
            $this->id_lapangan = htmlspecialchars(strip_tags($this->id_lapangan));

            $stmt->bindParam(':id_mitra', $this->id_mitra);
            $stmt->bindParam(':harga_lapangan', $this->harga_lapangan);
            $stmt->bindParam(':foto_lapangan', $this->foto_lapangan);
            $stmt->bindParam(':nama_lapangan', $this->nama_lapangan);
            $stmt->bindParam(':id', $this->id_lapangan);      
            
            if ($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->execute());
 
            return false;
        }

        public function delete()
        {
             $query = 'DELETE FROM table_lapangan
                WHERE 
                    id_lapangan = :id';

            $stmt = $this->conn->prepare($query);
            
            $this->id_lapangan = htmlspecialchars(strip_tags($this->id_lapangan));

            $stmt->bindParam(':id', $this->id_lapangan,PDO::PARAM_INT); 

            if ($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->execute());
 
            return false;
        }



	}