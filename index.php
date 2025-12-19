<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Modern Login Page | AsmrProg</title>
</head>

<body>


    <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="POST" action="Signup_process.php">
                <h1 style="margin-bottom: 30px;">Create Account</h1>
               <!--  <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your email for registeration</span> -->
                <!-- <input type="text" name="name" placeholder="Name">
                <input type="email" name="email"  placeholder="Email">
                <input type="password" placeholder="Password"> -->
                <button name="doctor" >Doctor</button><br>
                <button name="pc">Patient Caretaker</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form method="POST" action="login_process.php"> 
                <h1>Login</h1>
                <!-- <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div> -->
               <!--  <span>or use your email password</span> -->
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="password" placeholder="Password">
                <select name="role" required style="background-color: #eee; border: none;  margin: 8px 0; padding: 10px 15px; border-radius: 8px;font-size: 13px;" >
                    <option value="" disabled selected>Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="doctor">Doctor</option>
                    <option value="pat_caretaker">Patient Caretaker</option>
                </select>
                <a href="#">Forget Your Password?</a>
                <button>Login</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Already have an account</p>
                    <button class="hidden" id="login">Login</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Don't have an account?</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>