<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Logixone / Add item</title>
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
  <?php
  include_once '../connection.php';
  $categories=mysqli_query($connect,'SELECT * FROM categorie ORDER BY nom_categorie ASC');
  ?>
</head>

<body>

<?php
  include_once 'header.php';
?>
  <main class="main" id="main">
  <div class="pagetitle">
      <h1><?= ajout_article ?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="liste_articles.php"><?= liste_articles ?></a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
             <!-- Custom Styled Validation -->
             <?php
              $rnd=rand(1,10000);
             ?>
             <form class="row g-3 needs-validation" enctype="multipart/form-data" action="ajout_article.php" method="post" novalidate>
                <div class="col-md-6">
                  <label for="validationCustomUsername" class="form-label"><b><?= designation ?></b></label>
                  <div class="input-group has-validation">
                    <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="designation" required>
                    <div class="invalid-feedback">
                      Veillez entrer la désignation!
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="validationCustomUsername" class="form-label"><b><?= quantite ?></b> </label>
                  <div class="input-group has-validation">
                    <input type="number" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="quantite" required>
                    <div class="invalid-feedback">
                      Veillez entrer la quantité!
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="validationCustom03" class="form-label"><b><?= prix_unitaire ?></b></label>
                  <input type="number" class="form-control" id="validationCustom03" name="prix_unitaire" required>
                  <div class="invalid-feedback">
                  Veillez entrer le prix unitaire!
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="validationCustom04" class="form-label"><b><?= categorie ?></b></label>
                  <select class="form-select" id="validationCustom04" name="categorie" required>
                    <?php
                    foreach($categories as $selected_cat){

                    ?>
                    <option  value="<?= $selected_cat['id_categorie'] ?>"><?= $selected_cat['nom_categorie'] ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="validationCustom03" class="form-label">Image</label>
                  <input type="file" class="form-control" id="validationCustom03" accept="image/*" name="image_article" required>
                  <div class="invalid-feedback">
                  Veillez inserer une image !
                </div>
                <div class="col-md-4">
                  <br>
                  <button class="btn btn-primary" type="submit">
                    <i class="bi bi-database"></i>
                    <?= enregistrer ?>
                  </button>
                </div>
              </form><!-- End Custom Styled Validation -->


            </div>
          </div>

        </div>
      </div>
    </section>

    

  </main><!-- End #main -->
  <?php
  include_once 'footer.php';
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