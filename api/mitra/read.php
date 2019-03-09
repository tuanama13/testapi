<?php  
	header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Mitras.php';

    $databae = new Database();
    $db = $databae->connect();

    $mitra = new Mitra($db);

    $result = $mitra->read();

    $num = $result->rowCount();

    if ($num > 0) {
        $mitra_arr = array();
        $mitra_arr['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $mitra_item = array(
                'id' => $id_mitra ,
                'email' => $email_mitra ,
                'password' => $password_mitra , 
                'nama' => $nama_mitra ,   
                'alamat' => $alamat_mitra ,
                'kontak' => $kontak_mitra ,
                'lat' => $lat,
                'lang' => $lang,
                'tgl_gabung' => $tgl_bergabung_mitra
                 
            );

            array_push($mitra_arr['data'], $mitra_item);
        }

        echo json_encode($mitra_arr);
    }else {
        echo json_encode(
            array('message' => 'No Mitra Found')
        );
        
    }

?>