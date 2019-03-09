<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization X-Requested-With ');

    include_once '../../config/Database.php';
    include_once '../../models/Mitras.php';

    $databae = new Database();
    $db = $databae->connect();

    $mitra = new Mitra($db);

    $data = json_decode(file_get_contents("php://input"));

    $mitra->id_mitra = $data->id_mitra; 
    
    $mitra->email_mitra = $data->email_mitra;
    $mitra->password_mitra = $data->password_mitra;
    $mitra->nama_mitra = $data->nama_mitra;
    $mitra->alamat_mitra = $data->alamat_mitra;
    $mitra->kontak_mitra = $data->kontak_mitra;
    $mitra->lat = $data->lat;
    $mitra->lang = $data->lang;    
    
      // Update mitra
    if ($mitra->update()) {
        echo json_encode(
            array('message'=> 'mitra Updated')
        );
    }else{
        echo json_encode(
            array('message'=> 'mitra Not Updated')
        );
    }
