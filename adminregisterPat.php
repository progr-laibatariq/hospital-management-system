<!DOCTYPE html>
<html>
<head>
	<title>Register Patient</title>
	<style>
		body{
			font-family: 'Segoe UI' , sans-serif;
			margin: auto;
			background-color:#e0eafc;
			padding: 50px;
		}

		form{
			background-color: white;
			padding: 30px 50px;
			width: 700px;
			margin: auto;
			border-radius: 12px;
			box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
			box-sizing: border-box;
			padding-right: 60px;
		}

		label{
			font-weight: bold;
			display: block;
			margin-bottom: 6px;
			color: #333;
		}

		#form-container{
			display: flex;
			gap: 80px;
			flex-wrap: wrap;
			justify-content: center;
		}

		input{
			width: 101%;
			padding: 7px;
			margin-bottom: 20px;
			border-radius: 6px;
			font-size: 18px;
			border-color: lightgrey;
			border-style: solid;
		}

		select{
			width: 101%;
			padding: 7px;
			margin-bottom: 20px;
			border-radius: 6px;
			font-size: 18px;
			border-color: lightgrey;
			border-style: solid;
		}

		input[type="submit"]{
			margin-top: 5px;
			background-color: #003366;
			color: white;
			border: none;
			font-size: 16px;
			font-weight: bold;
			padding: 12px;
			border-radius: 6px;
			cursor: pointer;
		}

		input[type="Submit"]:hover{
			background-color: #0059b3;
			transition: 0.3s;
		}

		/* Navbar Styling */
		.navbar {
			background-color: #003366;
			padding: 15px 20px;
			display: flex;
			justify-content: center;
			align-items: center;
			position: fixed;
			top: 0;
			left: 0;
			right: 0;
			z-index: 10;
			width: 100%;
		}

		.navbar .logo {
			position: absolute;
			left: 20px;
			font-size: 20px;
			font-weight: bold;
			color: white;
		}

		.navbar .menu {
			display: flex;
			gap: 20px;
			justify-content: center;
			width: 100%;
			text-align: center;
		}

		.navbar .menu a {
			color: white;
			text-decoration: none;
			padding: 12px 20px;
			font-size: 16px;
			font-weight: bold;
			border-radius: 6px;
			transition: all 0.3s ease;
			position: relative;
		}

		.navbar .menu a::after {
			content: '';
			position: absolute;
			width: 0%;
			height: 3px;
			bottom: 0;
			left: 50%;
			background: white;
			border-radius: 2px;
			transition: all 0.4s ease-in-out;
			transform: translateX(-50%);
		}

		.navbar .menu a:hover::after {
			width: 60%;
		}

		.navbar .logout {
			position: absolute;
			right: 60px;
			color: white;
			font-weight: bold;
			padding: 12px 20px;
			border-radius: 6px;
			transition: background-color 0.3s ease;
			font-size: 16px;
			text-decoration: none;
			background-color: red;
		}

		.navbar .logout::after {
			content: '';
			position: absolute;
			width: 0%;
			height: 3px;
			bottom: 0;
			left: 50%;
			background: white;
			border-radius: 2px;
			transition: all 0.4s ease-in-out;
			transform: translateX(-50%);
		}

		.navbar .logout:hover::after {
			width: 60%;
		}

		.container {
			margin-top: 80px; /* Space the container content below the fixed navbar */
		}
	</style>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <div class="logo">
        <span>MEDCARE</span>
    </div>
    <div class="menu">
        <a href="admin.php" class="dashboard">Dashboard</a>
        <a href="adminregisterPat.php" class="add-new-patient">Add New Patient</a>
        <a href="view_register_patient.php" class="manage-patients">Manage Patients</a>
    </div>
    <a href="logout.php" class="logout">Logout</a>
</div>

<!-- Register Patient Form -->
<form action="processRegisterPat.php" method="POST" style="margin-top: 100px;">
	<h2 style="text-align: center;margin-bottom: 30px;color: #003366;">🪪 Patient Registration</h2><br>

	<div id="form-container">

		<div id="left-column">
			<label>Name: </label>
			<input type="text" name="name" required placeholder="Enter Patient name"> <br>

			<label>SSN: </label>
			<input type="text" name="ssn" required placeholder="Enter SSN"> <br>

			<label>Age: </label>
			<input type="number" name="age" required placeholder="Enter age"> <br>

			<label>Gender</label>
			<select name="gender" >
				<option value="" >Choose an Option</option>
				<option value="male">Male</option>
				<option value="female">Female</option>
			</select> <br>
		</div>

		<div id="right-column">
			<label>Medical Condition</label>
			<input type="text" name="condition"> <br>

			<label>Mobile Number</label>
			<input type="text" name="mobile" required placeholder="Enter mobile numbers, e.g., 1234567890, 9876543210"><br>

			<label>Police Case: </label>
			<select name="police">
				<option value="">Choose an Option</option>
				<option value="yes">Yes</option>
				<option value="no">No</option>
			</select> <br>

			<label>Seriousness Level</label>
			<input type="text" name="level"> <br>
		</div>

	</div>

	<div style="text-align: center;margin-top: 37px;">
		<input type="submit" name="submit" value="Register Patient" id="submit">
	</div>
</form>

</body>
</html>
