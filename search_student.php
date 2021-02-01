<?php
    session_start();
    error_reporting(0);
    include('connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/dashbord.css">
    <link rel="stylesheet" href="css/styleregister.css">
    <title>Search Student</title>
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
        <a href="order_status.php"><i class="fa fa-envelope"></i><span>Message</span></a>
        <a class="active" href="search_student.php"><i class="fa fa-search"></i><span>Search</span></a>
        <a href="tailor_profile.php"><i class="fa fa-user"></i><span>Profile</span></a>
    </div>    
    <!------- Search student forms -------->
    <div class="info">
        <form method="post">
            <div class="stu_search_container_left">
                <div class="row">
                    <div class="col-75">
                        <label>Serach Student:</label>
                        <input type="text" id="email" name="email_stu_rollno" placeholder="Enter student email or roll number">
                    </div>
                </div>
                <div class="row">
                    <div class="col-75">
                        <input type="submit" value="Submit" name="submit1">
                    </div>
                </div>
            </div>
        </form>
    </div>   
    <?php
        echo "<div id='alert2'><br><br><br><h1 id='msg2'></h1>
        <button id='try_agn' onclick='display_none()'>OK</button></div>";
        $email = $_POST['email_stu_rollno'];
        $rollno = $_POST['email_stu_rollno'];
        if(isset($_POST['take_measure'])){
            $_SESSION['rollno']= $_POST['rollno'];
            $_SESSION['class']= $_POST['class'];
            $_SESSION['fname']=$_POST['fname'];
            $_SESSION['lname']=$_POST['lname'];
            $_SESSION['pno']=$_POST['pno'];
            $_SESSION['email']=$_POST['email'];
            echo $_SESSION['email'];
            header('Location:measure_form.php');
        }
        /********* used to seach any registered student *************/
        if(isset($_POST['submit1'])) {
            $sql2 = "SELECT rollno,fname,lname,class,pno,email FROM student_reg where email='$email' or rollno='$rollno'";
            $result = $connect->query($sql2);
        
            if ($result->num_rows > 0) {
                echo "<table><tr><th>Roll No.</th><th>Name</th><th>Class</th><th>Phone</th>
                        <th>Email</th><th>Action</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row['rollno'] . "</td><td>" . $row["fname"] . " " . $row["lname"] . "</td><td>" . $row['class'] . "</td><td>" . $row['pno'] . "</td><td>" . $row['email'] . "</td>
                        <td><form method='post'><input type=hidden name='rollno' value=".$row["rollno"].">
                        <input type=hidden name='class' value=".$row["class"].">
                        <input type=hidden name='fname' value=".$row["fname"].">
                        <input type=hidden name='lname' value=".$row["lname"].">
                        <input type=hidden name='pno' value=".$row["pno"].">
                        <input type=hidden name='email' value=".$row["email"].">
                        <input type='submit' name='take_measure' value='Take measurement'></form></td>
                        </tr>";
                }
            }else{
                echo '<script>
                                function display_none()
                                {
                                    document.getElementById("alert2").style="display:none";
                                }
                                function call_fun(){
                                    document.getElementById("alert2").style="display:block; z-index:1;";
                                    document.getElementById("msg2").innerHTML="User doesn\'t exist, Please try again!";
                                }
                                call_fun();
                            </script>';
            }
            echo "</table>";
        }
    ?>
    <body>
</html>