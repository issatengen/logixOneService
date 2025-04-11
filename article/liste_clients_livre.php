<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Costumers</title>
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
    include '../connection.php';
    $commande=mysqli_query($connect,'SELECT nom_client,prenom_client,nom_utilisateur,prenom_utilisateur,id_commande,date_depot,date_estimatrice,date_retrait 
    FROM client,commande,utilisateur 
    WHERE client.id_client=commande.id_client 
    AND utilisateur.id_utilisateur=commande.id_utilisateur 
    AND date_retrait<>0
    ORDER BY id_commande DESC');
  ?>
</head>

<body>

<?php
  include_once 'header.php';
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1><?= client_livres ?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php"><?= tableau_bord ?></a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
        
              <!-- Table with stripped rows -->
              <center>
              <table class="table datatable">
                <thead>
                  <tr>
                  <th scope="col"><?= date_depot ?> </th>
                    <th scope="col"><?= date_estimatrice ?></th>
                    <th scope="col"><?= date_retrait ?></th>
                    <th scope="col"><?= client ?></th>
                    <th scope="col"><?= utilisateur ?></th>
                    <th scope="col">Action</th>
                    <th scope="col"><?= statut ?></th>
                    <!-- <th scope="col">Action</th> -->
                  </tr>
                </thead>
                <tbody>
                <?php
                  while($liste_commande=mysqli_fetch_assoc($commande)){

                ?>
                <tr>
                  <td><?=$liste_commande['date_depot']?></td>
                  <td><?=$liste_commande['date_estimatrice']?></td>
                  <td><?=$liste_commande['date_retrait']?></td>
                  <td><?=$liste_commande['nom_client']?> <?=$liste_commande['prenom_client']?></td>
                  <td><?=$liste_commande['nom_utilisateur'] ?> <?= $liste_commande['prenom_utilisateur']?></td>
                  <td>
                      <button class="btn btn-danger" 
                        onclick="
                          if(confirm('Voulez-vous vraiment supprimer ce client ?')==true){
                          window.location.replace('supprimer_commande.php?id_client=<?= $liste_commande['id_commande'] ?>');
                          }else{
                            exit;
                          }
                        " 
                        title="<?= supprimer ?>">
                          <i class="bi bi-trash"></i>
                      </button>
                    <a href="form_modifier_commande.php?id_commande=<?= $liste_commande['id_commande']?>">
                      <button class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" title="<?= modifier ?>">
                        <i class="bi bi-pencil-fill"></i>
                      </button>
                    </a>
                    <a href="consulter_commande.php?id_commande=<?= $liste_commande['id_commande']?>">
                      <button class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="right" title="<?= consulter ?>">
                        <i class="bi bi-journal-text"></i>
                      </button>
                    </a>
                  </td>
                  <?php
                  if($liste_commande['date_retrait'] != 0){

                  
                  ?>
                  <td>
                    <a href="#">
                      <button class="btn btn-outline-secondary rounded-circle" data-bs-toggle="tooltip" data-bs-placement="right" title="<?= livre ?>">
                        <i class="bi bi-check-all"></i>
                      </button>
                    </a>
                  </td>
                </tr>
                <?php
                  }else{

                ?>
                 <td>
                    <a href="#">
                      <button class="btn btn-info rounded-circle" data-bs-toggle="tooltip" data-bs-placement="right" title="<?= non_livre ?>" >
                        <i class="bi bi-file-x"></i>
                      </button>
                    </a>
                  </td>
                </tr>
                <?php
                  }
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