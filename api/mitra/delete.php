<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization X-Requested-With ');

    include_once '../../config/Database.php';
    include_once '../../models/Mitras.php';

    $databae = new Database();
    $db = $databae->connect();

    $mitra = new Mitra($db);

    $data = json_decode(file_get_contents("php://input"));

    $mitra->id_mitra = $data->id_mitra; 

    // Delete Mitra
    if ($mitra->delete()) {
        echo json_encode(
            array('message'=> 'Mitra Deleted')
        );
    }else{
        echo json_encode(
            array('message'=> 'Mitra Not Deleted')
        );
    }
