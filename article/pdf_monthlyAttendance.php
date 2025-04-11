<?php
  include_once '../connection.php';
  $id_utilisateur=(int)$_GET['id_utilisateur'];

  // languages
  if(isset($_SESSION['langue'])){
    if(!empty($_SESSION['langue'])){
        $langue=$_SESSION['langue'];
    }
  }else{
      $langue=substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
  }

  if($langue=="en"){
      include_once '../langue/anglais.php';
  }else{
      include_once '../langue/francais.php';
  }
  // appel de l'utilisateur afin d'afficher ses coordonnées
  $user=$connect->prepare('SELECT * FROM utilisateur WHERE id_utilisateur=?');
  $user->bind_param('i', $id_utilisateur);
  $user->execute();
  $result=$user->get_result();
  while($thisUser=$result->fetch_assoc()){
    $userName=$thisUser['nom_utilisateur'];
    $userLastName=$thisUser['prenom_utilisateur'];
  }
// appel du registre de l'utilisateur
      // $role=mysqli_query($connect,'SELECT * FROM registre_presence WHERE id_utilisateur="'.$id_utilisateur.'" ');
      

      if(isset($_POST['date_x']) and isset($_POST['date_y'])){
        $date_x=$_POST['date_x'];
        $date_y=$_POST['date_y'];
        // data verification
        $date_x=date('Y-m-d', strtotime($date_x));
        $date_y=date('Y-m-d', strtotime($date_y));
        $this_presence=$connect->prepare('SELECT * FROM registre_presence 
          WHERE date_presence 
          BETWEEN ? AND ? 
          AND id_utilisateur=?');
        $this_presence->bind_param('ssi', $date_x, $date_y, $id_utilisateur);
        $this_presence->execute();
        $role=$this_presence->get_result();
      }
      // For time
      if(isset($_POST['date_x']) and isset($_POST['date_y'])){
        $date_x=$_POST['date_x'];
        $date_y=$_POST['date_y'];
        // data verification
        $date_x=date('Y-m-d', strtotime($date_x));
        $date_y=date('Y-m-d', strtotime($date_y));
        $calculate_time=$connect->prepare('SELECT *,COUNT(date_presence) AS number_days, SUM(heure_sortie) AS timeY FROM registre_presence 
          WHERE date_presence 
          BETWEEN ? AND ? 
          AND id_utilisateur=?');
        $calculate_time->bind_param('ssi', $date_x, $date_y, $id_utilisateur);
        $calculate_time->execute();
        $time_x_y=$calculate_time->get_result();
        while($timeXY=$time_x_y->fetch_assoc()){
          $number_days=$timeXY['number_days'];
          $timeY=$timeXY['timeY'];
        }
      }
      require_once '../fpdf186/fpdf.php';
      $pdf= new fpdf('p','mm','A4');
      $pdf-> Addpage();
      $pdf-> setMargins(20,15,20);
      $pdf-> setX(30);
      $pdf-> setY(20);

      $pdf->Ln();
      $pdf->SetFont('Arial','B',22);

      $pdf->Cell(70,10,nom_entreprise,0,1,'L');

      $pdf-> Ln();
      $pdf-> setFont('Times','b',18);
      // $pdf-> setTextColor(0,0,255);
      $pdf-> Cell(100,5,mb_convert_encoding(presences_de. $userName.' '. $userLastName,'ISO-8859-1','UTF-8'),0,2,'R');
      $pdf-> Ln(5);

      $pdf-> setTextColor(0,0,0);
      $pdf-> setFillColor(0,255,0);
      $pdf-> setFont('Times','b',14);
      $pdf-> Cell(43,8,date_presence,1,0);
      $pdf-> Cell(43,8,mb_convert_encoding(heure_entree,"iso-8859-1","utf-8"),1,0);
      $pdf-> Cell(43,8,heure_sortie,1,0);
      $pdf-> Cell(43,8,br_heures,1,1);

      $x1 = 20; // X-coordinate (horizontal position)
      $y1 = 57; // Y-coordinate (starting vertical position)
      $y2 = 20.5+$number_days*20.5; // Y-coordinate (ending vertical position)

      // Draw the vertical line
      $pdf->Line($x1, $y1, $x1, $y2);

      $x2 = 192; // X-coordinate (horizontal position)
      $y2 = 57; // Y-coordinate (starting vertical position)
      $y3 = 20.5+$number_days*20.5; // Y-coordinate (ending vertical position)

      $pdf-> Line($x2, $y2, $x2, $y3);

      while($attendance=$role->fetch_assoc()){
        $pdf-> setFont('Arial','',12);
        $pdf-> setFillColor(255);
        $pdf-> settextColor(0,0,0);
        $pdf-> Cell(43,8,$attendance['date_presence'],0,0);
        $pdf-> Cell(43,8,$attendance['heure_entree'],0,0);
        $pdf-> Cell(43,8,$attendance['heure_sortie'],0,0);

        $heure_entree=new DateTime($attendance['heure_entree']);
        $heure_sortie=new DateTime($attendance['heure_sortie']);

        $interval=$heure_entree->diff($heure_sortie);

        $heureDiff=($interval->days*24) + $interval->h;
        $MinDiff=($interval->days*24*60) + ($interval->h*60) + $interval->i;
        $secondDiff=($interval->days*24*60*60) + ($interval->h*60*60) + ($interval->i*60) + $interval->s;

        $pdf-> Cell(43,8,$heureDiff,0,1);
      }
      $pdf-> cell(172,0,'',1,1);
      $pdf-> Ln(20);
      $pdf-> setFont('Arial','',9);
      $pdf-> cell(170,8,'Designed By Logix',0,1,'C');
      $pdf-> setFont('Arial','',10);
      $pdf-> cell(80,8,'Email: ',0,0,'R');
      $pdf-> setFont('Arial','i',9);
      $pdf-> setTextColor(0,0,255);
      $pdf-> cell(35,8,'issatengen@outlook.com',0,0,'R');
      $pdf-> output();
?>