<?php
session_start();
error_reporting();
include("connect.php");
echo "<div id='alert2'><br><br><h1 id='msg2'></h1><br><br>
    <button id='try_agn' onclick='display_none()'>OK</button></div>";
if (isset($_POST['update'])) {
    $sql = "update student_reg set rollno='{$_POST['rollno']}',fname='{$_POST['firstname']}',lname='{$_POST['lastname']}',gender='{$_POST['gender']}',
        pno={$_POST['pno']},email='{$_POST['email']}',pass='{$_POST['pass']}' where stu_id={$_POST['stu_id']}";
    $res = mysqli_query($connect, $sql);
    if ($res) {
        echo '<script>
                        function display_none()
                        {
                            document.getElementById("alert2").style="display:none";
                        }
                        function call_fun(){
                            document.getElementById("alert2").style="display:block";
                            document.getElementById("msg2").innerHTML="Updated Successfully!";
                        }
                        call_fun();
                    </script>';
    } else {
        echo "<h1 style='color:white'>Error</h1>";
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
    <link rel="stylesheet" href="css/styleregister.css">
    <title>Profile</title>
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
        <a  href="student_feedback.php"><i class="fa fa-envelope"></i><span>Message</span></a>
        <a href="stu_uniform_status.php"><i class="fa fa-eye"></i><span>View Uniform Status</span></a>
        <a class="active" href="student_profile.php"><i class="fa fa-user"></i><span>Profile</span></a>
    </div>
    <?php
    $sql = "select stu_id,rollno,fname,lname,gender,class,pno,email,pass from student_reg where stu_id='" . $_SESSION['stu_id'] . "'";
    $res = $connect->query($sql);
    if ($res->num_rows > 0) {
        echo "<div class='tailor_profile' id='summury_page'>";
        echo "<p style='font-size:30px;'>-----------------------Profile-----------------------<p>";
        while ($row = $res->fetch_assoc()) {
            echo "<p>Roll no. : " . $row['rollno'] . "</p>" . "<p>Firstname : " . $row['fname'] . "</p>" . "<p>Lastname : " . $row['lname'] . "</p>" .
                "<p>Gender : " . $row['gender'] . "</p>" . "<p>Class. : " . $row['class'] . "</p>" . "<p>Phone number : " . $row['pno'] . "</p>" . "<p>Email : " . $row['email'] . "</p>" . "<p>Password : #####</p>" .
                "<button id='update_btn' onclick='hide()'>Edit</button>";
        }
        echo "</div>";
    }
    ?>
    <?php
    $sql = "select stu_id,rollno,fname,lname,gender,class,pno,email,pass from student_reg where stu_id='" . $_SESSION['stu_id'] . "'";
    $res = $connect->query($sql);
    if ($res->num_rows > 0) {
        echo "<form method='post'>";
        echo "<div class='tailor_profile' id='update_form' style='display:none'>";
        echo "<p style='font-size:30px;'>----------------------Profile-----------------------<p>";
        while ($row = $res->fetch_assoc()) {
            echo '<div class="row">
                    <div class="col-25"><label>Roll no.:</label></div>
                    <div class="col-75">
                        <input type="text" id="rollno" name="rollno" value="' . $row['rollno'] . '">
                    </div>
                </div> <div class="row">
                    <div class="col-25"><label>First name:</label></div>
                    <div class="col-75">
                        <input type="text" id="fname" name="firstname" value="' . $row['fname'] . '">
                    </div>
                </div> 
                <div class="row">
                    <div class="col-25"><label>Last name:</label></div>
                    <div class="col-75">
                        <input type="text" id="lname" name="lastname" value="' . $row['lname'] . '">
                    </div>
                </div> 
                <div class="row">
                    <div class="col-25"><label>Gender:</label></div>
                    <div class="col-75">
                        <input type="text" id="gender" name="gender" value="' . $row['gender'] . '">
                    </div>
                </div> 
                <div class="row">
                    <div class="col-25"><label>Class:</label></div>
                    <div class="col-75">
                        <input type="text" id="class" name="class" value="' . $row['class'] . '">
                    </div>
                </div> 
                <div class="row">
                    <div class="col-25"><label>Phone No:</label></div>
                    <div class="col-75">
                        <input type="text" id="pno" name="pno" value="' . $row['pno'] . '">
                    </div>
                </div> 
                <div class="row">
                    <div class="col-25"><label>Email:</label></div>
                    <div class="col-75">
                        <input type="text" id="email" name="email" value="' . $row['email'] . '">
                    </div>
                </div> 
                <div class="row">
                    <div class="col-25"><label>Password:</label></div>
                    <div class="col-75">
                        <input type="text" id="pass" name="pass" value="' . $row['pass'] . '">
                    </div>
                </div>
                <div class="row">
                    <div class="col-75">
                        <input type="hidden" name="stu_id" value="' . $row['stu_id'] . '">
                        <input type="submit" name="update" value="Update">
                    </div>
                </div>';
        }
        echo "</div>";
        echo "</form>";
    }
    echo '<script>
            function hide()
            {
                document.getElementById("summury_page").style="display:none";
                document.getElementById("update_form").style="display:block";
            }
        </script>';
    ?>
</body>

</html>