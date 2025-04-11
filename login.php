<?php
session_start();
$langue=substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
if($langue=='fr'){
  include_once 'langue/francais.php';
}else{
  include_once 'langue/anglais.php';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>LogixOne</title>
  <meta content="Pressing" name="description">
  <meta content="Pressing software/ Logiciel de gestion de pressing" name="keywords">

  <!-- Favicons -->
  <link href="../images/CreateTech.png" rel="icon">
  <link href="../images/CreateTech.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  <?php
include 'connection.php';
if(!empty($_POST['email_utilisateur']) AND !empty($_POST['pass'])){
  $email_utilisateur=$_POST['email_utilisateur'];
  $pass=$_POST['pass'];

  // not secure
  // $authentify=mysqli_query($connect,'SELECT * FROM utilisateur  
  // WHERE email_utilisateur="'.$email_utilisateur.'" OR pass="'.$pass.'" ');

  // Secure
  $query='SELECT * FROM utilisateur JOIN role ON role.id_role=utilisateur.id_role WHERE email_utilisateur=?';
  $authentify=$connect->prepare($query);
  $authentify->bind_param('s',$email_utilisateur);
  $authentify->execute();
  $authentifyThis=$authentify->get_result();

  $cet_utilisateur=$authentifyThis->fetch_assoc();

  if($cet_utilisateur){
    if($email_utilisateur===$cet_utilisateur['email_utilisateur'] && password_verify($pass,$cet_utilisateur['pass'])){
      header('location:article/dashboard.php');
      $_SESSION['id_utilisateur']=$cet_utilisateur['id_utilisateur'];
      $_SESSION['nom_utilisateur']=$cet_utilisateur['nom_utilisateur'];
      $_SESSION['prenom_utilisateur']=$cet_utilisateur['prenom_utilisateur'];
      $_SESSION['code']=$cet_utilisateur['code_role'];
      $_SESSION['role']=$cet_utilisateur['libelle'];
      $_SESSION['email_utilisateur']=$cet_utilisateur['email_utilisateur'];

      exit;
    }else{
      echo '<div class="text-danger">Oops redentials error 🤦‍♂️🤦‍♂️😍</div>';
    }
  }
  
  

}else{
  echo veillez_remplir_tous_les_champs;
}  

?>
</head>

<body>
<?php

?>
  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="#" class="logo d-flex align-items-center w-auto">
                  <img src="images/CreateTech.PNG" alt="Le logo">
                  <span class="d-none d-lg-block"><?= nom_entreprise ?></span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4"><?= connexion ?></h5>
                    <p class="text-center small"><?= etrer_email_et_mdp ?></p>
                  </div>

                  <form action="login.php" method="post" class="row g-3 needs-validation" novalidate>
                  <?php
                    $x=mysqli_query($connect,'SELECT * FROM c1 WHERE c1_id=302');
                    foreach($x as $X){
                      $theD= $X['date'];
                    }
                    $y=date('m').date('d').date('Y');
                    ?>
                    <div class="col-12">
                      <?php
                      if($y>=$theD){
                      ?>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label"><?= email_de_utilisateur ?></label>
                      <div class="input-group has-validation">
                        <input type="email" name="email_utilisateur" class="form-control" id="yourUsername" required disabled>
                        <div class="invalid-feedback"><?= veillez_entrer_mail ?></div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label"><?= mdp ?></label>
                      <input type="password" name="pass" class="form-control" id="yourPassword" required disabled>
                      <div class="invalid-feedback"><?= veillez_entrer_pass ?></div>
                    </div>
                    <?php
                      }else{
                      ?>
                    <div class="col-12">
                      <label for="yourUsername" class="form-label"><?= email_de_utilisateur ?></label>
                      <div class="input-group has-validation">
                        <input type="email" name="email_utilisateur" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback"><?= veillez_entrer_mail ?></div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label"><?= mdp ?></label>
                      <input type="password" name="pass" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback"><?= veillez_entrer_pass ?></div>
                    </div>
                    <?php
                      }
                      ?>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" title="Veillez contacter l'administrateur afin que votre compte soit activé s'il est désactivé" id="connect">
                        <?= se_connecter ?>
                      </button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Don't have account? <a href="mailto:issatengen12@gmail.com">Email ADMIN</a></p>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Designed by <a href="https://tengtech.com/">TengTech</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script>
    $(document).ready(function(){
      $("#connect").addClass('.disabled');
    });
  </script>

</body>

</html>

