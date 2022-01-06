<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/fassmo_black.png" type="image/png">
	<link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    @media only screen and (min-width: 1080px) {body {background-image: url('img/MMSU_bg.jpg'); background-size: cover; background-repeat:no-repeat;}}
    </style>
    <title>Computer Technology 3B Online Attendance</title>
</head>
<body class="w3-responsive w3-content">
    <a href="http://mmsu.edu.ph"><img class="w3-left w3-margin w3-circle" src="img/mmsu-logo.png" height="40px" width="40px"></a>
    <a href="http://cit.mmsu.edu.ph"><img class="w3-right w3-margin w3-circle" src="img/cit-logo.png" height="40px" width="45px"></a>
    <h3 class="w3-header w3-center w3-padding w3-serif w3-text-white" style="text-shadow:2px 2px 0 #528; background-color:#197800;"><b>Mariano Marcos State University</b></h3>
	<div class="w3-panel w3-center w3-round w3-margin w3-padding">
        <nav class="w3-panel w3-text-black w3-medium">
        <button id="admbtn" style="display: none;" class="w3-button w3-right w3-red w3-hover-blue w3-hover-shadow w3-round w3-animate-right" onclick="document.getElementById('admin').style.display='block'">
        <i class="material-icons w3-xlarge w3-spin">settings</i><br><small>admin</small></button>
        <button class="w3-button w3-right w3-hover-blue w3-hover-shadow" onclick="document.getElementById('about').style.display='block'">
        <i class="material-icons w3-xlarge">info</i><br><small>About</small></button>
        <a class="w3-button w3-left w3-hover-green w3-hover-shadow" href="../index.php">
        <i class="material-icons w3-xlarge">home</i><br><small>Home</small></a>
        </nav>
		<h2 class="w3-yellow w3-round-large"><b class="w3-xlarge">College of Industrial Technology</b><br>Student Online Attendance</h2>
        <?php
        if (isset($_POST['intime'])) {
            if (empty($_POST['datein']) || empty($_POST['timein']) || empty($_POST['PCNum']) || empty($_POST['subj']) || empty($_POST['teacher']) || empty($_POST['room'])){
                echo "<b>Incomplete DATA!<br><a class='w3-button w3-red' href='index.php'>Go Back</a>"; die();}
            else if (!empty($_POST['studID']) && !empty($_POST['datein']) && !empty($_POST['timein']) && !empty($_POST['PCNum']) && !empty($_POST['subj']) && !empty($_POST['room'])) {
                $studID = $_POST['studID'];
                $datein = $_POST['datein'];
                $timein = $_POST['timein'];
                $pcnum = $_POST['PCNum'];
                $subj = strtoupper($_POST['subj']);
                $teacher = $_POST['teacher'];
                $room = $_POST['room'];
                include "connect2db.php";
                if (mysqli_connect_error()) {
                    die('Connect Error('.mysqli_connect_error().')'.mysqli_connect_errno());}
                else {
                    if ($pcnum == "more") {$pcnum = $_POST['numpc'];}
                    if ($subj == "more") {$subj = $_POST['Osub'];}
                    if ($teacher == "others") {$teacher = ucwords($_POST['Oteacher']);}
                    if ($room == "acad") {$room = $_POST['ab'];}
                    else if ($room == "tech") {$room = $_POST['tb'];}
                    $SELECT = "SELECT studID FROM students WHERE studID = ? LIMIT 1";
                    $INSERT = "INSERT INTO timeincmpt (studID,datein,timein,PCNum,subj,teacher,room) VALUES(?,?,?,?,?,?,?)";
                    $krey = $conn->prepare($SELECT);
                    $krey->bind_param("s",$studID);
                    $krey->execute();
                    $krey->bind_result($studID);
                    $krey->store_result();
                    $mund = $krey->num_rows;
                    if($mund == 1){
                        $krey->close();
                        $krey = $conn->prepare($INSERT);
                        $krey->bind_param("sssssss",$studID,$datein,$timein,$pcnum,$subj,$teacher,$room);
                        $krey->execute();
                        echo "<h1 class='w3-green w3-animate-zoom'>Time In Successful!</h1>";}
                    else {echo "<h1 class='w3-red w3-animate-zoom'>Student Number Not Found!</h1>";}
                    $krey->close();
                    $conn->close();}}}
        else if (isset($_POST['timeout'])) {
            $studID = $_POST['studID'];
            //$subj = strtoupper($_POST['subj']);
            $dateout = $_POST['dateout'];
            $outtime = $_POST['outtime'];
            $outdate = $_POST['outdate'];
            if(!empty($studID) || !empty($dateout) || !empty($outtime)){
                include "connect2db.php";
                if (mysqli_connect_error()) {die('Connect Error('.mysqli_connect_error().')'.mysqli_connect_error());}
                else {
                    $SELECT = "SELECT studID FROM students WHERE studID = ? LIMIT 1";
                    $krey = $conn->prepare($SELECT);
                    $krey->bind_param("s",$studID);
                    $krey->execute();
                    $krey->bind_result($studID);
                    $krey->store_result();
                    $mund = $krey->num_rows;
                    if($mund == 1){
                        $krey->close();
                        $SELECT = "SELECT studID,subj,datein FROM timeincmpt WHERE studID = ? AND subj = ? AND datein = ? LIMIT 1";
                        $krey = $conn->prepare($SELECT);
                        $krey->bind_param("sss",$studID,$subj,$outdate);
                        $krey->execute();
                        $krey->bind_result($studID,$subj,$outdate);
                        $krey->store_result();
                        $mund = $krey->num_rows;
                        if($mund == 1){
                            $INSERT = "INSERT INTO timeoutcmpt (studID,dateout,outtime,outdate) VALUES(?,?,?,?)";
                            $krey = $conn->prepare($INSERT);
                            $krey->bind_param("ssss",$studID,$dateout,$outtime,$outdate);
                            $krey->execute();
                            echo "<h1 class='w3-white w3-animate-zoom'>Successfully Timed Out</h1>"; #}
                            $krey->close();
                            $conn->close();}
                        else{echo "<h1 class='w3-red w3-animate-zoom'>Not Currently Timed In!</h1>";}}}}
                else {echo "<h1 class='w3-red w3-animate-zoom'>Student Number Not Found!</h1>"; die();}}
        else if (isset($_POST['adminLogin'])) {
            $username = "admin";
            $password = sha1("nimda");
            if($_POST['username'] == $username && sha1($_POST['password']) == $password){
                echo '<h1><i class="material-icons w3-xxxlarge w3-center">spellcheck</i><br><b>Login Successful!<br>Proceeding to dashboard...<br><i class="material-icons w3-xxxlarge w3-spin">loop</i></h1>';
                //echo '<audio autoplay><source src="null.wav" type="audio/wav"></audio>';
                header("refresh:3;url=admin/dashboard.php");
                //echo '<script>window.location.href="dashboard.php"</script>';
            }
            else{
                echo '<h1><i class="material-icons w3-xxxlarge">warning</i><br><b>Login Failed!<br>Incorrect Username and/or Password<br></b>Returning Back...<br><i class="material-icons w3-xxxlarge w3-spin">loop</i></h1>';
                header("refresh:2;url=index.php");
                /*echo '<script>alert("Incorrect Username and/or Password!");</script>';
                echo '<script>window.location.href="../index.php"</script>';*/}}
        else if (isset($_POST['teacherLogin'])) {
            $user = $_POST['username'];
            $pass = sha1($_POST['password']);
            include "connect2db.php";
            $Tselect = "SELECT * FROM teacherscmpt WHERE user = '$user' AND pass = '$pass'";
            $Tvalid = $conn->prepare($Tselect);
            $Tvalid->execute();
            $Tvalid->store_result();
            $check = $Tvalid->num_rows;
            if($check == 1){
                echo '<h1><i class="material-icons w3-xxxlarge w3-center">spellcheck</i><br><b>Login Successful!<br>Proceeding to dashboard...<br><i class="material-icons w3-xxxlarge w3-spin">loop</i></b></h1>';
                //echo '<audio autoplay><source src="null.wav" type="audio/wav"></audio>';
                header("refresh:3;url=admin/Tdashboard.php");}
            else{
                echo '<h1><i class="material-icons w3-xxxlarge">warning</i><br><b>Login Failed!<br>Incorrect Username and/or Password<br></b>Returning Back...<br><i class="material-icons w3-xxxlarge w3-spin">loop</i></b></h1>';
                header("refresh:2;url=index.php");}}
        ?>
        <div class="w3-half w3-light-gray w3-margin-right w3-margin-top w3-round">
        <h2 id="digiclock" class="w3-large w3-animate-zoom"><?php
            echo "
            <html>
                <head>
                    <title>TIME</title>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <script src='js/jquery.js'></script>
                    <script>
                    $(document).ready(function(){
                        setInterval(_initTimer, 1000);
                    });
                    function _initTimer(){
                        $.ajax({
                            url: 'timer.php',
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
        </h2></div>
        <button class="w3-button w3-large w3-blue w3-hover-shadow w3-center w3-margin w3-round" onclick="document.getElementById('guro').style.display='block'">
        <i class="material-icons w3-jumbo">account_box</i><br>Teacher</button>
        <div id="guro" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-left w3-blue w3-round" style="max-width:600px">
                <div class="w3-center"><br>
                    <span onclick="document.getElementById('guro').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-hover-shadow w3-display-topright" title="Close">&times;</span>
                </div>
                <h2>Teacher Login</h2>
                <form class="w3-panel w3-margin w3-padding" action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                    <input required class="w3-animate-input w3-input w3-left w3-round w3-margin-bottom" style="width: 40%;" type="text" name="username" id="username" placeholder="Username" autocomplete="off">
                    <br><br><br>
                    <input required class="w3-animate-input w3-input w3-left w3-round w3-margin-bottom" style="width: 40%;" type="password" name="password" id="password" placeholder="Password">
                    <br><br><br>
                    <input type="submit" name="teacherLogin" class="w3-button w3-yellow w3-left w3-round-large w3-margin-top w3-hover-green w3-hover-shadow" value="Log In">
                </form>
                <div class="w3-container w3-border-top w3-padding-16 w3-light-gray">
                    <button onclick="document.getElementById('guro').style.display='none'" type="button" class="w3-button w3-red w3-hover-shadow">Cancel</button>
                </div>
            </div>
        </div>
        <button class="w3-button w3-large w3-green w3-hover-shadow w3-center w3-margin w3-round" onclick="document.getElementById('estudyante').style.display='block'">
        <i class="material-icons w3-jumbo">person</i><br>Student</button>
        <div id="estudyante" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-right w3-amber w3-round" style="max-width:600px">
                <div class="w3-center">
                    <span onclick="document.getElementById('estudyante').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-hover-shadow w3-display-topright" title="Close">&times;</span>
                </div>
                <button class="w3-button w3-green w3-hover-blue w3-hover-shadow w3-center w3-margin w3-round" onclick="document.getElementById('estudyante').style.display='none'; document.getElementById('in').style.display='block'">
                <i class="material-icons">alarm_on</i><br>Time In</button>
                <button class="w3-button w3-red w3-hover-blue w3-hover-shadow w3-center w3-margin w3-round" onclick="document.getElementById('estudyante').style.display='none'; document.getElementById('out').style.display='block'">
                <i class="material-icons">alarm_off</i><br>Time Out</button>
                <div class="w3-container w3-border-top w3-padding-16 w3-light-gray">
                    <button onclick="document.getElementById('estudyante').style.display='none'" type="button" class="w3-button w3-red w3-hover-shadow">Cancel</button>
                </div>
            </div>
        </div>
        <div id="in" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-left w3-green w3-round" style="max-width:600px">
                <div class="w3-center"><br>
                    <span onclick="document.getElementById('in').style.display='none'; document.getElementById('estudyante').style.display='block'" class="w3-button w3-xlarge w3-hover-red w3-hover-shadow w3-display-topright" title="Close">&times;</span>
                </div>
                <h2><b>Time In Form</b></h2>
                <form class="w3-panel w3-margin w3-padding" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
                    <input required autofocus autocomplete="off" class="w3-input w3-left w3-round w3-margin-bottom" type="text" name="studID" placeholder="Enter Student Number">
                    <small class="w3-left">Format: 09-123456</small><br><br><br><br>
                    <input hidden type="text" name="datein" value='<?php date_default_timezone_set("Asia/Manila"); echo date('Y-m-d');?>'>
                    <input hidden type="text" name="timein" value='<?php date_default_timezone_set("Asia/Manila"); echo date('h:i:s A');?>'>
                    <input type="number" class="w3-input w3-right w3-margin-top" id="numpc" name="numpc" min="4" style="display:none; max-width:45%" placeholder="Enter PC Number">
                    <select required class="w3-select w3-left w3-margin-top" style="max-width:45%;" name="PCNum" onchange="CheckPC(this.value);">
                        <option selected disabled>Select PC Number
                        <option value="with Laptop">with Laptop
                        <option value="1">1
                        <option value="2">2
                        <option value="3">3
                        <option value="None">None
                        <option value="more">More options...
                    </select><br><br><br>
                    <input type="text" class="w3-input w3-right w3-margin-top" id="Osub" name="Osub" style="display:none; max-width:45%" placeholder="Enter Course Code/Subject">
                    <select required class="w3-select w3-left w3-margin-top" style="max-width:45%;" name="subj" onchange="OtherSub(this.value);">
                        <option selected disabled>Select Subject
                        <option value="CMPT123">CMPT123
                        <option value="CMPT143">CMPT143
                        <option value="CMPT152">CMPT152
                        <option value="CMPT153">CMPT153
                        <option value="CMPT154">CMPT154
                        <option value="more">Other...
                    </select><br><br><br>
                    <input type="text" class="w3-input w3-right w3-margin-bottom" id="Oteacher" name="Oteacher" style="display:none; max-width:45%" autocomplete="off" placeholder="Enter Teacher Name">
                    <select required class="w3-select w3-left w3-margin-bottom" name="teacher" style="max-width:45%;" onchange="AddTeacher(this.value);">
                        <option selected disabled>Select Teacher
                        <?php
                        include "connect2db.php";
                        $query = "SELECT * FROM teacherscmpt";
                        $output = mysqli_query($conn,$query);
                        foreach ($output as $row){
                            echo "<option value='".$row['honorific']." ".$row['firstname']." ".$row['lastname']."'>".$row['honorific']." ".$row['firstname']." ".$row['lastname']."</option>" ;
                        }
                        ?>
                        <option value="others">Others... please specify
                    </select><br><br><br>
                    <select class="w3-select w3-right w3-margin-bottom" id="techb" name="tb" style="display:none; max-width: 45%" autocomplete="off">
                        <option selected disabled>Select Room</option>
                        <option value="TB101">TB101</option>
                        <option value="TB102">TB102</option>
                        <option value="TB103">TB103</option>
                        <option value="TB104">TB104</option>
                        <option value="TB105">TB105</option>
                        <option value="TB106">TB106</option>
                        <option value="TB201">TB201</option>
                        <option value="TB202">TB202</option>
                        <option value="TB203">TB203</option>
                        <option value="TB204">TB204</option>
                        <option value="TB205">TB205</option>
                        <option value="TB206">TB206</option>
                    </select>
                    <select class="w3-select w3-right w3-margin-bottom" id="acadb" name="ab" style="display:none; max-width: 45%" autocomplete="off">
                        <option selected disabled>Select Room</option>
                        <option value="AB101">AB101</option>
                        <option value="AB102">AB102</option>
                        <option value="AB103">AB103</option>
                        <option value="AB104">AB104</option>
                        <option value="AB105">AB105</option>
                        <option value="AB106">AB106</option>
                        <option value="AB107">AB107</option>
                        <option value="AB108">AB108</option>
                        <option value="AB201">AB201</option>
                        <option value="AB202">AB202</option>
                        <option value="AB203">AB203</option>
                        <option value="AB204">AB204</option>
                        <option value="AB205">AB205</option>
                        <option value="AB206">AB206</option>
                        <option value="AB207">AB207</option>
                        <option value="AB208">AB208</option>
                    </select>
                    <select required class="w3-select w3-left w3-margin-bottom" name="room" onchange="printSelect(this.value);" style="max-width: 45%;">
                        <option selected disabled>Select Building</option>
                        <option value="acad">Academic Building</option>
                        <option value="tech">Technology Building</option>
                    </select>
                    <!---<input type="text" class="w3-input w3-right w3-margin-bottom" id="Oroom" name="Oroom" style="display:none; max-width:45%" autocomplete="off" placeholder="Enter Room">
                    <select required class="w3-select w3-left w3-margin-bottom" name="room" style="max-width:45%;" onchange="OtherRoom(this.value);">
                        <option selected disabled>Select Room Number
                        <option value="TB201">TB201
                        <option value="TB202">TB202
                        <option value="Flexible Learning Hub">Flexible Learning Hub
                        <option value="other">Other
                    </select>--><br><br><br>
                    <input type="submit" name="intime" value="Time In" class="w3-button w3-orange w3-left w3-round w3-margin-top w3-hover-blue w3-hover-shadow">
                </form>
                <div class="w3-container w3-border-top w3-padding-16 w3-light-gray">
                    <button onclick="document.getElementById('in').style.display='none'; document.getElementById('estudyante').style.display='block'" type="button" class="w3-button w3-red w3-hover-shadow">Cancel</button>
                </div>
            </div>
        </div>
        <div id="out" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-right w3-red w3-round" style="max-width:600px">
                <div class="w3-center"><br>
                    <span onclick="document.getElementById('out').style.display='none'; document.getElementById('estudyante').style.display='block'" class="w3-button w3-xlarge w3-hover-red w3-hover-shadow w3-display-topright" title="Close">&times;</span>
                </div>
                <h2><b>Time Out Form</b></h2>
                <form class="w3-panel w3-margin w3-padding" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                    <input required autofocus autocomplete="off" class="w3-input w3-left w3-round w3-margin-bottom" type="text" name="studID" placeholder="Enter Student Number">                                        
                    <input hidden type="text" name="dateout" value="<?php date_default_timezone_set("Asia/Manila"); echo date('F d, Y');?>">
                    <input hidden type="text" name="outdate" value='<?php date_default_timezone_set("Asia/Manila"); echo date('Y-m-d');?>'>
                    <input hidden type="text" name="outtime" value="<?php date_default_timezone_set("Asia/Manila"); echo date('h:i:s A');?>">
                    <br><small class="w3-left">Format: 09-123456</small><br><br><br><!--
                    <select required class="w3-select w3-left w3-margin-top" style="max-width:45%;" name="subj" onchange="OtherSub(this.value);">
                        <option selected disabled>Select Subject
                        <option value="CMPT123">CMPT123
                        <option value="CMPT143">CMPT143
                        <option value="CMPT152">CMPT152
                        <option value="CMPT153">CMPT153
                        <option value="CMPT154">CMPT154
                        <option value="more">Other...
                    </select>
		    <input type="text" class="w3-input w3-right w3-margin-top" id="Osub" name="Osub" style="display:none; max-width:45%" placeholder="Enter Course Code/Subject">
                    <br><br><br>-->
                    <input type="submit" name="timeout" value="Time Out" class="w3-button w3-orange w3-left w3-round w3-margin-top w3-hover-blue w3-hover-shadow">
                </form>
                <div class="w3-container w3-border-top w3-padding-16 w3-light-gray">
                    <button onclick="document.getElementById('out').style.display='none'; document.getElementById('estudyante').style.display='block'" type="button" class="w3-button w3-red w3-hover-shadow">Cancel</button>
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
                under Mr. Elmer Blanco, with the utmost guidance of Mr. Jade Guillen.<br>Created by Kreymund Galacgac, with the help of Hannah Angelica Cac and Junry Rafael Reyes,
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
    <!--<i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>-->
    <h6 class="w3-small w3-half">
        <b>2021 All Rights Reserved.</b><br>
        <span class="w3-text-red">!!! CIT RED LIONS !!!</span>
    </h6>
    <h6 class="w3-small w3-half">
        <button class="w3-button" onclick="document.getElementById('about').style.display='block'">About this Website</button>
        <a class="w3-button w3-hover-green" onclick='window.open("https://www.mmsu.edu.ph","_blank")'><i class="fa fa-globe w3-hover-opacity w3-large"></i> MMSU Website</a>
        <a class="w3-button w3-hover-blue" onclick="window.open('https://www.facebook.com/MMSUofficial','_blank')"><i class="fa fa-facebook-official w3-hover-opacity w3-large"></i> MMSU Facebook Page</a><br>
        Designed for<br>MMSU College of Industrial Technology<br>
    </h6>
    <p class="w3-medium">Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank" class="w3-hover-text-green">w3.css</a></p>
  <!-- End footer -->
    </footer>
</div>
    <small><button class="w3-content w3-animate-fading w3-btn w3-center w3-bottom w3-text-black">Produced and Developed by <span onclick="w3.toggleShow('#admbtn')">Kreymund</span></button></small>
</body>
<script src="js/w3.js"></script>
<script type="text/javascript">
function CheckPC(val){
 var element=document.getElementById('numpc');
 if(val=='Select PC Number'||val=='more')
   element.style.display='block';
 else  
   element.style.display='none';
}
function OtherSub(val){
 var element=document.getElementById('Osub');
 if(val=='more')
   element.style.display='block';
 else  
   element.style.display='none';
}
function AddTeacher(val){
 var element=document.getElementById('Oteacher');
 if(val=='others')
   element.style.display='block';
 else  
   element.style.display='none';
}
function OtherRoom(val){
 var element=document.getElementById('Oroom');
 if(val=='other')
   element.style.display='block';
 else  
   element.style.display='none';
}
function printSelect(val){
if(val=='tech')
    {document.getElementById('techb').style.display='block';
    document.getElementById('acadb').style.display='none';}
else if(val=='acad')
    {document.getElementById('techb').style.display='none';
    document.getElementById('acadb').style.display='block';}}
</script>
</html>
