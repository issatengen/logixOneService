<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logix / Expenses</title>
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
    .image_depense{
      height: 7rem;
      width: 9rem;
      border-radius: 7%;
    }
    .image_depense:hover{
      height: 10rem;
      width: 12rem;
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
  include '../connection.php';
  include_once 'header.php';
  $code=$_SESSION['code'];
  if(isset($_POST['date_x']) and isset($_POST['date_y'])){
    $date_x=$_POST['date_x'];
    $date_y=$_POST['date_y'];

    $appel=mysqli_query($connect,"SELECT * FROM depense,utilisateur 
    WHERE utilisateur.id_utilisateur=depense.id_utilisateur 
    AND date_depense BETWEEN '$date_x' AND '$date_y' 
    ORDER BY date_depense DESC ");

    $x=mysqli_query($connect,"SELECT SUM(montant_depense) as montant FROM depense,utilisateur 
    WHERE utilisateur.id_utilisateur=depense.id_utilisateur 
    AND date_depense BETWEEN '$date_x' AND '$date_y' ");
  }else{
    echo ' ';
    $appel=mysqli_query($connect,'SELECT * FROM depense,utilisateur 
    WHERE utilisateur.id_utilisateur=depense.id_utilisateur ');

    $x=mysqli_query($connect,'SELECT SUM(montant_depense) as montant FROM depense,utilisateur 
    WHERE utilisateur.id_utilisateur=depense.id_utilisateur ');
  }
  foreach($x as $y){
    $montant=$y['montant'];
  }

  // Formulaire de modification

  if(isset($_GET['idDepense'])){
    // and isset($_POST['libelle_depense']) and isset($_POST['montant_depense']) and isset($_POST['date_depense']) and isset($_POST['raison_depense'])
    $id_depense=$_GET['idDepense'];
    // $libelle_depense=$_POST['libelle_depense'];
    // $montant_depense=$_POST['montant_depense'];
    // $date_depense=$_POST['date_depense'];
    // $raison_depense=$_POST['raison_depense'];

    $elements_to_modify=mysqli_query($connect,'SELECT * FROM depense WHERE id_depense="'.$id_depense.'"');
    
  }else{
    echo " ";
  }
  if(isset($_GET['id_dep'])){
    $del=mysqli_query($connect,'DELETE FROM depense WHERE id_depense="'.$_GET['id_dep'].'"');
  }else{
    echo ' ';
  }
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1><?= liste_depenses ?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="form_ajout_role.php"></a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
          <div class="col-md-7 mb-2">
            <h4 class="card-title"><?= rechercher_dans_un_intervale ?></h4>
            <form action="liste_depenses.php" method="post" style="margin-top:10px">
                <div class="row">
                    <div class="col-md-4">
                      <input type="date" class="form-control" name="date_x" required>
                      <?php
                      if(!empty($_POST['date_x'])){
                        echo $_POST['date_x'];
                      }
                      ?>
                    </div>
                    <div class="col-md-4">
                      <input type="date" class="form-control" name="date_y" required>
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
          <div class="col-md-5 pt-5">
            <a href="form_ajout_depense.php" class="" title="Ajouter une dépense">
              <button class="btn btn-outline-success">
                <i class="bi bi-plus"></i>
                <?= ajouter ?>
              </button>
            </a>
            <a href="csv_liste_depenses.php" class="" title="Exporter toute la liste vers excel(la fonctionnalité est désactivée)">
              <button class="btn btn-outline-success">
                <i class="bi bi-file-excel"></i>
                Excel
              </button>
            </a>
            <?php
            if(isset($_POST['date_x']) && isset($_POST['date_y'])){
            ?>
            <a href="pdf_depense.php?date_x=<?php echo $_POST['date_x'] ?> & date_y=<?php echo $_POST['date_y'] ?>"  title="Exporter toute la liste vers excel(la fonctionnalité est désactivée)">
              <button class="btn btn-outline-danger">
                <i class="bi bi-filetype-pdf"></i>
                PDF
              </button>
            </a>
            <?php
            }else{
            ?>
            <a href="pdf_depense.php" title="Exporter toute la liste vers excel(la fonctionnalité est désactivée)">
              <button class="btn btn-outline-danger">
                <i class="bi bi-filetype-pdf"></i>
                PDF
              </button>
            </a>
            <?php
            }
            ?>
          </div>
        </div>
        <div class="col-lg-12">
          
          <div class="card">
              <table class="table datatable ">
                <thead>
                  <tr>
                    <th scope="col"><?= date_depense ?></th>
                    <th class="col"><?= libelle ?></th> 
                    <th scope="col"><?= montant_depense ?></th>
                    <th scope="col"><?= description ?></th> 
                    <th scope="col"><?= nom_utilisateur ?></th>
                    <th scope="col"><?= action ?></th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  while($les_depenses=mysqli_fetch_assoc($appel)){

                ?>
                <tr>
                  <td><?=$les_depenses['date_depense']?> 
                  <td><?=$les_depenses['libelle_depense']?></td>
                  <td><?=$les_depenses['montant_depense']?></td>
                  <td>
                    <?php
                    $file='../images/image_depense/'. $les_depenses['image_depense'];
                    if(file_exists($file)){

                    ?>
                    <a href="../images/image_depense/<?php echo $les_depenses['image_depense'] ?>">
                      <img class="image_depense" title="<?php echo $les_depenses['raison_depense'] ?>" src="../images/image_depense/<?php echo $les_depenses['image_depense'] ?>" alt="<?php echo $les_depenses['raison_depense'] ?>">
                    </a>
                    <?php
                    }else{
                      
                    ?>
                    <img class="image_depense" title="<?php echo $les_depenses['raison_depense'] ?>" src="../images/image_depense/<?php echo $les_depenses['image_depense'] ?>" alt="<?php echo $les_depenses['raison_depense'] ?>">
                    <?php
                    }
                    ?>
                  </td>
                  <td><?=$les_depenses['nom_utilisateur'].' '. $les_depenses['prenom_utilisateur'] ?></td>
                  <td>
                    <a href="form_modifier_depense.php?id_depense=<?= $les_depenses['id_depense'] ?>">
                      <button class="btn btn-primary">
                        <i class="bi bi-pencil"></i>
                      </button>
                    </a>
                   
                    <?php
                     if($code == 'ADMIN'){

                    ?>
                    
                     <!-- Basic Modal -->
                     <button  type="button" id="id" class="btn btn-danger" onclick="
                       if(confirm('Voulez-vous vraiment supprimer cette dépense ?')==true){
                         window.location.replace('supprimer_depense.php?id_depense=<?= $les_depenses['id_depense'] ?>');
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
                ?>
                </tbody>
              </table>
              <div class="card">
                <div class="card-body">
                    <div class="col-md-8">
                        <table class=table>
                            <thead>
                              <?php
                              if($code=='ADMIN'){
                              ?>
                                <tr>
                                    <th >Total</th>
                                    <th><?= $montant.' FCFA' ?></th>
                                </tr>
                                <?php
                              }else{
                                echo ' ';
                              }
                                ?>
                            </thead>
                        </table>
                    </div>
                </div>
              </div>
              <!-- End Table with stripped rows -->
              </center>
            </div>
          </div>

        </div>
      </div>
    </section>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
  include_once 'footer.php';
  ?>
  <script>
    // Bouton de suppressioin de la depense
    function delete_expense(){
      if(confirm('Voulez-vous vraiment supprimer cette dépense?')=true){
        window.location.href('supprimer_depense.php?id_depense=<?= $les_depenses['id_depense'] ?>');
      }else{
        exit;
      }
    }
    
  </script>

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