<?php
session_start();
error_reporting(0);
include("connect.php");
/* echo "<div id='alert'><h1 id='msg1'></h1>
    <button onclick='display_none2()>OK</button></div>";
    echo "<div id='alert2'><h1 id='msg2'></h1><h2>**Please try again**</h2>
    <button onclick='display_none()'>Try again!</button></div>"; */
if (isset($_POST['submit'])) {
    $rollno = $_POST['rollno'];
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $class = $_POST['class'];
    $stu_email = $_POST['stu_email'];
    $tailor_email = $_POST['tailor_email'];
    $msg = $_POST['subject'];
    if (empty($rollno)) {
        $rollnoErr = "*Rollno is required";
    } else if (empty($fname)) {
        $fnameErr = "*First Name is required";
    } else if (!preg_match("/^[a-zA-Z ]*$/", $fname)) {
        $fnameErr = "*Only letters and white space allowed";
    } else if (empty($class)) {
        $classErr = "*Please enter your class";
    } else if (empty($stu_email)) {
        $stu_emailErr = "*Email is required";
    } else if (!filter_var($stu_email, FILTER_VALIDATE_EMAIL)) {
        $stu_emailErr = "*Invalid email format";
    } else if (empty($tailor_email)) {
        $tailor_emailErr = "*Email is required";
    } else if (!filter_var($tailor_email, FILTER_VALIDATE_EMAIL)) {
        $tailor_emailErr = "*Invalid email format";
    } else if (empty($msg)) {
        $msgErr = "*Please write your message";
    } else {
        $from = $_POST['stu_email'];
        $to = $_POST['tailor_email'];
        $subject = "Student Changes request message!";
        $message = $_POST['subject'];
        $headers = "From:" . $from;
        if (mail($to, $subject, $message, $headers)) {
            $sentMail = "********Email has been sent thankyou!********";
            /* echo '<script>
                function call_fun(){
                    document.getElementById("alert").style="display:block";
                    document.getElementById("msg1").innerHTML="Email has been sent!"
                }
                call_fun();
            </script>'; */
        } else {
            $sentMailerr = "**Email not sent please check your connection or email!**";
            /* echo '<script>
                function display_none()
                {
                    document.getElementById("alert2").style="display:none";
                }
                function display_none2()
                {
                    document.getElementById("alert1").style="display:none";
                }
                function call_fun(){
                    document.getElementById("alert2").style="display:block";
                    document.getElementById("msg2").innerHTML="Error in sending message!";
                }
                call_fun();
            </script>'; */
        }
        $sql1 = "insert into stu_feedback (fname,lname,rollno,class,stu_email,tailor_email,msg) 
                values('" . $fname . "','" . $lname . "','" . $rollno . "',
                '" . $class . "','" . $stu_email . "','" . $tailor_email . "','" . $msg . "')";
        $res = $connect->query($sql1);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/dashbord.css">
    <link rel="stylesheet" href="./css/styleregister.css">
    <title>Changes request form</title>
    <style>
        #class {
            margin-bottom: 0;
        }

        #email {
            margin-top: 5px;
        }

        #submit {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <!--header area start-->
    <header>

        <div class="left_area">
            <h3>
                <span>Student </span>Dashboard</h3>
        </div>
        <div class="right_area">
            <a href="sign.php" class="logout_btn">Logout</a>
        </div>
    </header>
    <!--header area end-->
    <!--sidebar start-->
    <div class="sidebar">
        <a href="student_dash.php"><i class="fa fa-home"></i><span>Home</span></a>
        <a class="active" href="student_feedback.php"><i class="fa fa-envelope"></i><span>Message</span></a>
        <a href="stu_uniform_status.php"><i class="fa fa-eye"></i><span>View Uniform Status</span></a>
        <a href="student_profile.php"><i class="fa fa-user"></i><span>Profile</span></a>
    </div>
    <?php
    $sql = "select stu_id,rollno,fname,lname,gender,class,pno,email,pass from student_reg where stu_id='" . $_SESSION['stu_id'] . "'";
    $res = $connect->query($sql);
    if ($res->num_rows > 0) {

        echo "<div class='container'>";
        echo "<span style='color:white; font-size:30px;'>" . $sentMail . "</span>";
        echo "<span style='color:white; font-size:30px;'>" . $sentMailerr . "</span>";
        echo "<form method='post'>";
        echo "<fieldset>";
        echo "<legend style='font-size: 30px; color:white; width:auto; letter-spacing:2px'>Changes request form</legend>";
        while ($row = $res->fetch_assoc()) {
            echo '<div class="row">
                            <div class="col-75">
                                <input type="text" id="rollno" name="rollno" placeholder="Enter your rollno.." value="' . $row['rollno'] . '">
                                <span class="error">' . $rollnoErr . '</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-75">
                                <input type="text" id="fname" name="firstname" placeholder="Enter your fullname.." value="' . $row['fname'] . ' ' . $row['lname'] . '">
                                <span class="error">' . $fnameErr . '</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-75">
                                <input type="text" id="class" name="class" placeholder="Enter your class.." value="' . $row['class'] . '">
                                <span class="error">' . $classErr . '</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-75">
                                <input type="hidden" id="email" name="stu_email" placeholder="Enter your email.." value="' . $row['email'] . '">
                                <span class="error">' . $stu_emailErr . '</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-75">
                                <input type="email" id="email" name="tailor_email" placeholder="Enter tailor email..">
                                <span class="error">' . $tailor_emailErr . '</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-75">
                                <textarea id="subject" name="subject" placeholder="Write something..." value="<?php echo $msg ?>"></textarea>
                                <span class="error">' . $msgErr . '</span>
                            </div>
                        </div>   
                        <div class="row">
                            <div class="col-75">     
                                <input type="submit" id="submit" name="submit" value="Submit">
                            </div>
                        </div>';
        }
        echo "</fieldset>";
        echo "</form>";
        echo "</div>";
    }
    ?>
</body>

</html>