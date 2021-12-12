<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FaSSMO - Faculty and Student System Monitoring Organizer</title>
    <link rel="stylesheet" href="admin/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    body, h1,h2,h3,h4,h5,h6 {font-family: "Montserrat", sans-serif}
    .w3-row-padding img {margin-bottom: 12px}
    /* Set the width of the sidebar to 120px */
    .w3-sidebar {width: 120px;background: #222;}
    /* Add a left margin to the "page content" that matches the width of the sidebar (120px) */
    #main {margin-left: 120px}
    /* Remove margins from "page content" on small screens */
    @media only screen and (max-width: 600px) {#main {margin-left: 0}}
    </style>
</head>
<body class="w3-black">

<!-- Icon Bar (Sidebar - hidden on small screens) -->
<nav class="w3-sidebar w3-bar-block w3-small w3-hide-small w3-center">
  <!-- Avatar image in top left corner -->
  <img src="img/fassmo_black.png" style="width:100%">
  <a href="#" class="w3-bar-item w3-button w3-padding-large w3-hover-white">
    <i class="fa fa-home w3-xxlarge"></i>
    <p>HOME</p>
  </a>
  <a href="#timein" class="w3-bar-item w3-button w3-padding-large w3-hover-white">
    <i class="fa fa-eye w3-xxlarge"></i>
    <p>TIME IN</p>
  </a>
  <a href="#about" class="w3-bar-item w3-button w3-padding-large w3-hover-white">
    <i class="fa fa-user w3-xxlarge"></i>
    <p>ABOUT</p>
  </a>
</nav>

<!-- Navbar on small screens (Hidden on medium and large screens) -->
<div class="w3-top w3-hide-large w3-hide-medium" id="myNavbar">
  <div class="w3-bar w3-black w3-opacity w3-hover-opacity-off w3-center w3-small">
    <a href="#" class="w3-bar-item w3-button" style="width:33% !important">HOME</a>
    <a href="#timein" class="w3-bar-item w3-button" style="width:34% !important">TIME IN</a>
    <a href="#about" class="w3-bar-item w3-button" style="width:33% !important">ABOUT</a>
  </div>
</div>

<!-- Page Content -->
<div class="w3-padding-large" id="main">
  <!-- Header/Home -->
  <header class="w3-container w3-padding-32 w3-center w3-black" id="home">
    <img src="img/fassmo_black.png" class="w3-image" width="800" height="800">
    <p class="w3-xlarge"><b><u>F</u></b>aculty <b><u>a</u></b>nd <b><u>S</u></b>tudent <b><u>S</u></b>ystem <b><u>M</u></b>onitoring <b><u>O</u></b>rganizer</p><br>
  </header>

  <!-- Section -->
  <div class="w3-padding-64 w3-content" id="timein">
    <h2 class="w3-text-light-grey">TIME IN</h2>
    <hr style="width:200px" class="w3-opacity">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" class="w3-container w3-card-4 w3-dark-grey w3-text-orange w3-margin">
        <h2 class="w3-center">Visitor Time In</h2>
        
        <div class="w3-row w3-section">
        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
            <div class="w3-rest">
            <input class="w3-input w3-border" name="fullname" type="text" placeholder="Full Name">
            </div>
        </div>

        <div class="w3-row w3-section">
        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-pencil"></i></div>
            <div class="w3-rest">
            <input class="w3-input w3-border" name="purpose" type="text" placeholder="Purpose of Visit">
            </div>
        </div>
    </form>
    <div class="w3-center">
        <?php
            echo "
            <html>
                <head>
                    <title>TIME</title>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <script src='admin/jquery.js'></script>
                    <script>
                    $(document).ready(function(){
                        setInterval(_initTimer, 1000);
                    });
                    function _initTimer(){
                        $.ajax({
                            url:'admin/timer.php',
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
    </div><br>
    <div class="w3-center">
    <button class="w3-button w3-xxlarge w3-round-large w3-margin-bottom w3-green">Student</button><br>
    <button class="w3-button w3-xxlarge w3-round-large w3-margin-bottom w3-blue">Faculty</button><br>
    <button class="w3-button w3-xxlarge w3-round-large w3-margin-bottom w3-orange">Visitor</button>
    </div>
  <!-- Section -->
  </div>

  <!-- About Section -->
  <div class="w3-content w3-justify w3-text-grey w3-padding-64" id="about">
    <h2 class="w3-text-light-grey">About This Project</h2>
    <hr style="width:200px" class="w3-opacity">
    <p>Some text about me. Some text about me. I am lorem ipsum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
      ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur
      adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
    </p>
  </div>
  
    <!-- Footer -->
  <footer class="w3-content w3-padding-64 w3-text-grey w3-xlarge">
    <!--<i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>-->
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
    <p class="w3-medium">Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank" class="w3-hover-text-green">w3.css</a></p>
  <!-- End footer -->
  </footer>

<!-- END PAGE CONTENT -->
</div>

</body>
</html>
