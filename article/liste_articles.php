<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Items</title>
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
  <style>
    .image_article{
      height: 3rem;
      width: 3rem;
      border-radius: 50%;
    }
    .image_article:hover{
      height: 10rem;
      width: 10rem;
      border-radius: 5%;
    }
    
  </style>


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
  $code=$_SESSION['code'];
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1><?= liste_articles ?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html"><?= tableau_bord ?></a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="row">
            <div class="col-sm-8"></div>
            <div class="col-sm-4 mb-2">
              <a href="form_ajout_article.php">
                <button class="btn btn-success">
                  <i class="bi bi-plus"></i>
                  <b><?= ajouter ?></b>
                </button>
              </a>
              <a href="csv_liste_articles.php">
                <button class="btn btn-success">
                <i class="bi bi-file-excel"></i>
                  <b>Excel</b>
                </button>
              </a>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
        
              <!-- Table with stripped rows -->
              <?php
                include '../connection.php';
                $article=mysqli_query($connect,'SELECT * FROM article,categorie 
                WHERE categorie.id_categorie=article.id_categorie
                ORDER BY nom_categorie DESC');
              ?>
              <center>
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col"><?= code_article ?></th>
                    <th scope="col"><?= designation ?></th>
                    <th scope="col"><?= quantite ?></th>
                    <th scope="col"><?= prix_unitaire ?></th>
                    <th scope="col"><?= categorie ?></th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  while($liste_article=mysqli_fetch_assoc($article)){

                ?>
                <tr>
                  <td>
                    <span class="d-block">
                      <span>
                         <?=$liste_article['code_article']?>
                      </span>
                      <span>
                      <?php
                       if($code == 'ADMIN'){

                      ?>
                        <a href="form_modifier_article.php?id_article=<?= $liste_article['id_article']?>">
                          <img class="image_article" src="../images/image_article/<?php echo $liste_article['image_article'] ?>" alt="Edit to insert a photo">
                        </a>
                      <?php
                        }else{
                          
                        ?>
                        <img class="image_article" src="../images/image_article/<?php echo $liste_article['image_article'] ?>" alt="Edit to insert a photo">
                        <?php
                        }
                        ?>
                      </span>
                    </span>
                  </td>
                  <td><?php echo $liste_article['designation']?></td>
                  <td><?php echo $liste_article['quantite']?></td>
                  <td><?php echo $liste_article['prix_unitaire'].' FCFA'?></td>
                  <td><?php echo $liste_article['nom_categorie']?></td>
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
  </main>
  <!-- End #main -->

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