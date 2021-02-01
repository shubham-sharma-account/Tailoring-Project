<?php
    error_reporting(0);
    include("connect.php");
    echo "<div id='alert'><h1 id='msg1'></h1><h2>**Click OK to go on dashboard**</h2>
    <a href='sign.php'><button id='alert_btn'>OK</button></a></div>";
    echo "<div id='alert2'><h1 id='msg2'></h1><h2>**Please try again**</h2>
    <button id='try_agn' onclick='display_none()'>Try again!</button></div>";
    if (isset($_POST['submit'])) {
        $fname=$_POST['firstname'];
        $lname=$_POST['lastname'];
        $rollno=$_POST['rollno'];
        $class=$_POST['class'];
        $stu_email=$_POST['stu_email'];
        $tailor_email=$_POST['tailor_email'];
        $msg=$_POST['subject'];
        if (empty($fname)){
            $fnameErr = "*First Name is required";
        }else if(!preg_match("/^[a-zA-Z ]*$/", $fname)){
            $fnameErr = "*Only letters and white space allowed";
        }else if(empty($lname)) {
            $lnameErr = "*Last Name is required";
        }else if (!preg_match("/^[a-zA-Z ]*$/", $lname)) {
            $lnameErr = "*Only letters and white space allowed";
        }else if (empty($rollno)){
            $rollnoErr = "*Rollno is required";
        }else if($class=="class"){
            $classErr="*Please select your class";
        }else if(empty($stu_email)){
            $stu_emailErr="*Email is required";  
        }else if(!filter_var($stu_email, FILTER_VALIDATE_EMAIL)) {
            $stu_emailErr = "*Invalid email format";  
        }else if(empty($tailor_email)){
            $tailor_emailErr="*Email is required";  
        }else if(!filter_var($tailor_email, FILTER_VALIDATE_EMAIL)) {
            $tailor_emailErr = "*Invalid email format";  
        }else if(empty($msg)){
            $msgErr="*Please write your message";
        }else{
            $sql1="insert into stu_feedback (fname,lname,rollno,class,stu_email,tailor_email,msg) 
                values('".$fname."','".$lname."','".$rollno."',
                '".$class."','".$stu_email."','".$tailor_email."','".$msg."')";
            if($connect->query($sql1))
            {
                echo '<script>
                        function call_fun(){
                            document.getElementById("alert").style="display:block";
                            document.getElementById("msg1").innerHTML="Email has been sent!"
                        }
                        call_fun();
                    </script>';
            }
            else{
                echo '<script>
                        function display_none()
                        {
                            document.getElementById("alert2").style="display:none";
                        }
                        function call_fun(){
                            document.getElementById("alert2").style="display:block";
                            document.getElementById("msg2").innerHTML="Error in sending message!";
                        }
                        call_fun();
                    </script>';
            }

        }
    }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Changes request form</title>
    <link rel="stylesheet" type="text/css" href="./css/styleregister.css">
</head>

<body>
    <div class="container">
        <form action="" method="post">
            <fieldset>
                <legend style="font-size: 30px; color:white; width:auto; letter-spacing:2px">Changes request form</legend>
                <div class="row">
                    <div class="col-75">
                        <input type="text" id="fname" name="firstname" placeholder="Enter your firstname.." value="<?php echo $fname ?>">
                        <span class="error"><?php echo $fnameErr ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-75">
                        <input type="text" id="lname" name="lastname" placeholder="Enter your lastname.." value="<?php echo $lname ?>">
                        <span class="error"><?php echo $lnameErr ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-75">
                        <input type="number" id="rollno" name="rollno" placeholder="Enter your rollno.." value="<?php echo $rollno ?>">
                        <span class="error"><?php echo $rollnoErr ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-75">
                        <select id="department" name="class">
                            <option value="class">Class</option>
                            <option value="mba" <?php if($class=="mba")echo "selected" ?>>MBA</option>
                            <option value="mca" <?php if($class=="mca")echo "selected" ?>>MCA</option>
                            <option value="bca" <?php if($depart=="bca")echo "selected" ?>>BCA</option>
                            <option value="bba" <?php if($depart=="bba")echo "selected" ?>>BBA</option>
                        </select>
                        <span class="error"><?php echo $classErr ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-75">
                        <input type="email" id="email" name="stu_email" placeholder="Enter your email.." value="<?php echo $stu_email ?>">
                        <span class="error"><?php echo $stu_emailErr ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-75">
                        <input type="email" id="email" name="tailor_email" placeholder="Enter tailor email.." value="<?php echo $tailor_email ?>">
                        <span class="error"><?php echo $tailor_emailErr ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-75">
                        <textarea id="subject" name="subject" placeholder="Write something..." value="<?php echo $msg ?>"></textarea>
                        <span class="error"><?php echo $msgErr ?></span>
                    </div>
                </div>   
                 <div class="row">
                    <div class="col-75">     
                        <input type="submit" name="submit" value="Submit">
                    </div>
                </div>    
            </fieldset>        
        </form>
    </div>
</body>

</html>