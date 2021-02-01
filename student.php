<?php
    error_reporting(0);
    include('connect.php');
    echo "<div id='alert'><h1 id='msg1'></h1><h2>**Click OK to SignIn**</h2>
    <a href='sign.php'><button id='alert_btn'>OK</button></a></div>";
    echo "<div id='alert2'><h1 id='msg2'></h1><h2>**Please try again**</h2>
    <button id='try_agn' onclick='display_none()'>Try again!</button></div>";
    $rollno=$_POST['rollno'];
    $fname=$_POST['firstname'];
    $lname=$_POST['lastname'];
    $gender=$_POST['gender'];
    $class=$_POST['class'];
    $pno=$_POST['num'];
    $email=$_POST['email'];
    $pass=$_POST['pass'];
    $cpass=$_POST['cpass'];
    $pnolength=strlen($pno);
    if (isset($_POST['submit'])){
        if (empty($rollno)){
            $rollnoErr = "*Rollno is required";
        }
        else if (empty($fname)){
            $fnameErr = "*First Name is required";
        }
        else if(!preg_match("/^[a-zA-Z ]*$/", $fname)){
            $fnameErr = "*Only letters and white space allowed";
        }
        else if(empty($lname)) {
            $lnameErr = "*Last Name is required";
        }
        else if (!preg_match("/^[a-zA-Z ]*$/", $lname)) {
            $lnameErr = "*Only letters and white space allowed";
        }
        else if ($gender=="gender") {
            $genderErr = "*Please select your gender";
        }
        else if($class=="class"){
            $classErr="*Please select your class";
        }
        else if(empty($pno)){
            $pnoErr ="*Phone number is required";
        }
        else if(!preg_match("/^[1-9][0-9]*$/", $pno)){
            $pnoErr="*Invalid number";
        }else if($pnolength != 10){
            $pnoErr="*The length of number must be 10";
        }
        else if(empty($email)){
            $emailErr="*Email is required";  
        }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "*Invalid email format";  
        }
        else if(empty($pass)){
            $passErr="*Password is required";
        }
        else if(!preg_match("/[a-zA-Z]{1}([a-zA-Z0-9-\W]{6})([!@#$%&~]{1})/",$pass)){
            $passErr="*Length must be 8 character, First letter must be an alphabet <br> and last letter must be a special symbol";
        }
        else if(empty($cpass)){
            $cpassErr="*Confirm password is required";
        }
        else if(!preg_match("/[a-zA-Z]{1}([a-zA-Z0-9-\W]{6})([!@#$%&~]{1})/",$cpass)){
            $cpassErr="*Length must be 8 character, First letter must be an alphabet <br> and last letter must be a special symbol";
        }else if($pass!=$cpass){
            $cpassErr="*Confirm password doesn't match";
        }
        else
        {
            $sql="select * from student_reg where rollno='$rollno' or email='$email'";
            $res1=$connect->query($sql);
            if($res1->num_rows>0)
            {
                echo '<script>
                        function display_none()
                        {
                            document.getElementById("alert2").style="display:none";
                        }
                        function call_fun(){
                            document.getElementById("alert2").style="display:block";
                            document.getElementById("msg2").innerHTML="User already exist!";
                        }
                        call_fun();
                    </script>';
            }
            else
            {
                $sql1="insert into student_reg (rollno,fname,lname,gender,class,pno,email,pass,cpass) 
                values('".$rollno."','".$fname."','".$lname."','".$gender."',
                '".$class."','".$pno."','".$email."','".$pass."','".$cpass."')";
            
                if($connect->query($sql1))
                {
                    echo '<script>
                        function call_fun(){
                            document.getElementById("alert").style="display:block";
                            document.getElementById("msg1").innerHTML="Registered successfully!"
                        }
                        call_fun();
                    </script>';
                }
                else
                {
                    echo '<script>
                        function display_none()
                        {
                            document.getElementById("alert2").style="display:none";
                        }
                        function call_fun(){
                            document.getElementById("alert2").style="display:block";
                            document.getElementById("msg2").innerHTML="Error in inserting data!";
                        }
                        call_fun();
                    </script>';
                }

            }
        } 
    }
    if(isset($_POST['back'])){
        header('Location:sign.php');
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleregister.css">
    <title>Registration form</title>
    <style>
        .error{
            color:white;
        }
    </style>
</head>

<body>
    <div id="alert">
        <h1 style="color:white">All feilds are required!</h1>
        <button id="alert_btn" onclick=display_none()>Ok</button>
    </div>
    <div class="container">
        <form action="#" method="post">
            <fieldset>
                <legend style="font-size: 30px; color:white; width:auto; letter-spacing:2px">Student SignUp Form</legend>
                <div class="row">
                    <div class="col-75">
                        <input type="text" id="rollno" name="rollno" placeholder="Your rollno.." value="<?php echo $rollno ?>">
                        <span class="error"><?php echo $rollnoErr ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-75">
                        <input type="text" id="fname" name="firstname" placeholder="Your first name.." value="<?php echo $fname ?>">
                        <span class="error"><?php echo $fnameErr ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-75">
                        <input type="text" id="lname" name="lastname" placeholder="Your last name.." value="<?php echo $lname ?>">
                        <span class="error"><?php echo $lnameErr ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-75">
                        <select id="gender" name="gender">
                            <option value="gender">Gender</option>
                            <option value="Male" <?php if($gender=="Male")echo "selected" ?>>Male</option>
                            <option value="Female" <?php if($gender=="Female")echo "selected" ?>>Female</option>
                        </select>
                        <span class="error"><?php echo $genderErr ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-75">
                        <select id="department" name="class">
                            <option value="class">Class</option>
                            <option value="MBA" <?php if($class=="MBA")echo "selected" ?>>MBA</option>
                            <option value="MCA" <?php if($class=="MCA")echo "selected" ?>>MCA</option>
                            <option value="BCA" <?php if($depart=="BCA")echo "selected" ?>>BCA</option>
                            <option value="BBA" <?php if($depart=="BBA")echo "selected" ?>>BBA</option>
                        </select>
                        <span class="error"><?php echo $classErr ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-75">
                        <input type="number" id="num" name="num" placeholder="Enter your phone no.." value="<?php echo $pno ?>">
                        <span class="error"><?php echo $pnoErr ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-75">
                        <input type="email" id="email" name="email" placeholder="Enter your email.." value="<?php echo $email ?>">
                        <span class="error"><?php echo $emailErr ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-75">
                        <input type="password" id="pass" name="pass" placeholder="Enter your password.." value="<?php echo $pass ?>">
                        <span class="error"><?php echo $passErr ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-75">
                        <input type="password" id="cpass" name="cpass" placeholder="Enter your confirm password.." value="<?php echo $cpass ?>">
                        <span class="error"><?php echo $cpassErr ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-75">
                        <input type="submit" value="Submit" name="submit">
                        <input type="submit" name="back" value="Back">
                    </div>
                </div>
            </fieldset>    
        </form>
    </div>
</body>

</html>