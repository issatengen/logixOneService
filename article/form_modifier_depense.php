<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>LogixOne / Edit expense</title>
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
  include '../connection.php';
  $id_depense=$_GET['id_depense'];

  // appel de la dépense
  $call=$connect->prepare("SELECT * FROM depense WHERE id_depense=?");
  $call->bind_param('i',$id_depense);
  $call->execute();
  $result=$call->get_result();
?>
  <main class="main" id="main">
    <div class="pagetitle">
      <h1><?= modifier_depense ?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="liste_depenses.php"><?= liste_depenses ?></a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">

            <!-- Custom Styled Validation -->
              <form class="row g-3 needs-validation" action="edit_expense.php?id_depense=<?php echo $id_depense ?>" method="post" novalidate>
                <?php
                while($info=$result->fetch_assoc()){
                ?>
                <div class="col-md-6">
                  <label for="validationCustomUsername" class="form-label"><b><?= libelle ?></b></label>
                  <div class="input-group has-validation">
                    <input type="text" class="form-control" value="<?php echo $info['libelle_depense'] ?>" name="libelle_depense" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                    Veillez entrer le libellé de la dépense !
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="validationCustomUsername" class="form-label"><b><?= date_depense ?></b></label>
                  <div class="input-group has-validation">
                    <input type="date" class="form-control" value="<?php echo $info['date_depense'] ?>" name="date_depense" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                    Veillez entrer la date du jour !
                    </div>
                  </div>
                </div>
                <div class="col-md-5">
                  <label for="validationCustomUsername" class="form-label"><b><?= montant_depense ?></b></label>
                  <div class="input-group has-validation">
                    <input type="number" class="form-control" value="<?php echo $info['montant_depense'] ?>" name="montant_depense" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                    Veillez entrer le montant dépensé !
                    </div>
                  </div>
                </div>
                <div class="col-md-8">
                  <label for="validationCustomUsername" class="form-label"><b><?= description ?></b></label>
                  <div class="input-group has-validation">
                    <textarea id="" name="raison_depense" cols="60" rows="5" class="form-control">
                      <?php echo $info['raison_depense'] ?>
                    </textarea>
                    <div class="invalid-feedback">
                      Veillez entrer la raison de la dépense !
                    </div>
                  </div>
                </div>
                <?php } ?>
                <div class="col-md-4">
                  <br>
                  <button class="btn btn-success" type="submit"><?= enregistrer ?></button>
                </div>
              </form><!-- End Custom Styled Validation -->
            <br>
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