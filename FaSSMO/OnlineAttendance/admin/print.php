<?php
    require "fpdf.php";
    include "../connect2db.php";
    if (isset($_POST['Stud_printnow'])) {
        if (!empty($_POST['aldaw'])) {
            $date = $_POST['aldaw'];
            $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.datein LIKE '%$date%' ORDER BY timeincmpt.timein ASC";                
        }
        else if (!empty($_POST['student'])) {
            $student = $_POST['student'];
            $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.studID LIKE '%$student%' ORDER BY timeincmpt.timein ASC";                
        }
        else if (!empty($_POST['teacher'])) {
            $teacher = $_POST['teacher'];
            $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.teacher LIKE '%$teacher%' ORDER BY timeincmpt.timein ASC";                
        }
        else if (!empty($_POST['tb'])) {
            $room = $_POST['tb'];
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.room LIKE '%$room%' ORDER BY timeincmpt.timein ASC";                
        }
        else if (!empty($_POST['ab'])) {
            $room = $_POST['ab'];
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.room LIKE '%$room%' ORDER BY timeincmpt.timein ASC";                
        }
        else if (!empty($_POST['period'])) {
            $period = $_POST['period'];
            if ($period == "S1") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.timein LIKE '08%AM' ORDER BY timeincmpt.timein ASC";                
            }
            else if ($period == "S2") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.timein LIKE '11%AM' ORDER BY timeincmpt.timein ASC";                
            }
            else if ($period == "S3") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.timein LIKE '02%PM' ORDER BY timeincmpt.timein ASC";                
            }
            else if ($period == "all") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID ORDER BY timeincmpt.timein ASC";
            }
            else if ($period == "flh") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.room LIKE 'Flexible Learning Hub' ORDER BY timeincmpt.timein ASC";                
            }
        }
        else if (!empty($_POST['aldaw']) && !empty($_POST['student'])) {
            $date = $_POST['aldaw'];
            $student = $_POST['student'];
            $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.datein LIKE '%$date%' AND timeincmpt.studID LIKE '%$student%' ORDER BY timeincmpt.timein ASC";                
        }
        else if (!empty($_POST['aldaw']) && !empty($_POST['teacher'])) {
            $date = $_POST['aldaw'];
            $student = $_POST['teacher'];
            $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.datein LIKE '%$date%' AND timeincmpt.teacher LIKE '%$teacher%' ORDER BY timeincmpt.timein ASC";                
        }
        else if (!empty($_POST['aldaw']) && !empty($_POST['student']) && !empty($_POST['ab'])) {
            $date = $_POST['aldaw'];
            $student = $_POST['student'];
            $room = $_POST['ab'];
            $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.datein LIKE '%$date%' AND timeincmpt.studID LIKE '%$student%' AND timeincmpt.room LIKE '%$room%' ORDER BY timeincmpt.timein ASC";                
        }
        else if (!empty($_POST['aldaw']) && !empty($_POST['student']) && !empty($_POST['tb'])) {
            $date = $_POST['aldaw'];
            $student = $_POST['student'];
            $room = $_POST['tb'];
            $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.datein LIKE '%$date%' AND timeincmpt.studID LIKE '%$student%' AND timeincmpt.room LIKE '%$room%' ORDER BY timeincmpt.timein ASC";                
        }
        else if (!empty($_POST['aldaw']) && !empty($_POST['teacher']) && !empty($_POST['ab'])) {
            $date = $_POST['aldaw'];
            $teacher = $_POST['teacher'];
            $room = $_POST['ab'];
            $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.datein LIKE '%$date%' AND timeincmpt.studID LIKE '%$teacher%' AND timeincmpt.room LIKE '%$room%' ORDER BY timeincmpt.timein ASC";                
        }
        else if (!empty($_POST['aldaw']) && !empty($_POST['teacher']) && !empty($_POST['tb'])) {
            $date = $_POST['aldaw'];
            $teacher = $_POST['teacher'];
            $room = $_POST['tb'];
            $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.datein LIKE '%$date%' AND timeincmpt.studID LIKE '%$teacher%' AND timeincmpt.room LIKE '%$room%' ORDER BY timeincmpt.timein ASC";                
        }
        else if (!empty($_POST['aldaw']) && !empty($_POST['student']) && !empty($_POST['ab']) && !empty($_POST['period'])) {
            $date = $_POST['aldaw'];
            $student = $_POST['student'];
            $room = $_POST['ab'];
            $period = $_POST['period'];
            if ($period == "S1") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.studID LIKE '%$student%' AND timeincmpt.datein LIKE '%$date%' AND timeincmpt.room LIKE '%$room%' AND timeincmpt.timein LIKE '08%AM' ORDER BY timeincmpt.timein ASC";                
            }
            else if ($period == "S2") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.studID LIKE '%$student%' AND timeincmpt.datein LIKE '%$date%' AND timeincmpt.room LIKE '%$room%' AND timeincmpt.timein LIKE '11%AM' ORDER BY timeincmpt.timein ASC";                
            }
            else if ($period == "S3") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.studID LIKE '%$student%' AND timeincmpt.datein LIKE '%$date%' AND timeincmpt.room LIKE '%$room%' AND timeincmpt.timein LIKE '02%PM' ORDER BY timeincmpt.timein ASC";                
            }
            else if ($period == "all") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.studID LIKE '%$student%' AND timeincmpt.datein LIKE '%$date%' AND timeincmpt.room LIKE '%$room%' ORDER BY timeincmpt.timein ASC";
            }
            else if ($period == "flh") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.studID LIKE '%$student%' AND timeincmpt.datein LIKE '%$date%' AND timeincmpt.room LIKE 'Flexible Learning Hub' ORDER BY timeincmpt.timein ASC";                
            }
        }
        else if (!empty($_POST['aldaw']) && !empty($_POST['student']) && !empty($_POST['tb']) && !empty($_POST['period'])) {
            $date = $_POST['aldaw'];
            $student = $_POST['student'];
            $room = $_POST['tb'];
            $period = $_POST['period'];
            if ($period == "S1") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.studID LIKE '%$student%' AND timeincmpt.datein LIKE '%$date%' AND timeincmpt.room LIKE '%$room%' AND timeincmpt.timein LIKE '08%AM' ORDER BY timeincmpt.timein ASC";                
            }
            else if ($period == "S2") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.studID LIKE '%$student%' AND timeincmpt.datein LIKE '%$date%' AND timeincmpt.room LIKE '%$room%' AND timeincmpt.timein LIKE '11%AM' ORDER BY timeincmpt.timein ASC";                
            }
            else if ($period == "S3") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.studID LIKE '%$student%' AND timeincmpt.datein LIKE '%$date%' AND timeincmpt.room LIKE '%$room%' AND timeincmpt.timein LIKE '02%PM' ORDER BY timeincmpt.timein ASC";                
            }
            else if ($period == "all") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.studID LIKE '%$student%' AND timeincmpt.datein LIKE '%$date%' AND timeincmpt.room LIKE '%$room%' ORDER BY timeincmpt.timein ASC";
            }
            else if ($period == "flh") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.studID LIKE '%$student%' AND timeincmpt.datein LIKE '%$date%' AND timeincmpt.room LIKE 'Flexible Learning Hub' ORDER BY timeincmpt.timein ASC";                
            }
        }
        else if (!empty($_POST['aldaw']) && !empty($_POST['teacher']) && !empty($_POST['ab']) && !empty($_POST['period'])) {
            $date = $_POST['aldaw'];
            $teacher = $_POST['teacher'];
            $room = $_POST['ab'];
            $period = $_POST['period'];
            if ($period == "S1") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.teacher LIKE '%$teacher%' AND timeincmpt.datein LIKE '%$date%' AND timeincmpt.room LIKE '%$room%' AND timeincmpt.timein LIKE '08%AM' ORDER BY timeincmpt.timein ASC";                
            }
            else if ($period == "S2") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.teacher LIKE '%$teacher%' AND timeincmpt.datein LIKE '%$date%' AND timeincmpt.room LIKE '%$room%' AND timeincmpt.timein LIKE '11%AM' ORDER BY timeincmpt.timein ASC";                
            }
            else if ($period == "S3") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.teacher LIKE '%$teacher%' AND timeincmpt.datein LIKE '%$date%' AND timeincmpt.room LIKE '%$room%' AND timeincmpt.timein LIKE '02%PM' ORDER BY timeincmpt.timein ASC";                
            }
            else if ($period == "all") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.teacher LIKE '%$teacher%' AND timeincmpt.datein LIKE '%$date%' AND timeincmpt.room LIKE '%$room%' ORDER BY timeincmpt.timein ASC";
            }
            else if ($period == "flh") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.teacher LIKE '%$teacher%' AND timeincmpt.datein LIKE '%$date%' AND timeincmpt.room LIKE 'Flexible Learning Hub' ORDER BY timeincmpt.timein ASC";                
            }
        }
        else if (!empty($_POST['aldaw']) && !empty($_POST['teacher']) && !empty($_POST['tb']) && !empty($_POST['period'])) {
            $date = $_POST['aldaw'];
            $teacher = $_POST['teacher'];
            $room = $_POST['tb'];
            $period = $_POST['period'];
            if ($period == "S1") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.teacher LIKE '%$teacher%' AND timeincmpt.datein LIKE '%$date%' AND timeincmpt.room LIKE '%$room%' AND timeincmpt.timein LIKE '08%AM' ORDER BY timeincmpt.timein ASC";                
            }
            else if ($period == "S2") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.teacher LIKE '%$teacher%' AND timeincmpt.datein LIKE '%$date%' AND timeincmpt.room LIKE '%$room%' AND timeincmpt.timein LIKE '11%AM' ORDER BY timeincmpt.timein ASC";                
            }
            else if ($period == "S3") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.teacher LIKE '%$teacher%' AND timeincmpt.datein LIKE '%$date%' AND timeincmpt.room LIKE '%$room%' AND timeincmpt.timein LIKE '02%PM' ORDER BY timeincmpt.timein ASC";                
            }
            else if ($period == "all") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.teacher LIKE '%$teacher%' AND timeincmpt.datein LIKE '%$date%' AND timeincmpt.room LIKE '%$room%' ORDER BY timeincmpt.timein ASC";
            }
            else if ($period == "flh") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.teacher LIKE '%$teacher%' AND timeincmpt.datein LIKE '%$date%' AND timeincmpt.room LIKE 'Flexible Learning Hub' ORDER BY timeincmpt.timein ASC";                
            }
        }
        else if (!empty($_POST['student']) && !empty($_POST['ab']) && !empty($_POST['period'])) {
            $student = $_POST['student'];
            $room = $_POST['ab'];
            $period = $_POST['period'];
            if ($period == "S1") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.studID LIKE '%$student%' AND timeincmpt.room LIKE '%$room%' AND timeincmpt.timein LIKE '08%AM' ORDER BY timeincmpt.timein ASC";                
            }
            else if ($period == "S2") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.studID LIKE '%$student%' AND timeincmpt.room LIKE '%$room%' AND timeincmpt.timein LIKE '11%AM' ORDER BY timeincmpt.timein ASC";                
            }
            else if ($period == "S3") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.studID LIKE '%$student%' AND timeincmpt.room LIKE '%$room%' AND timeincmpt.timein LIKE '02%PM' ORDER BY timeincmpt.timein ASC";                
            }
            else if ($period == "all") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.studID LIKE '%$student%' AND timeincmpt.room LIKE '%$room%' ORDER BY timeincmpt.timein ASC";
            }
            else if ($period == "flh") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.studID LIKE '%$student%' AND timeincmpt.room LIKE 'Flexible Learning Hub' ORDER BY timeincmpt.timein ASC";                
            }
        }
        else if (!empty($_POST['student']) && !empty($_POST['tb']) && !empty($_POST['period'])) {
            $student = $_POST['student'];
            $room = $_POST['tb'];
            $period = $_POST['period'];
            if ($period == "S1") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.studID LIKE '%$student%' AND timeincmpt.room LIKE '%$room%' AND timeincmpt.timein LIKE '08%AM' ORDER BY timeincmpt.timein ASC";                
            }
            else if ($period == "S2") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.studID LIKE '%$student%' AND timeincmpt.room LIKE '%$room%' AND timeincmpt.timein LIKE '11%AM' ORDER BY timeincmpt.timein ASC";                
            }
            else if ($period == "S3") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.studID LIKE '%$student%' AND timeincmpt.room LIKE '%$room%' AND timeincmpt.timein LIKE '02%PM' ORDER BY timeincmpt.timein ASC";                
            }
            else if ($period == "all") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.studID LIKE '%$student%' AND timeincmpt.room LIKE '%$room%' ORDER BY timeincmpt.timein ASC";
            }
            else if ($period == "flh") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.studID LIKE '%$student%' AND timeincmpt.room LIKE 'Flexible Learning Hub' ORDER BY timeincmpt.timein ASC";                
            }
        }
        else if (!empty($_POST['teacher']) && !empty($_POST['ab']) && !empty($_POST['period'])) {
            $teacher = $_POST['teacher'];
            $room = $_POST['ab'];
            $period = $_POST['period'];
            if ($period == "S1") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.teacher LIKE '%$teacher%' AND timeincmpt.room LIKE '%$room%' AND timeincmpt.timein LIKE '08%AM' ORDER BY timeincmpt.timein ASC";                
            }
            else if ($period == "S2") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.teacher LIKE '%$teacher%' AND timeincmpt.room LIKE '%$room%' AND timeincmpt.timein LIKE '11%AM' ORDER BY timeincmpt.timein ASC";                
            }
            else if ($period == "S3") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.teacher LIKE '%$teacher%' AND timeincmpt.room LIKE '%$room%' AND timeincmpt.timein LIKE '02%PM' ORDER BY timeincmpt.timein ASC";                
            }
            else if ($period == "all") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.teacher LIKE '%$teacher%' AND timeincmpt.room LIKE '%$room%' ORDER BY timeincmpt.timein ASC";
            }
            else if ($period == "flh") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.teacher LIKE '%$teacher%' AND timeincmpt.room LIKE 'Flexible Learning Hub' ORDER BY timeincmpt.timein ASC";                
            }
        }
        else if (!empty($_POST['teacher']) && !empty($_POST['tb']) && !empty($_POST['period'])) {
            $teacher = $_POST['teacher'];
            $room = $_POST['tb'];
            $period = $_POST['period'];
            if ($period == "S1") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.teacher LIKE '%$teacher%' AND timeincmpt.room LIKE '%$room%' AND timeincmpt.timein LIKE '08%AM' ORDER BY timeincmpt.timein ASC";                
            }
            else if ($period == "S2") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.teacher LIKE '%$teacher%' AND timeincmpt.room LIKE '%$room%' AND timeincmpt.timein LIKE '11%AM' ORDER BY timeincmpt.timein ASC";                
            }
            else if ($period == "S3") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.teacher LIKE '%$teacher%' AND timeincmpt.room LIKE '%$room%' AND timeincmpt.timein LIKE '02%PM' ORDER BY timeincmpt.timein ASC";                
            }
            else if ($period == "all") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.teacher LIKE '%$teacher%' AND timeincmpt.room LIKE '%$room%' ORDER BY timeincmpt.timein ASC";
            }
            else if ($period == "flh") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.teacher LIKE '%$teacher%' AND timeincmpt.room LIKE 'Flexible Learning Hub' ORDER BY timeincmpt.timein ASC";                
            }
        }
        else if (!empty($_POST['ab']) && !empty($_POST['period'])) {
            $room = $_POST['ab'];
            $period = $_POST['period'];
            if ($period == "S1") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.room LIKE '%$room%' AND timeincmpt.timein LIKE '08%AM' ORDER BY timeincmpt.timein ASC";                
            }
            else if ($period == "S2") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.room LIKE '%$room%' AND timeincmpt.timein LIKE '11%AM' ORDER BY timeincmpt.timein ASC";                
            }
            else if ($period == "S3") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.room LIKE '%$room%' AND timeincmpt.timein LIKE '02%PM' ORDER BY timeincmpt.timein ASC";                
            }
            else if ($period == "all") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.room LIKE '%$room%' ORDER BY timeincmpt.timein ASC";
            }
            else if ($period == "flh") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.room LIKE 'Flexible Learning Hub' ORDER BY timeincmpt.timein ASC";                
            }
        }
        else if (!empty($_POST['tb']) && !empty($_POST['period'])) {
            $room = $_POST['tb'];
            $period = $_POST['period'];
            if ($period == "S1") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.room LIKE '%$room%' AND timeincmpt.timein LIKE '08%AM' ORDER BY timeincmpt.timein ASC";                
            }
            else if ($period == "S2") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.room LIKE '%$room%' AND timeincmpt.timein LIKE '11%AM' ORDER BY timeincmpt.timein ASC";                
            }
            else if ($period == "S3") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.room LIKE '%$room%' AND timeincmpt.timein LIKE '02%PM' ORDER BY timeincmpt.timein ASC";                
            }
            else if ($period == "all") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.room LIKE '%$room%' ORDER BY timeincmpt.timein ASC";
            }
            else if ($period == "flh") {
                $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID WHERE timeincmpt.room LIKE 'Flexible Learning Hub' ORDER BY timeincmpt.timein ASC";                
            }
        }
        else {
            $query = "SELECT * FROM timeoutcmpt INNER JOIN students on timeoutcmpt.studID = students.studID INNER JOIN timeincmpt on timeoutcmpt.studID = timeincmpt.studID ORDER BY timeincmpt.num ASC";}
    }
    class myPDF extends FPDF{
        function header(){
            $this->SetTextColor(5,28,0);
            $this->SetFont('times','B',18);
            $this->Cell(276,5,'Mariano Marcos State University',0,0,'C');
            $this->Ln();
            $this->SetFont('courier','',14);
            $this->Cell(276,5,'College of Industrial Technology',0,0,'C');
            $this->Ln();
            $this->Cell(276,5,'Laoag City, 2900 Ilocos Norte',0,0,'C');
            $this->Ln(10);
            $this->SetFont('courier','B',13);
            $this->Cell(276,5,'Student Attendance Record',0,0,'C');
            $this->Ln(10);
            $this->SetFont('times','',12);
            $this->Cell(276,5,'Topics/Activities: ________________________________',0,0,'L');
            $this->Ln(10);}
        function footer(){
            $this->SetY(-15);
            $this->SetFont('Courier','',9);
            $this->Cell(0,10,'Page '.$this->PageNo(),0,0);
            $this->SetY(-20);
            $this->SetX(-75);
            $this->SetFont('Courier','B',9);
            $this->Cell(0,10,'____________________________',0,0);
            $this->Ln(6);
            $this->SetX(-74);
            $this->Cell(0,10,'Signature over printed name',0,0);
        }
        function headerTable(){
            $this->SetFont('Courier','B',12);
            $this->Cell(30,10,'First Name',1,0,'C');
            $this->Cell(30,10,'Last Name',1,0,'C');
            $this->Cell(23,10,'PC Number',1,0,'C');
            $this->Cell(45,10,'Teacher',1,0,'C');
            $this->Cell(20,10,'Subject',1,0,'C');
            $this->Cell(33,10,'Room',1,0,'C');
            $this->Cell(28,10,'Time In',1,0,'C');
            $this->Cell(28,10,'Time Out',1,0,'C');
            $this->Cell(38,10,'Date',1,0,'C');
            $this->Ln();}
        function dataTable($conn,$query){
            $this->SetFont('Arial','',10);
            $output = mysqli_query($conn,$query);
            foreach ($output as $row){
                $this->Cell(30,10,$row['fname'],1,0,'C');
                $this->Cell(30,10,$row['lname'],1,0,'C');
                $this->Cell(23,10,$row['PCNum'],1,0,'C');
                $this->Cell(45,10,$row['teacher'],1,0,'C');
                $this->Cell(20,10,$row['subj'],1,0,'C');
                $this->Cell(33,10,$row['room'],1,0,'C');
                $this->Cell(28,10,$row['timein'],1,0,'C');
                $this->Cell(28,10,$row['outtime'],1,0,'C');
                $this->Cell(38,10,$row['dateout'],1,0,'C');
                $this->Ln();}}
    }
    $pdf = new myPDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('L','A4',0);
    $pdf->headerTable();
    $pdf->dataTable($conn,$query);
    $pdf->Output('I','cmpt-attendance.pdf');
?>