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
            // $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // $this->tgl_booking = $row['tgl_booking'];
            // $this->jam_booking = $row['jam_booking'];
            // $this->id_lapangan = $row['id_lapangan'];
            // $this->harga_lapangan = $row['harga_lapangan'];
            // // $this->foto_lapangan = $row['foto_lapangan'];
            // // $this->nama_lapangan = $row['nama_lapangan'];
        }
	}