<?php
    include '../connection.php';
    $clt=mysqli_query($connect,"SELECT *,COUNT(cni_client) AS nbre_fois 
    FROM commande,client 
    WHERE client.id_client=commande.id_client
    GROUP BY nom_client
    ORDER BY COUNT(cni_client) DESC");

    include '../fpdf186/fpdf.php';
    $pdf=new fpdf('p','mm','A4');
    $pdf -> Addpage(); 
    $pdf -> setMargins(20,15,5);
    $pdf -> Ln();

    $pdf -> setFont('Times','b',20);
    $pdf -> Cell(50,20,'Rapport sur les clients',0,1,'L');

    $pdf -> setfont('times','b',13);
    $pdf -> cell(45,5,'Nom',1,0,'c');
    $pdf -> cell(45,5,mb_convert_encoding('Prénom','ISO-8859-1','UTF-8'),1,0,'c');
    $pdf -> cell(45,5,'Nombre commandes',1,1,'c');

    while($client=mysqli_fetch_assoc($clt)){

     $pdf -> setFont('times','',12);
     $pdf -> cell(45,5,mb_convert_encoding($client['nom_client'],'ISO-8859-1','UTF-8'),1,0);
     $pdf -> cell(45,5,mb_convert_encoding($client['prenom_client'],'ISO-8859-1','UTF-8'),1,0);
     $pdf -> cell(45,5,$client['nbre_fois'],1,1);
    }
    $pdf -> Output();
?>