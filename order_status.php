<?php 
    session_start();
    error_reporting(0);
    include("connect.php");
    echo "<div id='alert2'><br><h1 id='msg2'></h1><br><br>
    <button id='try_agn' onclick='display_none()'>OK</button></div>";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./css/styleregister.css">
        <link rel="stylesheet" href="./css/dashbord.css">
        <title>View Meassages</title>
    </head>
    <body>
        <!--header area start-->
        <header>
        
        <div class="left_area">
            <h3>
                <span>Tailor </span>Dashboard</h3>
        </div>
        <div class="right_area">
            <a href="sign.php" class="logout_btn">Logout</a>
        </div>
    </header>
    <!--header area end-->
    <!--sidebar start-->
    <div class="sidebar">
        <a href="tailor_dash.php"><i class="fa fa-home"></i><span>Home</span></a>
        <a href="take_measure.php"><i class="fa fa-shopping-cart"></i><span>Add Order</span></a>
        <a href="edit_stu_measurement.php"><i class="fa fa-edit"></i><span>Edit Order</span></a>
        <a href="all_orders.php"><i class="fa fa-shopping-cart"></i><span>View Order</span></a>
        <a class="active" href="order_status.php"><i class="fa fa-envelope"></i><span>Message</span></a>
        <a href="search_student.php"><i class="fa fa-search"></i><span>Search</span></a>
        <a href="tailor_profile.php"><i class="fa fa-user"></i><span>Profile</span></a>
    </div>
    <form method='post'>
            <div>
                <div class="row">
                <label style="margin:0 0 0 30%; font-size:40px;">View uniform changes request according to classes</label>
                    <div class="col-75 class_btn" style="margin:2% 0 0 33%;">
                        <input type="submit" style=" font-size:20px; border-radius:10px; border:5px solid white; padding:40px; margin-right:8%" value="MCA" name="mca">
                        <input type="submit" style=" font-size:20px; border-radius:10px; border:5px solid white; padding:40px; margin-right:8%" value="BCA" name="bca">
                        <input type="submit" style=" font-size:20px; border-radius:10px; border:5px solid white; padding:40px; margin-right:8%" value="MBA" name="mba">
                        <input type="submit" style=" font-size:20px; border-radius:10px; border:5px solid white; padding:40px; margin-right:8%" value="BBA" name="bba">
                    </div>
                </div>
            </div>
        </form>
        <?php
            if(isset($_POST['mca'])){
                $sql = "SELECT id,rollno,fname,lname,class,stu_email,msg FROM stu_feedback where class='MCA'";
                $result = $connect->query($sql);
                if ($result->num_rows > 0) {
                    echo "<table><tr><th>ORDER ID</th><th>Roll No.</th><th>Name</th><th>Class</th>
                    <th>Email</th><th>Message</th></tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>".$row['id']."</td><td>".$row['rollno']."</td><td>". $row["fname"]." ".$row["lname"]."</td><td>" 
                        . $row['class'] . "</td><td>".$row['stu_email']."</td><td>".$row['msg']."</td></tr>";
                    }
                    echo "</table>";
                }else{
                    echo '<script>
                            function display_none()
                            {
                                document.getElementById("alert2").style="display:none";
                            }
                            function call_fun(){
                                document.getElementById("alert2").style="display:block";
                                document.getElementById("msg2").innerHTML="No message found from this class!";
                            }
                            call_fun();
                        </script>';
                }            
            }else if(isset($_POST['mba'])){
                $sql = "SELECT id,rollno,fname,lname,class,stu_email,msg FROM stu_feedback where class='BCA'";
                $result = $connect->query($sql);
                if ($result->num_rows > 0) {
                    echo "<table><tr><th>ORDER ID</th><th>Roll No.</th><th>Name</th><th>Class</th>
                    <th>Email</th><th>Message</th></tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>".$row['id']."</td><td>".$row['rollno']."</td><td>". $row["fname"]." ".$row["lname"]."</td><td>" 
                        . $row['class'] . "</td><td>".$row['stu_email']."</td><td>".$row['msg']."</td></tr>";
                    }
                    echo "</table>";
                }else{
                    echo '<script>
                            function display_none()
                            {
                                document.getElementById("alert2").style="display:none";
                            }
                            function call_fun(){
                                document.getElementById("alert2").style="display:block";
                                document.getElementById("msg2").innerHTML="No message found from this class!";
                            }
                            call_fun();
                        </script>';
                }
            }else if(isset($_POST['bca'])){
                $sql = "SELECT id,rollno,fname,lname,class,stu_email,msg FROM stu_feedback where class='MBA'";
                $result = $connect->query($sql);
                if ($result->num_rows > 0) {
                    echo "<table><tr><th>ORDER ID</th><th>Roll No.</th><th>Name</th><th>Class</th>
                    <th>Email</th><th>Message</th></tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>".$row['id']."</td><td>".$row['rollno']."</td><td>". $row["fname"]." ".$row["lname"]."</td><td>" 
                        . $row['class'] . "</td><td>".$row['stu_email']."</td><td>".$row['msg']."</td></tr>";
                    }
                    echo "</table>";
                }else{
                    echo '<script>
                            function display_none()
                            {
                                document.getElementById("alert2").style="display:none";
                            }
                            function call_fun(){
                                document.getElementById("alert2").style="display:block";
                                document.getElementById("msg2").innerHTML="No message found from this class!";
                            }
                            call_fun();
                        </script>';
                }
            }else if(isset($_POST['bba'])){
                $sql = "SELECT id,rollno,fname,lname,class,stu_email,msg FROM stu_feedback where class='BBA'";
                $result = $connect->query($sql);
                if ($result->num_rows > 0) {
                    echo "<table><tr><th>ORDER ID</th><th>Roll No.</th><th>Name</th><th>Class</th>
                    <th>Email</th><th>Message</th></tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>".$row['id']."</td><td>".$row['rollno']."</td><td>". $row["fname"]." ".$row["lname"]."</td><td>" 
                        . $row['class'] . "</td><td>".$row['stu_email']."</td><td>".$row['msg']."</td></tr>";
                    }
                    echo "</table>";
                }else{
                    echo '<script>
                            function display_none()
                            {
                                document.getElementById("alert2").style="display:none";
                            }
                            function call_fun(){
                                document.getElementById("alert2").style="display:block";
                                document.getElementById("msg2").innerHTML="No message found from this class!";
                            }
                            call_fun();
                        </script>';
                }
            }
        ?>
    </body>
</html>

