<?php
session_start();
error_reporting();
include("connect.php");
echo "<div id='alert2'><br><br><h1 id='msg2'></h1><br><br>
    <button id='try_agn' onclick='display_none()'>OK</button></div>";
if (isset($_POST['update'])) {
    $sql = "update admin_reg set fname='{$_POST['firstname']}',lname='{$_POST['lastname']}',gender='{$_POST['gender']}',
        pno={$_POST['pno']},email='{$_POST['email']}',pass='{$_POST['pass']}' where id={$_POST['admin_id']}";
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
<style>
    .col-75 {
        float: left;
        width: 65%;
        margin-top: 6px;
        margin-left: 5%;
    }

    .col-25 {
        float: left;
        width: 25%;
        margin-top: 15px;
    }
</style>

<body>
    <!--header area start-->
    <header>

        <div class="left_area">
            <h3>
                <span>Admin </span>Dashboard</h3>
        </div>
        <div class="right_area">
            <a href="sign.php" class="logout_btn">Logout</a>
        </div>
    </header>
    <!--header area end-->
    <!--sidebar start-->
    <div class="sidebar">
        <a href="admin_dash.php"><i class="fa fa-home"></i><span>Home</span></a>
        <a href="add_stu_tailor.php"><i class="fa fa-plus"></i><span>Add Tailor/Student</span></a>
        <a href="del_stu_tailor.php"><i class="fa fa-edit"></i><span>Delete Tailor/Student</span></a>
        <a href="admin_msg.php"><i class="fa fa-envelope"></i><span>Message</span></a>
        <a href="admin_search.php"><i class="fa fa-search"></i><span>Search</span></a>
        <a class="active" href="admin_profile.php"><i class="fa fa-user"></i><span>Profile</span></a>
    </div>
    <?php
    $sql = "select fname,lname,gender,depart,pno,email,pass from admin_reg where id='" . $_SESSION['admin_id'] . "'";
    $res = $connect->query($sql);
    if ($res->num_rows > 0) {
        echo "<div class='tailor_profile' id='summury_page'>";
        echo "<p style='font-size:30px;'>-----------------------Profile-----------------------<p>";
        while ($row = $res->fetch_assoc()) {
            echo   "<p>Firstname : " . $row['fname'] . "</p>" . "<p>Lastname : " . $row['lname'] . "</p>" .
                "<p>Gender : " . $row['gender'] . "</p>" . "<p>Department : " . $row['depart'] . "</p>" . "<p>Phone number : " . $row['pno'] . "</p>" . "<p>Email : " . $row['email'] . "</p>" . "<p>Password : #####</p>" .
                "<button id='update_btn' onclick='hide()'>Edit</button>";
        }
        echo "</div>";
    }
    ?>
    <?php
    $sql = "select id,fname,lname,gender,depart,pno,email,pass from admin_reg where id='" . $_SESSION['admin_id'] . "'";
    $res = $connect->query($sql);
    if ($res->num_rows > 0) {
        echo "<form method='post'>";
        echo "<div class='tailor_profile' id='update_form' style='display:none'>";
        echo "<p style='font-size:30px;'>----------------------Profile-----------------------<p>";
        while ($row = $res->fetch_assoc()) {
            echo ' <div class="row">
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
                    <div class="col-25"><label>Department:</label></div>
                    <div class="col-75">
                        <input type="text" id="depart" name="depart" value="' . $row['depart'] . '">
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
                        <input type="password" id="pass" name="pass" value="' . $row['pass'] . '"><i class="fa fa-eye" onclick="Toggle()"></i>
                    </div>
                </div>
                <div class="row">
                    <div class="col-75">
                        <input type="hidden" name="admin_id" value="' . $row['id'] . '">
                        <input type="submit" style="margin-left:40%" name="update" value="Update">
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
    <script src="./js/main.js"></script>
</body>

</html>