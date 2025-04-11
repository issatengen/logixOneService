
<?php
// try{
//     $connect=new PDO('mysql:host=localhost;dbname=gest_pressing','root','');
// }
// catch(EXCEPTION $e){
// die('Erreur:' .$e->getMessage());
// }
$connect=new mysqli('localhost','root','','logixoneservice');
if($connect->connect_error){
    die('Error: '. $connect->connect_error);
}
// var_dump($connect);
?>