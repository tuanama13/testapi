<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization X-Requested-With ');

    include_once '../../config/Database.php';
    include_once '../../models/Lapangans.php';

    $databae = new Database();
    $db = $databae->connect();

    $lapangan = new Lapangan($db);

    $data = json_decode(file_get_contents("php://input"));

    $lapangan->id_lapangan = $data->id_lapangan; 

    // Update lapangan
    if ($lapangan->delete()) {
        echo json_encode(
            array('message'=> 'Lapangan Deleted')
        );
    }else{
        echo json_encode(
            array('message'=> 'Lapangan Not Deleted')
        );
    }
