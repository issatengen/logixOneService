<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial report</title>
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

  //  Créer le 14/12/2024
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
        <h1><?php echo rapport_fin ?></h1>
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

             // RAPPORT FINANCIER SUR LE NOMBRE DE COMMANDE
              $call_fin_cmd="SELECT date_depot,
                SUM(montant_verse) AS montant,
                SUM(reste) AS  restant,
                SUM(reduction) AS les_reductions,
                COUNT(date_depot) AS nbre_cmd 
                FROM commande
                JOIN facture ON  commande.id_commande=facture.id_commande
                AND date_depot BETWEEN '$date_x' AND '$date_y'
                GROUP BY date_depot
                ORDER BY date_depot DESC
                LIMIT 31";

              $call_fin_cmd_tt="SELECT date_depot,
                SUM(montant_verse) AS montant_cmd,
                SUM(reste) AS  restant,
                SUM(reduction) AS red,
                COUNT(date_depot) AS nbre_cmd 
                FROM commande,facture 
                WHERE commande.id_commande=facture.id_commande
                AND date_depot BETWEEN '$date_x' AND '$date_y'";

              // Pour tableau
              $fr_cmd=mysqli_query($connect,$call_fin_cmd);
              // Pour afficher les totaux à la fin du tableau
              $cmd_totals=mysqli_query($connect,$call_fin_cmd_tt);

              // Utiliser pour le graphe
              $fr_plt=mysqli_query($connect,$call_fin_cmd);

           // RAPPORT FINANCIER SUR LES RECETTES JOURNALIERE
            $call_fin_recette="SELECT * FROM recette_journaliere 
              JOIN utilisateur ON utilisateur.id_utilisateur=recette_journaliere.id_utilisateur
              AND date_recette BETWEEN '$date_x' AND '$date_y' 
              ORDER BY date_recette DESC
              LIMIT 31";

            $call_fin_recette_tt="SELECT SUM(montant_recette) as montant_recette FROM recette_journaliere 
            JOIN utilisateur ON utilisateur.id_utilisateur=recette_journaliere.id_utilisateur 
            AND date_recette BETWEEN '$date_x' AND '$date_y' ";

            $fr_recette=mysqli_query($connect,$call_fin_recette);

            $recette_totals=mysqli_query($connect,$call_fin_recette_tt);

          // RAPPORT FINANCIER SUR LES DEPENSE JOURNALIERE
            $call_fin_depense="SELECT * FROM depense 
            JOIN utilisateur ON utilisateur.id_utilisateur=depense.id_utilisateur
            AND date_depense BETWEEN '$date_x' AND '$date_y' 
            ORDER BY date_depense DESC
            LIMIT 31";

            $call_fin_depense_tt="SELECT SUM(montant_depense) as montant_depense FROM depense
            JOIN utilisateur ON utilisateur.id_utilisateur=depense.id_utilisateur 
            AND date_depense BETWEEN '$date_x' AND '$date_y' ";

            $fr_depense=mysqli_query($connect,$call_fin_depense);

            $depense_totals=mysqli_query($connect,$call_fin_depense_tt);
            }
          }else{
            echo ' ';

           // RAPPORT FINANCIER SUR LE NOMBRE DE COMMANDE
            $call_fin_cmd="SELECT date_depot,
            SUM(montant_verse) AS montant,
            SUM(reste) AS  restant,
            SUM(reduction) AS les_reductions,
            COUNT(date_depot) AS nbre_cmd 
            FROM commande
            JOIN facture ON  commande.id_commande=facture.id_commande
            GROUP BY date_depot
            ORDER BY date_depot DESC
            LIMIT 31";

            $call_fin_cmd_tt='SELECT date_depot,
              SUM(montant_verse) AS montant_cmd,
              SUM(reste) AS  restant,
              SUM(reduction) AS red
              FROM commande,facture 
              WHERE commande.id_commande=facture.id_commande';

            // Pour tableau
            $fr_cmd=mysqli_query($connect,$call_fin_cmd);
            // Pour afficher les totaux à la fin du tableau
            $cmd_totals=mysqli_query($connect,$call_fin_cmd_tt);

            // Pour graphique
            $fr_plt=mysqli_query($connect,$call_fin_cmd);

          // RAPPORT FINANCIER SUR LES RECETTES JOURNALIERE
            $call_fin_recette="SELECT * FROM recette_journaliere 
              JOIN utilisateur ON utilisateur.id_utilisateur=recette_journaliere.id_utilisateur
              ORDER BY date_recette DESC
              LIMIT 31";

            $call_fin_recette_tt="SELECT SUM(montant_recette) as montant_recette FROM recette_journaliere 
              JOIN utilisateur ON utilisateur.id_utilisateur=recette_journaliere.id_utilisateur ";

            $fr_recette=mysqli_query($connect,$call_fin_recette);
            // Pour afficher les totaux à la fin du tableau
            $recette_totals=mysqli_query($connect,$call_fin_recette_tt);

          // RAPPORT FINANCIER SUR LES DEPENSES JOURNALIERE
            $call_fin_depense="SELECT * FROM depense 
            JOIN utilisateur ON utilisateur.id_utilisateur=depense.id_utilisateur
            ORDER BY date_depense DESC
            LIMIT 31";

            $call_fin_depense_tt="SELECT SUM(montant_depense) as montant_depense FROM depense 
              JOIN utilisateur ON utilisateur.id_utilisateur=depense.id_utilisateur ";

            $fr_depense=mysqli_query($connect,$call_fin_depense);
            // Pour afficher les totaux à la fin du tableau
            $depense_totals=mysqli_query($connect,$call_fin_depense_tt);
          }

          // Retrive totals cmd
          foreach($cmd_totals as $totals_cmd){
            $tt_encaissement=$totals_cmd['montant_cmd'];
            $tt_restant=$totals_cmd['restant'];
            $tt_red=$totals_cmd['red'];
          }
          // Retrive totals incomes
          foreach($recette_totals as $totals_recette){
            $tt_mt_recette=$totals_recette['montant_recette'];
          }
          // Retrive totals expenses
          foreach($depense_totals as $totals_depense){
            $tt_mt_depense=$totals_depense['montant_depense'];
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
          
          <div class="row">
            <div class="col-md-4 mb-1">
              <h3 class="card-title"><?= exporter ?></h3>
              <div class="row">
                <?php
                foreach($pourPDF as $cni){
                  $cni_client=$cni['cni_client'];
                }
                ?>
                <?php
                  if(isset($date_x) and isset($date_y)){

                  ?>
                  <a href="pdf_report_finance.php?date_x=<?php echo $date_x ?> & date_y=<?php echo $date_y ?>" >
                    <button class="btn btn-outline-danger">
                      <i class="bi bi-filetype-pdf"></i>
                      <span style="font-size:0.6rem">PDF</span>
                    </button>
                  </a>
                  <?php
                  }
                  else{
                    
                  ?>
                    <a class="col-sm-4" href="pdf_report_finance.php">
                      <button class="btn btn-outline-danger">
                        <i class="bi bi-filetype-pdf"></i>
                        <span style="font-size:0.6rem">PDF</span>
                      </button>
                    </a>
                  <?php } ?>
              </div>
            </div>
            <div class="col-md-8 mb-1" title="<?= rechercher_dans_intervale ?>">
             <h3 class="card-title"><?= rechercher ?></h3>
              <form action="rapport_finance.php" style="margin-top:10px" method="post">
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
          <hr>
          <div class="col-md-11">
            <table class="table">
              <h3 class="card-title"><?php echo rapport_sur_commandes ?></h3>
              <thead>
                <th scope="col"><?= date ?></th>
                <th scope="col"><?= encaissement ?></th>
                <th scope="col"><?= montant_restant ?></th>
                <th scope="col"><?= reduction ?></th>
              </thead>
              <tbody>
                <?php
                while($this_fin_cmd=mysqli_fetch_assoc($fr_cmd)){

                ?>
                  <tr>
                    <td ><?= $this_fin_cmd['date_depot'] ?></td>
                    <td ><?= $this_fin_cmd['montant'] ?></td>
                    <td ><?= $this_fin_cmd['restant'] ?></td>
                    <td ><?= $this_fin_cmd['les_reductions'] ?></td>
                  </tr>
                <?php
                }
                ?>
                  <tr>
                    <td><b><?php echo totaux ?></b></td>
                    <td><b><?php echo $tt_encaissement.' FCFA' ?></b></td>
                    <td><b><?php echo $tt_restant.' FCFA' ?></b></td>
                    <td><b><?php echo $tt_red.' FCFA' ?></b></td>
                  </tr>
              </tbody>
            </table>
          </div>
          <div class="col-md-11">
            <table class="table">
              <h3 class="card-title"><?php echo rapport_recette ?></h3>
              <thead>
                <tr>
                  <th scope="col">Date</th>
                  <th scope="col"><?php echo montant_recette ?></th>
                  <th scope="col"><?php echo nom_utilisateur ?></th>
                </tr>
              </thead>
              <tbody>
                <?php
                while($this_fin__recette=mysqli_fetch_assoc($fr_recette)){

                
                ?>
                <tr>
                  <td><?php echo $this_fin__recette['date_recette'] ?></td>
                  <td><?php echo $this_fin__recette['montant_recette'] ?></td>
                  <td><?php echo $this_fin__recette['nom_utilisateur'].' '.$this_fin__recette['prenom_utilisateur'] ?></td>
                </tr>
                <?php
                }
                ?>
                <tr>
                  <td><b><?php echo 'Total'  ?></b></td>
                  <td><b><?php echo $tt_mt_recette.' FCFA' ?></b></td>
                  <td>
                    <?php

                    ?>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-md-11">
            <table class="table">
              <h3 class="card-title"><?php echo rapport_depense ?></h3>
              <thead>
                <tr>
                  <th scope="col">Date</th>
                  <th scope="col"><?php echo montant_depense ?></th>
                  <th scope="col"><?php echo nom_utilisateur ?></th>
                </tr>
              </thead>
              <tbody>
                <?php
                while($this_fin__depense=mysqli_fetch_assoc($fr_depense)){

                
                ?>
                <tr>
                  <td><?php echo $this_fin__depense['date_depense'] ?></td>
                  <td><?php echo $this_fin__depense['montant_depense'] ?></td>
                  <td><?php echo $this_fin__depense['nom_utilisateur'].' '.$this_fin__depense['prenom_utilisateur'] ?></td>
                </tr>
                <?php
                }
                ?>
                <tr>
                  <td><b><?php echo 'Total'  ?></b></td>
                  <td><b><?php echo $tt_mt_depense.' FCFA' ?></b></td>
                  <td>
                    <?php

                    ?>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-md-11 card">
            <h3 class="card-title">
              <?php echo resumer ?>
            </h3>
            <table class="table">
              <thead>
                <tr>
                  <th><?php echo recettes_des_cmd ?></th>
                  <th><?php echo recette_des_services_tierce ?></th>
                  <th><?php echo recettes_tt ?></th>
                  <th><?php echo depenses ?></th>
                  <th><?php echo resultats ?></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><b><?php echo $tt_encaissement.' FCFA' ?></b></td>
                  <td><b><?php echo $tt_mt_recette-$tt_encaissement.' FCFA' ?></b></td>
                  <td><b><?php echo $tt_mt_recette.' FCFA' ?></b></td>
                  <td><b><?php echo $tt_mt_depense.' FCFA' ?></b></td>
                  <td><b><?php echo $tt_mt_recette-$tt_mt_depense.' FCFA' ?></b></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-md-10">
            <div class="">
              <div class="">
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