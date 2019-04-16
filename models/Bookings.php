<?php
	/**
	 * Class Booking 
	 */
	class Booking
	{
		private $conn;
	    /**
	     * Table Booking Field
	     */
	    public $id_booking;
        public $id_mitra;
        public $id_lapangan;
        public $id_user;
        public $harga_lapangan;
        public $jumlah_jam;
        public $tgl_booking;
        public $jam_booking;
        public $status_booking;

	    public function __construct($db)
	    {
	        $this->conn = $db;
	    }

	    public function read()
        {
            $query = "SELECT * FROM table_booking";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        public function read_booking_list()
        {
            $query = 'SELECT table_lapangan.id_lapangan, table_lapangan.nama_lapangan, table_lapangan.harga_lapangan, table_lapangan.id_mitra, table_mitra.nama_mitra FROM table_lapangan JOIN table_mitra USING(id_mitra) WHERE id_lapangan 
            			NOT IN (
					        SELECT
					            table_lapangan.id_lapangan
					        FROM
					            table_lapangan
					        LEFT OUTER JOIN
					            table_booking ON table_booking.id_lapangan = table_lapangan.id_lapangan
					        WHERE
					            table_booking.tgl_booking = ?
					        AND
					            table_booking.jam_booking = ?
					    )
						ORDER BY
						    harga_lapangan
						ASC';

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->tgl_booking);
            $stmt->bindParam(2, $this->jam_booking);
            $stmt->execute();

            return $stmt;

        }
        public function create()
        {
            $query = 'INSERT INTO table_booking 
                SET 
                id_booking = :id_booking,
                id_mitra = :id_mitra,
                id_lapangan = :id_lapangan,
                id_user = :id_user,
                harga_lapangan = :harga_lapangan,
                jumlah_jam = :jumlah_jam,
                tgl_booking = :tgl_booking,
                jam_booking = :jam_booking,
                status_booking = :status_booking';

            $stmt = $this->conn->prepare($query);
            
            // Clean Data
            $this->id_booking = htmlspecialchars(strip_tags($this->id_booking));
            $this->id_mitra = htmlspecialchars(strip_tags($this->id_mitra));
            $this->id_lapangan = htmlspecialchars(strip_tags($this->id_lapangan));
            $this->id_user = htmlspecialchars(strip_tags($this->id_user));
            $this->harga_lapangan = htmlspecialchars(strip_tags($this->harga_lapangan));
            $this->jumlah_jam = htmlspecialchars(strip_tags($this->jumlah_jam));
            $this->tgl_booking = htmlspecialchars(strip_tags($this->tgl_booking));
            $this->jam_booking = htmlspecialchars(strip_tags($this->jam_booking));
            $this->status_booking = htmlspecialchars(strip_tags($this->status_booking));

            $stmt->bindParam(':id_booking', $this->id_booking);
            $stmt->bindParam(':id_mitra', $this->id_mitra);
            $stmt->bindParam(':id_lapangan', $this->id_lapangan);
            $stmt->bindParam(':id_user', $this->id_user);
            $stmt->bindParam(':harga_lapangan', $this->harga_lapangan);
            $stmt->bindParam(':jumlah_jam', $this->jumlah_jam);
            $stmt->bindParam(':tgl_booking', $this->tgl_booking);
            $stmt->bindParam(':jam_booking', $this->jam_booking);
            $stmt->bindParam(':status_booking', $this->status_booking);

            
            
            if ($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->execute());
 
            return false;
        }
	}