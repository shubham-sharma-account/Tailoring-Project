<?php
session_start();
error_reporting(0);
include("connect.php");
/* echo "<div id='alert2'><h1 id='msg2'></h1><h2>**Please try again**</h2>
    <button id='try_agn' onclick='display_none()'>Try again!</button></div>"; */
$user = $_POST['role'];
$email = $_POST['email'];
$pass = $_POST['pass'];
if (isset($_POST['submit'])) {
    if ($user == "Select Your Role") {
        $userErr = "*Please select your role!";
    } else if (empty($email)) {
        $emailErr = "*Please enter your email!";
    } else if (empty($pass)) {
        $passErr = "*Please enter your password!";
    } else if ($user == "Tailor") {
        $sql1 = "select * from tailor_reg where email='$email' and pass='$pass'";
        $res = $connect->query($sql1);
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $_SESSION['tailor_id'] = $row['tailor_id'];
            }
            header('Location:tailor_dash.php');
        } else {
            echo "<h1>No User found please try again or signup!</h1>";
        }
    } else if ($user == "Student") {
        $sql1 = "select * from student_reg where email='$email' and pass='$pass'";
        $res = $connect->query($sql1);
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $_SESSION['stu_id'] = $row['stu_id'];
                $_SESSION['email'] = $row['email'];
            }
            header('Location:student_dash.php');
        } else {
            echo "<h1>No User found please try again or signup!</h1>";
        }
    } else if ($user = "admin") {
        $sql1 = "select * from admin_reg where email='$email' and pass='$pass'";
        $res = $connect->query($sql1);
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $_SESSION['admin_id'] = $row['id'];
            }
            header('Location:admin_dash.php');
        } else {
            echo "<h1>No User found please try again or signup!</h1>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <title>Slider Sign In/Sign Up form</title>
    <style>
        #alert2 {
            position: absolute;
            left: 35%;
            top: 70%;
            background-image: url("../img/boximg3.jpg");
            background-size: 100% 100%;
            width: 30%;
            color: white;
            display: none;
            height: 35%;
            text-align: center;
            background-color: rgb(202, 38, 38);
            border-radius: 2%;
        }

        #try_agn {
            width: 25%;
            height: 18%;
            padding: 20px;
            font-size: 20px;
            color: black;
            margin-top: 15%;
            border-radius: 10px;
            background-color: white;
        }
    </style>
</head>

<body>
    <div style="position:relative;" class="container" id="container">
        <div class="form-container sign-in-container">
            <form action="#" method="post">
                <h1>Sign In</h1>
                <div class="select-option">
                    <select name="role">
                        <option value="Select Your Role">Select Your Role</option>
                        <option value="Admin" <?php if ($role == "Admin") echo "selected" ?>>Admin</option>
                        <option value="Tailor" <?php if ($role == "Yailor") echo "selected" ?>>Tailor</option>
                        <option value="Student" <?php if ($role == "Student") echo "selected" ?>>Student</option>
                    </select>
                </div>
                <span style="color:white"><?php echo $userErr ?></span>
                <input type="email" name="email" placeholder="Email" value="<?php echo $email ?>" />
                <span style="color:white"><?php echo $emailErr ?></span>
                <input type="password" name="pass" placeholder="Password" value="<?php echo $pass ?>" />
                <span style="color:white"><?php echo $passErr ?></span>
                <a href="#">Forget your password</a>
                <input type="submit" name="submit" value="Sign In">
            </form>
        </div>
        <div class="form-container sign-up-container">
            <form action="#">
                <h1>Create Account</h1>
                <div class="btn">
                    <button formaction="admin.php" style="width: 71%; margin:12px;color:white">Signup As Admin</button>
                    <button formaction="tailor.php" style="width: 71%; margin:12px;color:white">Signup As Tailor</button>
                    <button formaction="student.php" style="width: 71%; margin:12px;color:white">Signup As Student</button>
                </div>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-pannel overlay-left">
                    <h1>Welcome back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="btn" id="signIn">Sign In </button>
                </div>
                <div class="overlay-pannel overlay-right">
                    <h1>Hello friends!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="btn" id="signUp">Sign Up </button>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/main.js"></script>
</body>

</html>