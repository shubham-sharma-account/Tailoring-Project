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
    <title>Send Messages</title>
</head>

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
        <a class="active" href="admin_msg.php"><i class="fa fa-envelope"></i><span>Message</span></a>
        <a href="admin_search.php"><i class="fa fa-search"></i><span>Search</span></a>
        <a href="admin_profile.php"><i class="fa fa-user"></i><span>Profile</span></a>
    </div>