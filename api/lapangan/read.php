<?php  
	header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Lapangans.php';

    $databae = new Database();
    $db = $databae->connect();

    $lapangan = new Lapangan($db);

    $result = $lapangan->read();

    $num = $result->rowCount();

    if ($num > 0) {
        $lapangan_arr = array();
        $lapangan_arr['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $lapangan_item = array(
                'id' => $id_lapangan ,
                'id_mitra' => $id_mitra ,
                'harga_lapangan' => $harga_lapangan , 
                'foto_lapangan' => $foto_lapangan ,   
                'nama_lapangan' => $nama_lapangan            
            );

            array_push($lapangan_arr['data'], $lapangan_item);
        }

        echo json_encode($lapangan_arr);
    }else {
        echo json_encode(
            array('message' => 'No Lapangan Found')
        );
        
    }

?>