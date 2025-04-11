<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Categories</title>
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
  // Modifier la catégorie
   
  ?>
  
</head>

<body>

<?php
  include_once 'header.php';
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1><?= liste_categories ?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html"><?= tableau_bord ?></a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row mb-2">
        <div class="col-sm-8"></div>
        <div class="col-sm-3">
        <!-- Basic Modal -->
            <button type="button" class="btn btn-success fs-6" data-bs-toggle="modal" data-bs-target="#basicModal">
              <b><i class="bi bi-plus"></i>
              Ajouter</b>
            </button>
            <div class="modal fade" id="basicModal" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title"><?= ajout_categorie ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-10">
                        <div class="card">
                          <div class="card-body">
                            <form class="row g-3 needs-validation" action="ajout_categorie.php" method="post" novalidate>
                              <div class="col-md-8">
                                <label for="validationCustom01" class="form-label"><b><?= designation ?></b></label><br>
                                <input type="text" class="form-control" id="validationCustom01" name="nom_categorie" required>
                                <div class="valid-feedback">
                                  <?= veillez_entrer_designation ?>
                                </div>
                              </div>
                              <div class="col-md-11">
                                <label for="validationCustomUsername" class="form-label"><b><?= description ?></b></label>
                                <textarea class="form-control" name="description_categorie"id="validationCustom01" required></textarea>
                                <div class="valid-feedback">
                                  <?= veillez_entrer_designation ?>
                                </div>
                              </div>
                              <div class="col-12">
                                <br>
                                <button class="btn btn-lg btn-primary" type="submit"><?= enregistrer ?></button>
                              </div>
                            </form><!-- End Custom Styled Validation -->
                          </div>
                        </div>
                      </div>
                    </div> 
                  </div>        
                  <div class="modal-footer">
                    <?= pied_formulaires?>
                  </div>
                </div>
              </div>
            </div><!-- End Basic Modal-->
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
        
              <!-- Table with stripped rows -->
              <?php
                $categorie=mysqli_query($connect,'SELECT * FROM categorie');
              ?>
              <center>
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col"><?= categorie ?> </th>
                    <th scope="col"><?= description ?> </th>
                    <th scope="col">Action </th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  while($liste_categorie=mysqli_fetch_assoc($categorie)){

                ?>
                <tr>
                  <td>
                    <?=$liste_categorie['nom_categorie']?>
                  </td>
                  <td>
                    <?=$liste_categorie['description_categorie']?>
                  </td>
                  <td>

                    <?php
                    if($code == 'ADMIN'){


                    ?>
                    <button class="btn btn-danger" 
                      onclick="
                        if(confirm('Voulez-vous vraiment supprimer cette catégorie ?')==true){
                          window.location.replace('supprimer_categorie.php?id_categorie=<?= $liste_categorie['id_categorie'] ?>');
                        }else{
                          exit;
                        }
                      " 
                      title="<?= supprimer ?>">
                        <i class="bi bi-trash"></i>
                    </button>
                    <a href="form_modifier_categorie.php?id_categorie=<?= $liste_categorie['id_categorie'] ?>" data-bs-placement="right" title="<?= modifier ?>" >
                      <button class="btn btn-primary">
                       <i class="bi bi-pencil-fill"></i>
                      </button>
                    </a>
                      
                    <?php
                      }else{
                        echo ' ';
                      }
                    ?>
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
    const statusParam=new URLSearchParams(window.location.search);
    const status=statusParam.get('status');
    if(status){
      alert(status);
    }else{
      exit;
    }
  </script>

</body>

</html>