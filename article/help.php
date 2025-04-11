<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Help</title>
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
      <h1><?= aide ?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php"><?=tableau_bord?></a></li>
        </ol>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="mailto:issatengen@outlook.com">Contacter le développeur</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
      
      <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><?= enregistrer_client ?></h4>
                    <p><?= signification_enregistrer_client ?> <br>
                        <ol>
                            <?= sur_la_barre_verticale ?> <span class="text-primary"><b><?= client ?></b></span>
                            <li><?= cliquer_sur.' ' ?><span class="text-primary"><b><?= ajout_client ?></b></span></li>
                            <hr class="divider">
                            <?= le_systeme_dirige_vers_form_ajout_commande ?> <span class="text-primary"><?= date_estimatrice ?></span> 
                            <?=sur_une_page_de_selection_article?>
                            <li><?= cliquer_sur.' ' ?><span class="text-primary"><b><?= facturee ?></b></span> </li>
                            <hr class="divider">
                            <?= le_systeme_vous_dirige_sur_form_facture ?>
                            <li><?= cliquer_sur.' ' ?><span class="text-primary"><b><?= enregistrer ?></b></span></li>
                            <?= le_syteme_vous_dirige_sur_liste_factures ?>
                        </ol>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><?= les_niveaux_d_acces ?></h4>
                    <p>
                        <?= acces_aux_diff_taches_se_fait_en_fonction ?> <br>
                        <?= notons_que ?> <b><?= administrateur ?></b> <?= soit_il_est ?> <b><?= util_simple ?></b> <br>
                        <b><u>NB</u></b>: <i><?= phrase_nb ?> </i> <br> <i><?= phrase_nb2 ?> </i>
                    </p>
                    <hr>
                    <h4 class="card-title"><?= pour_admin ?></h4>
                    <ul>
                      <li><span class="text-primary"><b><?= sup_client ?></b></span>
                        <p><?= la_sup_1_client_se_fait ?> <br>
                        <ol>
                          <!-- <li><span class="text-info"><?= sup_diff_factures ?></span><?= du_client_en_question ?></li> -->
                          <li><span class="text-info"><?= sup_la_cmd ?></span> <?= de_ce_dernier ?></li>
                          <li><span class="text-info"><?= supp_client ?></span></li>
                        </ol>
                        </p>
                      </li>
                    </ul>
                    <hr>
                    <h4 class="card-title"><?= parametre ?></h4>
                    <ul>
                      <li>
                        <p><span class="text-primary" ><?= langue ?></p></span>
                        <p>
                          <?= afin_de_definir_la_langue ?>
                          <ol>
                            <li><span class="text-info"><?= parametre ?></span></li>
                            <li><span class="text-info"><?= langue ?></span></li>
                            <li><span class="text-info"><?= choisi_laungue_deux_fois ?></span></li>
                          </ol>
                        </p>
                      </li>
                    </ul>
                    <ul>
                      <li>
                        <p><span class="text-primary" ><?= notification ?></pan></p>
                        <p>
                          <?= afin_de_definir_les_notifications ?>
                          <ol>
                            <li><span class="text-info"><?= parametre ?></span></li>
                            <li><span class="text-info"><?= notification ?></span></li>
                            <li><span class="text-info"><?= remplir_form_par_nombre_jour.' ' ?></span><?= et.' '?><span class="text-info"><?= sauvegarder ?></span></li>
                          </ol>
                        </p>
                      </li>
                    </ul>

                </div>
            </div>
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