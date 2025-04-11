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

    $appel=mysqli_query($connect,"SELECT * FROM recette_journaliere 
    JOIN utilisateur ON utilisateur.id_utilisateur=recette_journaliere.id_utilisateur
    AND date_recette BETWEEN '$date_x' AND '$date_y' 
    ORDER BY date_recette DESC ");

    $tt_recette=mysqli_query($connect,"SELECT SUM(montant_recette) as montant, SUM(banque) as banque, SUM(caisse) as caissee FROM recette_journaliere 
    JOIN utilisateur ON utilisateur.id_utilisateur=recette_journaliere.id_utilisateur 
    AND date_recette BETWEEN '$date_x' AND '$date_y' ");
    
    // retrieve data from caisse
    $caisse=$connect->prepare('SELECT montant_caisse,date_caisse FROM caisse WHERE date_caisse BETWEEN ? AND ?');
    $caisse->bind_param('ss',$date_x,$date_y);
    $caisse->execute();
    $resultCaisse=$caisse->get_result();

    $tt_caisse=$connect->prepare('SELECT SUM(montant_caisse) AS mt_caisse FROM caisse WHERE date_caisse BETWEEN ? AND ?');
    $tt_caisse->bind_param('ss',$date_x,$date_y);
    $tt_caisse->execute();
    $resultTtCaisse=$tt_caisse->get_result();
}else{
    echo ' ';
    $appel=mysqli_query($connect,'SELECT * FROM recette_journaliere 
    JOIN utilisateur ON utilisateur.id_utilisateur=recette_journaliere.id_utilisateur
    ORDER BY date_recette DESC');

    $tt_recette=mysqli_query($connect,'SELECT SUM(montant_recette) as montant, SUM(banque) as banque, SUM(caisse) as caissee FROM recette_journaliere 
    JOIN utilisateur ON utilisateur.id_utilisateur=recette_journaliere.id_utilisateur ');

    // retrieve data from caisse
    $caisse=$connect->prepare('SELECT montant_caisse,date_caisse FROM caisse ');
    $caisse->execute();
    $resultCaisse=$caisse->get_result();

    $tt_caisse=$connect->prepare('SELECT SUM(montant_caisse) AS mt_caisse FROM caisse ');
    $tt_caisse->execute();
    $resultTtCaisse=$tt_caisse->get_result();
}
foreach($tt_recette as $y){
    $montant=$y['montant'];
    $banque=$y['banque'];
    $caissee=$y['caissee'];
}
foreach($resultTtCaisse as $z){
    $mt_caisse=$z['mt_caisse'];
}
  
// Calling the library
require_once '../fpdf186/fpdf.php';

$pdf = new FPDF('P','mm','A4');
$pdf->Addpage();
$pdf->AliasNbPages();
$pdf->setMargins(20,15,20);
$pdf->Ln();

$pdf->image('../images/CreateTech.png',10,3,10);

$pdf->setFont('arial','b',20);
$pdf->Cell(150,20,'Foncham & Sons Enterprise',0,1,'C');

$pdf->setFont('arial','b',14);
$pdf->cell(150,7,mb_convert_encoding(recettes,'ISO-8859-1','UTF-8'),0,1,'c');
$pdf->setFont('arial','b',11);
// $pdf->cell(150,7,$month.' '. $year,0,1,'c');

$pdf->ln(5);

$pdf->setFont('arial','b',12);
$pdf->cell(40,8,date,1,0,'c');
$pdf->cell(40,8,montant_recette,1,0,'c');
$pdf->cell(40,8,banque,1,0,'c');
$pdf->cell(40,8,caisse,1,1,'c');

while($this_appel=mysqli_fetch_assoc($appel)){
    $pdf->setFont('arial','',12);
    $pdf->cell(40,8,$this_appel['date_recette'],1,0);
    $pdf->cell(40,8,$this_appel['montant_recette'].'  FCFA',1,0);
    $pdf->cell(40,8,$this_appel['banque'].'  FCFA',1,0);
    $pdf->cell(40,8,$this_appel['caisse'].'  FCFA',1,1);
}
$pdf->setFont('arial','b',12);
$pdf->cell(40,8,'Total ',0,0);
$pdf->cell(40,8,$montant.'  FCFA',0,0);
$pdf->cell(40,8,$banque.'  FCFA',0,0);
$pdf->cell(40,8,$caissee.'  FCFA',0,1);
$pdf->Ln(10);

$pdf->setFont('arial','b',14);
$pdf->cell(50,8,caisse,0,2,'c');
$pdf->setFont('arial','b',12);
$pdf->cell(80,8,date,1,0,'c');
$pdf->cell(80,8,'Caisse',1,1,'c');
while($thisCaisse=mysqli_fetch_assoc($resultCaisse)){
    $pdf->setFont('arial','',12);
    $pdf->cell(80,8,$thisCaisse['date_caisse'],1,0);
    $pdf->cell(80,8,$thisCaisse['montant_caisse'].' FCFA',1,1);
}

$pdf->setFont('arial','b',12);
$pdf->cell(80,8,'Total ',0,0);
$pdf->cell(80,8,$mt_caisse.'  FCFA',0,1);


$pdf->output();
?>