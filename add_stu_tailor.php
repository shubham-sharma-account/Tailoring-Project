<?php
session_start();
error_reporting(0);
include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/dashbord.css">
    <title>Add Student or Tailor</title>
</head>

<body>
    <!--header area start-->
    <header>

        <div class="left_area">
            <h3>
                <span>Admin </span>Dashboard</h3>
        </div>
        <div class="right_area">
            <a href="#" class="logout_btn">Logout</a>
        </div>
    </header>
    <!--header area end-->
    <!--sidebar start-->
    <div class="sidebar">
        <a href="admin_dash.php"><i class="fa fa-home"></i><span>Home</span></a>
        <a class="active" href="add_stu_tailor.php"><i class="fa fa-plus"></i><span>Add Tailor/Student</span></a>
        <a href="del_stu_tailor.php"><i class="fa fa-edit"></i><span>Delete Tailor/Student</span></a>
        <a href="admin_msg.php"><i class="fa fa-envelope"></i><span>Message</span></a>
        <a href="admin_search.php"><i class="fa fa-search"></i><span>Search</span></a>
        <a href="admin_profile.php"><i class="fa fa-user"></i><span>Profile</span></a>
    </div>
    <form method="post">
        <div class="row">
            <div class="col-75 class_btn" style="margin:2% 0 0 33%;">
                <input type="submit" formaction="tailor.php" style=" font-size:20px; border-radius:10px; border:5px solid white; padding:40px; margin:5% 12% " value="Add Tailor" name="mca">
                <input type="submit" formaction="student.php" style=" font-size:20px; border-radius:10px; border:5px solid white; padding:40px; margin-right:8%" value="Add Student" name="bca">
            </div>
        </div>
    </form>
</body>

</html>