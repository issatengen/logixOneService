<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>LogixOne / Costumer report</title>
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
  include '../connection.php';
?>

  <main id="main" class="main">
  <?php
  if(isset($_GET['cni_client'])){
    $id_client=$_GET['id_client'];
    $detail=mysqli_query($connect,"SELECT * FROM client 
    JOIN commande ON client.id_client=commande.id_client
    JOIN commande_article ON commande.id_commande=commande_article.id_commande
    JOIN article ON article.id_article=commande_article.id_article
    WHERE cni_client='".$cni_client."' ");

    // Pour nom et prenom
    $detail2=mysqli_query($connect,"SELECT * FROM client 
    JOIN commande ON client.id_client=commande.id_client
    JOIN commande_article ON commande.id_commande=commande_article.id_commande
    JOIN article ON article.id_article=commande_article.id_article
    WHERE cni_client='".$cni_client."' ");
  }else{
    echo " ";
  }
  foreach($detail2 as $nomPrenom){
    $nom=$nomPrenom['nom_client'];
    $prenom=$nomPrenom['prenom_client'];
  }
?>

    <div class="pagetitle">
      <h1>Details sur commande de </h1><b><?php echo $nom.' '. $prenom ?> </b>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item btn btn-primary m-1">
            <a href="pdf_costumer_details.php?cni_client=<?= $cni_client ?>">
                <button class="btn btn-danger">
                    PDF
                </button>
            </a>
          </li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
    <div class="col-lg-11">
          <div class="card">
            <div class="card-body">
              <table class="table table-striped">
                <thead>
                  <tr>
                  <th class="scope">Article</th>
                  <th class="scope">Quantité</th>
                  <th class="scope">date dépot</th>
                  <th class="scope">date estimatrice</th>
                  <th class="scope">Date retrait</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  while($le_detail=mysqli_fetch_assoc($detail)){

                  ?>
                  <tr>
                  <td><?= $le_detail['designation'] ?></td>
                  <td><?= $le_detail['quantite_art'] ?></td>
                  <td><?= $le_detail['date_depot'] ?></td>
                  <td><?= $le_detail['date_estimatrice'] ?></td>
                  <td><?= $le_detail['date_retrait'] ?></td>
                  </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
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