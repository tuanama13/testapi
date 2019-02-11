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
                'name' => $name_user ,   
                'tlp' => $tlp_user ,
                'address' => $address_user ,
                'key' => $api_key_user ,
                'hit' => $hit    
            );

            array_push($user_arr['data'], $user_item);
        }

        echo json_encode($user_arr);
    }else {
        echo json_encode(
            array('message' => 'No User Found')
        );
        
    }