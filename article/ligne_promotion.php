
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Items on promotion</title>
  <meta content="OnePressing" name="description">
  <meta content="OnePressing" name="keywords">

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
  require_once 'header.php'; 
  include_once '../connection.php';
  $allArticles=mysqli_query($connect,'SELECT id_article,designation FROM article ORDER BY designation DESC');

  ?>
  <main class="main" id="main">
    <div class="pagetitle">
      <h1><?= ajout_articles_promotion ?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#"></a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
    <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">

            <!-- Custom Styled Validation -->
              <form class="row g-3 needs-validation" id="ligne_promotion" action="ligne_promotion_ajout.php" method="post" novalidate>
                <div class="col-md-4">
                  <?php
                    foreach($allArticles as $article){

                  ?>
                    <input type="checkbox" name="id_article" id="article" value="<?= $article['id_article'] ?>">
                    <label for="validationCustom01" class="form-label"><b><?= $article['designation'] ?></b></label><br>
                  <?php
                   }
                  ?>
                </div>
                <div class="col-md-5">
                  <label for="validationCustomUsername" class="form-label"><b><?= poucentage_reduction ?></b></label>
                  <div class="input-group has-validation">
                    <input type="number" class="form-control" title="<?= entrer_un_nombre_entre_zero_cent ?>" name="pourcentage_reduction" id="pourcentage" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                     <?= veillez_pourcentage ?>
                    </div>
                </div>
                <div class="col-md-9">
                  <br>
                  <button class="btn btn-success" type="submit">
                    <i class="bi bi-database"></i>
                    <?= enregistrer ?>
                  </button>
                </div>
              </form><!-- End Custom Styled Validation -->
            <br>
            </div>
          </div>

        </div>
      </div>
    </section>
  </main>


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
    let ligne_promotion=document.getElementById('ligne_promotion');
    ligne_promotion.addEventListener('submit', envoyer);
    function envoyer(){
      let pourcentage_reduction=document.getElementById('pourcentage').value;
      let article=document.getElementsByName('id_article').value.checked;
      document.write(pourcentage_reduction);
      let i=0;
      for(i=1;i<=article.lenght;i++){
        if(article[i].checked){
          let selected=article[i].value;
          document.write(selected);
        }else{
          exit
        }
      }
    }
  </script>
</body>
</html>