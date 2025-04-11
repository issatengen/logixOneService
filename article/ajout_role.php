<?php
include '../connection.php';
$code_role=$_POST['code_role'];
$libelle=$_POST['libelle'];
$id_role=$_POST['id_role'];
$ad_role=mysqli_query($connect,'INSERT INTO role(code_role,libelle,id_role) VALUES("'.$code_role.'","'.$libelle.'","'.$id_role.'")');
var_dump($ad_role);
// header('location:liste_roles.php');
?>