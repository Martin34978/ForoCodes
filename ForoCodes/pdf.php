<?php
require('fpdf/fpdf.php');
require_once('View/view.php');
require_once('Controllers/controller.php');

$catID = $_GET['catID'];

$replies = showReplies();

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
$topicID = $_GET['topicID'];
$i = showTopicName($topicID);
$topicName = implode($i[0]);
    // Logo
//$this->Image('logo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Helvetica','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(50,10,$topicName,1,0,'C');
    // Salto de línea
    $this->Ln(20);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Helvetica','',14);
//var_dump($replies);
$pdf->setY(50);

$pdf->setFillColor(233,239,235);
for($i=0;$i<sizeof($replies);$i++){
    
    $out= $replies[$i]['replyContent'];
    $autorID = $replies[$i]['userID'];
    $autorArray= getUsrName($autorID);
    $autor = $autorArray[0]['userName'];
    
    $pdf->Cell(0,10,utf8_decode('Autor: '.$autor),0,1,'L',0);
    $pdf->Cell(0,10,utf8_decode($out),0,1,'C',1);
}
$pdf->Output();
?>