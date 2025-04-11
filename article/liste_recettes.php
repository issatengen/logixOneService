<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logix / Incomes</title>
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
  include_once 'header.php';
  $code=$_SESSION['code'];
  if(isset($_POST['date_x']) and isset($_POST['date_y'])){
    $date_x=$_POST['date_x'];
    $date_y=$_POST['date_y'];

    $appel=mysqli_query($connect,"SELECT * FROM recette_journaliere 
    JOIN utilisateur ON utilisateur.id_utilisateur=recette_journaliere.id_utilisateur
    AND date_recette BETWEEN '$date_x' AND '$date_y' 
    ORDER BY date_recette DESC ");

    $x=mysqli_query($connect,"SELECT SUM(montant_recette) as montant, SUM(banque) as bank, SUM(caisse) as caisse FROM recette_journaliere 
    JOIN utilisateur ON utilisateur.id_utilisateur=recette_journaliere.id_utilisateur 
    AND date_recette BETWEEN '$date_x' AND '$date_y' ");
  }else{
    echo ' ';
    $appel=mysqli_query($connect,'SELECT * FROM recette_journaliere 
    JOIN utilisateur ON utilisateur.id_utilisateur=recette_journaliere.id_utilisateur
    ORDER BY date_recette DESC');

    $x=mysqli_query($connect,'SELECT SUM(montant_recette) as montant, SUM(banque) as bank, SUM(caisse) as caisse FROM recette_journaliere 
    JOIN utilisateur ON utilisateur.id_utilisateur=recette_journaliere.id_utilisateur ');
  }
  foreach($x as $y){
    $montant=$y['montant'];
    $banque=$y['bank'];
    $caisse=$y['caisse'];
  }
  if(isset($_GET['id_dep'])){
    $del=mysqli_query($connect,'DELETE FROM depense WHERE id_depense="'.$_GET['id_dep'].'"');
  }else{
    echo ' ';
  }
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1><?= liste_recettes ?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="form_ajout_role.php"></a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
          <div class="col-md-8"></div>
          <div class="col-md-4 mb-2">
            <a href="form_add_daily_incom.php" class="m-2" title="Ajouter une dépense">
              <button class="btn btn-outline-success">
                <i class="bi bi-plus"></i>
                <?= ajouter ?>
              </button>
            </a>
            <?php
            if($code=='ADMIN'){
             if(isset($_POST['date_x']) && isset($_POST['date_y'])){
            ?>
            <a href="pdf_recette.php?date_x=<?php echo $_POST['date_x'] ?> & date_y=<?php echo $_POST['date_y'] ?>" class="m-2" title="Exporter toute la liste vers excel(la fonctionnalité est désactivée)">
              <button class="btn btn-outline-danger">
                <i class="bi bi-filetype-pdf"></i>
                PDF
              </button>
            </a>
            <?php
            }else{
            ?>
            <a href="pdf_recette.php" class="m-2" title="Exporter toute la liste vers excel(la fonctionnalité est désactivée)">
              <button class="btn btn-outline-danger">
                <i class="bi bi-filetype-pdf"></i>
                PDF
              </button>
            </a>
            <?php
             }
            }
            ?>
          </div>
        </div>
        <div class="col-lg-12">
          
          <div class="card">
            <div class="ms-2 mb-4">
              <h4 class="card-title"><?= rechercher_dans_un_intervale ?></h4>
              <form action="liste_recettes.php" method="post" style="margin-top:10px">
                  <div class="row">
                      <div class="col-md-4">
                        <input type="date" class="form-control" name="date_x">
                        <?php
                        if(!empty($_POST['date_x'])){
                          echo $_POST['date_x'];
                        }
                        ?>
                      </div>
                      <div class="col-md-4">
                        <input type="date" class="form-control" name="date_y">
                        <?php
                        if(!empty($_POST['date_y'])){
                          echo $_POST['date_y'];
                        }
                        ?>
                      </div>
                      <div class="col-md-2">
                        <button class="btn btn-primary" type="submit">
                          <i class="bi bi-search"></i>
                      </button>
                      </div>
                  </div>
                </form>
            </div>
              <table class="table datatable ">
                <thead>
                  <tr>
                    <th scope="col"><?= code_recette ?></th>
                    <th class="col"><?= date_presence ?></th> 
                    <th scope="col"><?= montant_recette ?></th>
                    <th scope="col"><?= banque ?></th>
                    <th scope="col"><?= caisse ?></th>
                    <?php
                     if($code == 'ADMIN'){

                    ?>
                    <th scope="col"><?= nom_utilisateur ?></th>
                    <th scope="col"><?= action ?></th>
                    <?php
                     }else{
                      echo ' ';
                     }
                    ?>
                  </tr>
                </thead>
                <tbody>
                <?php
                  while($les_recettes=mysqli_fetch_assoc($appel)){

                ?>
                <tr>
                  <td><?=$les_recettes['code_recette']?> 
                  <td><?=$les_recettes['date_recette']?></td>
                  <td><?=$les_recettes['montant_recette'].' FCFA'?></td>
                  <td><?=$les_recettes['banque'].' FCFA'?></td>
                  <td><?=$les_recettes['caisse'].' FCFA'?></td>
                  <?php
                    if($code == 'ADMIN'){

                  ?>
                  <td><?=$les_recettes['nom_utilisateur'].' '. $les_recettes['prenom_utilisateur'] ?></td>
                  <td>
                    <a href="form_modifier_recette.php?id_recette=<?= $les_recettes['id_recette'] ?>">
                      <button class="btn btn-primary">
                        <i class="bi bi-pencil"></i>
                      </button>
                    </a>
                    
                     <!-- Basic Modal -->
                     <button  type="button" id="id" class="btn btn-danger" onclick="
                       if(confirm('Voulez-vous vraiment supprimer cette dépense ?')==true){
                         window.location.replace('supprimer_recette.php?id_recette=<?= $les_recettes['id_recette'] ?>');
                      }else{
                        exit;
                      }
                     ">
                        <i class="bi bi-trash "></i>
                     </button>
                    
                    <?php
                      }else{
                        echo ' ';
                      }
                    ?>

                  </td>
        
                </tr>
                <?php
                  }
                  if($code == 'ADMIN'){
                ?>
                <tr>
                  <td><b>Total</b></td>
                  <td></td>
                  <td><b><?php echo $montant.' FCFA' ?></b></td>
                  <td><b><?php echo $banque.' FCFA' ?></b></td>
                  <td><b><?php echo $caisse.' FCFA' ?></b></td>
                  <td><b></b></td>
                </tr>
                
                </tbody>
              </table>
              <?php
                }else{
                    echo ' ';
                }
              ?>
              <!-- End Table with stripped rows -->
              </center>
            </div>
          </div>

        </div>
      </div>
    </section>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
 

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