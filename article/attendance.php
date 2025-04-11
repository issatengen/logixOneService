<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Attendance</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../images/CreateTech.png" rel="icon">
  <link href="../images/CreateTech.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="../https://fonts.gstatic.com" rel="preconnect">
  <link href="../https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">


  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  
</head>

<body>

<?php
  include_once 'header.php';
  date_default_timezone_set('Africa/Douala');
  $id_utilisateur=$_GET['id_utilisateur'];
  include '../connection.php';
  $code=$_SESSION['code'];
  $thisDate=date('Y-m-d');
  // not secured

  // $first_button=mysqli_query($connect,'SELECT *,COUNT(id_presence) AS presence1 
  // FROM registre_presence WHERE id_utilisateur = "'.$id_utilisateur.'" AND date_presence="'.$thisDate.'" ');

  // secured

  $first_button=$connect->prepare('SELECT *,COUNT(id_presence) AS presence1
   FROM registre_presence 
   WHERE id_utilisateur=? AND date_presence=?');
   // validation of inputs
   $id_utilisateur=(int)$id_utilisateur;
   $thisDate=date('Y-m-d', strtotime($thisDate));
   $first_button->bind_param('is',$id_utilisateur,$thisDate);
   $first_button->execute();
  $thisMax_id=$first_button->get_result();

  while($max_id=$thisMax_id->fetch_assoc()){
    $max_id_presence=$max_id['presence1'];
    $heure_entree=$max_id['heure_entree'];
    $heure_sortie=$max_id['heure_sortie'];
    $date_presence=$max_id['date_presence'];

  }
  // appel de l'utilisateur afin d'afficher ses coordonnées
  $user=$connect->prepare('SELECT * FROM utilisateur WHERE id_utilisateur=?');
  $id_utilisateur=(int)$_GET['id_utilisateur'];
  $user->bind_param('i', $id_utilisateur);
  $user->execute();
  $result=$user->get_result();
  while($thisUser=$result->fetch_assoc()){
    $userName=$thisUser['nom_utilisateur'];
    $userLastName=$thisUser['prenom_utilisateur'];
  }
      $this_presence=$connect->prepare('SELECT * FROM registre_presence');
      $this_presence->execute();
      $role=$this_presence->get_result();
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1><?php echo presence ?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><?php echo $userName.' '. $userLastName ?></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
                <div class="col-sm-8">
                  <div class="card">
                      <div class="card-body">
                        <form action="pdf_monthlyAttendance.php?id_utilisateur=<?php echo (int)$_GET['id_utilisateur'] ?>" style="margin-top:10px" method="post">
                          <div class="row">
                            <div class="has-validation col-md-4" >
                              <input type="date" class="form-control" id="validationCustomUsername" title="<?= date_debut ?>" aria-describedby="inputGroupPrepend" name="date_x" required>
                              <div class="invalid-feedback">
                              Veillez entrer la première date !
                              </div>
                              <?php
                                if(isset($_POST['date_x']) and isset($_POST['date_y'])){
                                    echo $_POST['date_x'];
                                }else{
                                  echo ' ';
                                }
                              ?>
                            </div>
                            <div class="has-validation col-md-4" >
                              <input type="date" class="form-control" id="validationCustomUsername" title="<?= date_fin ?>" aria-describedby="inputGroupPrepend" name="date_y" required>
                              <div class="invalid-feedback">
                                Veillez entrer la dernière date !
                              </div>
                              <?php
                                if(isset($_POST['date_x']) and isset($_POST['date_y'])){
                                    echo $_POST['date_y'];
                                }else{
                                  echo ' ';
                                }
                              ?>
                            </div>
                            <div class="col-md-4 mt-1">
                              <button type="submit" class="btn btn-primary" title="<?= rechercher ?>">
                                <i class="bi bi-search" title="<?= rechercher ?>"></i>
                                Search
                              </button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4 mb-2">
                  <!-- conditions of displaying buttons-->
                  <?php
                   if($max_id_presence < 1 ){
                  ?>
                    <a href="time_in.php?id_utilisateur=<?= $id_utilisateur ?>">
                        <button class="btn btn-outline-success m-3">
                          <i class="bi bi-arrow-down-circle-fill"></i>
                          <b><?= heure_entree ?></b>
                        </button>
                    </a>
                    <?php
                      }else{
                        echo ' ';
                      }
                      if($max_id_presence < 1){
                        echo ' ';
                      }else{

                    ?>
                    <a href="time_out.php?id_utilisateur=<?= $id_utilisateur ?>">
                        <button class="btn btn-outline-warning m-3">
                          <i class="bi bi-arrow-up-circle-fill"></i>
                          <b><?= sortie ?></b>
                        </button>
                    </a>
                    <?php
                      }
                    ?>
                </div>
          <div class="card">
            <div class="card-body">
        
              <!-- Table with stripped rows -->
              <?php
                include '../connection.php';
                // appel du registre de l'utilisateur
                  $role=mysqli_query($connect,'SELECT * FROM registre_presence WHERE id_utilisateur="'.$id_utilisateur.'"'); 
              ?>
              <center>
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col"><?= date_presence ?></th>
                    <th scope="col"><?= heure_entree ?></th>
                    <th scope="col"><?= heure_sortie ?></th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  while($attendance=$role->fetch_assoc()){

                ?>
                <tr>
                  <td><?=$attendance['date_presence']?></td>
                  <td><?=$attendance['heure_entree']?></td>
                  <td><?=$attendance['heure_sortie']?></td>
                  <?php
                  if($code=="ADMIN"){
                  ?>
                  <td>
                    <button
                      onclick="
                      let del=confirm('Voulez-vous vraiment supprimer cette présence ?');
                      if(del==true){
                        window.location.replace('supprimer_presence.php?id_presence=<?= $attendance['id_presence'] ?>');
                      }else{
                      exit;
                      }
                      "
                      class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="left" title="<?= supprimer ?>">
                      <i class="bi bi-trash"></i>
                    </button>
                    <a href="form_modifier_presence.php?id_presence=<?= $attendance['id_presence']?>">
                      <button class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" title="<?= modifier ?>">
                        <i class="bi bi-pencil-fill"></i>
                      </button>
                    </a>
                  </td>
                  <?php
                  }else{
                    echo ' ';
                  }
                  ?>
                </tr>
                <?php
                  }
                ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->
              </center>
            </div>
          </div>

        </div>
      </div>
    </section>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
    <span>Copyright &copy; Your web App 2023</span><br>
    <span>TengTech</span>
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="tengtech.com/"> TengTech</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>
  <script>
    let parameters=new URLSearchParams(window.location.search);
    let status=parameters.get('status');
    if(status){
      alert(status);
    }else{
      exit;
    }
  </script>

</body>

</html>