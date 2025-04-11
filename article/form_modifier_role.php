<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>logixone / Edit role</title>
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

    <main id="main" class="main">
      <div class="pagetitle">
        <h1>Modifier le role</h1>
      </div>
      <nav>
        <div class="row">
          <div class="col-4">
            <div class="row">
              <div class="col-3">
                <a href="dashboard.php">
                  <button class="btn btn-light btn-lg" title="<?= tableau_bord ?>">
                    <i class="bi bi-house "></i>
                  </button>
                </a>
              </div>
              <div class="col-3">
                <a href="form_ajout_role.php">
                  <button class="btn btn-light btn-lg" title="<?= ajouter_role ?>">
                    <i class="bi bi-file-plus"></i>
                  </button>
                </a>
              </div>
            </div>
          </div>
          <div class="col-4"></div>
          <div class="col-4"></div>
        </div>
      </nav>
      <div class="row">
        <div class="col-lg-12">
            <?php
            include_once '../connection.php';
            $id_role=$_GET['id_role'];
            $roles=mysqli_query($connect,'SELECT * FROM role WHERE id_role="'.$id_role.'"');
            while($le_role=mysqli_fetch_assoc($roles)){

            ?>
          <div class="card">
            <div class="card-body">
            <form action="modifier_role.php?id_role=<?= $le_role['id_role']?>" method="post">
                <hr>
                <div class="row">
                  <div class="col-md-6 h6">
                    <label for="designation"><b><?= code ?></b></label><br>
                    <input type="text" class="form-control" name="code_role" value="<?= $le_role['code_role']?>">
                  </div>
                  <div class="col-md-8 ">
                    <label for="libelle"><b><?= libelle ?></b></label><br>
                    <input type="text" class="form-control" name="libelle" value="<?= $le_role['libelle']?>">
                  </div>
                  <br><br>
                  <div class="col-md-10 mt-2">
                    <input class="btn btn-success" type="submit" value="Modifier" class="submit" >
                  </div>
                </div>
                <br>
            </form>
            </div>
          </div>
          <?php
            }
          ?>

        </div>
      </div>
          </main>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
  include_once 'footer.php'
  ?>

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