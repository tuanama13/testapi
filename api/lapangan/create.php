<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization X-Requested-With ');

    include_once '../../config/Database.php';
    include_once '../../models/Lapangans.php';

    $databae = new Database();
    $db = $databae->connect();

    $lapangan = new Lapangan($db);

    $data = json_decode(file_get_contents("php://input"));
    // api_key_user_ = hash('sha1', );
    $lapangan->id_mitra = $data->id_mitra;
    $lapangan->harga_lapangan = $data->harga_lapangan;
    $lapangan->foto_lapangan = $data->foto_lapangan;
    $lapangan->nama_lapangan = $data->nama_lapangan;

    // Create User
    if ($lapangan->create()) {
        echo json_encode(
            array('message'=> 'Lapangan Created')
        );
    }else{
        echo json_encode(
            array('message'=> 'Lapangan Not Created')
        );
    }
