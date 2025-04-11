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

     // RAPPORT FINANCIER SUR LE NOMBRE DE COMMANDE
      $call_fin_cmd="SELECT date_depot,
        SUM(montant_verse) AS montant,
        SUM(reste) AS  restant,
        SUM(reduction) AS les_reductions,
        COUNT(date_depot) AS nbre_cmd 
        FROM commande
        JOIN facture ON  commande.id_commande=facture.id_commande
        AND date_depot BETWEEN '$date_x' AND '$date_y'
        GROUP BY date_depot
        ORDER BY date_depot DESC
        LIMIT 31";

      $call_fin_cmd_tt="SELECT date_depot,
        SUM(montant_verse) AS montant_cmd,
        SUM(reste) AS  restant,
        SUM(reduction) AS red,
        COUNT(date_depot) AS nbre_cmd 
        FROM commande,facture 
        WHERE commande.id_commande=facture.id_commande
        AND date_depot BETWEEN '$date_x' AND '$date_y'";

      // Pour tableau
      $fr_cmd=mysqli_query($connect,$call_fin_cmd);
      // Pour afficher les totaux à la fin du tableau
      $cmd_totals=mysqli_query($connect,$call_fin_cmd_tt);

      // Utiliser pour le graphe
      $fr_plt=mysqli_query($connect,$call_fin_cmd);

   // RAPPORT FINANCIER SUR LES RECETTES JOURNALIERE
    $call_fin_recette="SELECT * FROM recette_journaliere 
      JOIN utilisateur ON utilisateur.id_utilisateur=recette_journaliere.id_utilisateur
      AND date_recette BETWEEN '$date_x' AND '$date_y' 
      ORDER BY date_recette DESC
      LIMIT 31";

    $call_fin_recette_tt="SELECT SUM(montant_recette) as montant_recette FROM recette_journaliere 
    JOIN utilisateur ON utilisateur.id_utilisateur=recette_journaliere.id_utilisateur 
    AND date_recette BETWEEN '$date_x' AND '$date_y' ";

    $fr_recette=mysqli_query($connect,$call_fin_recette);

    $recette_totals=mysqli_query($connect,$call_fin_recette_tt);

  // RAPPORT FINANCIER SUR LES DEPENSE JOURNALIERE
    $call_fin_depense="SELECT * FROM depense 
    JOIN utilisateur ON utilisateur.id_utilisateur=depense.id_utilisateur
    AND date_depense BETWEEN '$date_x' AND '$date_y' 
    ORDER BY date_depense DESC
    LIMIT 31";

    $call_fin_depense_tt="SELECT SUM(montant_depense) as montant_depense FROM depense
    JOIN utilisateur ON utilisateur.id_utilisateur=depense.id_utilisateur 
    AND date_depense BETWEEN '$date_x' AND '$date_y' ";

    $fr_depense=mysqli_query($connect,$call_fin_depense);

    $depense_totals=mysqli_query($connect,$call_fin_depense_tt);
  }else{
    echo ' ';

   // RAPPORT FINANCIER SUR LE NOMBRE DE COMMANDE
    $call_fin_cmd="SELECT date_depot,
    SUM(montant_verse) AS montant,
    SUM(reste) AS  restant,
    SUM(reduction) AS les_reductions,
    COUNT(date_depot) AS nbre_cmd 
    FROM commande
    JOIN facture ON  commande.id_commande=facture.id_commande
    GROUP BY date_depot
    ORDER BY date_depot DESC
    LIMIT 31";

    $call_fin_cmd_tt='SELECT date_depot,
      SUM(montant_verse) AS montant_cmd,
      SUM(reste) AS  restant,
      SUM(reduction) AS red
      FROM commande,facture 
      WHERE commande.id_commande=facture.id_commande';

    // Pour tableau
    $fr_cmd=mysqli_query($connect,$call_fin_cmd);
    // Pour afficher les totaux à la fin du tableau
    $cmd_totals=mysqli_query($connect,$call_fin_cmd_tt);

    // Pour graphique
    $fr_plt=mysqli_query($connect,$call_fin_cmd);

  // RAPPORT FINANCIER SUR LES RECETTES JOURNALIERE
    $call_fin_recette="SELECT * FROM recette_journaliere 
      JOIN utilisateur ON utilisateur.id_utilisateur=recette_journaliere.id_utilisateur
      ORDER BY date_recette DESC
      LIMIT 31";

    $call_fin_recette_tt="SELECT SUM(montant_recette) as montant_recette FROM recette_journaliere 
      JOIN utilisateur ON utilisateur.id_utilisateur=recette_journaliere.id_utilisateur ";

    $fr_recette=mysqli_query($connect,$call_fin_recette);
    // Pour afficher les totaux à la fin du tableau
    $recette_totals=mysqli_query($connect,$call_fin_recette_tt);

  // RAPPORT FINANCIER SUR LES DEPENSES JOURNALIERE
    $call_fin_depense="SELECT * FROM depense 
    JOIN utilisateur ON utilisateur.id_utilisateur=depense.id_utilisateur
    ORDER BY date_depense DESC
    LIMIT 31";

    $call_fin_depense_tt="SELECT SUM(montant_depense) as montant_depense FROM depense 
      JOIN utilisateur ON utilisateur.id_utilisateur=depense.id_utilisateur ";

    $fr_depense=mysqli_query($connect,$call_fin_depense);
    // Pour afficher les totaux à la fin du tableau
    $depense_totals=mysqli_query($connect,$call_fin_depense_tt);
  }

  // Retrive totals cmd
  foreach($cmd_totals as $totals_cmd){
    $tt_encaissement=$totals_cmd['montant_cmd'];
    $tt_restant=$totals_cmd['restant'];
    $tt_red=$totals_cmd['red'];
  }
  // Retrive totals incomes
  foreach($recette_totals as $totals_recette){
    $tt_mt_recette=$totals_recette['montant_recette'];
  }
  // Retrive totals expenses
  foreach($depense_totals as $totals_depense){
    $tt_mt_depense=$totals_depense['montant_depense'];
  }

  $pourPDF=mysqli_query($connect,"SELECT *,COUNT(cni_client) AS nbre_fois 
  FROM commande,client 
  WHERE client.id_client=commande.id_client
  GROUP BY nom_client
  ORDER BY COUNT(cni_client) DESC");
  
  
  $z=mysqli_query($connect,'SELECT date_depot,COUNT(date_depot) AS nbre_cmd 
  FROM commande 
  GROUP BY date_depot 
  ORDER BY date_depot DESC ');

require_once '../fpdf186/fpdf.php';
$pdf=new fpdf('p','mm','A4');
$pdf->addPage();
$pdf->setMargins(20,15,20);

$pdf->image('../images/CreateTech.png',10,3,10);
$pdf->ln();
// $pdf->cell(50,7,$date_x,0,1,'c');

$pdf->setFont('Arial','b',9);
$pdf->cell(50,3,nom_logiciel,0,1,'c');
$pdf->ln(10);

$pdf->setFont('arial','b',16);
$pdf->cell(150,5,rapport_sur_commandes,0,1,'c');
$pdf->ln();

$pdf->setfont('arial','b',12);
$pdf->cell(40,5,date,1,0,'c');
$pdf->cell(40,5,encaissement,1,0,'c');
$pdf->cell(40,5,montant_restant,1,0,'c');
$pdf->cell(40,5,mb_convert_encoding(reduction,'ISO-8859-1','UTF-8'),1,1,'c');

$pdf->setfont('arial','',12);
while($this_fin_cmd=mysqli_fetch_assoc($fr_cmd)){
    $pdf->cell(40,5,$this_fin_cmd['date_depot'],1,0,'c');
    $pdf->cell(40,5,$this_fin_cmd['montant'].' FCFA',1,0,'c');
    $pdf->cell(40,5,$this_fin_cmd['restant'].' FCFA',1,0,'c');
    $pdf->cell(40,5,$this_fin_cmd['les_reductions'].' FCFA',1,1,'c');
}
$pdf->ln(10);

$pdf->setFont('arial','b',16);
$pdf->cell(150,5,mb_convert_encoding(rapport_recette,'iso-8859-1','utf-8'),0,1,'c');
$pdf->ln();

$pdf->setfont('arial','b',12);
$pdf->cell(80,5,date,1,0,'c');
$pdf->cell(80,5,montant_recette,1,1,'c');


$pdf->setfont('arial','',12);
while($this_fin_recette=mysqli_fetch_assoc($fr_recette)){
    $pdf->cell(80,5,$this_fin_recette['date_recette'],1,0,'c');
    $pdf->cell(80,5,$this_fin_recette['montant_recette'].' FCFA',1,1,'c');
}

$pdf->ln(10);

$pdf->setFont('arial','b',16);
$pdf->cell(150,5,mb_convert_encoding(rapport_depense,'iso-8859-1','utf-8'),0,1,'c');
$pdf->ln();

$pdf->setfont('arial','b',12);
$pdf->cell(40,5,date,1,0,'c');
$pdf->cell(40,5,mb_convert_encoding(montant_depense,'iso-8859-1','utf-8'),1,0,'c');
$pdf->cell(100,5,mb_convert_encoding(description,'iso-8859-1','utf-8'),1,1,'c');


$pdf->setfont('arial','',12);
while($this_fin_depence=mysqli_fetch_assoc($fr_depense)){
    $pdf->cell(40,5,$this_fin_depence['date_depense'],1,0,'c');
    $pdf->cell(40,5,$this_fin_depence['montant_depense'].' FCFA',1,0,'c');
    $pdf->cell(100,5,mb_convert_encoding($this_fin_depence['raison_depense'],'iso-8859-1','utf-8'),1,1,'c');
}

$pdf->ln(10);

$pdf->setFont('arial','b',16);
$pdf->cell(150,5,mb_convert_encoding(resumer,'iso-8859-1','utf-8'),0,1,'c');
$pdf->ln();

$pdf->setfont('arial','b',12);
$pdf->cell(36,8,mb_convert_encoding(recettes_des_cmd,'iso-8859-1','utf-8'),1,0,'c');
$pdf->cell(36,8,mb_convert_encoding(recette_des_services_tierce,'iso-8859-1','utf-8'),1,0,'c');
$pdf->cell(36,8,mb_convert_encoding(recettes,'iso-8859-1','utf-8'),1,0,'c');
$pdf->cell(36,8,mb_convert_encoding(depenses,'iso-8859-1','utf-8'),1,0,'c');
$pdf->cell(36,8,mb_convert_encoding(resultats,'iso-8859-1','utf-8'),1,1,'c');


$pdf->setfont('arial','b',14);
$pdf->cell(36,8,$tt_encaissement.' F',1,0,'c');
$pdf->cell(36,8,$tt_mt_recette-$tt_encaissement.' F',1,0,'c');
$pdf->cell(36,8,$tt_mt_recette.' F',1,0,'c');
$pdf->cell(36,8,$tt_mt_depense.' F',1,0,'c');
$pdf->cell(36,8, $tt_mt_recette-$tt_mt_depense.' F',1,1,'c');


$pdf->output();
?>