<?php
require_once(dirname(__FILE__) . '/Veritrans.php');
Veritrans_Config::$isProduction = false;
Veritrans_Config::$serverKey = 'SB-Mid-server-_w5FC_k9AKEJmQ845H0fRkP2';
include_once 'config/Database.php';
$database = new Database();
$db = $database->connect();
date_default_timezone_set("Asia/Jakarta");

$query = 'UPDATE table_booking 
                SET 
                    status_booking = :status_booking              
                WHERE 
                    id_booking = :id_booking';

 $stmt = $db->prepare($query);

 
	  	$query_transaksi = 'INSERT INTO table_transaksi (id_booking,tgl_bayar,total_bayar,tipe_transaksi)
                          VALUES(:id_booking,:tgl_bayar,:total_bayar,:tipe_transaksi)';

 		$stmt_transaksi = $db->prepare($query_transaksi);

 


if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {


 try {
  $notif = new Veritrans_Notification();
} catch (Exception $e) {
  echo "Exception: ".$e->getMessage()."\r\n";
  echo "Notification received: ".file_get_contents("php://input");
  exit();
} 
$transaction = $notif->transaction_status;
$type = $notif->payment_type;
$order_id = $notif->order_id;
$fraud = $notif->fraud_status;
$gross_amount = $notif->gross_amount;
$paid_at = date("Y-m-d H:i:s");
// $paid_at = $notif->paid_at;


if ($transaction == 'capture') {
  // For credit card transaction, we need to check whether transaction is challenge by FDS or not
  if ($type == 'credit_card'){
    if($fraud == 'challenge'){
           
      $stmt->bindParam(':status_booking', $transaction);
      $stmt->bindParam(':id_booking', $order_id);

        if ($stmt->execute()) {
          return true;
        }else{
          return false;
        }
      }
      else {
      // UPDATE STATUS BOOKING
      $stmt->bindParam(':status_booking', $transaction);
      $stmt->bindParam(':id_booking', $order_id);
      $stmt->execute();

            
      // INSERT TRANSAKSI
      $stmt_transaksi->bindParam(':id_booking', $order_id);
      $stmt_transaksi->bindParam(':tgl_bayar', $paid_at);
      $stmt_transaksi->bindParam(':total_bayar', $gross_amount);
      $stmt_transaksi->bindParam(':tipe_transaksi', $type);
            $stmt_transaksi->execute();
       

      }
    }
  }
  else if ($transaction == 'settlement'){
    // UPDATE STATUS BOOKING
    	$stat = "Berhasil";
	  	$stmt->bindParam(':status_booking', $stat);
	  	$stmt->bindParam(':id_booking', $order_id);

	  	$stmt->execute();
      	
 		$stmt_transaksi->bindParam(':id_booking', $order_id);
      	$stmt_transaksi->bindParam(':tgl_bayar', $paid_at);
      	$stmt_transaksi->bindParam(':total_bayar', $gross_amount);
      	$stmt_transaksi->bindParam(':tipe_transaksi', $type);
      	$stmt_transaksi->execute();      

  }
  else if($transaction == 'pending'){
   
	  // $stmt->bindParam(':status_booking', 'Belum Bayar');
	  // $stmt->bindParam(':id_booking', $order_id);

	  // $stmt->execute();
     
  }
  else if ($transaction == 'deny') {
   		$stat = "Ditolak";
	  	$stmt->bindParam(':status_booking', $stat);
	  	$stmt->bindParam(':id_booking', $order_id);

	  	$stmt->execute();
      
    
  }
  else if ($transaction == 'expire') {
   		$stat = "Kadaluarsa";
	  $stmt->bindParam(':status_booking', $stat);
	  $stmt->bindParam(':id_booking', $order_id);

	  $stmt->execute();
      
  }
  else if ($transaction == 'cancel') {
   		$stat = "Batal";
	  $stmt->bindParam(':status_booking', $stat);
	  $stmt->bindParam(':id_booking', $order_id);

	  $stmt->execute();
  }


} else {


    //
    // order_id=776981683&status_code=200&transaction_status=capture

    $order_id = $_GET['order_id'];
    $statusCode = $_GET['status_code'];
    $transaction  = $_GET['transaction_status'];


	if($transaction == 'capture') {
	  echo "<p>Transaksi berhasil.</p>";
	  echo "<p>Status transaksi untuk order id : " . $order_id;

	}
	// Deny
	else if($transaction == 'deny') {
	  echo "<p>Transaksi ditolak.</p>";
	  echo "<p>Status transaksi untuk order id .: " . $order_id;

	}
	// Challenge
	else if($transaction == 'challenge') {
	  echo "<p>Transaksi challenge.</p>";
	  echo "<p>Status transaksi untuk order id : " . $order_id;

	}
	// Error
	else {
	  echo "<p>Terjadi kesalahan pada data transaksi yang dikirim.</p>";
	  echo "<p>Status message: [$response->status_code] " . $transaction;
	}


}