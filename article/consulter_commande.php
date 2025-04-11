<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>LogixOne / details on order</title>
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
  <?php
  $id_commande=$_GET['id_commande'];
  $nom=mysqli_query($connect,'SELECT * FROM client,commande 
  WHERE client.id_client=commande.id_client AND id_commande="'. $id_commande .'" ');
  while($le_nom=mysqli_fetch_assoc($nom)){
    $nom_client=$le_nom['nom_client'];
    $prenom_client=$le_nom['prenom_client'];
    $cni_client=$le_nom['id_client'];
  }
  ?>

    <div class="pagetitle">
      <h1>Details sur commande de </h1><b><?= $nom_client .' '. $prenom_client ?> - <?= $id_commande ?> </b>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item btn btn-primary m-1">
            <a style="color:white" href="form_ajout_commande_article.php?id_commande=<?= $id_commande ?>">
              <i class="bi bi-database-add"></i>
              Ajouter un article
            </a>
          </li>
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
                $commande_article=mysqli_query($connect,'SELECT * FROM commande_article WHERE id_commande="'.$id_commande.'"');
                while($cet_article=mysqli_fetch_assoc($commande_article)){
                  $id_article=$cet_article['id_article'];
                }
              ?>
              <table class="table table-striped datatable">
                <thead>
                  <tr>
                    <th scope="col">  Designation </th>
                    <th scope="col"> Quantite </th>
                    <th scope="col"> Prix Unitaire </th>
                    <th scope="col"> Montant </th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  // $art=mysqli_query($connect,'SELECT id_article, FROM commande_article WHERE id_commande="'.$id_commande.'"');
                  // while($cet_art=mysqli_fetch_assoc($art)){
                  // $id_article=$cet_art['id_article'];
                  // }
                ?>
                  <tr>
                    <?php
                     $commande=mysqli_query($connect,'SELECT * FROM article,commande_article WHERE article.id_article=commande_article.id_article AND id_commande="'.$id_commande.'"');
                     while($cet_commande=mysqli_fetch_assoc($commande)){
                
                    
                    ?>
                      <td><?=$cet_commande['designation']?></td>
                      <td><?=$cet_commande['quantite_art']?></td>
                      <td><?=$cet_commande['prix_unitaire_art']?></td>
                      <td><?=$cet_commande['montant']?></td>
                      <td>
                        <button
                        onclick="
                          let del=confirm('Voulez-vous vraiment supprimer cet article de la commande ?');
                          if(del==true){
                          window.location.replace('supprimer_article_commande.php?id_article=<?= $cet_commande['id_article'] ?>')
                          }
                        "
                        class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="left" title="Supprimer">
                        <i class="bi bi-trash-fill"></i>
                        </button>
                        <a href="form_modifier_article_commande.php?id_article=<?= $cet_commande['id_article'] ?>" >
                          <button class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="Mofidier">
                          <i class="bi bi-pencil-fill"></i>
                          </button>
                        </a>
                      </td>
                  </tr>
                <?php
                }
                $quantite_art=mysqli_query($connect,'SELECT SUM(quantite_art) AS quantite_totale 
                FROM commande_article WHERE id_commande="'.$id_commande.'"');
                ?>
                </tbody>
              </table>
              <table class="table ">
                <thead>
                  <tr>
                    <th>Nombre d'article</th>
                    <th>Montant Total</th>
                    <!-- <th>Montant versé</th> -->
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php
                    while($la_quantite=mysqli_fetch_assoc($quantite_art)){

                    ?>
                    <td><?= $la_quantite['quantite_totale'] ?></td>
                    <?php
                    }
                    $montant=mysqli_query($connect,'SELECT SUM(montant) AS montant_total FROM commande_article WHERE id_commande="'.$id_commande.'"');
                    while($le_montant_total=mysqli_fetch_assoc($montant)){

                    ?>
                    <td><?= $le_montant_total['montant_total'] ?> FCFA</td>
                    <?php
                    }
                    ?>
                    <!-- <td>
                      <button class="btn btn-info">
                        <i class="bi bi-coin"></i>
                        <a style="text-decoration:none;color:white" href="reduction.php">Réduction</a>
                      </button>
                    </td> -->
                  </tr>
                </tbody>
              </table>
              <form action="form_ajout_facture.php?id_commande=<?= $_GET['id_commande']?>" method="post">
                <button class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="left">
                 <i class="bi bi-receipt"></i>
                 <input type="submit" value="Facture"  class="btn btn-success">
                </button>
              </form>
              <!-- End Table with stripped rows -->
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