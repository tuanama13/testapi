<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Lapangans.php';

    $databae = new Database();
    $db = $databae->connect();

    $lapangan = new Lapangan($db);

    $lapangan->id = isset($_GET['id']) ? $_GET['id'] : die();

    $result = $lapangan->read_single();

    $lapangan_arr = array(
      'id' => $lapangan->id_lapangan ,
      'id_mitra' => $lapangan->id ,
      'harga_lapagan' => $lapangan->harga_lapangan , 
      'foto_lapangan' => $lapangan->foto_lapangan ,   
      'nama_lapangan' => $lapangan->nama_lapangan  
    );

    print_r(json_encode($lapangan_arr));