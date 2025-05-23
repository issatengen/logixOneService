
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Logix / Settings</title>
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
  require_once 'header.php'; 
  
  if(!empty($_GET['langue'])){
    $langue=$_GET['langue'];
  }else{
    $langue=substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
  }
  $_SESSION['langue']=$langue;

  ?>
  <main class="main" id="main">
    <div class="pagetitle">
      <h1><?= parametre ?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="form_ajout_role.php"></a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-md-11">
          <div class="card card-body">
            <div class="row">
              <div class="col-md-4">
                <!-- Vertically centered Modal -->
                <button  class="btn" data-bs-toggle="modal" data-bs-target="#verticalycentered">
                  <?= langue ?>
                </button>
                <div class="modal fade" id="verticalycentered" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title"><?= langue ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-sm-6">
                            English
                          </div>
                          <div class="col-sm-6">
                            <a class="" href="parametre.php?langue=en"><?= utiliser ?></a>
                          </div>
                          <div class="col-sm-6">
                            Français
                          </div>
                          <div class="col-sm-6">
                            <a class="" href="parametre.php?langue=fr"><?= utiliser ?></a>
                          </div>
                        </div>
                    </div>
                  </div>
                </div><!-- End Vertically centered Modal-->
              </div>
            </div>
            <?php
            if(isset($_POST['delais'])){
              $_SESSION['delais']=$_POST['delais'];
            }else{
              echo ' ';
            }
            ?>
            <div class="row">
              <div class="col-md-4">
                <!-- Basic Modal -->
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#basicModal">
                  <?= notification ?>
                </button>
                <div class="modal fade" id="basicModal" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title"><?= notification ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-sm-10">
                            <div class="card">
                              <div class="card-body">
                                <form action="parametre.php" class="form m-10" method="post">
                                  <label for="delais"><?= nbre_jour ?></label><br>
                                  <input type="number" class="form-control" name="delais"><br>
                                  <button class="btn btn-success" type="submit">
                                    <i class="bi bi-database"></i>
                                    <?= enregistrer ?>
                                  </button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div> 
                      </div>        
                      <div class="modal-footer">
                        <?= pied_param_notification ?>
                      </div>
                    </div>
                  </div>
                </div><!-- End Basic Modal-->
                <div class="col-md-7">

                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="dropdown">
                  <button class="btn btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                     <?= promotion ?>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-light">
                    <li><a class="dropdown-item" href="form_ajout_promotion.php"><?= lancer_promotion ?></a></li>
                    <li><a class="dropdown-item" href="#"><?= liste_promotions ?></a></li>
                    <li><hr class="dropdown-divider"></li>
                  </ul>
                </div>
              </div>
              <div class="col-md-9">
                <a class="text-black ms-3" data-bs-target="" data-bs-toggle="" href="liste_roles.php">
                  <span><?= role ?></span>
                </a>
              </div>
              <div class="col-md-4">
                <div class="dropdown">
                  <button class="btn btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Finance
                  </button>
                  <ul class="dropdown-menu dropdown-menu-light">
                    <li><a class="dropdown-item" href="param_caisse.php">Caisse</a></li>
                    <li><a class="dropdown-item" href="param_banque"><?= banque ?></a></li>
                    <li><hr class="dropdown-divider"></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>


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
</body>
</html>