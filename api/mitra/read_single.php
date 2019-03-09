<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Mitras.php';

    $databae = new Database();
    $db = $databae->connect();

    $mitra = new Mitra($db);

    $mitra->id = isset($_GET['id']) ? $_GET['id'] : die();

    $result = $mitra->read_single();

    $mitra_arr = array(
       'id' => $mitra->id ,
       'email' => $mitra->email_mitra ,
       'password' => $mitra->password_mitra , 
       'nama' => $mitra->nama_mitra ,   
       'alamat' => $mitra->alamat_mitra ,
       'kontak' => $mitra->kontak_mitra ,
       'lat' => $mitra->lat,
       'lang' => $mitra->lang,
       'tgl_gabung' => $mitra->tgl_bergabung_mitra
        
    );

    print_r(json_encode($mitra_arr));