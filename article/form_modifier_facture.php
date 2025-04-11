<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogixOne / Edit invoice</title>
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
    include_once '../connection.php';

    $id_facture=$_GET['id_facture'];
    $fact=mysqli_query($connect,'SELECT * FROM facture,commande,client WHERE commande.id_commande=facture.id_commande AND client.id_client=commande.id_client AND id_facture="'.$id_facture.'" ');
    while($le_fact=mysqli_fetch_assoc($fact)){
        $montant_total=$le_fact['montant_total'];
        $montant_verse=$le_fact['montant_verse'];
        $reste=$le_fact['reste'];
        $id_commande=$le_fact['id_commande'];
        $nom_client=$le_fact['nom_client'];
        $prenom_client=$le_fact['prenom_client'];
        $date_facture=$le_fact['date_facture'];
        $code_facture=$le_fact['code_facture'];
       
    }
    $rnd=rand(0,10000);
    ?>
  <main class="main" id="main">
    <div class="pagetitle">
      <h1><?= edite_facture ?> </h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="consulter_commande.php"></a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
              <form class="row g-3 needs-validation" enctype="multipart/form-data" action="modifier_facture.php?id_facture=<?=$id_facture ?>" method="post" novalidate>
                <div class="col-md-4">
                  <label for="validationCustomUsername" class="form-label"><b>Code</b> </label>
                  <div class="input-group has-validation">
                    <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="code_facture" value="FCT-<?= $rnd ?>" required >
                    <div class="invalid-feedback">
                    <?= veillez_entre_cd_fact ?>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="validationCustomUsername" class="form-label"><b>Date</b> </label>
                  <div class="input-group has-validation">
                    <input type="date" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="date_facture" value="<?= $date_facture ?>"  required>
                    <div class="invalid-feedback">
                      <?= veillez_etre_date ?>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <label for="validationCustomUsername" class="form-label"><b><?= mt_a_verser ?></b> </label>
                  <div class="input-group has-validation">
                    <input type="number" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="montant_total" value="<?= $reste ?>" required >
                    <div class="invalid-feedback">
                      <?= veillez_entre_mt_a_verse ?>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <label for="validationCustomUsername" class="form-label"><b><?= montant_verse ?></b> </label>
                  <div class="input-group has-validation">
                    <input type="number" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="montant_verse"   required>
                    <div class="invalid-feedback">
                    <?= veillez_etre_mt_verse ?>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <label for="validationCustomUsername" class="form-label"><b><?= id_cmd ?></b> </label>
                  <div class="input-group has-validation">
                    <input type="number" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="id_commande" value="<?= $id_commande ?>"   required>
                    <div class="invalid-feedback">
                      <?= veillez_entre_id_cmd ?>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="validationCustomUsername" class="form-label"><b><?= client ?></b> </label>
                  <div class="input-group has-validation">
                    <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  value="<?= $nom_client ?> <?= $prenom_client ?>"   disabled>
                    <div class="invalid-feedback">
                      !
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <br>
                  <button class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="left">
                    <i class="bi bi-database"></i>
                    <input type="submit" value="<?= enregistrer ?>"  class="btn btn-success">
                  </button>
                </div>
              </form><!-- End Custom Styled Validation -->
                </div>
            </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

    <!-- ======= Footer ======= -->
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