<!DOCTYPE html>
<html>
<head>
    <title>Doctor Registration Form</title>
    <style>
         body{
            font-family: 'Segoe UI' , sans-serif;
            margin: auto;
            background-color:#e0eafc;
            padding: 30px;
        }


        form{
            background-color: white;
            padding: 30px ;
            width: 600px;
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
        .navbar {
            background-color: #003366;
            padding: 15px 20px;
            display: flex;
            justify-content: center; /* Center the navbar items */
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
            justify-content: center; /* Centering menu items */
            width: 100%; /* Ensure it takes the full width */
            text-align: center; /* Align text to the center */
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

        /* Hover Effect (Underlining effect) */
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
    </style>
</head>
<body>
    
    <form action="Doc_details.php" method="POST">
        <h2 style="text-align: center;margin-bottom: 30px;color: #003366;">Doctor Registration</h2>
        <label for="name">Full Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label for="username">Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label for="Phone Number">Phone Number:</label><br>
        <input type="number" name="ph" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" name="password" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" name="email" required><br><br>

            <label>Gender</label>
            <select name="gender" >
                <option value="" >Choose an Option</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select> <br>
</div>

        <label for="specialization">Specialization:</label><br>
        <input type="text" name="specialization" required><br><br>

        <input type="submit" name="submit" value="Register">
    </form>
</body>
</html>
