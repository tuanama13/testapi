<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Users.php';

    $databae = new Database();
    $db = $databae->connect();

    $user = new User($db);

    $result = $user->read();

    $num = $result->rowCount();

    if ($num > 0) {
        $user_arr = array();
        $user_arr['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $user_item = array(
                'id' => $id_user ,
                'email' => $email_user ,
                'password' => $password_user , 
                'name' => $nama_user ,   
                'tlp' => $kontak_user ,
                'tgl_gabung' => date_format(date_create($tgl_bergabung_user),"d-m-Y") ,
                'key' => $api_key_user     
            );

            array_push($user_arr['data'], $user_item);
        }

        echo json_encode($user_arr, JSON_PRETTY_PRINT);
    }else {
        echo json_encode(
            array('message' => 'No User Found')
        );
        
    }