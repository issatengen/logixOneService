<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoicing</title>
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
      <h1><?= liste_factures?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="form_ajout_role.php"></a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
        
              <!-- Table with stripped rows -->
              <?php
                    include '../connection.php';
                    $facture=mysqli_query($connect,'SELECT * FROM commande,facture,client 
                    WHERE commande.id_commande=facture.id_commande AND client.id_client=commande.id_client ORDER BY id_facture DESC');
              ?>
              <center>
              <table class="table datatable ">
                <thead>
                  <tr>
                    <th scope="col"><?= nom_clt ?></th>
                    <!-- <th scope="col"><?= tel ?></th>
                    <th scope="col"><?= cni ?></th>-->
                    <th class="scope"><?= code_commande ?></th> 
                    <!-- <th scope="col"><?= date_depot ?></th>
                    <th scope="col"><?= date_estimatrice ?></th>-->
                    <th scope="col"><?= date_retrait ?></th> 
                    <th scope="col"><?= montant_total ?></th>
                    <th scope="col"><?= reduction ?></th>
                    <th scope="col"><?= montant_verse ?></th>
                    <th scope="col"><?= montant_restant ?></th>
                    <th scope="col"><?= action ?></th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  while($liste_facture=mysqli_fetch_assoc($facture)){
                    $restant=$liste_facture['montant_total']-($liste_facture['montant_verse']+$liste_facture['reduction']);
                ?>
                <tr>
                  <td><?=$liste_facture['nom_client']?> <?=$liste_facture['prenom_client']?></td>
                  <!-- <td><?=$liste_facture['tel_client']?></td>
                  <td><?=$liste_facture['cni_client']?></td>-->
                  <td><?=$liste_facture['code_commande']?></td> 
                  <!--<td><?=$liste_facture['date_depot']?></td>
                  <td><?=$liste_facture['date_estimatrice']?></td> -->
                  <td><?=$liste_facture['date_retrait']?></td>
                  <td><b><?=$liste_facture['montant_total']?> FCFA</b></td>
                  <td><b><?=$liste_facture['reduction']?> FCFA</b></td>
                  <td><b><?=$liste_facture['montant_verse']?> FCFA</b></td>
                  <td><b><?= $restant ?>FCFA</b></td>
                  <td>
                    <a href="pdf_imprimer_commande.php?id_commande=<?= $liste_facture['id_commande']?>" >
                      <button class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="left" title="<?= imprimer ?>">
                        <i class="bi bi-printer"></i>
                      </button>
                    </a>
                    <a href="https://wa.me/237<?=$liste_facture['tel_client']?>?text=<?= votre_code_fact_est .' <b>'
                    . $liste_facture['code_commande'] .'</b>'?>" >
                      <button class="btn " data-bs-toggle="tooltip" data-bs-placement="left" title="<?= imprimer ?>">
                        <img src="../images/whatsapp_logo_icon.png" alt="Whatsapp" style="width: 25px;height: 25px;">
                      </button>
                    </a>
                    
                    <?php
                   if($code == 'ADMIN'){

      
                  ?>
                    <button class="btn btn-danger" onclick="
                      if(confirm('Voulez-vous vraiment supprimer cette facture ?')== true){
                        window.location.replace('supprimer_facture.php?id_facture=<?= $liste_facture['id_facture'] ?>');
                      }else{
                        exit;
                      }
                      " data-bs-toggle="tooltip" data-bs-placement="left" title="<?= supprimer ?>">
                      <i class="bi bi-trash"></i>
                    </button>
                    <?php
                      }else{
                        echo ' ';
                      }
                    ?>

                    <a href="form_modifier_facture.php?id_facture=<?= $liste_facture['id_facture']?>">
                      <button class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" title="<?= modifier ?>">
                        <i class="bi bi-pencil-fill"></i>
                      </button>
                    </a>
                  </td>
        
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