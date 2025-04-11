<?php
  session_start();
  include_once '../connection.php';
  
  if(!empty($_SESSION['code'])){
    $nom_utilisateur=$_SESSION['nom_utilisateur'];
    $prenom_utilisateur=$_SESSION['prenom_utilisateur'];
    $code=$_SESSION['code'];
    $role=$_SESSION['role'];
    $id_utilisateur=$_SESSION['id_utilisateur'];
    $email_utilisateur=$_SESSION['email_utilisateur'];
  }else{
    header('location:../login.php');
  }
  if(!empty($_SESSION['langue'])){
    $langue=$_SESSION['langue'];
  }else{
    $langue=substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
  }
  if($langue=='en'){
    require '../langue/anglais.php';
  }else{
    require '../langue/francais.php';
  }
  ?>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="../images/Tengtech_Logo.png" alt="">
        <span class="d-none d-lg-block"><?php echo nom_logiciel ?></span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->
    
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <!-- <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li>End Search Icon -->

        <li class="nav-item dropdown">

        <?php
          
          if(!empty($_SESSION['delais'])){
            $delais=$_SESSION['delais'];
          }else{
            $delais=1;
            $delais2=2;
          }
            $estimatrice_echue=mysqli_query($connect,'SELECT *
            FROM commande,client 
            WHERE client.id_client=commande.id_client 
            AND date_retrait IS NULL 
            AND date_estimatrice-DATE(NOW())="'.$delais.'" ');

            $num=mysqli_query($connect,'SELECT COUNT(id_commande) AS nombre
            FROM commande,client 
            WHERE client.id_client=commande.id_client 
            AND date_retrait IS NULL 
            AND date_estimatrice-DATE(NOW())="'.$delais.'" ');

          foreach($num as $le_nombre){
            $nbre=$le_nombre['nombre'];
          }
          ?>
          

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-danger badge-number"><?= $nbre ?></span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              <?= vous_avez ?> <?= $nbre ?> <?= nouvelles_notif ?>
              <!-- <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">Lire toutes</span></a> -->
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <?php
            while($echeance=mysqli_fetch_assoc($estimatrice_echue)){

            
            ?>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4><?= date_echeance ?></h4>
                <p><?= date_echeance_de ?> 
                  <b><?= $echeance['nom_client'] ." ". $echeance['prenom_client'].'('. $echeance['code_commande'].')' ?></b> 
                  <?= sera_echu.' '. $delais .' '. jour ?>
                </p>
                <!-- <p><?= date('Y-m-d h:m:s')-2 ?></p> -->
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <?php
            }
            ?>

            <li>
              <hr class="dropdown-divider">
            </li> 
            <li class="dropdown-footer">
              <!-- <a href="#">Show all notifications</a> -->
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        <!-- <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
          </a><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have 3 new messages 
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Maria Hudson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>4 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Anna Nelson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>6 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>David Muldon</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>8 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li> -->

          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <?php
              $callImage=$connect->prepare('SELECT *, COUNT(image_id) as nb_ids FROM profile_picture 
              WHERE image_id=(SELECT MAX(image_id) FROM profile_picture WHERE id_utilisateur=?)');
              $callImage->bind_param('i', $id_utilisateur);
              $callImage->execute();
              $result= $callImage -> get_result();
              foreach($result as $thisIMG){
                $image_name=$thisIMG['image_name'];
                $nb_ids=$thisIMG['nb_ids'];
              }
              if($nb_ids > 0){
            ?>
            <img src="../images/upload/<?php echo $image_name ?>" style="height: 60%; width: 60%; border-radius: 50%;" alt="Profile">
            <?php
            }else{

            ?>
            <img src="../image/CreateTech.png" alt="Profile" class="rounded-circle">
            <?php
            }
            ?>
            <span class="d-none d-md-block dropdown-toggle ps-2"><?= $nom_utilisateur.' '. $prenom_utilisateur ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <a href="profil_utilisateur.php"></a>
              <h6><?= $nom_utilisateur.' '. $prenom_utilisateur ?> </h6>
              <span><?= $role ?></span>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="profile.php?id_utilisateur=<?= $id_utilisateur ?>">
                <i class="bi bi-person-circle text-secondary"></i>
                <span> Profil </span>
              </a>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="attendance.php?id_utilisateur=<?= $id_utilisateur ?>">
                <i class="bi bi-patch-check text-secondary"></i>
                <span> <?= presence ?> </span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="parametre.php">
                <i class="bi bi-gear text-secondary"></i>
                <span><?= parametre ?> </span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="help.php">
                <i class="bi bi-question-circle text-secondary"></i>
                <span><?= aide ?></span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="../logout.php">
                <i class="bi bi-box-arrow-right text-secondary"></i>
                <span><?= deconnexion ?></span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="dashboard.php">
          <i class="bi bi-speedometer"></i>
          <span><?= tableau_bord ?></span>
        </a>
      </li>
      <hr>
      <li class="nav-item">
        <a class="nav-link collapsed" href="liste_recettes.php">
          <i class="bi bi-cash-coin"></i>
          <span><?= Recettes_journaliere ?></span>
        </a>
      </li>
      
      <?php
      if($code == 'ADMIN'){

      
      ?>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="" data-bs-toggle="" href="liste_utilisateurs.php">
          <i class="bi bi-people-fill"></i><span><?= utilisateur ?></span>
        </a>
      </li>
      <?php
      }else{
        echo ' ';
      }
      ?>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="" data-bs-toggle="" href="liste_factures.php">
          <i class="bi bi-receipt-cutoff"></i><span><?= facturation ?></span>
        </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="" data-bs-toggle="" href="liste_categories.php">
          <i class="bi bi-file-earmark-check"></i><span><?= categorie?></span>
        </a>
      </li>
      <hr>

      
      </li><!-- End Dashboard Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people"></i><span><?= client ?></span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a href="tables-general.html">
                <i class="bi bi-circle"></i><a href="form_ajout_client.php"><?= ajout_client ?></a>
              </a>
            </li>
            <li>
              <a href="tables-data.html" class="active">
                <i class="bi bi-circle"></i><a href="liste_clients.php"><?= liste_clients ?></a>
              </a>
            </li>
        </ul>
      </li>


      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span><?= commande ?></span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="forms-elements.html">
              <i class="bi bi-circle"></i><a href="form_ajout_commande.php"><?= ajout_commande ?></a>
            </a>
          </li>
          <li>
            <a href="forms-layouts.html" >
              <i class="bi bi-circle"></i><a href="liste_commandes.php"><?= liste_commandes ?></a>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->
      <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-file-earmark-diff"></i><span><?= article ?></span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="components-alerts.html">
              <i class="bi bi-circle"></i><a href="form_ajout_article.php"><?= ajout_article ?></a>
            </a>
          </li>
          <li>
            <a href="components-accordion.html">
              <i class="bi bi-circle"></i><a href="liste_articles.php"><?= liste_articles ?></a>
            </a>
          </li>
        </ul><li class="nav-item">


      </li>

      <li class="nav-item">
        
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-cash-stack"></i><span><?php echo depense ?></span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a href="tables-general.html">
                <i class="bi bi-circle"></i><a href="form_ajout_depense.php"><?= ajout_depense ?></a>
              </a>
            </li>
            <li>
              <a href="tables-data.html" class="active">
                <i class="bi bi-circle"></i><a href="liste_depenses.php"><?= liste_depenses ?></a>
              </a>
            </li>
        </ul>
      </li><!-- End Components Nav -->

      <?php
      if($code == 'ADMIN'){
      
      ?>

      <li class="nav-item">
        
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-graph-up-arrow"></i><span><?php echo rapport ?></span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a href="tables-general.html">
                <i class="bi bi-circle"></i><a href="rapport_sur_commandes.php"><?php echo rapport_sur_commandes ?></a>
              </a>
            </li>
            <li>
              <a href="tables-data.html" class="active">
                <i class="bi bi-circle"></i><a href="rapport_sur_clients.php"><?php echo rapport_sur_clients ?></a>
              </a>
            </li>
            <li>
              <a href="tables-data.html" class="active">
                <i class="bi bi-circle"></i><a href="rapport_finance.php"><?php echo rapport_finance ?></a>
              </a>
            </li>
        </ul>
      </li><!-- End Components Nav -->
      <?php
      }else{
        echo ' ';
      }
      ?>


    </ul>

  </aside><!-- End Sidebar-->