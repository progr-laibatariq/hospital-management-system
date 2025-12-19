<!DOCTYPE html>
<html>
<head>
	
	<title>Update Patient</title>
</head>
<body>

</body>
</html>

<?php 

require 'connection.php';

if(isset($_POST['submit'])){

	$id = $_POST['id'];
	$name = $_POST['name'];
	$age = $_POST['age'];
	$gender = $_POST['gender'];
	
	if(empty($name) || empty($age)|| empty($gender) ){

		echo "<br><br><br><br><br><br><br>";
		echo "<h3><center>❌ Please fill in all fields to Proceed next !";
	}else{


		$sql = "UPDATE Patient SET Name = '$name' , Age ='$age', Gender = '$gender' WHERE pat_id = '$id'";

		if($conn->query($sql)==TRUE){

			echo "<br><br><br>";
			echo "<h2><center>✅ Patient updated ! </h2> <br><center>";
			header("Location:view_register_patient.php");
			exit();

		}else{


			echo "<br><br><br><br><br><br><br>";
			echo "<h3><center>⚠️  Form not submitted properly ! Please complete the form !";
		}

	}
}

?>