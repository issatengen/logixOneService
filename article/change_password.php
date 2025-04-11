<?php
include_once '../connection.php';
$call=$connect->prepare('SELECT pass FROM utilisateur WHERE id_utilisateur=?');
$id_utilisateur=(int)$_GET['id_utilisateur'];
$call->bind_param('i',$id_utilisateur);
$call->execute();
$result=$call->get_result();

foreach($result as $thisResult){
    $current_pass=$thisResult['pass'];
}
if($_SERVER['REQUEST_METHOD']== 'POST'){
    $oldPass=$_POST['pass'];
    $newPass=$_POST['newPassword'];
    if(password_verify($oldPass,$current_pass)){
        $sql='UPDATE utilisateur SET pass=? WHERE id_utilisateur=?';
        $change=$connect->prepare($sql);
        $change->bind_param('si',$newPass, $id_utilisateur);
        $change->execute();
        header('location:profile.php?status=The password was changed successfully');
    }else{
        header('location:profile.php?status=Impossible to change the password');   
    }
}


?>