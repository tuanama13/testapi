<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization X-Requested-With ');

    include_once '../../config/Database.php';
    include_once '../../models/Users.php';

    $databae = new Database();
    $db = $databae->connect();

    $user = new User($db);

    $data = json_decode(file_get_contents("php://input"));

    $user->email_user = $data->email_user;
    $user->password_user = $data->password_user;
    $user->name_user = $data->name_user;
    $user->tlp_user = $data->tlp_user;
    $user->address_user = $data->address_user;
    $user->api_key_user = $data->api_key_user;
    $user->hit = $data->hit;

    // Create User
    if ($user->create()) {
        echo json_encode(
            array('message'=> 'User Created')
        );
    }else{
        echo json_encode(
            array('message'=> 'User Not Created')
        );
    }
