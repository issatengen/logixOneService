
<?php
include '../connection.php';
$cmd_totales=mysqli_query($connect,'SELECT COUNT(id_commande) AS nombre_commande 
FROM commande ');
while($cet_cmd=mysqli_fetch_assoc($cmd_totales)){
  $nombre=$cet_cmd['nombre_commande'];
}
$cmd_en_cour=mysqli_query($connect,'SELECT COUNT(id_commande) AS nombre_cmd_en_cour 
FROM commande WHERE date_retrait IS NULL ');
while($cet_cmd_en_cour=mysqli_fetch_assoc($cmd_en_cour)){
  $nombre_cmd_en_cour=$cet_cmd_en_cour['nombre_cmd_en_cour'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>LogixOne / Dashboard</title>
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
      <h1><?= tableau_bord ?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="form_ajout_client.php"><?= ajout_client?></a></li>
          <li class="breadcrumb-item active"><?= tableau_bord ?></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div >
        <!-- Left side columns -->
        <div class="col-md-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card sales-card">
              <?php
                $cmd_ojd=mysqli_query($connect,'SELECT COUNT(id_commande) AS cmd_ojd 
                FROM commande WHERE date_depot=DATE(NOW()) ');
                while($les_cmd_ojd=mysqli_fetch_assoc($cmd_ojd)){
                  $ojd8=$les_cmd_ojd['cmd_ojd'];
                }
              ?>

                <div class="card-body">
                  <h5 class="card-title"><?= commande ?>s <span></span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <a href="liste_commandes.php"><i class="bi bi-cart-check"></i></a>
                    </div>
                    <div class="ps-3">
                      <h6><?= $nombre ?></h6>
                      <span class="small pt-1 fw-bold"><?= commande ?>s</span> <span class="text-muted small pt-2 ps-1"></span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card revenue-card">

                <div class="filter">
                  <!-- <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a> -->
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6></h6>
                    </li>

                    <li><a class="dropdown-item" href="commandes_en_cour.php">Consulter</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title"><?= cmd_en_cour ?> </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <a href="liste_commandes_en_cour.php"><i class="bi bi-cart"></i></a>
                    </div>
                    <div class="ps-3">
                      <h6><?= $nombre_cmd_en_cour ?></h6>
                      <?php
                      if($nombre !=0 AND $nombre_cmd_en_cour !=0){

                      $pourcentage_cmd_en_cour=($nombre_cmd_en_cour/$nombre)*100;
                      ?>
                      <span class="text-success small pt-1 fw-bold"><?= $pourcentage_cmd_en_cour ?>%</span> <span class="text-muted small pt-2 ps-1"><?= par_rapport_cmd ?></span>
                      <?php
                      }else{
                        echo ' ';
                      }
                      ?>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-sm-4">

              <div class="card info-card customers-card">

                <div class="filter">
                  <!-- <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a> -->
                  <!-- <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Date</h6>
                    </li>

                    <li><a class="dropdown-item" href="liste_client_livre.php"><?= cette_semaine ?></a></li>
                    <li><a class="dropdown-item" href="#"><?= ce_mois ?></a></li>
                    <li><a class="dropdown-item" href="#"><?= cette_annee ?></a></li>
                  </ul> -->
                </div>

                <div class="card-body">
                  <h5 class="card-title"><?= client_livres ?> <span><?= cette_annee ?></span></h5>
                  <?php
                  $num_clt_liv=mysqli_query($connect,'SELECT COUNT(date_retrait) AS clt_livre FROM commande WHERE date_retrait<>0');
                  while($clt_livre=mysqli_fetch_assoc($num_clt_liv)){
                    $nombre_clt_liv=$clt_livre['clt_livre'];
                  }
                  $clt_liv=mysqli_query($connect,'SELECT * FROM commande,client WHERE client.id_client=commande.id_client');
                  while($cmd_liv=mysqli_fetch_assoc($clt_liv)){

                  }
                  ?>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <a href="liste_clients_livre.php">
                        <i class="bi bi-people"></i>
                      </a>
                    </div>
                    <div class="ps-3">
                      <h6><?= $nombre_clt_liv ?></h6>
                      <?php
                      if($nombre_clt_liv !=0 AND $nombre !=0){

                      ?>
                      <span class="text-danger small pt-1 fw-bold"><?= ($nombre_clt_liv/$nombre)*100 ?>%</span> <span class="text-muted small pt-2 ps-1"><?= par_rapport_clt ?></span>
                      <?php
                      }else{
                        echo ' ';
                      }
                      ?>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->
            <?php
            $factures=mysqli_query($connect,'SELECT COUNT(id_facture) AS nombre_factures FROM facture');
            while($les_factures=mysqli_fetch_assoc($factures)){
              $la_facture=$les_factures['nombre_factures'];
            }
            ?>

            <!-- Customers Card -->
            <div class="col-xxl-4 col-sm-4">

              <div class="card info-card revenue-card">

                <div class="filter">
                </div>

                <div class="card-body">
                  <h5 class="card-title"><?= facturee ?> <span></span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-receipt-cutoff"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?= $la_facture ?></h6>
                      <span class="small pt-1 fw-bold"><?= facturee ?></span><span class="text-muted small pt-2 ps-1"></span>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

            <!-- Customers Card -->

            
            <div class="col-xxl-4 col-sm-4">

              <div class="card info-card revenue-card">

                <div class="filter">
                </div>
                <?php
                $art=mysqli_query($connect,'SELECT * , SUM(quantite_art) AS quantite 
                FROM commande_article,commande 
                WHERE commande.id_commande=commande_article.id_commande AND date_retrait IS NULL ');
                while($en_stock=mysqli_fetch_assoc($art)){
                  $article_en_stock=$en_stock['quantite'];
                }
                ?>
                <div class="card-body">
                  <h5 class="card-title"><?= art_stock ?><span></span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-server"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?= $article_en_stock ?></h6>
                      <span class="small pt-1 fw-bold"><?= article ?>s</span><span class="text-muted small pt-2 ps-1"></span>

                    </div>
                  </div>

                </div>
              </div>

            </div>

          
              </div>
            </div><!-- End Reports -->
      </div>

      <?php

        $c=mysqli_query($connect,"SELECT *,COUNT(cni_client) AS nbre_fois 
        FROM commande,client 
        WHERE client.id_client=commande.id_client
        GROUP BY nom_client
        ORDER BY COUNT(cni_client) DESC");

        foreach($c as $le_clt){
          $nom[]=$le_clt['nom_client'];
          $nbre_fois[]=$le_clt['nbre_fois'];
          $prenom[]=$le_clt['prenom_client'];
        }

        $z=mysqli_query($connect,
        "SELECT date_depot,SUM(montant_verse) 
        AS montant,COUNT(date_depot) 
        AS nbre_cmd 
        FROM commande
        INNER JOIN facture ON commande.id_commande=facture.id_commande
        GROUP BY date_depot 
        ORDER BY date_depot ASC ");

        foreach($z as $y){
          $date[]=$y['date_depot'];
          $cmd[]=$y['nbre_cmd'];
        }

      ?>
      <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title"><?= comparaison_par_rapport_cmd ?></h3>

                  <!-- Bar Chart -->
                  <canvas id="barChart" style="max-height: 400px; display: block; box-sizing: border-box; height: 26px; width: 53px;" width="43" height="26"></canvas>
                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new Chart(document.querySelector('#barChart'), {
                        type: 'bar',
                        data: {
                          labels: <?php echo json_encode($nom) ?>,
                          datasets: [{
                            label: '',
                            data: <?php echo json_encode($nbre_fois) ?>,
                            backgroundColor: [
                              'rgba(255, 99, 132, 0.2)',
                              'rgba(255, 159, 64, 0.2)',
                              'rgba(255, 205, 86, 0.2)',
                              'rgba(75, 192, 192, 0.2)',
                              'rgba(54, 162, 235, 0.2)',
                              'rgba(153, 102, 255, 0.2)',
                              'rgba(201, 203, 207, 0.2)'
                            ],
                            borderColor: [
                              'rgb(255, 99, 132)',
                              'rgb(255, 159, 64)',
                              'rgb(255, 205, 86)',
                              'rgb(75, 192, 192)',
                              'rgb(54, 162, 235)',
                              'rgb(153, 102, 255)',
                              'rgb(201, 203, 207)'
                            ],
                            borderWidth: 1
                          }]
                        },
                        options: {
                          scales: {
                            y: {
                              beginAtZero: true
                            }
                          }
                        }
                      });
                    });
                  </script>
                  <!-- End Bar CHart -->

              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title"><?= evolution_cmd ?></h5>

                <!-- Line Chart -->
                <canvas id="lineChart" style="max-height: 400px; display: block; box-sizing: border-box; height: 103px; width: 206px;" width="206" height="103"></canvas>
                <script>
                  document.addEventListener("DOMContentLoaded", () => {
                    new Chart(document.querySelector('#lineChart'), {
                      type: 'line',
                      data: {
                        labels: <?php echo json_encode($date) ?>,
                        datasets: [{
                          label: '<?= nombre_cmd ?>',
                          data: <?php echo json_encode($cmd) ?>,
                          fill: false,
                          borderColor: 'rgb(75, 192, 192)',
                          tension: 0.1
                        }]
                      },
                      options: {
                        scales: {
                          y: {
                            beginAtZero: true
                          }
                        }
                      }
                    });
                  });
                </script>
                <!-- End Line CHart -->

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

  <script>
    // script for attendance
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