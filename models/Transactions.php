<?php
	/**
	 * summary
	 */
	class Transaksi
	{
	    /**
	     * summary
	     */
	    private $conn;
	    public $id_transaksi;
	    public $id_booking;
	    public $tgl_bayar;
	    public $total_bayar;
	    public $tipe_transaksi;

	    public function __construct($db)
	    {
	        $this->conn = $db;
	    }
	}