<?php  
	
	date_default_timezone_set('Asia/Jakarta');
	echo date("H:i");
	echo "<br>";
	// $jam = array();
	$jam_mulai = 7;
	$jam_end = 21;
	for ($i = $jam_mulai; $i <= $jam_end; $i++) {
		$jamnya = $jam_mulai.":00";
		// echo $jamnya."<br>";
		$jam = array(
				'jam' => $jamnya);
		print_r($jam);	
		$jam_mulai++;
	}
?>
<!-- 
	<select name="country">
		<option value="">-----------------</option> -->
		<?php
			while ($row = $jam) {
				echo($row['jam']);
			}
			// foreach($jam as $key => $value):
			// echo '<option value="'.$key.'">'.$value.'</option>'; //close your tags!!
			// endforeach;
		?>
	<!-- </select> -->