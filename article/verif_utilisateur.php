<?php
  include_once 'connection.php';
  $user=mysqli_query($connect,'SELECT * FROM utilisateur');
  while($users=mysqli_fetch_assoc($user)){
    $id_role=$users['id_role'];
    $code=$users['code_utilisateur'];
  }
  if($id_role=0 AND $code=""){
    header('location:liste_utilisateurs.php');
  }else{
    echo 'Seuls les administrateurs peuvent avoir access a cette page';
  }

  
  
?>