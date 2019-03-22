<?php  
  header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Bookings.php';

    $database = new Database();
    $db = $database->connect();

    $booking = new Booking($db);

    $booking->tgl_booking = isset($_GET['tgl_booking']) ? $_GET['tgl_booking'] : die();
    $booking->jam_booking = isset($_GET['jam_booking']) ? $_GET['jam_booking'] : die();
    $result = $booking->read_booking_list();

    $num = $result->rowCount();

    if ($num > 0) {
        $booking_arr = array();
        $booking_arr['value'] = 'Booking Free';
        $booking_arr['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $booking_item = array(
                'id_lapangan' => $id_lapangan ,
                'nama_lapangan' => $nama_lapangan,
                'harga_lapangan' => $harga_lapangan,
                'id_mitra' => $id_mitra,
                'nama_mitra' => $nama_mitra

            );

            array_push($booking_arr['data'], $booking_item);
        }

        echo json_encode($booking_arr);
    }else {
        echo json_encode(
            array('message' => 'Lapangan Tidak Tersedia')
        );
        
    }

?>