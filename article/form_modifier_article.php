<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>LogixOne / Edit item</title>
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
      height: 15rem;
      width: 15rem;
      border-radius: 50%;
    }
    .image_article:hover{
      height: 17rem;
      width: 17rem;
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
?>
  <main class="main" id="main">
  <div class="pagetitle">
      <h1>Modifier ou supprimer</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="liste_articles.php">Liste des articles</a></li>
        </ol>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="form_ajout_article.php">Ajouter un article</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="container-fluid">
          <!-- <img src="../images/TengTech_Logo.png" alt=""> -->
              <br>
          <!-- <img src="../images/TengTech_Logo.png" alt=""> -->
              <br>
              <?php
              include '../connection.php';
              $categories=mysqli_query($connect,'SELECT * FROM categorie ORDER BY nom_categorie ASC');
              $id_article=$_GET['id_article'];
              $modif=mysqli_query($connect,'SELECT * FROM article,categorie WHERE categorie.id_categorie=article.id_categorie AND id_article="'.$id_article.'"');
              while($modifier=mysqli_fetch_assoc($modif)){

              ?>
              <div class="row shadow ">
                <div class="col-md-5 pt-3">
                    <div class="m-2">
                      <button class="btn btn-danger" 
                        onclick=" 
                          if(window.confirm('Voulez-vous vraiment supprimer cet article ?')== true){
                            window.location.replace('supprimer_article.php?id_article=<?php echo $modifier['id_article'] ?>');
                          }else{
                            exit;
                          }
                        " 
                        data-bs-toggle="tooltip" data-bs-placement="left" title="<?php echo supprimer ?>">
                        <i class="bi bi-trash"></i>
                        <?php echo supprimer ?>
                      </button>
                      <hr>
                    </div>
                  <span>
                    <img class="image_article shadow" src="../images/image_article/<?php echo $modifier['image_article'] ?>" alt="Edit to insert a photo">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Code</th>
                          <th>Designation</th>
                          <th>Prix</th>
                          <th>Categorie</th>
                        </tr>
                        <tbody>
                          <tr>
                            <td><?php echo $modifier['code_article'] ?></td>
                            <td><?php echo $modifier['designation'] ?></td>
                            <td><?php echo $modifier['prix_unitaire'] ?></td>
                            <td><?php echo $modifier['nom_categorie'] ?></td>
                          </tr>
                        </tbody>
                      </thead>
                    </table>
                  </span>
                </div>
                <div class="col-md-7 bg-white rounded pb-2 pt-4">
                  <h3 class="pagetitle">Modifier</h3>
                  <hr>
                  <form class="row g-3 needs-validation" enctype="multipart/form-data" action="modifier_article.php?id_article=<?=$id_article?>" method="post" novalidate>
                    <div class="col-md-4">
                      <label for="validationCustom01" class="form-label"><b>Code article</b></label><br>
                      <div class="input-group has-validation">
                        <input type="text" class="form-control" aria-describedby="inputGroupPrepend"  name="code_article" value="<?= $modifier['code_article'] ?>" id="validationCustomUsername" name="code_article" required>
                        <div class="invalid-feedback">
                          Veillez entrer un code de l'article!
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label for="validationCustomUsername" class="form-label"><b>Désignation</b></label>
                      <div class="input-group has-validation">
                        <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="designation" value="<?= $modifier['designation'] ?>" required>
                        <div class="invalid-feedback">
                          Veillez entrer la désignation!
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label for="validationCustomUsername" class="form-label"><b>Quantité</b> </label>
                      <div class="input-group has-validation">
                        <input type="number" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="quantite" value="<?= $modifier['quantite'] ?>" required>
                        <div class="invalid-feedback">
                          Veillez entrer la quantité!
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <label for="validationCustom03" class="form-label"><b>Prix Unitaire</b></label>
                      <input type="number" class="form-control" id="validationCustom03" name="prix_unitaire" value="<?= $modifier['prix_unitaire'] ?>" required>
                      <div class="invalid-feedback">
                      Veillez entrer le prix unitaire!
                      </div>
                    </div>
                    <div class="col-md-4">
                      <label for="validationCustom04" class="form-label"><b>Catégorie</b></label>
                      <select class="form-select" id="validationCustom04" name="categorie" value="<?= $modifier['nom_categorie'] ?>" required>
                        <?php
                          foreach($categories as $selected_cat){

                          ?>
                          <option  value="<?= $selected_cat['id_categorie'] ?>"><?= $selected_cat['nom_categorie'] ?></option>
                          <?php
                          }
                        ?>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label for="validationCustom03" class="form-label">Image</label>
                      <input type="file" class="form-control" id="validationCustom03" accept="image/*" name="image_article" required>
                      <div class="invalid-feedback">
                      Veillez inserer une image !
                    </div>
                    <div class="row mt-3">
                      <div class="col-md-6">
                        <button class="btn btn-primary" type="submit">
                          <i class="bi bi-database"></i>
                          Modifier
                        </button>
                      </div>
                      <div class="col-md-6">
                        <button class="btn btn-secondary" type="reset">
                          <i class="bi bi-arrow-counterclockwise"></i>
                          Annuler
                        </button>
                      </div>
                    </div>
                  </form><!-- End Custom Styled Validation -->
                </div>
              </div>

                <?php
                 }
                ?> 
            </form>

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