<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Users.php';

    $databae = new Database();
    $db = $databae->connect();

    $user = new User($db);

    $user->id = isset($_GET['id']) ? $_GET['id'] : die();

    $result = $user->read_single();

    $user_arr = array(
        'id' => $user->id ,
        'email' => $user->email_user ,
        'password' => $user->password_user , 
        'nama' => $user->nama_user ,   
        'kontak' => $user->kontak_user ,
        'tgl_gabung' => $user->tgl_bergabung_user ,
        'key' => $user->api_key_user
        
    );

    print_r(json_encode($user_arr));