<?php
include '../connection.php';
$callLastuser=mysqli_query($connect,'SELECT MAX(id_utilisateur) AS nomberUser FROM utilisateur');
foreach($callLastuser as $number){
    $code=$number['nomberUser']+1;
}
$code_utilisateur='USER'.$code;
$nom_utilisateur=$_POST['nom_utilisateur'];
$prenom_utilisateur=$_POST['prenom_utilisateur'];
$about=$_POST['about'];
$adresse_utilisateur=$_POST['adresse_utilisateur'];
$tel_utilisateur=$_POST['tel_utilisateur'];
$email_utilisateur=$_POST['email_utilisateur'];
$id_role=$_POST['id_role'];
$password_uts=$_POST['password_utilisateur'];
$password_utilisateur=password_hash($password_uts,PASSWORD_DEFAULT);

// requete preparée plus sécurisée contre les injection SQL / prepared query more secure againts SQL injections
$query='INSERT INTO utilisateur(code_utilisateur,nom_utilisateur,prenom_utilisateur,about,adresse_utilisateur,tel_utilisateur,email_utilisateur,id_role,pass)
VALUES(?,?,?,?,?,?,?,?,?)';
$insertUser=$connect->prepare($query);
$insertUser->bind_param('sssssssis',$code_utilisateur,$nom_utilisateur,$prenom_utilisateur,$about,$adresse_utilisateur,$tel_utilisateur,$email_utilisateur,$id_role,$password_utilisateur);
$insertUser->execute();

//requete non preparé (Moin sécurisée) / Non prepared query (less secure)
   /* $ajout_util=mysqli_query($connect,'INSERT INTO utilisateur(code_utilisateur,nom_utilisateur,prenom_utilisateur,about,adresse_utilisateur,tel_utilisateur,email_utilisateur,id_role,pass) 
    VALUES("'.$code_utilisateur.'","'.$nom_utilisateur.'","'.$prenom_utilisateur.'","'.$about.'","'.$adresse_utilisateur.'","'.$tel_utilisateur.'","'.$email_utilisateur.'","'.$id_role.'","'.$password_utilisateur.'")');
   */
    $image_name=$_FILES['profile']['name'];
    $image_tmp_name=$_FILES['profile']['tmp_name'];
    $image_size=$_FILES['profile']['size'];
    $image_type=$_FILES['profile']['type'];

    $destination='../images/upload/'. $image_name;
    move_uploaded_file($image_tmp_name,$destination);
    // insertion into database

    $insertion=$connect->prepare('INSERT INTO profile_picture(image_name,image_tmp_name,id_utilisateur) VALUES(?,?,?)');
    $insertion->bind_param('ssi',$image_name,$image_tmp_name,$code);
    $insertion->execute();
    header('location:profile.php');

// header('location:liste_utilisateurs.php');
?>