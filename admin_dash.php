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
    <title>Admin dashboard</title>
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
            <a class="active" href="admin_dash.php"><i class="fa fa-home"></i><span>Home</span></a>
            <a href="add_stu_tailor.php"><i class="fa fa-plus"></i><span>Add Tailor/Student</span></a>
            <a href="del_stu_tailor.php"><i class="fa fa-edit"></i><span>Delete Tailor/Student</span></a>
            <a href="admin_msg.php"><i class="fa fa-envelope"></i><span>Message</span></a>
            <a href="admin_search.php"><i class="fa fa-search"></i><span>Search</span></a>
            <a href="admin_profile.php"><i class="fa fa-user"></i><span>Profile</span></a>
        </div>
        <form method='post'>
            <div class="container">
                <div class="row" style="margin: 40px auto auto 100px;">
                    <div class="column"><a href="#"><i style="color:yellow" class="shop fa fa-shopping-cart fa-5x" aria-hidden="true"></i><br></a>
                        <div class="order">Total Order:
                            <?php
                            $sql = "SELECT * from measure_data";
                            $res = $connect->query($sql);
                            if ($res) {
                                $row = mysqli_num_rows($res);
                                if ($row > 0) {
                                    echo "<b>" . $row . "</b>";
                                } else {
                                    echo '0';
                                }
                            }
                            ?>
                        </div>
                        <input id="status_btn" type="submit" name="total_order" value="View Order">
                    </div>
                    <div class="column"><a href="#"><i style="color:yellow" class="shop fa fa-shopping-cart fa-5x" aria-hidden="true"></i><br></a>
                        <div class="order">Completed Order:
                            <?php
                            $sql = "SELECT * from measure_data where status='complete'";
                            $res = $connect->query($sql);
                            if ($res) {
                                $row = mysqli_num_rows($res);
                                if ($row > 0) {
                                    echo "<b>" . $row . "</b>";
                                } else {
                                    echo '0';
                                }
                            }
                            ?>
                        </div>
                        <input id="status_btn" type="submit" name="complete_order" value="View Order">
                    </div>
                    <div class="column"><a href="#"><i style="color:yellow" class="shop fa fa-shopping-cart fa-5x" aria-hidden="true"></i><br></a>
                        <div class="order">Remaining Order:
                            <?php
                            $sql = "SELECT * from measure_data where status='incomplete'";
                            $res = $connect->query($sql);
                            if ($res) {
                                $row = mysqli_num_rows($res);
                                if ($row > 0) {
                                    echo "<b>" . $row . "</b>";
                                } else {
                                    echo '0';
                                }
                            }
                            ?>
                        </div>
                        <input id="status_btn" type="submit" name="remain_order" value="View Order">
                    </div>
                </div>
            </div>
            </div>
        </form>
        <?php
        if (isset($_POST['total_order'])) {
            $sql = "select id,rollno,class,fname,lname,email from measure_data";
            $res = $connect->query($sql);
            if ($res->num_rows > 0) {
                echo "<table><tr><th>ORDER ID</th><th>Roll No.</th><th>Name</th><th>Class</th>
                    <th>Email</th></tr>";
                while ($row = $res->fetch_assoc()) {
                    echo "<tr><td>" . $row['id'] . "</td><td>" . $row['rollno'] . "</td><td>" . $row["fname"] . " " . $row["lname"] . "</td><td>"
                        . $row['class'] . "</td><td>" . $row['email'] . "</td><tr>";
                }
                echo "</table>";
            }
        } else if (isset($_POST['complete_order'])) {
            $sql = "select id,rollno,class,fname,lname,email,status from measure_data where status='Complete'";
            $res = $connect->query($sql);
            if ($res->num_rows > 0) {
                echo "<table><tr><th>ORDER ID</th><th>Roll No.</th><th>Name</th><th>Class</th>
                    <th>Email</th><th>Status</th></tr>";
                while ($row = $res->fetch_assoc()) {
                    echo "<tr><td>" . $row['id'] . "</td><td>" . $row['rollno'] . "</td><td>" . $row["fname"] . " " . $row["lname"] . "</td><td>"
                        . $row['class'] . "</td><td>" . $row['email'] . "</td><td>" . $row['status'] . "</td><tr>";
                }
                echo "</table>";
            }
        } else if (isset($_POST['remain_order'])) {
            $sql = "select id,rollno,class,fname,lname,email,status from measure_data where status='Incomplete'";
            $res = $connect->query($sql);
            if ($res->num_rows > 0) {
                echo "<table><tr><th>ORDER ID</th><th>Roll No.</th><th>Name</th><th>Class</th>
                    <th>Email</th><th>Status</th></tr>";
                while ($row = $res->fetch_assoc()) {
                    echo "<tr><td>" . $row['id'] . "</td><td>" . $row['rollno'] . "</td><td>" . $row["fname"] . " " . $row["lname"] . "</td><td>"
                        . $row['class'] . "</td><td>" . $row['email'] . "</td><td>" . $row['status'] . "</td><tr>";
                }
                echo "</table>";
            }
        }
        ?>
    </body>

</html>