<?php
   ob_start();
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="OnlineAttendance/img/fassmo_black.png" type="image/png">
	<link rel="stylesheet" href="OnlineAttendance/css/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    @media only screen and (min-width: 1080px) {body {background-image: url('OnlineAttendance/img/MMSU_bg.jpg'); background-size: cover; background-repeat:no-repeat;}}
    </style>
    <title>FaSSMO - for MMSU-CIT</title>
</head>
<body class="w3-responsive w3-content w3-white">
    <a href="http://mmsu.edu.ph"><img class="w3-left w3-margin w3-circle" src="OnlineAttendance/img/mmsu-logo.png" height="40px" width="40px"></a>
    <a href="http://cit.mmsu.edu.ph"><img class="w3-right w3-margin w3-circle" src="OnlineAttendance/img/cit-logo.png" height="40px" width="45px"></a>
    <h3 class="w3-header w3-center w3-padding w3-serif w3-text-white" style="background-color:#197800; text-shadow:2px 2px 0 #528;"><b>Mariano Marcos State University</b></h3>
	<div class="w3-panel w3-center w3-round w3-padding">
		<h3 class="w3-yellow w3-round"><b class="w3-xlarge">College of Industrial Technology<br>FaSSMO</b><br>Faculty and Student System Monitoring Organizer</h3>
        <?php
        if (isset($_POST['faculty_in'])) {
            if (empty($_POST['datein']) || empty($_POST['timein']) || empty($_POST['idnumber'])){
                echo "<b>Incomplete DATA!<br><a class='w3-button w3-red' href='index.php'>Go Back</a>"; die();}
            else if (!empty($_POST['idnumber']) && !empty($_POST['datein']) && !empty($_POST['timein'])) {
                $idnumber = $_POST['idnumber'];
                $datein = $_POST['datein'];
                $timein = $_POST['timein'];
                include "OnlineAttendance/connect2db.php";
                if (mysqli_connect_error()) {
                    die('Connect Error('.mysqli_connect_error().')'.mysqli_connect_errno());}
                else {
                    $SELECT = "SELECT idnumber FROM faculty WHERE idnumber = ? LIMIT 1";
                    $INSERT = "INSERT INTO faculty_timein (idnumber,timein,datein) VALUES(?,?,?)";
                    $krey = $conn->prepare($SELECT);
                    $krey->bind_param("s",$idnumber);
                    $krey->execute();
                    $krey->bind_result($idnumber);
                    $krey->store_result();
                    $mund = $krey->num_rows;
                    if($mund == 1){
                        $krey->close();
                        $krey = $conn->prepare($INSERT);
                        $krey->bind_param("sss",$idnumber,$timein,$datein);
                        $krey->execute();
                        echo "<h1 class='w3-green w3-animate-zoom'>Time In Successful!</h1>";}
                    else {echo "<h1 class='w3-red w3-animate-zoom'>ID Number Not Found!</h1>";}
                    $krey->close();
                    $conn->close();}}}
        else if (isset($_POST['faculty_out'])) {
            $idnumber = $_POST['idnumber'];
            $dateout = $_POST['dateout'];
            $outtime = $_POST['outtime'];
            if(!empty($idnumber) || !empty($dateout) || !empty($outtime)){
                include "OnlineAttendance/connect2db.php";
                if (mysqli_connect_error()) {die('Connect Error('.mysqli_connect_error().')'.mysqli_connect_error());}
                else {
                    $SELECT = "SELECT idnumber FROM faculty WHERE idnumber = ? LIMIT 1";
                    $INSERT = "INSERT INTO faculty_timeout (idnumber,dateout,outtime) VALUES(?,?,?)";
                    $krey = $conn->prepare($SELECT);
                    $krey->bind_param("s",$idnumber);
                    $krey->execute();
                    $krey->bind_result($idnumber);
                    $krey->store_result();
                    $mund = $krey->num_rows;
                    if($mund == 1){
                        $krey->close();
                        $krey = $conn->prepare($INSERT);
                        $krey->bind_param("sss",$idnumber,$dateout,$outtime);
                        $krey->execute();
                        echo "<h1 class='w3-white w3-animate-zoom'>Successfully Timed Out</h1>";}
                    else {echo "<h1 class='w3-red w3-animate-zoom'>ID Number Not Found!</h1>";}
                    $krey->close();
                    $conn->close();}}
            else {echo "Incomplete DATA!"; die();}}
        else if (isset($_POST['adminLogin'])) {
            $username = "admin";
            $password = sha1("nimda");
            if($_POST['username'] == $username && sha1($_POST['password']) == $password){
                echo '<h1 class="w3-green"><i class="material-icons w3-xxxlarge w3-center">spellcheck</i><br><b>Login Successful!<br>Proceeding to dashboard...<br><i class="material-icons w3-xxxlarge w3-spin">loop</i></h1>';
                echo '<audio autoplay><source src="OnlineAttendance/null.wav" type="audio/wav"></audio>';
                header("refresh:3;url=dashboard.php");
                //echo '<script>window.location.href="dashboard.php"</script>';
            }
            else{
                echo '<h1><i class="material-icons w3-xxxlarge">warning</i><br><b>Login Failed!<br>Incorrect Username and/or Password<br></b>Returning Back...<br><i class="material-icons w3-xxxlarge w3-spin">loop</i></h1>';
                header("refresh:2;url=index.php");
                /*echo '<script>alert("Incorrect Username and/or Password!");</script>';
                echo '<script>window.location.href="../index.php"</script>';*/}}
        else if (isset($_POST['Vtimein'])) {
            if (empty($_POST['datein']) || empty($_POST['timein']) || empty($_POST['fullname']) || empty($_POST['purpose'])){
                echo "<b>Incomplete DATA!<br><a class='w3-button w3-red' href='index.php'>Go Back</a>"; die();}
            else if (!empty($_POST['fullname']) && !empty($_POST['datein']) && !empty($_POST['timein']) && !empty($_POST['purpose'])) {
                $fullname = ucwords($_POST['fullname']);
                $datein = $_POST['datein'];
                $timein = $_POST['timein'];
                $purpose = $_POST['purpose'];
                include "OnlineAttendance/connect2db.php";
                if (mysqli_connect_error()) {
                    die('Connect Error('.mysqli_connect_error().')'.mysqli_connect_errno());}
                else {
                    $INSERT = "INSERT INTO visitor_log (fullname,purpose,datein,timein) VALUES(?,?,?,?)";
                    $krey = $conn->prepare($INSERT);
                    $krey->bind_param("ssss",$fullname,$purpose,$datein,$timein);
                    $krey->execute();
                    echo "<h1 class='w3-green w3-animate-zoom'>Time In Successful!</h1>";}
                    $conn->close();}}
        ?>
        <div class="w3-half w3-light-gray w3-margin-right w3-margin-top w3-margin-bottom w3-round">
            <h3 id="digiclock" class="w3-medium w3-animate-zoom">
                <?php
                echo "
                <html>
                    <head>
                        <title>TIME</title>
                        <meta charset='UTF-8'>
                        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                        <script src='OnlineAttendance/js/jquery.js'></script>
                        <script>
                        $(document).ready(function(){
                            setInterval(_initTimer, 1000);
                        });
                        function _initTimer(){
                            $.ajax({
                                url: 'OnlineAttendance/timer.php',
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
            </h3>
        </div>
        <button class="w3-button w3-large w3-orange w3-hover-shadow w3-center w3-margin-4 w3-round" onclick="document.getElementById('bisita').style.display='block'">
        <i class="material-icons w3-jumbo">people</i><br>Visitor</button>
        <button class="w3-button w3-large w3-blue w3-hover-shadow w3-center w3-margin-4 w3-round" onclick="document.getElementById('guro').style.display='block'">
        <i class="material-icons w3-jumbo">account_box</i><br>Faculty</button>
        <a href="OnlineAttendance/index.php" class="w3-button w3-large w3-green w3-hover-shadow w3-center w3-margin-4 w3-round">
        <i class="material-icons w3-jumbo">person</i><br>Student</a>
        <div id="bisita" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-left w3-blue w3-round" style="max-width:600px">
                <div class="w3-center"><br>
                    <span onclick="document.getElementById('bisita').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-hover-shadow w3-display-topright" title="Close">&times;</span>
                </div>
                <h2>Visitor Time In</h2>
                <form class="w3-panel w3-margin w3-padding" action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                    <input hidden type="text" name="datein" value="<?php date_default_timezone_set("Asia/Manila"); echo date('F d, Y');?>">
                    <input hidden type="text" name="timein" value="<?php date_default_timezone_set("Asia/Manila"); echo date('h:i:s A');?>">
                    <input required class="w3-animate-input w3-input w3-left w3-round w3-margin-bottom" style="width: 40%;" type="text" name="fullname" id="fullname" placeholder="Full Name" autocomplete="off">
                    <br><br><br>
                    <input required class="w3-animate-input w3-input w3-left w3-round w3-margin-bottom" style="width: 40%;" type="text" name="purpose" id="purpose" placeholder="Purpose">
                    <br><br><br>
                    <input type="submit" name="Vtimein" class="w3-button w3-yellow w3-left w3-round-large w3-margin-top w3-hover-green w3-hover-shadow" value="Time In">
                </form>
                <div class="w3-container w3-border-top w3-padding-16 w3-light-gray">
                    <button onclick="document.getElementById('bisita').style.display='none'" type="button" class="w3-button w3-red w3-hover-shadow">Cancel</button>
                </div>
            </div>
        </div>
        <div id="guro" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-top w3-amber w3-round" style="max-width:600px">
                <div class="w3-center"><br>
                    <span onclick="document.getElementById('guro').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-hover-shadow w3-display-topright" title="Close">&times;</span>
                </div>
                <button class="w3-button w3-green w3-hover-blue w3-hover-shadow w3-center w3-margin w3-round" onclick="document.getElementById('guro').style.display='none'; document.getElementById('in').style.display='block'">
                <i class="material-icons">alarm_on</i><br>Time In</button>
                <button class="w3-button w3-red w3-hover-blue w3-hover-shadow w3-center w3-margin w3-round" onclick="document.getElementById('guro').style.display='none'; document.getElementById('out').style.display='block'">
                <i class="material-icons">alarm_off</i><br>Time Out</button>
                <div class="w3-container w3-border-top w3-padding-16 w3-light-gray">
                    <button onclick="document.getElementById('guro').style.display='none'" type="button" class="w3-button w3-red w3-hover-shadow">Cancel</button>
                </div>
            </div>
        </div>
        <div id="in" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-left w3-green w3-round" style="max-width:600px">
                <div class="w3-center"><br>
                    <span onclick="document.getElementById('in').style.display='none'; document.getElementById('guro').style.display='block'" class="w3-button w3-xlarge w3-hover-red w3-hover-shadow w3-display-topright" title="Close">&times;</span>
                </div>
                <h2>Faculty Time In</h2>
                <form class="w3-panel w3-margin w3-padding" action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                    <input required autofocus class="w3-animate-input w3-input w3-left w3-round w3-margin-bottom" style="width: 40%;" type="text" name="idnumber" id="idnumber" placeholder="ID Number" autocomplete="off">
                    <input hidden type="text" name="datein" value="<?php date_default_timezone_set("Asia/Manila"); echo date('Y-m-d');?>">
                    <input hidden type="text" name="timein" value="<?php date_default_timezone_set("Asia/Manila"); echo date('h:i:s A');?>">
                    <br><br><br>
                    <input type="submit" name="faculty_in" class="w3-button w3-yellow w3-left w3-round-large w3-margin-top w3-hover-green w3-hover-shadow" value="Time In">
                </form>
                <div class="w3-container w3-border-top w3-padding-16 w3-light-gray">
                    <button onclick="document.getElementById('in').style.display='none'; document.getElementById('guro').style.display='block'" type="button" class="w3-button w3-red w3-hover-shadow">Cancel</button>
                </div>
            </div>
        </div>
        <div id="out" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-right w3-red w3-round" style="max-width:600px">
                <div class="w3-center"><br>
                    <span onclick="document.getElementById('out').style.display='none'; document.getElementById('guro').style.display='block'" class="w3-button w3-xlarge w3-hover-red w3-hover-shadow w3-display-topright" title="Close">&times;</span>
                </div>
                <h2><b>Faculty Time Out</b></h2>
                <form class="w3-panel w3-margin w3-padding" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                    <input required autofocus class="w3-animate-input w3-input w3-left w3-round w3-margin-bottom" style="width: 40%;" type="text" name="idnumber" id="idnumber" placeholder="ID Number" autocomplete="off">                                                   
                    <input hidden type="text" name="dateout" value="<?php date_default_timezone_set("Asia/Manila"); echo date('F d, Y');?>">
                    <input hidden type="text" name="outtime" value="<?php date_default_timezone_set("Asia/Manila"); echo date('h:i:s A');?>">
                    <br><br><br>
                    <input type="submit" name="faculty_out" value="Time Out" class="w3-button w3-orange w3-left w3-round w3-margin-top w3-hover-blue w3-hover-shadow">
                </form>
                <div class="w3-container w3-border-top w3-padding-16 w3-light-gray">
                    <button onclick="document.getElementById('out').style.display='none'; document.getElementById('guro').style.display='block'" type="button" class="w3-button w3-red w3-hover-shadow">Cancel</button>
                </div>
            </div>
        </div>
        <div id="admin" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-bottom w3-blue w3-round" style="max-width:600px">
                <div class="w3-center"><br>
                    <span onclick="document.getElementById('admin').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-hover-shadow w3-display-topright" title="Close">&times;</span>
                </div>
                <h2>Administrator Login</h2>
                <form class="w3-panel w3-margin w3-padding" action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                    <div>
                        <label class="w3-label w3-left">Username</label><br>
                        <input required class="w3-animate-input w3-input w3-left w3-round w3-margin-bottom" style="width: 40%;" type="text" name="username" id="username" placeholder="Enter Username" autocomplete="off">
                    </div>
                    <br><br><br>
                    <div>
                        <label class="w3-label w3-left">Password</label><br>
                        <input required class="w3-animate-input w3-input w3-left w3-round w3-margin-bottom" style="width: 40%;" type="password" name="password" id="password" placeholder="Enter Password">
                    </div>
                    <br><br><br>
                    <div>
                        <input type="submit" name="adminLogin" class="w3-button w3-yellow w3-left w3-round-large w3-margin-top w3-hover-green w3-hover-shadow" value="Log In">
                    </div>
                </form>
                <div class="w3-container w3-border-top w3-padding-16 w3-light-gray">
                    <button onclick="document.getElementById('admin').style.display='none'" type="button" class="w3-button w3-red w3-hover-shadow">Cancel</button>
                </div>
            </div>
        </div>
        <div id="about" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom w3-round-large" style="max-width:600px; background-color:#197800;">
                <div class="w3-center"><br>
                    <span onclick="document.getElementById('about').style.display='none'" class="w3-button w3-medium w3-hover-red w3-hover-shadow w3-display-topright" title="Close">&times;</span>
                </div><br>
                <div class="w3-yellow">
                <strong class="w3-xxlarge">ABOUT</strong><br>
                </div>
                <h3 class="w3-padding-32 w3-margin">This website application is made possible as a fulfillment project to the course "Capstone Project", course code: CMPT197
                under Mr. Elmer Blanco, with the utmost guidance of Mr. Christian Jade Guillen.<br>Created by Kreymund Galacgac, with the help of Hannah Angelica Cac and Junry Rafael Reyes,
                this online attendance system can be of future use as an attendance system for the students and faculty staff of MMSU College of Industrial Technology.
                This online attendance system can be revised, further expand and add more functionalities.
                <br><strong>To God Be All The Glory.</strong><br>
                <h6>Sic Parvis Magna</h6>
                </h3>
            </div>
        </div>
	</div>
    <div class="w3-light-gray w3-opacity w3-round-xxlarge">
    <footer class="w3-content w3-padding-32 w3-text-black w3-xlarge w3-margin">
    <!--<i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>-->
    <h6 class="w3-small w3-half">
        <b>2021 All Rights Reserved.</b><br>
        <span class="w3-text-red">!!! CIT RED LIONS !!!</span>
        <button id="admbtn" style="display: none;" class="w3-button w3-medium w3-red w3-hover-blue w3-hover-shadow w3-animate-right w3-round" onclick="document.getElementById('admin').style.display='block'">
        <i class="material-icons w3-large w3-spin">settings</i><br><small>Administrator</small></button>
    </h6>
    <h6 class="w3-small w3-half">
        <button class="w3-button" onclick="document.getElementById('about').style.display='block'">About this Website</button>
        <a class="w3-button w3-hover-green" onclick='window.open("https://www.mmsu.edu.ph","_blank")'><i class="fa fa-globe w3-hover-opacity w3-large"></i> MMSU Website</a>
        <a class="w3-button w3-hover-blue" onclick="window.open('https://www.facebook.com/MMSUofficial','_blank')"><i class="fa fa-facebook-official w3-hover-opacity w3-large"></i> MMSU Facebook Page</a><br>
        Designed for<br>MMSU College of Industrial Technology<br>
    </h6>
    <p class="w3-medium">Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank" class="w3-hover-text-green">w3.css</a></p>
  <!-- End footer -->
  </footer></div>
  <small><button class="w3-content w3-animate-fading w3-btn w3-center w3-bottom w3-text-black">Produced and Developed by <span onclick="w3.toggleShow('#admbtn')">Kreymund</span></button></small>
</body>
<script src="OnlineAttendance/js/w3.js"></script>
</html>
