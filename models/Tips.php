<?php

/**
   * summary
   */
  class Tips
  {
      /**
       * summary
       */
      private $conn;
      public $id_tips;
      public $img_tips;
      public $tgl_post_tips;
      public $judul_tips;
      public $isi_tips;


      public function __construct($db)
      {
          $this->conn = $db;
      }

      public function add3dots($string, $repl, $limit){
      	if(strlen($string) > $limit) 
		  {
		    return substr($string, 0, $limit) . $repl; 
		  }
		  else 
		  {
		    return $string;
		  }
      }

      public function read()
        {
            $query = "SELECT * FROM table_tips";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }
  }  