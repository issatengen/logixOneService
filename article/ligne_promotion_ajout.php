<?php
include '../connection.php';
$call=mysqli_query($connect,'SELECT * FROM article');
if(isset($_POST['pourcentage_reduction']) and isset($_POST['id_article'])){
    echo $_POST['pourcentage_reduction'].' <br>';
    foreach($call as $selected){
        if($selected['id_article']==$_POST['id_article']){
            echo $_POST['id_article'].' ';
        }
    }
}

?>