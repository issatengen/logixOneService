<?php
    include '../connection.php';
    $appel=mysqli_query($connect,'SELECT * FROM depense,utilisateur 
    WHERE utilisateur.id_utilisateur=depense.id_utilisateur ');
    $excel="";
    $excel .="Date_depense\tLibelle\tDescription\tMontant\tAgent";
    foreach($appel as $depenses){
        $excel .="
        {$depenses['date_depense']}\t{$depenses['libelle_depense']}\t{$depenses['raison_depense']}\t{$depenses['montant_depense']}\t{$depenses['nom_utilisateur']}";
    }
    header('content-type: application/xls');
    header('content-disposition:attachment; filename=listeDepenses.xls');
    print $excel;
    exit;
?>