<?php
require "fpdf.php";
include "../connect2db.php";
if (isset($_POST['V_printnow'])) {
    if ($_POST['bulan'] == 'all') {
        $query = "SELECT * FROM visitor_log ORDER BY visitor_log.datein ASC";
    }
    else {
        if (!empty($_POST['bulan'] && !empty($_POST['araw']) && !empty($_POST['tawen']))) {
            $date = $_POST['bulan'].' '.$_POST['araw'].', '.$_POST['tawen'];
            $query = "SELECT * FROM visitor_log WHERE datein LIKE '%$date%' ORDER BY visitor_log.datein ASC";

        }
        else if (!empty($_POST['bulan'] && empty($_POST['araw']) && empty($_POST['tawen']))) {
            $date = $_POST['bulan'];
            $query = "SELECT * FROM visitor_log WHERE datein LIKE '%$date%' ORDER BY visitor_log.datein ASC";

        }
        else if (empty($_POST['bulan'] && !empty($_POST['araw']) && empty($_POST['tawen']))) {
            $date = $_POST['araw'].', ';
            $query = "SELECT * FROM visitor_log WHERE datein LIKE '%$date%' ORDER BY visitor_log.datein ASC";

        }
        else if (empty($_POST['bulan'] && empty($_POST['araw']) && !empty($_POST['tawen']))) {
            $date = $_POST['tawen'];
            $query = "SELECT * FROM visitor_log WHERE datein LIKE '%$date%' ORDER BY visitor_log.datein ASC";

        }
        else if (!empty($_POST['bulan'] && !empty($_POST['araw']) && empty($_POST['tawen']))) {
            $date = $_POST['bulan'].' '.$_POST['araw'];
            $query = "SELECT * FROM visitor_log WHERE datein LIKE '%$date%' ORDER BY visitor_log.datein ASC";

        }
        else if (!empty($_POST['bulan'] && empty($_POST['araw']) && !empty($_POST['tawen']))) {
            $date = $_POST['bulan'].'%'.$_POST['tawen'];
            $query = "SELECT * FROM visitor_log WHERE datein LIKE '%$date%' ORDER BY visitor_log.datein ASC";

        }
        else if (empty($_POST['bulan'] && !empty($_POST['araw']) && !empty($_POST['tawen']))) {
            $date = $_POST['araw'].', '.$_POST['tawen'];
            $query = "SELECT * FROM visitor_log WHERE datein LIKE '%$date%' ORDER BY visitor_log.datein ASC";

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
            $this->Cell(276,5,'Visitor Log',0,0,'C');
            $this->Ln(10);
            $this->SetFont('times','',12);
            /*$this->Cell(276,5,'Topics/Activities: ________________________________',0,0,'L');*/
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
            $this->Cell(80,10,'Full Name',1,0,'C');
            $this->Cell(80,10,'Purpose',1,0,'C');
            $this->Cell(50,10,'Time In',1,0,'C');
            $this->Cell(60,10,'Date',1,0,'C');
            $this->Ln();}
        function dataTable($conn,$query){
            $this->SetFont('Arial','',11);
            $output = mysqli_query($conn,$query);
            foreach ($output as $row){
                $this->Cell(80,10,$row['fullname'],1,0,'C');
                $this->Cell(80,10,$row['purpose'],1,0,'C');
                $this->Cell(50,10,$row['timein'],1,0,'C');
                $this->Cell(60,10,$row['datein'],1,0,'C');
                $this->Ln();}}
    }
    $pdf = new myPDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('L','A4',0);
    $pdf->headerTable();
    $pdf->dataTable($conn,$query);
    $pdf->Output('I','visitor-log.pdf');
?>