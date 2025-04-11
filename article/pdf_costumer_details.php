<?php
session_start();
include '../connection.php';
if(isset($_GET['cni_client'])){
  $cni_client=$_GET['cni_client'];
  $detail=mysqli_query($connect,"SELECT * FROM client 
  JOIN commande ON client.id_client=commande.id_client
  JOIN commande_article ON commande.id_commande=commande_article.id_commande
  JOIN article ON article.id_article=commande_article.id_article
  WHERE cni_client='".$cni_client."' ");

  // Pour nom et prenom
  $detail2=mysqli_query($connect,"SELECT * FROM client 
  JOIN commande ON client.id_client=commande.id_client
  JOIN commande_article ON commande.id_commande=commande_article.id_commande
  JOIN article ON article.id_article=commande_article.id_article
  WHERE cni_client='".$cni_client."' ");

  while($nomPrenom=mysqli_fetch_assoc($detail2)){
    $nom=$nomPrenom['nom_client'];
    $prenom=$nomPrenom['prenom_client'];
  }
}else{
  echo " ";
}

require_once '../fpdf186/fpdf.php';
if(isset($_SESSION['langue'])){
  if(!empty($_SESSION['langue'])){
      $langue=$_SESSION['langue'];
  }
}else{
  $langue=substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
}
if($langue=="en"){
  include_once '../langue/anglais.php';
}else{
  include_once '../langue/francais.php';
}


$pdf= new FPDF('l','mm','A5');
$pdf-> AliasNbPages();
$pdf-> Addpage();
$pdf->setX(30);

$pdf->image('../images/CreateTech.png',10,3,10);
$pdf->ln(4);
$pdf->setFont('Arial','b',9);
$pdf->cell(50,3,nom_logiciel,0,1,'c');
$pdf->ln(3);
$pdf-> Ln(10);
$pdf-> setfont('arial','b',18);
$pdf-> cell(70,7,'Detail du client:',0,0,'C');
$pdf-> setfont('arial','b',16);
$pdf->setTextColor(0,0,200);
$pdf-> cell(70,7,$nom .' '. $prenom,0,1,'c');

$pdf-> Ln();
$pdf->setFont('arial','b',12);
$pdf->setTextColor(0);
$pdf->cell(35,5,'Article',1,0,'c');
$pdf->cell(35,5,'Quantite',1,0,'c');
$pdf->cell(35,5,'Date depot',1,0,'c');
$pdf->cell(35,5,'Date estimatrice',1,0,'c');
$pdf->cell(35,5,'Date retrait',1,1,'c');

while($liste=mysqli_fetch_assoc($detail)){
    $pdf->setFont('arial','',12);
    $pdf->cell(35,5,mb_convert_encoding($liste['designation'],'ISO-8859-1','UTF-8'),1,0,'');
    $pdf->cell(35,5,$liste['quantite_art'],1,0,'c');
    $pdf->cell(35,5,$liste['date_depot'],1,0,'c');
    $pdf->cell(35,5,$liste['date_estimatrice'],1,0,'c');
    $pdf->cell(35,5,$liste['date_retrait'],1,1,'c');
}


$pdf->output();
?>