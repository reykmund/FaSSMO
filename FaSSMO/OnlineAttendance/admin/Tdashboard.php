<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/w3.css">
	<link rel="icon" href="../img/fassmo_black.png" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-food.css">
    <style>
    @media only screen and (min-width: 1080px) {body {background-image: url('../img/MMSU_bg.jpg'); background-size: cover; background-repeat:no-repeat;}}
    </style>
    <title>Teacher's Dashboard</title>
</head>
<body class="w3-responsive w3-content">
    <a href="http://mmsu.edu.ph"><img class="w3-left w3-margin w3-circle" src="../img/mmsu-logo.png" height="40px" width="40px"></a>
    <a href="http://cit.mmsu.edu.ph"><img class="w3-right w3-margin w3-circle" src="../img/cit-logo.png" height="40px" width="45px"></a>
    <h3 class="w3-header w3-center w3-padding w3-serif w3-text-white" style="background-color:#197800; text-shadow:2px 2px 0 #528;"><b>Mariano Marcos State University</b></h3>
	<div class="w3-panel w3-center w3-round w3-padding w3-margin">
		<h2 class="w3-food-banana w3-round-xlarge w3-text-black"><i class="material-icons w3-xxlarge">person</i><i class="material-icons w3-xxlarge">dashboard</i><br><b>Teacher's Dashboard</b></h2>
        <nav class="w3-panel w3-food-cranberry w3-round w3-tiny">
            <span class="w3-left w3-margin-bottom">
            <?php
                echo "
                <html>
                    <head>
                        <title>TIME</title>
                        <meta charset='UTF-8'>
                        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                        <script src='../js/jquery.js'></script>
                        <script>
                        $(document).ready(function(){setInterval(_initTimer, 1000);});
                        function _initTimer(){
                            $.ajax({
                                url: '../timer.php',
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
            </span>
            <a class="w3-button w3-hover-yellow w3-hover-shadow w3-right" href="../index.php" onclick="<?php session_destroy();?>"><i class="material-icons w3-xlarge">backspace</i><br>Log Out</a>
            <button class="w3-button w3-right w3-hover-blue w3-hover-shadow" onclick="document.getElementById('about').style.display='block'">
            <i class="material-icons w3-xlarge">info</i><br>About</button>
            <div id="about" class="w3-modal">
                <div class="w3-modal-content w3-card-4 w3-animate-right w3-round-large" style="max-width:600px; background-color:#197800;">
                    <div class="w3-center"><br>
                        <span onclick="document.getElementById('about').style.display='none'" class="w3-button w3-medium w3-hover-red w3-hover-shadow w3-display-topright" title="Close">&times;</span>
                    </div><br>
                    <div class="w3-yellow">
                    <strong class="w3-xxlarge">ABOUT</strong><br>
                    </div>
                    <h3 class="w3-padding-32 w3-margin">This attendance system is made possible as a fulfillment project to the course "Advance Web Development", course code: CMPT152
                    under the supervision of Mr. Jade Guillen.<br>Created by Kreymund Galacgac and Charlene Labiton, 
                    this online attendance system can be of future use as an attendance system for Computer Technology students, 
                    as this is only a simple system.
                    <br><strong>To God Be All The Glory.</strong><br>
                    <h6>Sic Parvis Magna</h6>
                    </h3>
                </div>
            </div>
        </nav>
        <?php
        if (isset($_POST['regStudent'])) {
            $studID = $_POST['studID'];
            $fname = ucwords($_POST['fname']);
            $lname = ucwords($_POST['lname']);
            if(!empty($studID) || !empty($fname) || !empty($lname)){
                include "../connect2db.php";
                if (mysqli_connect_error()) {die('Connect Error('.mysqli_connect_error().')'.mysqli_connect_error());}
                else {
                    $SELECT = "SELECT studID FROM cmpt WHERE studID = ? LIMIT 1";
                    $INSERT = "INSERT INTO cmpt (studID,fname,lname) VALUES(?,?,?)";
                    $krey = $conn->prepare($SELECT);
                    $krey->bind_param("s",$studID);
                    $krey->execute();
                    $krey->bind_result($studID);
                    $krey->store_result();
                    $mund = $krey->num_rows;
                    if($mund == 0){
                        $krey->close();
                        $krey = $conn->prepare($INSERT);
                        $krey->bind_param("sss",$studID,$fname,$lname);
                        $krey->execute();
                        echo "<h1 class='w3-green w3-animate-zoom'>Successfully Registered!</h1>";}
                    else {echo "<h1 class='w3-gray w3-animate-zoom'>This Student Number is Already Registered!</h1>";}
                    $krey->close();
                    $conn->close();}}
            else {echo "Incomplete DATA!"; die();}}
        else if(isset($_POST['delStud'])) {
            include "../connect2db.php";
            if (mysqli_connect_error()) {die('Connect Error('.mysqli_connect_error().')'.mysqli_connect_error());}
            else {
            $id = $_POST['id'];
            $del = "DELETE FROM cmpt WHERE studID = '$id'";
            mysqli_query($conn,$del);
            echo "<h1 class='w3-green w3-center w3-animate-zoom'>Successfully Deleted!</h1>";}}
        ?>
        <div class="w3-panel w3-center w3-padding w3-round-large">
            <button class="w3-margin w3-round w3-indigo w3-hover-red w3-hover-shadow w3-button" onclick="document.getElementById('Sreg').style.display='block'">
            <i class="material-icons w3-jumbo">assignment_ind</i><br><h6><b>Register a Student</b></h6></button>
            <button class="w3-margin w3-round w3-orange w3-hover-red w3-hover-shadow w3-button" onclick="document.getElementById('infoS').style.display='block'">
            <i class="material-icons w3-jumbo">description</i><br><h6><b>Students' Information</b></h6></button>
            <button class="w3-margin w3-round w3-blue w3-hover-red w3-hover-shadow w3-button" onclick="document.getElementById('infoT').style.display='block'">
            <i class="material-icons w3-jumbo">description</i><br><h6><b>Teachers' Information</b></h6></button>
            <button class="w3-margin w3-round w3-green w3-hover-red w3-hover-shadow w3-button" onclick="document.getElementById('rec').style.display='block'">
            <i class="material-icons w3-jumbo">date_range</i><br><h6><b>Attendance Record</b></h6></button>
        </div>
        <div id="Sreg" class="w3-modal">
                <div class="w3-modal-content w3-card-4 w3-animate-left w3-indigo w3-round" style="max-width:600px">
                    <div class="w3-center"><br>
                        <!--<span onclick="document.getElementById('Sreg').style.display='none'" class="w3-button w3-large w3-hover-red w3-display-topright" title="Close">&times;</span>-->
                    </div>
                    <h2 class="w3-yellow"><b>Student Registration Form</b></h2>
                    <h6 class="w3-panel"><button class="w3-button w3-orange w3-hover-red w3-hover-shadow w3-right" onclick="document.getElementById('Sreg').style.display='none'">Cancel</button></h6>
                    <div class="w3-margin">
                        <p><span class="w3-text-red w3-left">* required field</span></p><br>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                            <label class="w3-label w3-left"><span class="w3-text-red">* </span>Student Number</label>
                            <input required class="w3-input w3-round w3-margin-bottom" type="text" name="studID" placeholder="Student Number" autocomplete="off">
                            <label class="w3-label w3-left"><span class="w3-text-red">* </span>First Name</label>
                            <input required class="w3-input w3-round w3-margin-bottom" type="text" name="fname" placeholder="First Name" autocomplete="off">
                            <label class="w3-label w3-left"><span class="w3-text-red">* </span>Last Name</label>
                            <input required class="w3-input w3-round w3-margin-bottom" type="text" name="lname" placeholder="Last Name" autocomplete="off">
                            <br>
                            <input class="w3-button w3-hover-green w3-hover-shadow w3-yellow w3-round w3-margin" type="submit" name="regStudent" value="Submit">  
                        </form>
                    </div>
                </div>
        </div>
        <div id="infoS" class="w3-modal">
                <div class="w3-modal-content w3-card-4 w3-animate-zoom w3-orange w3-round-large" style="max-width:800px">
                    <div class="w3-center"><br>
                        <!--<span onclick="document.getElementById('info').style.display='none'" class="w3-button w3-large w3-hover-red w3-display-topright" title="Close">&times;</span>-->
                    </div>
                    <h2 class="w3-yellow"><b>Student Information</b></h2>
                    <h6 class="w3-panel"><button class="w3-button w3-yellow w3-hover-red w3-hover-shadow w3-right" onclick="document.getElementById('infoS').style.display='none'">Back</button></h6>
                    <div class="w3-responsive">
                        <table class="w3-table w3-green w3-margin-bottom">
                            <tr class="w3-yellow">
                                <th></th>
                                <th>Student Number</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                            </tr>
                            <?php
                            include "../connect2db.php";
                            $sql = "SELECT * FROM students WHERE 1 ORDER BY lname ASC";
                            $output = mysqli_query($conn,$sql);
                            foreach($output as $row){
                                echo "<tr class='w3-hover-blue w3-hover-shadow'>
                                <td><form action='' method='post'>
                                <input hidden type='text' name='id' value='".$row['studID']."'>
                                <input type='submit' class='w3-button w3-red' name='delStud' value='Delete'>
                                </form></td>
                                <td>".$row['studID']."</td>
                                <td>".$row['fname']."</td>
                                <td>".$row['lname']."</td></tr>";}
                            ?>
                        </table>
                    </div>
                </div>
        </div>
        <div id="infoT" class="w3-modal">
                <div class="w3-modal-content w3-card-4 w3-animate-zoom w3-orange w3-round-large" style="max-width:800px">
                    <div class="w3-center"><br>
                        <!--<span onclick="document.getElementById('info').style.display='none'" class="w3-button w3-large w3-hover-red w3-display-topright" title="Close">&times;</span>-->
                    </div>
                    <h2 class="w3-yellow"><b>Teachers' Information</b></h2>
                    <h6 class="w3-panel"><button class="w3-button w3-yellow w3-hover-red w3-hover-shadow w3-right" onclick="document.getElementById('infoT').style.display='none'">Back</button></h6>
                    <div class="w3-responsive">
                        <table class="w3-table w3-green w3-margin-bottom">
                            <tr class="w3-yellow">
                                <th></th>
                                <th>Teacher ID Number</th>
                                <th>Username</th>
                                <th>Title</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                            </tr>
                            <?php
                            include "../connect2db.php";
                            $sql = "SELECT * FROM teacherscmpt WHERE 1 ORDER BY lastname ASC";
                            $output = mysqli_query($conn,$sql);
                            foreach($output as $row){
                                echo "<tr class='w3-hover-blue w3-hover-shadow'>
                                <td><form action='' method='post'>
                                <input hidden type='text' name='id' value='".$row['teacher_id']."'>
                                <input disabled type='submit' class='w3-button w3-red' name='delTeach' value='Remove'>
                                </form></td>
                                <td>".$row['teacher_id']."</td>
                                <td>".$row['user']."</td>
                                <td>".$row['honorific']."</td>
                                <td>".$row['firstname']."</td>
                                <td>".$row['lastname']."</td></tr>";}
                            ?>
                        </table>
                    </div>
                </div>
        </div>
        <div id="rec" class="w3-modal">
                <div class="w3-modal-content w3-card-4 w3-animate-right w3-green w3-round-large" style="max-width:2160px">
                    <div class="w3-center"><br>
                        <!--<span onclick="document.getElementById('rec').style.display='none'" class="w3-button w3-large w3-hover-red w3-display-topright" title="Close">&times;</span>-->
                    </div>
                    <h2 class="w3-yellow"><b>Student Attendance</b></h2>
                    <div class="w3-panel">
                    <button class="w3-button w3-yellow w3-hover-red w3-hover-shadow w3-right" onclick="document.getElementById('rec').style.display='none'">Back</button>
                    <button class="w3-button w3-blue w3-hover-red w3-hover-shadow w3-right w3-margin-right" onclick="document.getElementById('rec').style.display='none'; document.getElementById('print').style.display='block'">Print</button></div>
                    <div class="w3-responsive">
                        <table class="w3-table w3-round-large w3-margin-bottom">
                            <tr class="w3-yellow">
                                <th>Student Number</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>PC Number</th>
                                <th>Teacher</th>
                                <th>Subject</th>
                                <th>Room</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                                <th>Date</th>
                            </tr>
                            <?php
                            include "../connect2db.php";
                            date_default_timezone_set("Asia/Manila");
			    $today = date('Y-m-d');
                            $sql = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.datein LIKE '%$today%' ORDER BY timeincmpt.num ASC";
                            $output = mysqli_query($conn,$sql);
                            foreach($output as $row){
                                echo "<tr class='w3-hover-blue w3-hover-shadow'>
                                <td>".$row['studID']."</td>
                                <td>".$row['fname']."</td>
                                <td>".$row['lname']."</td>
                                <td>".$row['PCNum']."</td>
                                <td>".$row['teacher']."</td>
                                <td>".$row['subj']."</td>
                                <td>".$row['room']."</td>
                                <td>".$row['timein']."</td>
                                <td>".$row['outtime']."</td>
                                <td>".$row['dateout']."</td></tr>";}
                            mysqli_close($conn);
                            ?>
                        </table>
                    </div>
                </div>
        </div>
        <div id="print" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom w3-blue w3-round-large" style="max-width:800px">
                <div class="w3-center">
                    <span onclick="document.getElementById('print').style.display='none'" class="w3-button w3-large w3-hover-red w3-display-topright" title="Close">&times;</span>
                </div><br>
                <h2 class="w3-yellow"><b>Print based on</b></h2>
                <div class="w3-panel"><button class="w3-button w3-yellow w3-hover-red w3-hover-shadow w3-right" onclick="document.getElementById('print').style.display='none'">Back</button></div>
                <div class="w3-panel">
                <form class="w3-form" action="print.php" method="POST">
                <input type="date" class="w3-input w3-right w3-margin-bottom" name="aldaw" placeholder="Select Date">
                <input type="text" class="w3-input w3-right w3-margin-bottom" id="Sprint" name="student" style="display:none; max-width: 45%" autocomplete="off" placeholder="Enter Student ID (optional)">
                <input type="text" class="w3-input w3-right w3-margin-bottom" id="Tprint" name="teacher" style="display:none; max-width: 45%" autocomplete="off" placeholder="Enter Teacher Name">
                <select required class="w3-select w3-left w3-margin-bottom" name="printopt" onchange="printSelect(this.value);" style="max-width: 45%;">
                    <option selected disabled>Select Option</option>
                    <option value="student">Student</option>
                    <option value="teacher">Teacher</option>
                </select><br><br><br><br><br>
                <select class="w3-select w3-right w3-margin-bottom" id="techb" name="ab" style="display:none; max-width: 45%" autocomplete="off" placeholder="Select Room">
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
                <select class="w3-select w3-right w3-margin-bottom" id="acadb" name="tb" style="display:none; max-width: 45%" autocomplete="off" placeholder="Select Room">
                    <option value="TB101">AB101</option>
                    <option value="TB101">AB102</option>
                    <option value="TB101">AB103</option>
                    <option value="TB101">AB104</option>
                    <option value="TB101">AB105</option>
                    <option value="TB101">AB106</option>
                    <option value="TB101">AB107</option>
                    <option value="TB101">AB108</option>
                    <option value="TB101">AB201</option>
                    <option value="TB101">AB202</option>
                    <option value="TB101">AB203</option>
                    <option value="TB101">AB204</option>
                    <option value="TB101">AB205</option>
                    <option value="TB101">AB206</option>
                    <option value="TB101">AB207</option>
                    <option value="TB101">AB208</option>
                </select>
                <select required class="w3-select w3-left w3-margin-bottom" name="printroom" onchange="printSelect(this.value);" style="max-width: 45%;">
                    <option selected disabled>Select Room</option>
                    <option value="acad">Academic Building</option>
                    <option value="tech">Technology Building</option>
                </select><br><br><br>
                <select required class="w3-select w3-left w3-margin-bottom" name="period" style="max-width: 45%;">
                    <option selected disabled>Select Time Period</option>
                    <option value="S1">8am-11am</option>
                    <option value="S2">11am-2pm</option>
                    <option value="S3">2pm-5pm</option>
                    <option value="flh">Flexible Learning Hub Only</option>
                    <option value="all">All Records</option>
                </select>
                <input type="submit" class="w3-button w3-margin w3-green w3-round w3-right" name="Stud_printnow" value="Export to PDF" onclick="document.getElementById('print').style.display='none'">
                </form></div>
            </div>
        </div>
    </div>
    <small class="w3-animate-fading w3-center w3-bottom">program by kreymund</small>
</body>
<script src="w3.js"></script>
<script>function printSelect(val){
if(val=='student')
   {document.getElementById('Sprint').style.display='block';
    document.getElementById('Tprint').style.display='none';}
else if(val=='teacher')
   {document.getElementById('Tprint').style.display='block';
    document.getElementById('Sprint').style.display='none';}
else if(val=='tech')
    {document.getElementById('techb').style.display='block';
    document.getElementById('acadb').style.display='none';}
else if(val=='acad')
    {document.getElementById('techb').style.display='none';
    document.getElementById('acadb').style.display='block';}
else{element.style.display='none';}}</script>
</html>
