<?php
 session_start();
 if(!empty($_SESSION['code'])){
   header('location:article/dashboard.php');
 }else{
   header('location:login.php');
 }
?>