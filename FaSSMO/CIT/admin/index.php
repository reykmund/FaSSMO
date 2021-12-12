<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FaSSMO - Faculty and Student System Monitoring Organizer</title>
    <link rel="stylesheet" href="w3.css">
</head>
<body class="w3-responsive">
    <div class="w3-center w3-light-gray">
        <header class="w3-xxxlarge w3-yellow"><b><u>FaSSMO</u></b>
        <div class="w3-xlarge w3-dark-gray"><b><u>F</u></b>aculty <b><u>a</u></b>nd <b><u>S</u></b>tudent <b><u>S</u></b>ystem <b><u>M</u></b>onitoring <b><u>O</u></b>rganizer<br>
        <h5 class="w3-serif" style="background-color:#197800;"><b>Welcome to<h4 class="w3-serif"><b>Mariano Marcos State University</b></h4>College of Industrial Technology</b></h5>
        </div></header>
        <h6 class="w3-half">
            <?php
            echo "
            <html>
                <head>
                    <title>TIME</title>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <script src='jquery.js'></script>
                    <script>
                    $(document).ready(function(){
                        setInterval(_initTimer, 1000);
                    });
                    function _initTimer(){
                        $.ajax({
                            url:'timer.php',
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
        <h4 class="w3-half">No. of persons in the area:<br><b>####</b></h4>
        <div class="w3-panel">
            <div class="w3-red w3-round-large w3-center w3-padding-16">
                <div><h2><b>Administrator Login</b></h2><br><br><br><br><br><br></div>
                <div class="w3-display-container w3-margin">
                    <form class="w3-form w3-twothird w3-display-bottommiddle">
                        <input type="text" class="w3-input w3-margin-bottom w3-border w3-center" placeholder="Enter Username">
                        <input type="password" class="w3-input w3-margin-bottom w3-border w3-center" placeholder="Enter Password">
                        <button class="w3-button w3-green w3-round">Log In</button>
                    </form>
                </div>
            </div>
        </div>
        <div>
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
    </div>
</body>
</html>