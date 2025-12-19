<?php 
require 'connection.php';

if(isset($_GET['pat_id'] ) ){

	$patId = $_GET['pat_id'];

	$sql = "DELETE FROM Patient WHERE pat_id = '$patId' ";

		if($conn->query($sql) == TRUE){
			echo "<br><br><br>";
			echo "<h2><center>✅ Patient Deleted Successfully ! </h2> <br><center>";
			header("Location:view_register_patient.php");
			exit();
		}
		else{
			echo "<br><br><br>";
			echo "<h2><center>❌ Payment not Deleted ! </h2> <br><center>";
		}


}

else{
			echo "<br><br><br>";
			echo "<h2><center>❌ Error! Please open from proper source ! </h2> <br><center>";
	}

?>
