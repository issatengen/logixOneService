<?php
// on appelle la session
session_start();
$code=$_SESSION['code'];
if(!empty($code)){
    // on detruit la session
    session_destroy();
    unset($_SESSION);
    header('cache-control:no-store,no-cache,must-revalidate');
    header('location:login.php');
}

?>