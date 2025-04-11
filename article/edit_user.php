<?php
include_once '../connection.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $nom_utilisateur=$_POST['nom_utilisateur'];
    $prenom_utilisateur=$_POST['prenom_utilisateur'];
    $email_utilisateur=$_POST['email_utilisateur'];
    $adresse_utilisateur=$_POST['adresse_utilisateur'];
    $job=$_POST['job'];
    $tel_utilisateur=$_POST['tel_utilisateur'];
    $company=$_POST['company'];
    $about=$_POST['about'];
    $id_utilisateur=$_GET['id_utilisateur'];
    echo $nom_utilisateur.'<br> '. $prenom_utilisateur.'<br> '. $email_utilisateur.'<br> '. $adresse_utilisateur.'<br> '. $job;
    echo '<br> '. $tel_utilisateur.' <br>'. $company.'<br> '. $about.' <br>'. $id_utilisateur;
    $sql='UPDATE utilisateur 
    SET nom_utilisateur=?, prenom_utilisateur=?, email_utilisateur=?, adresse_utilisateur=?, job=?, tel_utilisateur=?, company=?, about=?
    WHERE id_utilisateur=?';
    $update=$connect->prepare($sql);
    $update->bind_param('ssssssssi',$nom_utilisateur, $prenom_utilisateur, $email_utilisateur, $adresse_utilisateur, $job, $tel_utilisateur, $company, $about, $id_utilisateur);
    $update->execute();
    var_dump($update);
    header('location:profile.php');
}
?>