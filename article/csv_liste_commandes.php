<?php
    include '../connection.php';
    $commande=mysqli_query($connect,'SELECT nom_client,prenom_client,nom_utilisateur,prenom_utilisateur,id_commande,date_depot,date_estimatrice,date_retrait 
    FROM client,commande,utilisateur 
    WHERE client.id_client=commande.id_client 
    AND utilisateur.id_utilisateur=commande.id_utilisateur 
    ORDER BY id_commande DESC');
    $excel="";
    $excel .="Date_depot\tDate_estimatrice\tDate_retrait\tNom_client\tPrenom_client\tAgent";
    foreach($commande as $la_cmd){
        $excel .="
        {$la_cmd['date_depot']}\t{$la_cmd['date_estimatrice']}\t{$la_cmd['date_retrait']}\t{$la_cmd['nom_client']}\t{$la_cmd['prenom_client']}\t{$la_cmd['nom_utilisateur']}";
    }
    header('content-type: application/xls');
    header('content-disposition: attachment; filename=listeCMD.xls');
    print $excel;
    exit;
?>
