<?php  
	header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Tips.php';

    $database = new Database();
    $db = $database->connect();

    $tips = new Tips($db);

    $result = $tips->read();


    $num = $result->rowCount();

    if ($num > 0) {
        $tips_arr = array();
        $tips_arr['value'] = 'tips';
        $tips_arr['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $tips_item = array(
                'id_tips' => $id_tips ,
                'img_tips' => $img_tips ,
                'tgl_post_tips' => $tgl_post_tips , 
                'judul_tips' => $judul_tips,   
                'isi_tips' => $tips->add3dots($isi_tips,"",70)                 
            );

            array_push($tips_arr['data'], $tips_item);
        }

        echo json_encode($tips_arr);
    }else {
        echo json_encode(
            array('message' => 'No Tips Found')
        );
        
    }

?>