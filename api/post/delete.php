<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization X-Requested-With ');

    include_once '../../config/Database.php';
    include_once '../../models/Users.php';

    $databae = new Database();
    $db = $databae->connect();

    $user = new User($db);

    $data = json_decode(file_get_contents("php://input"));

    $user->id_user = $data->id_user; 

    // Update User
    if ($user->update()) {
        echo json_encode(
            array('message'=> 'User Deleted')
        );
    }else{
        echo json_encode(
            array('message'=> 'User Not Deleted')
        );
    }
