<?php  
	header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Bookings.php';

    $database = new Database();
    $db = $database->connect();
    // private $conn;

    $booking = new Booking($db);

    $result = $booking->read();

    $num = $result->rowCount();

    if ($num > 0) {
        $booking_arr = array();
        $booking_arr['value'] = 'booking';
        $booking_arr['data'] = array();
        // $booking_item
        // $booking_arr['mitra'] = array();
        // $booking_arr['mitra'] = array();

        // $query1 = "SELECT * FROM table_mitra";
        // // $this->conn = $db;
        // $stmt1 = $db->prepare($query1);
        // $stmt1->execute();

          

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            // $booking_item['mitra'] = array();
            $booking_item = array(

                'id_booking' => $id_booking ,
                'id_mitra' => $id_mitra ,
                'id_lapangan' => $id_lapangan ,
                'id_user' => $id_user ,
                'harga_lapagan' => $harga_lapangan , 
                'jumlah_jam' => $jumlah_jam ,
                'tgl_booking' => $tgl_booking ,   
                'jam_booking' => $jam_booking ,
                'status_booking' => $status_booking       
                   
            );


            // array_push($booking_item['mitra'], $booking_item);  

            array_push($booking_arr['data'], $booking_item);
        }

        echo json_encode($booking_arr);
    }else {
        echo json_encode(
            array('message' => 'No Booking Found')
        );
        
    }

?>