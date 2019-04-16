<?php  
  header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Bookings.php';

    $database = new Database();
    $db = $database->connect();

    $booking = new Booking($db);

    $booking->id_user = isset($_GET['id_user']) ? $_GET['id_user'] : die();
    // $booking->jam_booking = isset($_GET['jam_booking']) ? $_GET['jam_booking'] : die();
    $result = $booking->read_booking_history();

    $num = $result->rowCount();

    if ($num > 0) {
        $booking_arr = array();
        $booking_arr['value'] = 'Booking History';
        $booking_arr['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $booking_item = array(
               'id_booking' => $id_booking ,
                'id_mitra' => $id_mitra ,
                'nama_mitra' => $nama_mitra,
                'id_lapangan' => $id_lapangan ,
                'nama_lapangan' => $nama_lapangan ,
                'id_user' => $id_user ,
                'harga_lapagan' => $harga_lapangan , 
                'jumlah_jam' => $jumlah_jam ,
                'tgl_booking' => $tgl_booking ,   
                'jam_booking' => $jam_booking ,
                'status_booking' => $status_booking

            );

            array_push($booking_arr['data'], $booking_item);
        }

        echo json_encode($booking_arr);
    }else {
        echo json_encode(
            array('message' => 'Anda Belum Pernah Melakukan Pemesanan')
        );
        
    }

?>