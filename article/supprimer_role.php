<?php
include_once '../connection.php';
$id_role=$_GET['id_role'];
$call_rule=mysqli_query($connect,'SELECT code_role FROM role WHERE id_role="'.$id_role.'" ');
foreach($call_rule as $this_rule){
    $rule_code=$this_rule['code_role'];
}
$del=mysqli_query($connect,'DELETE FROM role WHERE id_role="'.$id_role.'"');
// var_dump($del);
if($del){
    header('location:liste_roles.php?status=Catégorie supprimé avec succès');
}else{
    header("location:liste_roles.php?status=Ce rôle n'a pas été supprimé
    car des utilisateurs joue ce rôle. Pour que cette suppression soit effective veillez dabord supprimer les utilisateurs
    dont le rôle est \"$rule_code\" ");
}

?>