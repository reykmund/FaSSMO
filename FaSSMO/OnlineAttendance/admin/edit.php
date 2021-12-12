<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Edit Teacher Details</title>
</head>
<body class="w3-responsive w3-content w3-black" style="background-image: url('../img/MMSU_bg.jpg'); background-repeat:no-repeat; background-size: cover;">
    <a href="http://mmsu.edu.ph"><img class="w3-left w3-margin w3-circle" src="../img/mmsu-logo.png" height="60px" width="60px"></a>
    <a href="http://cit.mmsu.edu.ph"><img class="w3-right w3-margin w3-circle" src="../img/cit-logo.png" height="60px" width="65px"></a>
    <h1 class="w3-header w3-center w3-padding w3-serif" style="text-shadow:2px 2px 0 #444; background-color:#197800;"><b>Mariano Marcos State University</b></h1>
    <div class="w3-panel w3-round w3-center w3-blue">
    <nav class="w3-xlarge w3-yellow w3-panel">Edit Details</nav>
        <?php
        if (isset($_POST['updateT'])) {
            $current = $_POST['idcurrent'];
            $id = $_POST['id'];
            $user = $_POST['user'];
            $pass = sha1($_POST['pass']);
            $title = $_POST['title'];
            $first = ucwords($_POST['first']);
            $last = ucwords($_POST['last']);
            include "../connect2db.php";
            if (!$conn) {die("Connection failed: ".mysqli_connect_error());}
            else {
                $check = "SELECT user FROM teacherscmpt WHERE user = ? LIMIT 1";
                $insert = "UPDATE teacherscmpt SET teacher_id = '$id', user = '$user', pass = '$pass', honorific = '$title', firstname = '$first', lastname = '$last' WHERE teacher_id = '$current'";
                $krey = $conn->prepare($check);
                $krey->bind_param("s",$user);
                $krey->execute();
                $krey->bind_result($user);
                $krey->store_result();
                $mund = $krey->num_rows;
                mysqli_query($conn,$insert);
                echo "<h1 class='w3-green w3-center w3-animate-zoom'>Successfully Updated!</h1>";
                header("refresh:2; url=dashboard.php");
                $conn->close();
            }
        }
        ?>
        <?php
        if (isset($_POST['editTeach'])) {
            $id = $_POST['id'];
            include "../connect2db.php";
            if (!$conn) {
                die("Connection failed: ".mysqli_connect_error());}
            else {
                $check = "SELECT * FROM teacherscmpt WHERE teacher_id = '$id'";
                $selected = mysqli_query($conn,$check);
                while($row = mysqli_fetch_array($selected)){
                    echo '
                    <form class="w3-panel w3-margin w3-padding" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post">
                    <input hidden type="text" name="idcurrent" value="'.$row['teacher_id'].'">
                    <input required class="w3-input w3-left w3-round w3-margin-bottom" type="text" name="id" value="'.$row['teacher_id'].'"><br>
                    <input required autofocus autocomplete="off" class="w3-input w3-left w3-round w3-margin-bottom" type="text" name="user" value="'.$row['user'].'"><br>
                    <input required class="w3-input w3-left w3-round w3-margin-bottom" type="password" name="pass" placeholder="Enter Password"><br>
                    <select required class="w3-select w3-margin-bottom" name="title">
                        <option disabled>Select Title</option>
                        <option value="Mr.">Mr.</option>
                        <option value="Ms.">Ms.</option>
                        <option value="Mrs.">Mrs.</option>
                        <option value="Engr.">Engr.</option>
                        <option value="Dr.">Dr.</option>
                        <option value="">None</option>
                    </select>
                    <input required class="w3-input w3-left w3-round w3-margin-bottom" type="text" name="first" value="'.$row['firstname'].'"><br>
                    <input required class="w3-input w3-left w3-round w3-margin-bottom" type="text" name="last" value="'.$row['lastname'].'"><br>
                    <input type="submit" name="updateT" value="Update" class="w3-button w3-orange w3-left w3-round-large w3-margin-top w3-hover-green w3-hover-shadow">
                    <a href="dashboard.php" class="w3-button w3-yellow w3-round-large w3-margin w3-hover-green w3-hover-shadow w3-left">Cancel</a>
                    </form>';}
                $conn->close();
            }
        }
        ?>
    </div>
        </div>
	</div>
    <small><strong><span class="w3-animate-fading w3-center w3-bottom">program by kreymund ♥♦</span></strong></small>
</body>
<script src="../js/w3.js"></script>
</html>