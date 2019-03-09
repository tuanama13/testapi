<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization X-Requested-With ');

    include_once '../../config/Database.php';
    include_once '../../models/Mitras.php';

    $databae = new Database();
    $db = $databae->connect();

    $mitra = new Mitra($db);

    $data = json_decode(file_get_contents("php://input"));
    // api_key_user_ = hash('sha1', );
    $mitra->email_mitra = $data->email_mitra;
    $mitra->password_mitra = $data->password_mitra;
    $mitra->nama_mitra = $data->nama_mitra;
    $mitra->alamat_mitra = $data->alamat_mitra;
    $mitra->kontak_mitra = $data->kontak_mitra;
    $mitra->lat = $data->lat;
    $mitra->lang = $data->lang;

    // Create User
    if ($mitra->create()) {
        echo json_encode(
            array('message'=> 'Mitra Created')
        );
    }else{
        echo json_encode(
            array('message'=> 'Mitra Not Created')
        );
    }
