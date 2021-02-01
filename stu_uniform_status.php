<?php
error_reporting(0);
session_start();
include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/dashbord.css">
    <!--<link rel="stylesheet" href="./css/styleregister.css">-->
    <title>Uniform Status</title>
    <style>
        p {
            font-size: 40px;
            color: white;
        }

        #alert2 {
            position: relative;
            left: 40%;
            width: 30%;
            margin-top: 7%;
            height: 300px;
            background-color: rgba(21, 21, 22, 0.9);
            border-radius: 20px;
            background-size: 100% 100%;
        }

        #try_agn {
            position: absolute;
            top: 70%;
            left: 37%;
            width: 25%;
            height: 18%;
            padding: 10px;
            font-size: 20px;
            border-radius: 5px;
            background-color: green;
        }

        #msg2 {
            margin: 10px 30px 0 30px;
            color: white;
            text-align: center;
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
        <a href="student_feedback.php"><i class="fa fa-envelope"></i><span>Message</span></a>
        <a class="active" href="stu_uniform_status.php"><i class="fa fa-eye"></i><span>View Uniform Status</span></a>
        <a href="student_profile.php"><i class="fa fa-user"></i><span>Profile</span></a>
    </div>
    <?php
    echo "<div id='alert2'><br><h1 id='msg2'></h1>
            <a href='student_dash.php'><button id='try_agn' onclick='display_none()'>OK</button></a></div>";
    $sql = "select status from measure_data where email='" . $_SESSION['email'] . "'";
    $res = $connect->query($sql);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $status = $row['status'];
            if ($status == "Complete") {
                echo '<script>
                            function display_none(){
                                document.getElementById("alert2").style="display:none";
                            }
                            function call_fun(){
                                document.getElementById("msg2").innerHTML="Your uniform is complete, You will be informed when it will delivered to your college!";
                            }
                            call_fun();
                        </script>';
            } else {
                echo '<script>
                        function display_none()
                        {
                            document.getElementById("alert2").style="display:none";
                        }
                        function call_fun(){
                            document.getElementById("alert2").style="display:block";
                            document.getElementById("msg2").innerHTML="Your unifrom is not complete till now, Please check after sometime, Thankyou!";
                        }
                        call_fun();
                    </script>';
            }
        }
    } else {
        echo '<script>
                        function display_none()
                        {
                            document.getElementById("alert2").style="display:none";
                        }
                        function call_fun(){
                            document.getElementById("alert2").style="display:block";
                            document.getElementById("msg2").innerHTML="Your measurement is not taken till now!";
                        }
                        call_fun();
                    </script>';
    }
    ?>
</body>

</html>