<?php  
	include_once 'config/Database.php';
	
    // include_once '../../models/Mitras.php';

    /**
     * 
     */
    class Insert
    {
    	private $conn;
    	
    	function __construct($db)
    	{
    		$this->conn = $db;
    	}

    	function insertImage(){
    		$randNum = 3; //rand(1,10);

    		// function make directory
    		// mkdir('images/'.$randNum, 0777,true); //Windows
    		//chmod('images/'.$randNum, 0777')
    		$dir = "images/".$randNum."/";


    		$target_file = $dir.basename($_FILES['myimage']['name']);
    		$uploadOK = 1;

    		$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    		if (isset($_POST['saveimage']) && isset($_POST['myimage']['tmp_name'])) {
    			$check = getimagesize($_FILES['myimage']['tmp_name']);
    			if ($check != false) {
	    			echo "FILE is an Image - " . $check["mime"] . ".";
	    			echo "<br>";
	    			$uploadOK = 1;
	    		}else{
	    			echo "FILE is not an Image.";
	    			echo "<br>";
	    			$uploadOK = 0;
	    		}
	    	}

	    	// check image size
	    	if ($_FILES['myimage']['tmp_name'] > 50000000) {
	    		echo "Sorry, your file to large";
	    		echo "<br>";
	    		$uploadOK = 0;
	    	}


	    	// check file type
	    	if ($imageFileType != 'jpg' && $imageFileType != 'JPG' && $imageFileType != 'png' && $imageFileType != 'PNG' && $imageFileType != 'jpeg' && $imageFileType != 'JPEG' && $imageFileType != 'gif') {
	    		echo "Sorry only image format can upload";
	    		echo "<br>";
	    		$uploadOK = 0;
	    	}else{

	    		// New Name
	    		$tanggal = date("Ymd");
	    		$temp = explode(".", "jsjsjs.jpeg");
				$newName = round(microtime(true)) . '.' .end($temp);

				$target_file = $dir."".$tanggal."".$newName;
	    	}

	    	if ($uploadOK == 0) {
	    		echo "Your File was not Uploaded";
	    		echo "<br>";
	    		echo "<a href='upload_image.php' title='backtoupload'>Back</a>";
	    	}else{


	    		if (move_uploaded_file($_FILES['myimage']['tmp_name'], $target_file)) {
	    			$imagePath = $target_file;

	    			try {
	    				$sql = "INSERT INTO images (image) VALUES('$imagePath')";
	    				$stmt = $this->conn->prepare($sql);
			            $stmt->execute();

			            echo "Insert Image Succeesful";
	    				echo "<br>";
	    				echo "<a href='upload_image.php' title='backtoupload'>Back</a>";


	    			} catch (Exception $e) {
	    				echo "ERROR : ".$e->getMessage();
	    			}
	    		}

	    	}
    	}
    }

    $databae = new Database();
    $db = $databae->connect();

    $insertImage = new Insert($db);
    $insertImage->insertImage();

