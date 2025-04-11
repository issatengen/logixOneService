<?php
session_start();
$code=$_SESSION['code'];
include_once '../connection.php';
$call=$connect->prepare('SELECT id_utilisateur FROM utilisateur WHERE code_utilisateur=?');
$call->bind_param('s', $code);
$call-> execute();
$result=$call-> get_result();
foreach($result as $userId){
    $id_utilisateur=$userId['id_utilisateur'];
}

$del=$connect->prepare('DELETE FROM profile_picture WHERE id_utilisateur=?');
$del->bind_param('i', $id_utilisateur);
$del->execute();

if($_SERVER['REQUEST_METHOD'] == 'POST' ){
    $image_name=$_FILES['profile']['name'];
    $image_tmp_name=$_FILES['profile']['tmp_name'];
    $image_size=$_FILES['profile']['size'];
    $image_type=$_FILES['profile']['type'];

    $destination='../images/upload/'. $image_name;
    move_uploaded_file($image_tmp_name,$destination);
    
    // insertion into database

    $insertion=$connect->prepare('INSERT INTO profile_picture(image_name,image_tmp_name,id_utilisateur) VALUES(?,?,?)');
    $insertion->bind_param('ssi',$image_name,$image_tmp_name,$id_utilisateur);
    $insertion->execute();
    header('location:profile.php');
}else{
    echo 'Error';
    exit;
}
?>