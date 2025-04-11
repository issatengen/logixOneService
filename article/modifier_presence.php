<?php
include_once '../connection.php';
 if(isset($_POST['date_presence']) and isset($_POST['heure_entree']) or isset($_POST['heure_sortie']) and isset($_GET['id_present'])){
    $dateIn=$_POST['date_presence'];
    $timeIn=$_POST['heure_entree'];
    $timeOut=$_POST['heure_sortie'];
    $id_present=$_GET['id_present'];

    $query='UPDATE registre_presence SET date_presence=?,heure_entree=?,heure_sortie=? WHERE id_presence=?';
    $edit=$connect->prepare($query);
    $edit->bind_param('sssi',$dateIn,$timeIn,$timeOut,$id_present);
    $edit->execute();
 }
if($edit){
    header('location:dashboard.php?status=The modification was successfull');
}
?>