<?php
session_start();
?>
<?php
error_reporting(0);
include('connect.php');
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
    <title>View All Orders</title>
    <style>
        #alert2 {
            margin-top: 5%;
        }

        .col-75 {
            float: left;
            width: 70%;
            margin-top: 6px;
            margin-left: 5%;
        }

        .col-25 {
            float: left;
            width: 25%;
            margin-top: 15px;
        }
    </style>
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
        <a href="tailor_dash.php"><i class="fa fa-home"></i><span>Dashboard</span></a>
        <a href="take_measure.php"><i class="fa fa-shopping-cart"></i><span>Add Order</span></a>
        <a href="edit_stu_measurement.php"><i class="fa fa-edit"></i><span>Edit Order</span></a>
        <a class="active" href="all_orders.php"><i class="fa fa-shopping-cart"></i><span>View Order</span></a>
        <a href="order_status.php"><i class="fa fa-envelope"></i><span>Message</span></a>
        <a href="search_student.php"><i class="fa fa-search"></i><span>Search</span></a>
        <a href="tailor_profile.php"><i class="fa fa-user"></i><span>Profile</span></a>
    </div>
    <form method='post'>
        <div>
            <div class="row">
                <label style="margin:0 0 0 40%; font-size:40px;">View orders according to classes</label>
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
    if (isset($_POST['mca'])) {
        $sql = "SELECT id,rollno,fname,lname,pno,email,class,status FROM measure_data where class='MCA'";
        $result = $connect->query($sql);
        include("tailor_all_order_query.php");
    } else if (isset($_POST['mba'])) {
        $sql = "SELECT id,rollno,fname,lname,pno,email,class,status FROM measure_data where class='MBA'";
        $result = $connect->query($sql);
        include("tailor_all_order_query.php");
    } else if (isset($_POST['bca'])) {
        $sql = "SELECT id,rollno,fname,lname,pno,email,class,status FROM measure_data where class='BCA'";
        $result = $connect->query($sql);
        include("tailor_all_order_query.php");
    } else if (isset($_POST['bba'])) {
        $sql = "SELECT id,rollno,fname,lname,pno,email,class,status  FROM measure_data where class='BBA'";
        $result = $connect->query($sql);
        include("tailor_all_order_query.php");
    }
    ?>
    <?php
    if (isset($_POST['uniform_status'])) {
        echo "<div id='confirm_box'><h1 id='confirm_msg'>Do you want to update status to complete?</h1>
            <form method='post'><input type='hidden' name='email' value={$_POST['email']}>
            <input type='hidden' name='class' value={$_POST['class']}>
            <input type='submit' id='delete_btn' name='complete' value='Yes'></form>
            <button id='confirm_box_cancel_btn' onclick='cancel_confirm_box()'>No</button>
            </div>";
        echo '<script>
                function cancel_confirm_box(){
                    document.getElementById("confirm_box").style="visibility:hidden";
                    return false;
                }
            </script>';
        $sql = "SELECT id,rollno,fname,lname,pno,email,class,status FROM measure_data where class='{$_POST['class']}'";
        $result = $connect->query($sql);
        include("tailor_all_order_query.php");
    }
    if (isset($_POST['complete'])) {
        $sql = "update measure_data set status='Complete' where email='{$_POST['email']}'";
        $res = $connect->query($sql);
        if ($res) {
            echo '<script>
                        function display_none()
                        {
                            document.getElementById("alert2").style="display:none";
                        }
                        function call_fun(){
                            document.getElementById("alert2").style="display:block; z-index:1;";
                            document.getElementById("msg2").innerHTML="Status successfully updated to \"Complete\" !";
                        }
                        call_fun();
                    </script>';
            $sql = "SELECT id,rollno,fname,lname,pno,email,class,status FROM measure_data where class='{$_POST['class']}'";
            $result = $connect->query($sql);
            include("tailor_all_order_query.php");
        } else {
            echo "<h1 style='color:white;'>Error in updating status!</h1>";
        }
    }
    if (isset($_POST['delete'])) {
        echo "<div id='confirm_box'><h1 id='confirm_msg'>Do you want to delete this order?</h1>
            <form method='post'><input type='hidden' name='rollno' value={$_POST['rollno']}>
            <input type='hidden' name='class' value={$_POST['class']}>
            <input type='submit' id='delete_btn' name='del_btn' value='Yes'></form>
            <button id='confirm_box_cancel_btn' onclick='cancel_confirm_box()'>No</button>
            </div>";
        echo '<script>
                function cancel_confirm_box(){
                    document.getElementById("confirm_box").style="visibility:hidden";
                    return false;
                }
            </script>';
        $sql = "SELECT id,rollno,fname,lname,pno,email,class,status FROM measure_data where class='{$_POST['class']}'";
        $result = $connect->query($sql);
        include("tailor_all_order_query.php");
    }
    if (isset($_POST['del_btn'])) {
        $delete = "delete from measure_data where rollno={$_POST['rollno']}";
        $res = mysqli_query($connect, $delete);
        if ($res) {
            echo '<script>
                        function display_none()
                        {
                            document.getElementById("alert2").style="display:none";
                        }
                        function call_fun(){
                            document.getElementById("alert2").style="display:block; z-index:1;";
                            document.getElementById("msg2").innerHTML="Order has been deleted!";
                        }
                        call_fun();
                    </script>';
            $sql = "SELECT id,rollno,fname,lname,pno,email,class,status FROM measure_data where class='{$_POST['class']}'";
            $result = $connect->query($sql);
            include("tailor_all_order_query.php");
        } else {
            echo "<h1 style='color:white;'>Error in deleting row!</h1>";
        }
    }
    if (isset($_POST['view_measure'])) {
        $sql = "select fname,lname,rollno,class,email,chest,waist,sleeve,sholder,neck,shirt_len,
            hips,thigh,outseam,inseam,pant_len from measure_data where email='{$_POST['stu_email']}'";
        $res = $connect->query($sql);
        if ($res->num_rows > 0) {
            $sql = "SELECT id,rollno,fname,lname,pno,email,class,status FROM measure_data where class='{$_POST['class']}'";
            $result = $connect->query($sql);
            include("tailor_all_order_query.php");
            echo '<script>
                    document.getElementById("result").style="z-index:-1";
                </script>';
            echo "<div class='tailor_profile' id='summury_page'>";
            echo "<button id='close_btn' onclick='hide()'>X</button>" . "<br><br><br>";
            echo "<p style='font-size:30px;'>------------------Measurement-------------------<p>";
            while ($row = $res->fetch_assoc()) {
                echo "<p>Name : " . $row['fname'] . " " . $row['lname'] . "</p>" . "<p>Roll no. : " . $row['rollno'] . "</p>" . "<p>Class : " . $row['class'] . "</p>" . "<p>Chest circumference : " . $row['chest'] . "</p>" .
                    "<p>Waist circumference : " . $row['waist'] . "</p>" . "<p>Sleeve length : " . $row['sleeve'] . "<p>Sholder : " . $row['sholder'] . "</p>" .
                    "<p>Neck size : " . $row['neck'] . "</p>" . "<p>Shirt length : " . $row['shirt_len'] . "</p>" . "<p>Hips circumference : " . $row['hips'] . "</p>" .
                    "<p>Thigh circumference : " . $row['thigh'] . "</p>" . "<p>Outseam : " . $row['outseam'] . "</p>" . "<p>Inseam : " . $row['inseam'] .
                    "</p>" . "<p>Pant length : " . $row['pant_len'] . "</p>" .
                    "<form method='post'><input type='hidden' name='email' value=" . $row["email"] . ">
                    <input type='hidden' name='class' value=" . $row["class"] . ">
                    <input type='submit' name='update' value='Edit'></form>";
            }
            echo "</div>";
        }
    }
    echo '<script>
            function hide(){
                document.getElementById("summury_page").style="display:none";
                document.getElementById("result").style="z-index:1";
            }
        </script>';
    ?>
    <?php
    if (isset($_POST['update'])) {
        $sql = "select rollno,class,fname,lname,class,email,chest,waist,sleeve,sholder,neck,shirt_len,
        hips,thigh,outseam,inseam,pant_len from measure_data where email='{$_POST['email']}'";
        $res = $connect->query($sql);
        if ($res->num_rows > 0) {
            echo "<form method='post'>";
            echo "<div class='tailor_profile' id='update_form'>";
            echo "<p style='font-size:30px;'>----------------------Profile------------------------<p>";
            while ($row = $res->fetch_assoc()) {
                echo '<div class="row">
                    <div class="col-25"><label>Roll no.:</label></div>
                    <div class="col-75">
                        <input type="text" id="rollno" name="rollno" value="' . $row['rollno'] . '" disabled>
                    </div>
                </div> <div class="row">
                    <div class="col-25"><label>Name:</label></div>
                    <div class="col-75">
                        <input type="text" id="fname" name="firstname" value="' . $row['fname'] . ' ' . $row['lname'] . '" disabled>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-25"><label>Class:</label></div>
                    <div class="col-75">
                        <input type="text" id="class" name="class" value="' . $row['class'] . '" disabled>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-25"><label>Chest:</label></div>
                    <div class="col-75">
                        <input type="text" id="chest" name="chest" value="' . $row['chest'] . '">
                    </div>
                </div>
                <div class="row">
                        <div class="col-25"><label>Waist:</label></div>
                        <div class="col-75">
                            <input type="text" id="waist" name="waist" value="' . $row['waist'] . '">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25"><label>Sleeve:</label></div>
                        <div class="col-75">
                            <input type="text" id="sleeve" name="sleeve" value="' . $row['sleeve'] . '">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25"><label>Sholder:</label></div>
                        <div class="col-75">
                            <input type="text" id="sholder" name="sholder" value="' . $row['sholder'] . '">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25"><label>Neck:</label></div>
                        <div class="col-75">
                            <input type="text" id="neck" name="neck" value="' . $row['neck'] . '">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25"><label>Shirt length:</label></div>
                        <div class="col-75">
                            <input type="text" id="shirt_len" name="shirt_len" value="' . $row['shirt_len'] . '">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25"><label>Hips:</label></div>
                        <div class="col-75">
                            <input type="text" id="hips" name="hips" value="' . $row['hips'] . '">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25"><label>Thigh:</label></div>
                        <div class="col-75">
                            <input type="text" id="thigh" name="thigh" value="' . $row['thigh'] . '">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25"><label>Outseam:</label></div>
                        <div class="col-75">
                            <input type="text" id="outseam" name="outseam" value="' . $row['outseam'] . '">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25"><label>Inseam:</label></div>
                        <div class="col-75">
                            <input type="text" id="inseam" name="inseam" value="' . $row['inseam'] . '">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25"><label>Pant length:</label></div>
                        <div class="col-75">
                            <input type="text" id="pant_len" name="pant_len" value="' . $row['pant_len'] . '">
                        </div>
                    </div>
                <div class="row">
                    <div class="col-75">
                        <input type="hidden" name="tailor_id" value="' . $row['tailor_id'] . '">
                        <input type="submit" name="update" value="Update" onclick="hide()">
                    </div>
                </div>';
            }
            echo "</div>";
            echo "</form>";
        }
    }

    ?>
</body>

</html>