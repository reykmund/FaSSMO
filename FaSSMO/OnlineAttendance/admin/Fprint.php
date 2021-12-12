<?php
require "fpdf.php";
include "../connect2db.php";
if (isset($_POST['Fac_printnow'])) {
        if (empty($_POST['aldaw']) && empty($_POST['faculty'])) {
            $query = "SELECT * FROM faculty_timeout INNER JOIN faculty on faculty_timeout.idnumber = faculty.idnumber INNER JOIN faculty_timein on faculty_timeout.idnumber = faculty_timein.idnumber ORDER BY faculty_timein.datein ASC";
        }
        else if (!empty($_POST['aldaw']) || !empty($_POST['faculty'])) {
            if (!empty($_POST['faculty']) && empty($_POST['aldaw'])) {
                $idnumber = $_POST['faculty'];
                $query = "SELECT * FROM faculty_timeout INNER JOIN faculty on faculty_timeout.idnumber = faculty.idnumber INNER JOIN faculty_timein on faculty_timeout.idnumber = faculty_timein.idnumber WHERE faculty_timein.idnumber LIKE '%$idnumber%' ORDER BY faculty_timein.datein ASC";                
            }
            else if (!empty($_POST['aldaw']) && empty($_POST['faculty'])) {
                $date = $_POST['aldaw'];
                $query = "SELECT * FROM faculty_timeout INNER JOIN faculty on faculty_timeout.idnumber = faculty.idnumber INNER JOIN faculty_timein on faculty_timeout.idnumber = faculty_timein.idnumber WHERE faculty_timein.datein LIKE '%$date%' ORDER BY faculty_timein.datein ASC";                
            }
            else if (!empty($_POST['aldaw']) && !empty($_POST['faculty'])) {
                $date = $_POST['aldaw'];
                $idnumber = $_POST['faculty'];
                $query = "SELECT * FROM faculty_timeout INNER JOIN faculty on faculty_timeout.idnumber = faculty.idnumber INNER JOIN faculty_timein on faculty_timeout.idnumber = faculty_timein.idnumber WHERE faculty_timein.idnumber LIKE '%$idnumber%' AND faculty_timein.datein LIKE '%$date%' ORDER BY faculty_timein.datein ASC";                
            }
        }
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
            $this->Cell(276,5,'Faculty Attendance Record',0,0,'C');
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
            $this->Cell(36,10,'ID Number',1,0,'C');
            $this->Cell(28,10,'',1,0,'C');
            $this->Cell(50,10,'First Name',1,0,'C');
            $this->Cell(50,10,'Last Name',1,0,'C');
            $this->Cell(32,10,'Time In',1,0,'C');
            $this->Cell(32,10,'Time Out',1,0,'C');
            $this->Cell(40,10,'Date',1,0,'C');
            $this->Ln();}
        function dataTable($conn,$query){
            $this->SetFont('Arial','',11);
            $output = mysqli_query($conn,$query);
            foreach ($output as $row){
                $this->Cell(36,10,$row['idnumber'],1,0,'C');
                $this->Cell(28,10,$row['honorific'],1,0,'C');
                $this->Cell(50,10,$row['firstname'],1,0,'C');
                $this->Cell(50,10,$row['lastname'],1,0,'C');
                $this->Cell(32,10,$row['timein'],1,0,'C');
                $this->Cell(32,10,$row['outtime'],1,0,'C');
                $this->Cell(40,10,$row['dateout'],1,0,'C');
                $this->Ln();}}
    }
    $pdf = new myPDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('L','A4',0);
    $pdf->headerTable();
    $pdf->dataTable($conn,$query);
    $pdf->Output('I','faculty-attendance.pdf');
?>