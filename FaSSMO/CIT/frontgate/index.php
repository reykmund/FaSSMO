<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FaSSMO - Faculty and Student System Monitoring Organizer</title>
    <link rel="stylesheet" href="../admin/w3.css">
</head>
<body class="w3-responsive">
    <div class="w3-center w3-light-gray">
        <div class="w3-xlarge" style="background-color: #555555;">
            <img src="../img/fassmo_logo.png" height="100px" width="100px">    
            <b><u>F</u></b>aculty <b><u>a</u></b>nd <b><u>S</u></b>tudent <b><u>S</u></b>ystem <b><u>M</u></b>onitoring <b><u>O</u></b>rganizer<br>
        </div>
        <h5 class="w3-serif" style="background-color:#197800;"><b>Welcome to<h4 class="w3-serif"><b>Mariano Marcos State University</b></h4>College of Industrial Technology</b></h5>
        <h6 class="w3-half">
            <?php
            echo "
            <html>
                <head>
                    <title>TIME</title>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <script src='../admin/jquery.js'></script>
                    <script>
                    $(document).ready(function(){
                        setInterval(_initTimer, 1000);
                    });
                    function _initTimer(){
                        $.ajax({
                            url:'../admin/timer.php',
                            success: function(data) {
                                console.log(data);
                                data = data.split(':');
                                $('#hrs').html(data[0]);
                                $('#mins').html(data[1]);
                                $('#secs').html(data[2]);}});}
                    </script>
                </head>
                <body>
                    <b><span id='hrs'>Loading</span>:<span id='mins'>Time</span>:<span id='secs'>Now</span></b>
                </body>
            </html>";
            ?>
        </h6>
        <h5 class="w3-half">
            No. of persons in the area: <b>####</b><br>
            Limited to <b><u>250</u></b> persons only.
        </h5>
        <div class="w3-panel">
            <div class="w3-white w3-round-large w3-center w3-padding-16">
            <?php
                if(isset($_POST["Vlogin"])){
                    $fullname = ucwords($_POST["fullname"]);
                    $purpose = strtoupper($_POST["purpose"]);
                    $indate = $_POST["indate"];
                    $intime = $_POST["intime"];
                    include "../admin/connect2db.php";
                    if(mysqli_connect_error()){
                        die('Connect Error('.mysqli_connect_error().')'.mysqli_connect_errno());}
                    else{
                        $INSERT = "INSERT INTO visitor_timein (fullname,purpose,indate,intime) VALUES(?,?,?,?)";
                        $krey = $conn->prepare($INSERT);
                        $krey->bind_param("ssss",$fullname,$purpose,$indate,$intime);
                        $krey->execute();
                        echo "<h1 class='w3-green w3-animate-zoom'>Time In Successful!</h1>";}
                    $krey->close();
                    $conn->close();
                }
            ?>
                <div><h2><b>Visitor Time In</b></h2><br><br><br><br><br><br></div>
                <div class="w3-display-container w3-margin">
                    <form class="w3-form w3-twothird w3-display-bottommiddle" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
                        <input name="fullname" required class="w3-input w3-margin-bottom w3-border w3-center" placeholder="Enter Full Name">
                        <input name="purpose" required class="w3-input w3-margin-bottom w3-border w3-center" placeholder="Purpose of Visit">
                        <input hidden type="text" name="indate" value="<?php date_default_timezone_set("Asia/Manila"); echo date('F d, Y');?>">
                        <input hidden type="text" name="intime" value="<?php date_default_timezone_set("Asia/Manila"); echo date('h:i:s A');?>">
                        <input type="submit" name="Vlogin" class="w3-button w3-green w3-round" value="Time In">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="w3-blue w3-container w3-center">
            <h6 class="w3-small w3-half">
            <b>2021 All Rights Reserved.</b><br>
            Produced and Developed by<br>
            <u class="w3-animate-fading">Hannah Angelica, Junry Rafael, and Kreymund.</u><br>
            !!! CIT RED LIONS !!!
            </h6>
            <h6 class="w3-small w3-half">
                <button class="w3-button">About this Website</button>
                <a class="w3-button" href="http://www.mmsu.edu.ph">MMSU Website</a>
                <a class="w3-button" href="#">MMSU Facebook Page</a><br>
                Designed for<br>MMSU College of Industrial Technology<br>
            </h6>
        </div>
</body>
</html>