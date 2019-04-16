<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization X-Requested-With ');

    include_once '../../config/Database.php';
    include_once '../../models/Bookings.php';


    $database = new Database();
    $db = $database->connect();

    $booking = new Booking($db);
    // $data = json_decode(file_get_contents("php://input"));

    $booking->id_booking = $_POST['id_booking'];
    $booking->id_mitra = $_POST['id_mitra'];
    $booking->id_lapangan = $_POST['id_lapangan'];
    $booking->id_user = $_POST['id_user'];
    $booking->harga_lapangan = $_POST['harga_lapangan'];
    $booking->jumlah_jam = $_POST['jumlah_jam'];
    $booking->tgl_booking = $_POST['tgl_booking'];
    $booking->jam_booking = $_POST['jam_booking'];
    $booking->status_booking = $_POST['status_booking'];

    // Create Booking
    if ($booking->create()) {
        echo json_encode(
            array('message'=> 'Terima Kasih Pesanan Anda Berhasil')
        );
    }else{
        echo json_encode(
            array('message'=> 'Maaf Pesanan Anda Gagal')
        );
    }