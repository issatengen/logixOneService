<?php
session_start();
$id_commande=$_GET['id_commande'];
include_once '../connection.php';
$montant=mysqli_query($connect,'SELECT SUM(montant) AS montant_total FROM commande_article WHERE id_commande="'.$id_commande.'"');
while($le_montant_total=mysqli_fetch_assoc($montant)){
    $sous_total=$le_montant_total['montant_total'];
}
$red=mysqli_query($connect,'SELECT SUM(reduction) AS reduction FROM facture WHERE id_commande="'.$id_commande.'"');
while($reduction_total=mysqli_fetch_assoc($red)){
    $reduction=$reduction_total['reduction'];
}
$montant_verse=mysqli_query($connect,'SELECT SUM(montant_verse) AS montant_verse FROM facture WHERE id_commande="'.$id_commande.'" ');
while($le_mt_verse=mysqli_fetch_assoc($montant_verse)){
    $mt_verse=$le_mt_verse['montant_verse'];
}
$art_commande=mysqli_query($connect,'SELECT designation,quantite_art,prix_unitaire_art,montant 
FROM article,commande_article 
WHERE article.id_article=commande_article.id_article 
AND id_commande="'.$id_commande.'"');
$client=mysqli_query($connect,'SELECT nom_client,prenom_client,date_depot,date_estimatrice,id_commande,date_retrait,code_commande 
FROM client,commande 
WHERE client.id_client=commande.id_client 
AND id_commande="'.$id_commande.'"');
while($le_client=mysqli_fetch_assoc($client)){
    $clt=$le_client['nom_client'];
    $prenom_clt=$le_client['prenom_client'];
    $date_depot=$le_client['date_depot'];
    $date_estimatrice=$le_client['date_estimatrice'];
    $date_retrait=$le_client['date_retrait'];
    $code_commande=$le_client['code_commande'];
}

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

require '../fpdf186/fpdf.php';

$pdf=new fpdf('p','mm','A4');
$pdf->addPage();
$pdf->setMargins(20,15,20);

$pdf->image('../images/CreateTech.png',10,3,10);
$pdf->ln();
// $pdf->cell(50,7,$date_x,0,1,'c');

$pdf->setFont('Arial','b',9);
$pdf->cell(50,3,nom_logiciel,0,1,'c');
$pdf->ln(3);

$pdf->Ln();
$pdf->SetFont('Arial','B',22);

$pdf->Cell(70,10,nom_entreprise,0,1,'L');
//$pdf->Ln();

$pdf->SetFont('Arial','B',12);
$pdf->Cell(50,5,ville,0);
$pdf->Ln();

$pdf->SetFont('Arial','B',12);
$pdf->Cell(35,5,telephone,0,1,'C');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(50,5,mb_convert_encoding(lieu,'ISO-8859-1','UTF-8'),0,1,'C');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(70,5,lieu_precis,0,'C');


$pdf->SetFont('Arial','B',12);
$pdf->Cell(300,5,'Date depot'.': '.$date_depot,0,1,'C');


$pdf->SetFont('Arial','B',12);
$pdf->Cell(290,5,date_estimatrice.': '.$date_estimatrice,0,1,'C');
//$pdf->Ln();


$pdf->SetFont('Arial','B',12);
$pdf->Cell(300,5,date_retrait.': '.$date_retrait,0,1,'C');
//$pdf->Ln();

// Avant le tableau
$pdf->Ln();
$pdf->SetFont('Times','b',14);
$pdf->Cell(0,5,client.': '.$clt.' '.$prenom_clt,0,2);
$pdf->Cell(180,1,'',0,1);
$pdf->Ln();
$pdf->Cell(0,5,num_cmd.': '.$code_commande,0,2);
$pdf->Cell(180,1,'',0,1);
$pdf->Ln();
$pdf->Cell(0,5,'',0,0);
$pdf->Ln();


$pdf->SetFont('Arial','B',12);
$pdf->Cell(45,5,'Designation',1,0,'C');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(45,5,'Quantite',1,0,'C');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(45,5,prix_unitaire,1,0,'C');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(45,5,montant,1,1,'C');



while($articles_commandes=mysqli_fetch_assoc($art_commande)){
    $designation=$articles_commandes['designation'];
    $quantite_art=$articles_commandes['quantite_art'];
    $prix_unitaire_art=$articles_commandes['prix_unitaire_art'];
    $montant=$articles_commandes['montant'];
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(45,8,$designation,0,0,'C');

    $pdf->SetFont('Arial','',12);
    $pdf->Cell(45,8,$quantite_art,0,0,'C');

    $pdf->SetFont('Arial','',12);
    $pdf->Cell(45,8,$prix_unitaire_art.' FCFA',0,0,'C');

    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(45,8,$montant.' FCFA',0,1,'C');
}


$quantite=mysqli_query($connect,'SELECT SUM(quantite_art) AS quantite_totale FROM commande_article WHERE id_commande="'.$id_commande.'"');
while($la_quantite=mysqli_fetch_assoc($quantite)){
    $la_qt=$la_quantite['quantite_totale'];
}
$pdf->SetFont('Arial','',12);
$pdf->Cell(45,5,'',0,1,'C');


$pdf->SetFont('Arial','B',12);
$pdf->Cell(45,5,nombre_articles,1,'C');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(45,5,$la_qt,1,'C');

$pdf->SetFont('Arial','',12);
$pdf->Cell(45,5,'',0,'C');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(45,5,'',0,1,'C');



$pdf->SetFont('Arial','',12);
$pdf->Cell(135,10,net_commercial,0,0,'R');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(45,10,$sous_total.' FCFA',1,1,'C');



$pdf->setFont('Arial','','12');
$pdf->Cell(135,10,'Montant verse',0,0,'R');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(45,10,-$mt_verse.' FCFA',1,1,'C');



$pdf->setFont('Arial','','12');
$pdf->Cell(135,10,'Reduction',0,0,'R');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(45,10,-$reduction.' FCFA',1,1,'C');



$reste=$sous_total-($mt_verse+$reduction);

$pdf->setFont('Arial','','12');
$pdf->Cell(135,10,montant_restant,0,0,'R');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(45,10,$reste.' FCFA',1,1,'C');


$pdf->SetFont('Arial','B',12);
$pdf->Cell(50,30,signature_agent,0,0,'R');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(200,30,signature_client,0,1,'C');

$pdf->SetFont('Arial','',6);
$pdf->Cell(0,5,' ',0,20,'C');

$pdf->SetFont('Arial','',6);
$pdf->Cell(0,5,'Designed by TengTech',0,0,'C');

$pdf->SetFont('Arial','',6);
$pdf->Cell(200,0,'Email: issatengen@outlook.com',0,1,'C');


$pdf-> Output();
?>