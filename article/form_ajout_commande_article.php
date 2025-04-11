<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>LogixOne / Add items in order</title>
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
      height: 4rem;
      width: 4rem;
      border-radius: 7%;
    }
    .image_article:hover{
      height: 7rem;
      width: 7rem;
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
      <h1><?= ajout_article_cmd ?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="liste_commandes.php"><?= liste_commandes ?></a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <?php
    include_once '../connection.php';
    $liste_article=mysqli_query($connect,'SELECT * FROM article ORDER BY designation ASC');

    ?>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              
              <div class="row">
                <?php
                  While($article=mysqli_fetch_assoc($liste_article)){
                
                  
                ?>
                <div class="btn col-md-1">
                  <a href="form_ajout_commande_article.php?id_article= <?= $article['id_article'] ?>" style="text_decoration:none;">
                    <img class="image_article" src="../images/image_article/<?php echo $article['image_article']?>" alt="<?php echo $article['designation'] ?>" title="<?php echo $article['designation'] ?>">
                  </a>
                </div>
                <?php
                  }
                ?>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>
    <?php
    if(!empty($_GET['id_article'])){
    $id_art=$_GET['id_article'];

    }else{
      echo ' ';
    }
    ?>
    <table class="table datatable">
      <thead>
        <tr>
          <th class="scope"><?= designation ?></th>
          <th class="scope"><?= quantite ?></th>
          <th class="scope"><?= prix_unitaire ?></th>
          <th class="scope"><b>Action</b></th>
        </tr>
      </thead>
      <tbody>
        <?php
        ?>
        <tr>
          <?php
          if(!empty($id_art)){
            $l_article=mysqli_query($connect,'SELECT * FROM article WHERE id_article="'.$id_art.'"');
            while($un_article=mysqli_fetch_assoc($l_article)){
            $designation=$un_article['designation'];
            $quantite=$un_article['quantite'];
            $prix_unitaire=$un_article['prix_unitaire'];
          }
          }else{
            echo 'Cliquez sur un article';
          }
          ?>
          
        </tr>
      </tbody>
    </table>
    <?php
    $cmd=mysqli_query($connect,'SELECT id_commande,nom_client,prenom_client FROM commande,client WHERE client.id_client=commande.id_client ORDER BY id_commande DESC');
    if(!empty($id_art)){

    
    ?>
    <form action="ajout_commande_article.php?id_article=<?= $id_art ?> " method="post">
      <div class="row">
        <div class="col-sm-3">
          <?php
          if(!empty($designation)){
            echo $designation;
          }else{
            echo ' ';
          }
          ?>
        </div>
        <div class="col-sm-3">
          <input class="form-control" type="number" value="<?= $quantite ?>" name="quantite">
        </div>
        <div class="col-sm-3">
          <input class="form-control" type="number" value="<?= $prix_unitaire ?>" name="prix_unitaire">
        </div>
        <div class="col-sm-3">
          <input type="submit" value=" Ajouter" class="btn btn-outline-success">
        </div>
      </div>
      <label for="Client"><?= client ?></label><br>
      <select name="id_commande">
        <?php
        while($la_cmd=mysqli_fetch_assoc($cmd)){
          $id_commande=$la_cmd['id_commande'];
        ?>
        <option value="<?= $la_cmd['id_commande'] ?>"> <?= $la_cmd['nom_client'] ?> <?= $la_cmd['prenom_client'] ?></option>
        <?php
        }
        ?>
      </select>
    </form>
    <?php
    }
    ?>

    <!-- Autre section -->
    <?php
    $art_cmd=mysqli_query($connect,'SELECT * FROM article,commande_article 
    WHERE article.id_article=commande_article.id_article 
    AND id_commande=(SELECT MAX(id_commande) FROM commande_article) ');
    ?>
    <div class="card">
      <div class="card-body">
     <table class=" table datatable table-striped">
      <thead>
        <tr>
          <th class="scope"><?= designation ?></th>
          <th class="scope"><?= prix_unitaire ?></th>
          <th class="scope"><?= quantite ?></th>
          <th class="scope"><?= montant ?></th>
          <th class="scope">Action</th>
        </tr>
      </thead>
      <tbody>
      <?php
      while($l_art_cmd=mysqli_fetch_assoc($art_cmd)){

      ?>
        <tr>
          <td><?= $l_art_cmd['designation'] ?></td>
          <td><?= $l_art_cmd['prix_unitaire_art'] ?></td>
          <td><?= $l_art_cmd['quantite_art'] ?></td>
          <td><?= $l_art_cmd['montant'] ?></td>
          <td>
            <a href="supprimer_article_commande.php?id_article=<?=$l_art_cmd['id_article']?>">
              <button class="btn btn-danger">
                <i class="bi bi-trash"></i>
              </button>
            </a>
            <a href="form_modifier_article_commande.php?id_article=<?= $l_art_cmd['id_article'] ?> && id_commande=<?= $l_art_cmd['id_commande'] ?>" >
              <button class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="Mofidier">
                <i class="bi bi-pencil-fill"></i>
              </button>
            </a>
          </td>
        </tr>
        <?php
         }
         $quantite_art=mysqli_query($connect,'SELECT id_commande,
         SUM(quantite_art) AS quantite_totale, 
         SUM(montant) AS mt_total 
         FROM commande_article WHERE id_commande=(SELECT MAX(id_commande) FROM commande_article)');
         while($la_quantite_art=mysqli_fetch_assoc($quantite_art)){
          $total_art=$la_quantite_art['quantite_totale'];
          $mt_total=$la_quantite_art['mt_total'];
          $id_cmd=$la_quantite_art['id_commande'];
         }
        ?>
      </tbody>
     </table>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th class="scope"><?= nombre_articles ?></th>
                  <th class="scope"><?= montant_total ?></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th><?= $total_art ?></th>
                  <th><?= $mt_total ?> FCFA</th>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <form action="form_ajout_facture.php?id_commande=<?= $id_cmd ?>" method="post">
          <input type="number" class="btn btn-outline-info" name="reduction" placeholder="<?= reduction ?>" title="<?= entrer_nbre_entre_zero_et_cent ?>" ><br><br>
          <button class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="left">
            <i class="bi bi-receipt"></i>
            <input type="submit" value="<?= facturee ?>"  class="btn btn-success">
          </button>
        </form>
      </div>
    </div>
    
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