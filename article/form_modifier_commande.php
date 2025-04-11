<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>LogixOne / Edit order</title>
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
      <h1>Modifier la commande</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="liste_commandes.php">Liste des commandes</a></li>
        </ol>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="form_ajout_commande.php">Ajouter une commande</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
            <br>
            <?php
            include '../connection.php';
            $id_commande=$_GET['id_commande'];
            $la_cmd=mysqli_query($connect,'SELECT * FROM commande WHERE id_commande="'.$id_commande.'"');
            while ($cmd=mysqli_fetch_assoc($la_cmd)){


            ?>
            <form action="modifier_commande.php?id_commande=<?= $cmd['id_commande']?>" method="post" >
              <hr>
              <div class="row md-10">
                <div class="col-md-6">
                  <label for="date_depot"><b>Date de dépot</b></label><br>
                  <input class="form-control" type="date" name="date_depot" value="<?=$cmd['date_depot']?>"><br>
                </div>
                <div class="col-md-4">
                  <label for="designation"><b>Date extimatrice</b></label><br>
                  <input type="date" class="form-control" name="date_estimatrice" value="<?=$cmd['date_estimatrice']?>"><br>
                </div>
                <div class="col-md-4">
                  <label for="quantity"><b>Date de retrait</b></label><br>
                  <input type="date" class="form-control" name="date_retrait" value="<?= date('Y-m-d') ?>"><br>
                </div>
                <div class="col-md-6">
                  <label for="unit_price"><b>Client</b></label><br>
                  <input type="number" class="form-control" name="id_client" value="<?=$cmd['id_client']?>"><br><br>
                </div>
                <!-- <div class="col-md-6">
                  <label for="unit_price"><b>Identifiant de l'utilisateur</b></label><br>
                  <input type="number" class="form-control" name="id_utilisateur" value="<?=$cmd['id_utilisateur']?>"><br><br>
                </div> -->
              </div>
                <input type="submit" class="btn btn-success" value="Modifier" class="submit" ><br>
                <br>
            </form>
            <?php
            }
            ?>
            </div>
          </div>

        </div>
      </div>
    </main>

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