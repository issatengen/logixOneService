<?php
session_start();
if(isset($_SESSION['langue'])){
    $langue=$_SESSION['langue'];
}else{
    $langue=substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
}
if($langue=='fr'){
    include_once '../langue/francais.php';
}else{
    include_once '../langue/anglais.php';
}

include_once '../connection.php';

if(isset($_GET['date_x']) and isset($_GET['date_y'])){
    $date_x=$_GET['date_x'];
    $date_y=$_GET['date_y'];

    $appel=mysqli_query($connect,"SELECT * FROM depense 
    JOIN utilisateur ON utilisateur.id_utilisateur=depense.id_utilisateur
    AND date_depense BETWEEN '$date_x' AND '$date_y' 
    ORDER BY date_depense DESC ");

    $x=mysqli_query($connect,"SELECT SUM(montant_depense) as montant FROM depense 
    JOIN utilisateur ON utilisateur.id_utilisateur=depense.id_utilisateur 
    AND date_depense BETWEEN '$date_x' AND '$date_y' ");
}else{
    echo ' ';
    $appel=mysqli_query($connect,'SELECT * FROM depense 
    JOIN utilisateur ON utilisateur.id_utilisateur=depense.id_utilisateur
    ORDER BY date_depense DESC');

    $x=mysqli_query($connect,'SELECT SUM(montant_depense) as montant FROM depense 
    JOIN utilisateur ON utilisateur.id_utilisateur=depense.id_utilisateur ');
}
foreach($x as $y){
    $montant=$y['montant'];
}
  
// Calling the library
require_once '../fpdf186/fpdf.php';

$pdf = new FPDF('P','mm','A4');
$pdf->Addpage();
$pdf->AliasNbPages();
$pdf->setMargins(20,15,20);
$pdf->Ln();

$pdf->image('../images/CreateTech.png',10,3,10);
$pdf->setFont('Arial','b',9);
$pdf->cell(50,3,nom_logiciel,0,1,'c');

$pdf->setFont('arial','b',20);
$pdf->Cell(150,20,nom_entreprise,0,1,'C');

$pdf->setFont('arial','b',14);
$pdf->cell(150,7,mb_convert_encoding(depense,'ISO-8859-1','UTF-8'),0,1,'c');
$pdf->setFont('arial','b',11);
// $pdf->cell(150,7,$month.' '. $year,0,1,'c');

$pdf->ln(5);

$pdf->setFont('arial','b',12);
$pdf->cell(40,5,date,1,0,'c');
$pdf->cell(40,5,mb_convert_encoding(montant_depense,'ISO-8859-1','UTF-8'),1,0,'c');
$pdf->cell(100,5,mb_convert_encoding(description,'ISO-8859-1','UTF-8'),1,1,'c');
// $pdf->cell(40,5,caisse,1,1,'c');

while($this_appel=mysqli_fetch_assoc($appel)){
    $pdf->setFont('arial','',12);
    $pdf->cell(40,8,$this_appel['date_depense'],1,0,'c');
    $pdf->cell(40,8,$this_appel['montant_depense'].'  FCFA',1,0,'c');
    $pdf->cell(100,8,mb_convert_encoding($this_appel['raison_depense'],'ISO-8859-1','UTF-8'),1,1,'c');
    // $pdf->cell(40,5,$this_appel['montant_depense']*(10/100),1,1);
}

$pdf->setFont('arial','b',12);
$pdf->cell(50,8,'Total ',0,0);
$pdf->MultiCell(50,8,$montant.'  FCFA',0,1);

$pdf->ln(15);
$pdf->SetFont('Arial','',6);
$pdf->Cell(0,5,'Designed by TengTech',0,1,'C');

$pdf->SetFont('Arial','',6);
$pdf->Cell(170,0,'Email: issatengen@outlook.com',0,1,'C');

$pdf->output();
?>