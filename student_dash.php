<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/dashbord.css">
    <title>Student dashboard</title>
    <style>
        .uniform_imgs {
            position: relative;
            width: 600px;
            height: 500px;
            margin: 2% 0 0 38%;
        }

        .unifrom_img_frame {
            position: absolute;
            top: 0;
            left: 15%;
            width: 420px;
            height: 500px;
            background-color: pink;
            border-radius: 20px;
            border: 10px solid white;
        }

        .unifrom_img_frame_btn {
            width: 75px;
            height: 75px;
            border-radius: 100%;
            background-color: transparent;
            border: none;
        }

        .prev_btn {
            position: absolute;
            left: 0;
            top: 44%
        }

        .next_btn {
            position: absolute;
            left: 88%;
            top: 44%
        }

        .prev_btn_icon {
            font-size: 75px;
        }
    </style>
</head>

<body <!--header area start-->
    <header>

        <div class="left_area">
            <h3>
                <span>Student </span>Dashboard</h3>
        </div>
        <div class="right_area">
            <a href="sign.php" class="logout_btn">Logout</a>
        </div>
    </header>
    <!--header area end-->
    <!--sidebar start-->
    <div class="sidebar">
        <a class="active" href="student_dash.php"><i class="fa fa-home"></i><span>Home</span></a>
        <a href="student_feedback.php"><i class="fa fa-envelope"></i><span>Message</span></a>
        <a href="stu_uniform_status.php"><i class="fa fa-eye"></i><span>View Uniform Status</span></a>
        <a href="student_profile.php"><i class="fa fa-user"></i><span>Profile</span></a>
    </div>
    <div class="uniform_imgs">
        <button id="prev_btn" class="unifrom_img_frame_btn prev_btn" onclick="prev()"><i class="fa fa-chevron-circle-left prev_btn_icon" aria-hidden="true"></i></button>
        <div class="unifrom_img_frame">
            <img src="./img/tie_img1.jpg" id="frame" width="400px" height="480px">
        </div>
        <button id="next_btn" class="unifrom_img_frame_btn next_btn" onclick="next()"><i class="fa fa-chevron-circle-right prev_btn_icon" aria-hidden="true"></i></button>
    </div>
    <script>
        var imgArr = ["./img/tie_img2.jpg", "./img/tie_img3.jpg", "./img/tie_img4.jpg",
            "./img/shirt_img1.webp", "./img/shirt_img2.webp", "./img/shirt_img3.webp", "./img/pant_img1.jpg",
            "./img/coat_img1.jpg", "./img/coat_img3.jpg", "./img/tie_img1.jpg"
        ];
        var i = 0;

        function next() {
            document.getElementById('frame').src = imgArr[i];
            i++;
            if (i == 10) {
                i = 0;
            }
        }

        function prev() {
            document.getElementById('frame').src = imgArr[i];
            if (i == 0) {
                i = 10;
            }
            i--;
        }
    </script>
</body>

</html>