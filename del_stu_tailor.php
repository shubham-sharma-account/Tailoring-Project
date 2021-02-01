<?php
session_start();
error_reporting(0);
include("connect.php");
echo "<div id='alert2'><br><br><br><h1 id='msg2'></h1>
    <button id='try_agn' onclick='display_none()'>OK</button></div>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/dashbord.css">
    <link rel="stylesheet" href="./css/styleregister.css">
    <title>Delete Student or Tailor</title>
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
        <a class="active" href="del_stu_tailor.php"><i class="fa fa-edit"></i><span>Delete Tailor/Student</span></a>
        <a href="admin_msg.php"><i class="fa fa-envelope"></i><span>Message</span></a>
        <a href="admin_search.php"><i class="fa fa-search"></i><span>Search</span></a>
        <a href="admin_profile.php"><i class="fa fa-user"></i><span>Profile</span></a>
    </div>
    <form method="post">
        <div class="row">
            <div class="col-75 class_btn" style="margin:2% 0 0 33%;">
                <input type="submit" style=" font-size:20px; border-radius:10px; border:5px solid white; padding:40px; margin:5% 12% " value="Delete Tailor" name="del_tailor">
                <input type="submit" style=" font-size:20px; border-radius:10px; border:5px solid white; padding:40px; margin-right:8%" value="Delete Student" name="del_student">
            </div>
        </div>
    </form>
    <?php
        if(isset($_POST['del_student']))
        {
            $sql="select * from student_reg";
            $res=$connect->query($sql);
            if($res->num_rows > 0)
            {
                echo "<table id='result'><tr><th>Roll No.</th><th>Name</th><th>Class</th><th>Gender</th><th>Phone</th>
                <th>Email</th><th style='margin-right:15px'>Action</th></tr>";
                while($row=$res->fetch_assoc())
                {
                    echo "<tr><td>".$row['rollno']."</td><td>". $row["fname"]." ".$row["lname"]."</td><td>" 
                    . $row['class'] . "</td><td>" . $row['gender'] . "</td><td>" . $row['pno'] . "</td><td>".$row['email']."</td>
                    <td><form method='post'>
                    <input type='hidden' name='stu_id' value=".$row["stu_id"].">
                    <input type='submit' name='confirm_box' value='Delete'></form><td><tr>";
                }
            }else{
                echo '<script>
                        function display_none()
                        {
                            document.getElementById("alert2").style="display:none";
                        }
                        function call_fun(){
                            document.getElementById("alert2").style="display:block; z-index:1;";
                            document.getElementById("msg2").innerHTML="No Student Found!";
                        }
                        call_fun();
                </script>';
            $sql="select * from student_reg";
            $res=$connect->query($sql);
            if($res->num_rows > 0)
            {
                echo "<table id='result'><tr><th>Roll No.</th><th>Name</th><th>Class</th><th>Gender</th><th>Phone</th>
                <th>Email</th><th>Action</th></tr>";
                while($row=$res->fetch_assoc())
                {
                    echo "<tr><td>".$row['rollno']."</td><td>". $row["fname"]." ".$row["lname"]."</td><td>" 
                    . $row['class'] . "</td><td>" . $row['gender'] . "</td><td>" . $row['pno'] . "</td><td>".$row['email']."</td>
                    <td><form method='post'>
                    <input type='hidden' name='stu_id' value=".$row["stu_id"].">
                    <input type='submit' name='confirm_box' value='Delete'></form><td><tr>";
                }
            }
        }
        }
        if (isset($_POST['confirm_box'])) {
            echo "<div id='confirm_box'><h1 id='confirm_msg'>Do you want to delete this student?</h1>
                <form method='post'><input type='hidden' name='stu_id' value=".$_POST["stu_id"].">
                <input type='submit' id='delete_btn' name='delete_student' value='Yes'></form>
                <button id='confirm_box_cancel_btn' onclick='cancel_confirm_box()'>No</button>
                </div>";
            echo '<script>
                    function cancel_confirm_box(){
                        document.getElementById("confirm_box").style="visibility:hidden";
                        return false;
                    }
                </script>';
                $sql="select * from student_reg";
                $res=$connect->query($sql);
                if($res->num_rows > 0)
                {
                    echo "<table id='result'><tr><th>Roll No.</th><th>Name</th><th>Class</th><th>Gender</th><th>Phone</th>
                    <th>Email</th><th>Action</th></tr>";
                    while($row=$res->fetch_assoc())
                    {
                        echo "<tr><td>".$row['rollno']."</td><td>". $row["fname"]." ".$row["lname"]."</td><td>" 
                        . $row['class'] . "</td><td>" . $row['gender'] . "</td><td>" . $row['pno'] . "</td><td>".$row['email']."</td>
                        <td><form method='post'>
                        <input type='hidden' name='stu_id' value=".$row["stu_id"].">
                        <input type='submit' name='confirm_box' value='Delete'></form><td><tr>";
                    }
                }
        }
        if(isset($_POST['delete_student']))
        {
            $sql="delete from student_reg where stu_id={$_POST['stu_id']}";
            $res=$connect->query($sql);
            if($res)
            {
                echo '<script>
                        function display_none()
                        {
                            document.getElementById("alert2").style="display:none";
                        }
                        function call_fun(){
                            document.getElementById("alert2").style="display:block; z-index:1;";
                            document.getElementById("msg2").innerHTML="Student has been deleted!";
                        }
                        call_fun();
                    </script>';
                $sql="select * from student_reg";
                $res=$connect->query($sql);
                if($res->num_rows > 0)
                {
                    echo "<table id='result'><tr><th>Roll No.</th><th>Name</th><th>Class</th><th>Gender</th><th>Phone</th>
                    <th>Email</th><th>Action</th></tr>";
                    while($row=$res->fetch_assoc())
                    {
                        echo "<tr><td>".$row['rollno']."</td><td>". $row["fname"]." ".$row["lname"]."</td><td>" 
                        . $row['class'] . "</td><td>" . $row['gender'] . "</td><td>" . $row['pno'] . "</td><td>".$row['email']."</td>
                        <td><form method='post'>
                        <input type='hidden' name='stu_id' value=".$row["stu_id"].">
                        <input type='submit' name='delete_student' value='Delete'></form><td><tr>";
                    }
                }
            } 
            echo $_POST['stu_id'];
        }
        if(isset($_POST['del_tailor']))
        {
            $sql="select * from tailor_reg";
            $res=$connect->query($sql);
            if($res->num_rows > 0)
            {
                echo "<table id='result'><tr><th>Name</th><th>Phone</th><th>Email</th><th>Gender</th>
                <th>Action</th></tr>";
                while($row=$res->fetch_assoc())
                {
                    echo "<tr><td>". $row["fname"]." ".$row["lname"]."</td><td>" . $row['pno'] . "</td><td>" . $row['email'] . "</td><td>".$row['gender']."</td>
                    <td><form method='post'>
                    <input type='hidden' name='tailor_id' value=".$row["tailor_id"].">
                    <input type='submit' name='confirm_box2' value='Delete'></form><td><tr>";
                }
            }else{
                echo '<script>
                        function display_none()
                        {
                            document.getElementById("alert2").style="display:none";
                        }
                        function call_fun(){
                            document.getElementById("alert2").style="display:block; z-index:1;";
                            document.getElementById("msg2").innerHTML="No Tailor Found!";
                        }
                        call_fun();
                </script>';
            }
        }
        if (isset($_POST['confirm_box2'])) {
            echo "<div id='confirm_box2'><h1 id='confirm_msg2'>Do you want to delete this tailor?</h1>
                <form method='post'><input type='hidden' name='tailor_id' value=".$_POST["tailor_id"].">
                <input type='submit' id='delete_btn2' name='delete_tailor' value='Yes'></form>
                <button id='confirm_box_cancel_btn2' onclick='cancel_confirm_box()'>No</button>
                </div>";
            echo '<script>
                    function cancel_confirm_box(){
                        document.getElementById("confirm_box2").style="visibility:hidden";
                        return false;
                    }
                </script>';
                $sql="select * from tailor_reg";
                $res=$connect->query($sql);
                if($res->num_rows > 0)
                {
                    echo "<table id='result'><tr><th>Name</th><th>Phone</th><th>Email</th><th>Gender</th>
                    <th>Action</th></tr>";
                    while($row=$res->fetch_assoc())
                    {
                        echo "<tr><td>". $row["fname"]." ".$row["lname"]."</td><td>" . $row['pno'] . "</td><td>" . $row['email'] . "</td><td>".$row['gender']."</td>
                        <td><form method='post'>
                        <input type='hidden' name='tailor_id' value=".$row["tailor_id"].">
                        <input type='submit' name='confirm_box2' value='Delete'></form><td><tr>";
                    }
                }
        }
        if(isset($_POST['delete_tailor']))
        {
            $sql="delete from tailor_reg where tailor_id={$_POST['tailor_id']}";
            $res=$connect->query($sql);
            if($res)
            {
                echo '<script>
                        function display_none()
                        {
                            document.getElementById("alert2").style="display:none";
                        }
                        function call_fun(){
                            document.getElementById("alert2").style="display:block; z-index:1;";
                            document.getElementById("msg2").innerHTML="Tailor has been deleted!";
                        }
                        call_fun();
                    </script>';
                $sql="select * from tailor_reg";
                $res=$connect->query($sql);
                if($res->num_rows > 0)
                {
                    echo "<table id='result'><tr><th>Name</th><th>Phone</th><th>Email</th><th>Gender</th>
                    <th>Action</th></tr>";
                    while($row=$res->fetch_assoc())
                    {
                            echo "<tr><td>". $row["fname"]." ".$row["lname"]."</td><td>" . $row['pno'] . "</td><td>" . $row['email'] . "</td><td>".$row['gender']."</td>
                            <td><form method='post'>
                            <input type='hidden' name='tailor_id' value=".$row["tailor_id"].">
                            <input type='submit' name='delete_tailor' value='Delete'></form><td><tr>";
                    }
                }
            } 
        }
    ?>
</body>
</html>