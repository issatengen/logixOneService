<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Logix / Report on orders</title>
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
  
  if(isset($_POST['date_x']) and isset($_POST['date_y'])){
    if(!empty($_POST['date_x']) and !empty($_POST['date_y'])){
      $date_x=$_POST['date_x'];
      $date_y=$_POST['date_y'];
      // Utilisé pour le tableau
      $x=mysqli_query($connect,
      "SELECT date_depot,
      SUM(montant_verse) AS montant,
      SUM(reste) AS  restant,
      SUM(reduction) AS les_reductions,
      COUNT(date_depot) AS nbre_cmd 
      FROM commande,facture 
      WHERE commande.id_commande=facture.id_commande
      AND date_depot BETWEEN '$date_x' AND '$date_y'
      GROUP BY date_depot
      ORDER BY date_depot DESC ");

      // Utilisé pour les totaux
      $j=mysqli_query($connect,
      "SELECT date_depot,
      SUM(montant_verse) AS montant,
      SUM(reste) AS  restant,
      SUM(reduction) AS les_reductions,
      COUNT(date_depot) AS nbre_cmd 
      FROM commande,facture 
      WHERE commande.id_commande=facture.id_commande
      AND date_depot BETWEEN '$date_x' AND '$date_y'
      ");

      // Utilisé por le graphique
      $z=mysqli_query($connect,
      "SELECT date_depot,
      SUM(montant_verse) AS montant,
      COUNT(date_depot) AS nbre_cmd 
      FROM commande,facture 
      WHERE commande.id_commande=facture.id_commande
      AND date_depot BETWEEN '$date_x' AND '$date_y'
      GROUP BY date_depot 
      ORDER BY date_depot DESC ");
    }
  }else{
    echo ' ';

    // Utilisé pour le tableau
    $x=mysqli_query($connect,
    "SELECT date_depot,
    SUM(montant_verse) AS montant,
    SUM(reste) AS  restant,
    SUM(reduction) AS les_reductions,
    COUNT(date_depot) AS nbre_cmd 
    FROM commande,facture 
    WHERE commande.id_commande=facture.id_commande
    GROUP BY date_depot 
    ORDER BY date_depot DESC ");

    // Utilisé pour les totaux
    $j=mysqli_query($connect,
    "SELECT date_depot,
    SUM(montant_verse) AS montant,
    SUM(reste) AS  restant,
    SUM(reduction) AS les_reductions,
    COUNT(date_depot) AS nbre_cmd 
    FROM commande,facture 
    WHERE commande.id_commande=facture.id_commande
    ");

      // Utilisé pour le graphique
    $z=mysqli_query($connect,
    "SELECT date_depot,SUM(montant_verse) 
    AS montant,COUNT(date_depot) 
    AS nbre_cmd 
    FROM commande,facture 
    WHERE commande.id_commande=facture.id_commande
    GROUP BY date_depot
    ORDER BY date_depot ASC ");
  }
  foreach($j as $k){
    $n=$k['nbre_cmd'];
    $m=$k['montant'];
    $o=$k['restant'];
    $p=$k['les_reductions'];
  }

  ?>
</head>
<body>
    <?php
    include_once 'header.php';
    ?>
    <main class="main" id="main">
      <div class="pagetitle">
        <h1><?= rapport ?>s</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="form_ajout_role.php"></a></li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
      <section class="section">
        <div class="row">
          <div class="col-md-11">
            <div class="card">
              <div class="card-body">

                <div class="row">
                  <div class="col-md-8 mt-5" title="<?= rechercher_dans_intervale ?>">
                  <!-- <h5 class="card-title"><?= rapports_cmd ?></h5> -->
                    <div class="card">
                      <div class="card-body">
                        <form action="rapport_sur_commandes.php" style="margin-top:10px" method="post">
                          <div class="row">
                            <div class="has-validation col-md-4" >
                              <input type="date" class="form-control" id="validationCustomUsername" title="<?= date_debut ?>" aria-describedby="inputGroupPrepend" name="date_x" required>
                              <div class="invalid-feedback">
                              Veillez entrer la première date !
                              </div>
                              <?php
                                if(isset($_POST['date_x']) and isset($_POST['date_y'])){
                                  if(!empty($_POST['date_x']) and !empty($_POST['date_y'])){
                                    echo $_POST['date_x'];
                                  }
                                }else{
                                  echo ' ';
                                }
                              ?>
                            </div>
                            <div class="has-validation col-md-4" >
                              <input type="date" class="form-control" id="validationCustomUsername" title="<?= date_fin ?>" aria-describedby="inputGroupPrepend" name="date_y" required>
                              <div class="invalid-feedback">
                                Veillez entrer la dernière date !
                              </div>
                              <?php
                                if(isset($_POST['date_x']) and isset($_POST['date_y'])){
                                  if(!empty($_POST['date_x']) and !empty($_POST['date_y'])){
                                    echo $_POST['date_y'];
                                  }
                                }else{
                                  echo ' ';
                                }
                              ?>
                            </div>
                            <div class="col-md-4">
                              <button type="submit" class="btn btn-primary" title="<?= rechercher ?>">
                                <i class="bi bi-search"></i>
                              </button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                  <h3 class="card-title"><?= exporter ?></h3>
                    <div class="card pt-2">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-sm-6">
                            <?php
                            if(isset($date_x) and isset($date_y)){

                            ?>
                            <a href="csv_commande.php?date_x=<?= $date_x ?> & date_y=<?= $date_y ?>" >
                              <button class="btn btn-success">
                                <i class="bi bi-file-earmark-excel"></i>
                                <span style="font-size:0.6rem">Excel</span>
                              </button>
                            </a>
                            <?php
                            }
                            else{
                              
                            ?>
                            <a href="csv_commande.php" >
                              <button class="btn btn-success">
                                <i class="bi bi-file-earmark-excel"></i>
                                <span style="font-size:0.6rem">Excel</span>
                              </button>
                            </a>
                            <?php
                            }
                            ?>
                          </div>
                          <div class="col-sm-6">
                            <button class="btn btn-danger  ">
                              <i class="bi bi-filetype-pdf"></i>
                              <span style="font-size:0.6rem">PDF</span>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <table class="table datatable table-striped">
                  <thead>
                    <tr>
                      <th scope="col"><?= date ?></th>
                      <th scope="col"><?= nombre_cmd ?></th>
                      <th scope="col"><?= encaissement ?></th>
                      <th scope="col"><?= montant_restant ?></th>
                      <th scope="col"><?= reduction ?></th>
                      <th scope="col"><?= action ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while($les_cmd=mysqli_fetch_assoc($x)){
                      
                    ?>
                    <tr>
                      <td id="dates"><?= $les_cmd['date_depot'] ?></td>
                      <td><?= $les_cmd['nbre_cmd'] ?></td>
                      <td id="montant"><?= $les_cmd['montant'] ?></td>
                      <td id="montant"><?= $les_cmd['restant'] ?></td>
                      <td id="montant"><?= $les_cmd['les_reductions'] ?></td>
                      <td>
                        <a href="#" >
                          <button class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="left" title="Supprimer">
                            <i class="bi bi-file-earmark-text-fill"></i>
                          </button>
                        </a>
                      </td> 
                    </tr>
                    <?php
                      }
                    ?>
                    </tr>
                    <tr>
                      <td><b><?= totaux ?></b></td>
                      <td><b><?= $n ?></b></td>
                      <td><b><?= $m ?></b></td>
                      <td><b><?= $o ?></b></td>
                      <td><b><?= $p ?></b></td>
                      <td>
                        <a href="#" >
                          <button class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="left" title="Supprimer" disable>
                            <i class="bi bi-file-earmark-text-fill"></i>
                          </button>
                        </a>
                      </td> 
                    </tr>
                  </tbody>
                  
                </table>

              </div>

            </div>
          </div><!-- End Recent Sales -->
          <?php

          $c=mysqli_query($connect,'SELECT cni_client,nom_client,prenom_client, COUNT(cni_client) as nbre_fois 
          FROM commande,client 
          WHERE client.id_client=commande.id_commande GROUP BY nom_client');
          
          ?>

          <?php 
            foreach($z as $y){
              $date[]=$y['date_depot'];
              $cmd[]=$y['nbre_cmd'];
            }
          ?>

          <div class="col-md-11">
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
      </div>
    </div>
      </section>
      
    </main>
    <?php
    include_once 'footer.php';
    ?>

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