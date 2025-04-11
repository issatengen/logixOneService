<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report on costumers</title>
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
  $x=mysqli_query($connect,'SELECT date_depot,SUM(montant_verse) AS montant,COUNT(date_depot) AS nbre_cmd 
  FROM commande,facture 
  WHERE commande.id_commande=facture.id_commande
  GROUP BY date_depot 
  ORDER BY date_depot DESC ');
  ?>
</head>
<body>
    <?php
    include_once 'header.php';
    ?>
    <main class="main" id="main">
      <div class="pagetitle">
        <h1><?= rapport ?>s <?= client?>s</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="form_ajout_role.php"></a></li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
      <section class="section">
        <div class="row">
          <?php
          if(isset($_POST['date_x']) and isset($_POST['date_y'])){
            if(!empty($_POST['date_x']) and !empty($_POST['date_y'])){
              $date_x=$_POST['date_x'];
              $date_y=$_POST['date_y'];

              $clt=mysqli_query($connect,"  SELECT *,COUNT(cni_client) AS nbre_fois 
              FROM client,commande 
              WHERE client.id_client=commande.id_client 
              AND date_depot between '$date_x' and '$date_y' 
              GROUP BY nom_client 
              ORDER BY count(cni_client) DESC");

              // Utiliser pour le graphe
              $c=mysqli_query($connect,"  SELECT *,COUNT(cni_client) AS nbre_fois 
              FROM client,commande 
              WHERE client.id_client=commande.id_client 
              AND date_depot between '$date_x' and '$date_y' 
              GROUP BY nom_client 
              ORDER BY count(cni_client) DESC");

              // Utilisé pour le total 
              $c1=mysqli_query($connect,"  SELECT *,COUNT(cni_client) AS nbre_fois 
              FROM client,commande 
              WHERE client.id_client=commande.id_client 
              AND date_depot between '$date_x' and '$date_y'  
              ORDER BY count(cni_client) DESC");

            }
          }else{
            echo ' ';
            $clt=mysqli_query($connect,"SELECT *,COUNT(cni_client) AS nbre_fois 
            FROM commande,client 
            WHERE client.id_client=commande.id_client
            GROUP BY nom_client
            ORDER BY COUNT(cni_client) DESC");

            // pour le graphe
            $c=mysqli_query($connect,"SELECT *,COUNT(cni_client) AS nbre_fois 
            FROM commande,client 
            WHERE client.id_client=commande.id_client
            GROUP BY nom_client
            ORDER BY COUNT(cni_client) DESC");

            // pour le total
            // Utilisé pour le total 
            $c1=mysqli_query($connect,"  SELECT COUNT(cni_client) AS nbre_fois 
            FROM client,commande 
            WHERE client.id_client=commande.id_client  
            ORDER BY count(cni_client) DESC");
          }

          $pourPDF=mysqli_query($connect,"SELECT *,COUNT(cni_client) AS nbre_fois 
          FROM commande,client 
          WHERE client.id_client=commande.id_client
          GROUP BY nom_client
          ORDER BY COUNT(cni_client) DESC");
          
          
          $z=mysqli_query($connect,'SELECT date_depot,COUNT(date_depot) AS nbre_cmd 
          FROM commande 
          GROUP BY date_depot 
          ORDER BY date_depot DESC ');
          ?>
          
          <div class="col-md-11">
            <div class="card">
              <div class="card-body">
                <!-- <h2 class="card-title"><?= rapports_clt ?></h2> -->
   
                <div class="row">
                  <div class="col-md-8 mt-5" title="<?= rechercher_dans_intervale ?>">
                    <!-- <h3 class="card-title"><?= rechercher_dans_un_intervale ?></h3> -->
                    <div class="card">
                      <div class="card-body">
                        <form action="rapport_sur_clients.php" style="margin-top:10px" method="post">
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
                    <div class="card">
                      <div class="card-body mt-2">
                        <div class="row">
                          <div class="col-sm-4">
                            <?php
                            if(isset($date_x) and isset($date_y)){

                            ?>
                            <a href="csv_client.php?date_x=<?= $date_x ?> & date_y=<?= $date_y ?>" >
                              <button class="btn btn-success">
                                Excel
                              </button>
                            </a>
                            <?php
                            }
                            else{
                              
                            ?>
                            <a href="csv_client.php" >
                              <button class="btn btn-success">
                                Excel
                              </button>
                            </a>
                            <?php
                            }
                            ?>
                          </div>
                          <?php
                          foreach($pourPDF as $cni){
                            $cni_client=$cni['cni_client'];
                          }
                          ?>
                          <a class="col-sm-4" href="pdf_report_costumer.php">
                            <button class="btn btn-danger">
                              PDF
                            </button>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <table class="table datatable table-striped">
                  <thead>
                  <!-- <th class="col"><?= date_depot ?></th> -->
                    <th class="col"><?= nom_clt ?></th>
                    <th class="col"><?= prenom_clt?></th>
                    <th class="col"><?= nombre_cmd ?></th>
                    <!-- <th class="col"><?= recette_totale ?></th> -->
                    <th class="col"><?= action ?></th>
                  </thead>
                  <tbody>
                    <?php
                    while($les_clt=mysqli_fetch_assoc($clt)){

                    ?>
                      <tr>
                      <!-- <td><?= $les_clt['date_depot'] ?></td> -->
                        <td><?= $les_clt['nom_client'] ?></td>
                        <td><?= $les_clt['prenom_client'] ?></td>
                        <td><?= $les_clt['nbre_fois'] ?></td>
                        <!-- <td><?= $les_clt['recette'] ?></td> -->
                        <td>
                          <a href="costumer_details.php?cni_client=<?= $les_clt['cni_client']?>" >
                            <button class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="left" title="<?= imprimer ?>">
                              <i class="bi bi-file-earmark-text-fill"></i>
                            </button>
                          </a>           
                        </td>
                      </tr>
                    <?php
                    }
                    foreach($c as $le_clt){
                      $nom[]=$le_clt['nom_client'];
                      $nbre_fois[]=$le_clt['nbre_fois'];
                      $prenom[]=$le_clt['prenom_client'];
                    }
                    ?>
                  </tbody>
                </table>
                <div class="row">
                  <div class="col-md-4"></div>
                  <div class="col-md-6">
                    <div class="card">
                      <div class="card-body">
                        <?php
                        while($total=mysqli_fetch_assoc($c1)){
                        ?>
                        <div class="row">
                          <div class="col-sm-6 ">
                            <h2 class="card-title">Total commandes</h2>
                          </div>
                          <div class="col-sm-6">
                            <h3 class="card-title text-lg">
                              <?= $total['nbre_fois'] ?>
                            </h3>
                          </div>
                        </div>
                        <?php
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        
          <div class="col-md-10">
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