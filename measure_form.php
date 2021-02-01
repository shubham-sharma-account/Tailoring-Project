<?php
    session_start();
?>
<?php
    error_reporting(0);
    include('connect.php');
    echo "<div id='alert'><h1 id='msg1'></h1><h2>**Click OK to go on Add Order**</h2>
    <a href='take_measure.php'><button id='alert_btn'>OK</button></a></div>";
    echo "<div id='alert2'><h1 id='msg2'></h1><h2>**Please try again**</h2>
    <button id='try_agn' onclick='display_none()'>Try again!</button></div>";
    $rollno=$_POST['rollno'];
    $class=$_POST['class'];
    $fname=$_POST['firstname'];
    $lname=$_POST['lastname'];
    $pno=$_POST['num'];
    $email=$_POST['email'];
    $chest=$_POST['chest'];
    $waist=$_POST['waist'];
    $sleeve=$_POST['sleeve'];
    $sholder=$_POST['sholder'];
    $neck=$_POST['neck'];
    $shirt=$_POST['shirt'];
    $hip=$_POST['hip'];
    $thigh=$_POST['thigh'];
    $outseam=$_POST['outseam'];
    $inseam=$_POST['inseam'];
    $length=$_POST['length'];
    $pnolength=strlen($pno);
    if (isset($_POST['submit'])){
        if (empty($rollno)){
            $rollnoErr = "*Rollno is required";
        }else if($class=="class"){
            $classErr="*Please select your class";
        }else if (empty($fname)){
            $fnameErr = "*First Name is required";
        }else if(!preg_match("/^[a-zA-Z ]*$/", $fname)){
            $fnameErr = "*Only letters and white space allowed";
        }else if(empty($lname)) {
            $lnameErr = "*Last Name is required";
        }else if (!preg_match("/^[a-zA-Z ]*$/", $lname)) {
            $lnameErr = "*Only letters and white space allowed";
        }else if(empty($pno)){
            $pnoErr ="*Phone number is required";
        }else if(!preg_match("/^[1-9][0-9]*$/", $pno)){
            $pnoErr="*Invalid number";
        }else if($pnolength != 10){
            $pnoErr="*The length of number must be 10";
        }else if(empty($email)){
            $emailErr="*Email is required";  
        }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "*Invalid email format";  
        }else if (empty($chest)){
            $emptyErr1 = "*This feild is required";
        }else if (empty($waist)){
            $emptyErr2 = "*This feild is required";
        }else if (empty($sleeve)){
            $emptyErr3 = "*This feild is required";
        }else if (empty($sholder)){
            $emptyErr4 = "*This feild is required";
        }else if (empty($neck)){
            $emptyErr5 = "*This feild is required";
        }else if (empty($shirt)){
            $emptyErr6 = "*This feild is required";
        }else if (empty($hip)){
            $emptyErr7 = "*This feild is required";
        }else if (empty($thigh)){
            $emptyErr8 = "*This feild is required";
        }else if (empty($outseam)){
            $emptyErr9 = "*This feild is required";
        }else if (empty($inseam)){
            $emptyErr10 = "*This feild is required";
        }else if (empty($length)){
            $emptyErr11 = "*This feild is required";
        }
        else{
            $sql="select * from measure_data where pno=$pno or email='$email'";
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
                $sql1="insert into measure_data (rollno,class,fname,lname,pno,email,chest,waist,sleeve,sholder,neck,shirt_len,hips,thigh,outseam,inseam,pant_len,status) 
                values('".$rollno."','".$class."','".$fname."','".$lname."','".$pno."','".$email."','".$chest."','".$waist."','".$sleeve."','".$sholder."','".$neck."','".$shirt."','".$hip."','".$thigh."','".$outseam."','".$inseam."','".$length."','"."Incomplete"."')";
                if($connect->query($sql1))
                {
                    echo '<script>
                        function call_fun(){
                            document.getElementById("alert").style="display:block";
                            document.getElementById("msg1").innerHTML="Measurement is registered!";
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
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="./css/styleregister.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Measurement Form</title>
    <style>
    .measure_form{
        width:90%;
        margin:auto;    
    }.stu_info{
        width:35%;
        margin-left:3%;
        float:left;
    }.measure_feilds{
        width:55%;
        margin-left:5%;
        float:left;
    }.form_heading{
        color:white;
        margin-left:5%; 
        font-size:30px;
    }
    </style>
</head>

<body>
    <div class="measure_form">
        <form method="post">
            <fieldset>
                <legend style="font-size: 30px; color:white; width:auto; letter-spacing:2px">Measurement Form</legend>
                <div class="stu_info">
                    <lable class="form_heading">Student Information</lable>
                    <div class="row">
                        <div class="col-75">
                            <input type="text" id="rollno" name="rollno" placeholder="Rollno.." value="<?php echo $_SESSION['rollno']; ?>">
                            <span class="error"><?php echo $rollnoErr ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-75">
                        <input type="text" id="class" name="class" placeholder="Class.." value="<?php echo $_SESSION['class']; ?>">
                            <span class="error"><?php echo $classErr ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-75">
                            <input type="text" id="fname" name="firstname" placeholder="First Name.." value="<?php   echo $_SESSION['fname']; ?>">
                            <span class="error"><?php echo $fnameErr ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-75">
                            <input type="text" id="lname" name="lastname" placeholder="Last Name.." value="<?php   echo $_SESSION['lname']; ?>">
                            <span class="error"><?php echo $lnameErr ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-75">
                            <input type="number" id="num" name="num" placeholder="Phone no.." value="<?php   echo $_SESSION['pno']; ?>">
                            <span class="error"><?php echo $pnoErr ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-75">
                            <input type="email" id="email" name="email" placeholder="Email.." value="<?php   echo $_SESSION['email']; ?>">
                            <span class="error"><?php echo $emailErr ?></span>
                        </div>
                    </div>
                </div>
                <div class="measure_feilds">
                    <div class="row">
                        <lable class="form_heading">---------------------------Upper Body--------------------------</lable>
                        <div class="col-75">
                            <input type="text" id="chest" name="chest" placeholder="Chest circumference.." value="<?php echo $chest ?>">
                            <span class="error"><?php echo $emptyErr1 ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-75">
                            <input type="text" id="waist" name="waist" placeholder="Waist circumference.." value="<?php echo $waist ?>">
                            <span class="error"><?php echo $emptyErr2 ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-75">
                            <input type="text" id="seleve" name="sleeve" placeholder="Sleeve length.." value="<?php echo $sleeve ?>">
                            <span class="error"><?php echo $emptyErr3 ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-75">
                            <input type="text" id="sholder" name="sholder" placeholder="Sholder length.." value="<?php echo $sholder ?>">
                            <span class="error"><?php echo $emptyErr4 ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-75">
                            <input type="text" id="neck" name="neck" placeholder="Neck size.." value="<?php echo $neck ?>">
                            <span class="error"><?php echo $emptyErr5 ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-75">
                            <input type="text" id="shirt" name="shirt" placeholder="Shirt length.." value="<?php echo $shirt ?>">
                            <span class="error"><?php echo $emptyErr6 ?></span>
                        </div>
                    </div>
                    <div class="row">
                    <lable class="form_heading">---------------------------Lower Body--------------------------</lable>
                        <div class="col-75">
                            <input type="text" id="hip" name="hip" placeholder="Hips circumference.." value="<?php echo $hip ?>">
                            <span class="error"><?php echo $emptyErr7 ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-75">
                            <input type="text" id="thigh" name="thigh" placeholder="Thigh circumference.." value="<?php echo $thigh ?>">
                            <span class="error"><?php echo $emptyErr8 ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-75">
                            <input type="text" id="outseam" name="outseam" placeholder="Outseam " value="<?php echo $outseam ?>">
                            <span class="error"><?php echo $emptyErr9 ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-75">
                            <input type="text" id="inseam " name="inseam" placeholder="inseam.." value="<?php echo $inseam ?>">
                            <span class="error"><?php echo $emptyErr10 ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-75">
                            <input type="text" id="length" name="length" placeholder="Full length.." value="<?php echo $length ?>">
                            <span class="error"><?php echo $emptyErr11 ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-75">
                            <input type="submit" name="submit" value="Register">
                            <input type="submit" name="cancel" value="Cancel">
                            <a href="tailor_dash.php"><input type="button" name="back" value="Goto dashboard"></a>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</body>

</html>