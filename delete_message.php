<?php 
require 'connection.php';

if(isset($_GET['msg_id'] ) ){

	$id = $_GET['msg_id'];

	$sql = "DELETE FROM message WHERE msg_id = '$id' ";

		if($conn->query($sql) == TRUE){
			echo "<br><br><br>";
			echo "<h2><center>✅ Message Deleted Successfully ! </h2> <br><center>";
			header("Location:view_message.php");
			exit();
		}
		else{
			echo "<br><br><br>";
			echo "<h2><center>❌ Message not Deleted ! </h2> <br><center>";
		}


}

else{
			echo "<br><br><br>";
			echo "<h2><center>❌ Error! Please open from proper source ! </h2> <br><center>";
	}

?>
