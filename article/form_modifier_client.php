<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Logixone / Edit costumer</title>
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
?>
  <main class="main" id="main">
  <div class="pagetitle">
      <h1><?= modifier_clt ?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="liste_clients.php"><?= liste_clt ?></a></li>
        </ol>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="form_ajout_client.php"><?= ajout_clt ?></a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
        
            <?php
            include '../connection.php';
            $id_client=$_GET['id_client'];
            $client=mysqli_query($connect,'SELECT * FROM client WHERE id_client="'.$id_client.'"');
            while ($clients=mysqli_fetch_assoc($client)){


            ?>
             <form class="row g-3 needs-validation" action="modifier_client.php?id_client=<?= $clients['id_client'] ?>" method="post" novalidate>
                <div class="col-md-4">
                  <label for="validationCustom01" class="form-label"><b><?= cni ?></b></label><br>
                  <input type="text" class="form-control" id="validationCustom01" name="cni_client" value="<?= $clients['cni_client'] ?>" required>
                  <div class="valid-feedback">
                    <i class="bi bi-check-all"></i>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="validationCustomUsername" class="form-label"><b><?= nom_clt ?></b></label>
                  <div class="input-group has-validation">
                    <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="nom_client" value="<?= $clients['nom_client'] ?>" required>
                    <div class="invalid-feedback">
                    <?= veillez_entre_nom_clt ?>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="validationCustomUsername" class="form-label"><b><?= prenom_clt ?></b></label>
                  <div class="input-group has-validation">
                    <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="prenom_client" value="<?= $clients['prenom_client'] ?>" required>
                    <div class="invalid-feedback">
                    <?= veillez_entre_prenom_clt ?>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="validationCustom03" class="form-label"><b><?= adresse ?></b></label>
                  <input type="text" class="form-control" id="validationCustom03" name="adresse_client" value="<?= $clients['adresse_client'] ?>" required>
                  <div class="invalid-feedback">
                  <?= veillez_entre_adresse_clt ?>
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="validationCustom03" class="form-label"><b><?= tel ?></b> </label>
                  <input type="text" class="form-control" id="validationCustom03" name="tel_client" value="<?= $clients['tel_client'] ?>" required>
                  <div class="invalid-feedback">
                  <?= veillez_entre_tel_cl ?>
                  </div>
                </div>
                <div class="col-12">
                  <br>
                  <button class="btn btn-lg btn-primary" type="submit"><?= enregistrer ?></button>
                </div>
              </form>
              <!-- End Custom Styled Validation -->

            <?php
            }
            ?>
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

</body>

</html>