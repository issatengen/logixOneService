<?php
$id_role=$_GET['id_role'];
$libelle=$_POST['libelle'];
$code_role=$_POST['code_role'];
include '../connection.php';
$modifie=mysqli_query($connect,'UPDATE role SET code_role="'.$code_role.'",libelle="'.$libelle.'" WHERE id_role="'.$id_role.'"');
// var_dump($modifie);
header ('location:liste_roles.php');
?>