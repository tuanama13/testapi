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
    // api_key_user_ = hash('sha1', );
    $user->email_user = $data->email_user;
    $user->password_user = $data->password_user;
    $user->nama_user = $data->nama_user;
    $user->kontak_user = $data->kontak_user;
    $user->api_key_user = hash('sha1', uniqid());

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
