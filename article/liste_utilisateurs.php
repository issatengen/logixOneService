<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Users</title>
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

    <div class="pagetitle">
      <h1><?= liste_utilisateurs ?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="form_ajout_utilisateur.php"><?= ajout_utilisateur ?></a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="row">
            <div class="col-sm-9"></div>
            <div class="col-sm-3 mb-2">
              <a href="form_ajout_utilisateur.php">
                <button class="btn btn-success">
                  <i class="bi bi-person-plus-fill"></i>
                  <b><?= ajouter ?></b>
                </button>
              </a>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
        
              <!-- Table with stripped rows -->
              <?php
                include '../connection.php';
                $utilisateur=mysqli_query($connect,'SELECT * FROM utilisateur
                INNER JOIN role 
                ON role.id_role=utilisateur.id_role
                INNER JOIN profile_picture 
                ON utilisateur.id_utilisateur=profile_picture.id_utilisateur');
              ?>
              <center>
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col"><?= nom_clt ?></th>
                    <th scope="col"><?= adresse ?></th>
                    <th scope="col"><?= tel ?></th>
                    <th scope="col"><?= mail ?></th>
                    <th scope="col"><?= role ?></th>
                    <th scope="col"><?= mdp ?></th>
                    <th scope="col"><?= action ?></th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  while($liste_utilisateur=mysqli_fetch_assoc($utilisateur)){
                    $permit=$liste_utilisateur['libelle'];
                    if($permit="Administrateur"){

                ?>
                <tr>
                  <td><a href="profile.php?id_utilisateur=<?php echo $liste_utilisateur['id_utilisateur'] ?>"><img style="width:70px; height: 70px;" src="../images/upload/<?php echo $liste_utilisateur['image_name'] ?>" alt="Profile" class="rounded-circle"></a></td>
                  <td><?=$liste_utilisateur['nom_utilisateur'].' '.$liste_utilisateur['prenom_utilisateur']?></td>
                  <td><?=$liste_utilisateur['adresse_utilisateur']?></td>
                  <td><?=$liste_utilisateur['tel_utilisateur']?></td>
                  <td><?=$liste_utilisateur['email_utilisateur']?></td>
                  <td><?=$liste_utilisateur['libelle']?></td>
                  <td>
                    <button
                      onclick="
                        let del=confirm('Voulez-vous vraiment supprimer cet utilisateur ?');
                        if(del==true){
                        window.location.replace('supprimer_utilisateur.php?id_utilisateur=<?= $liste_utilisateur['id_utilisateur'] ?>');
                        }else{
                        exit;
                        }
                      "
                      class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="left" title="<?= supprimer ?>">
                      <i class="bi bi-trash"></i>
                    </button>
                    <a href="form_modifier_utilisateur.php?id_utilisateur=<?= $liste_utilisateur['id_utilisateur']?>">
                      <button class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" title="<?= modifier ?>">
                        <i class="bi bi-pencil-fill"></i>
                      </button>
                    </a>
                    <a href="attendance.php?id_utilisateur=<?= $liste_utilisateur['id_utilisateur']?>" title="Attendance">
                      <button class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="right" title="présence">
                        <i class="bi bi-check-all"></i>
                      </button>
                    </a>
                  </td>
                </tr>
                <?php
                  }else{
                    echo 'Seuls les administrateurs peuvent voir la liste des utilisateurs';
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