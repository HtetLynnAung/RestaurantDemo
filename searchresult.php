<?php   
    

    require_once 'firestore.php';
    $fs = new Firestore(collection:'menu');
 ?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/favicon/manifest.json">
    <link rel="mask-icon" href="assets/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="assets/favicon/favicon.ico">
    <meta name="msapplication-config" content="./assets/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    
    <!-- Libs CSS -->
    <link rel="stylesheet" href="assets/css/libs.bundle.css" />
    
    <!-- Theme CSS -->
    <link rel="stylesheet" href="assets/css/theme.bundle.css" />
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&amp;family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&amp;display=swap" rel="stylesheet">
    
    <!-- Map -->
    <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' />
    
    <!-- Title -->
    <title>Touché - Café &amp; Restaurant Template</title>
  </head>
  <body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-light navbar-expand-lg fixed-top border-bottom">
      <div class="container">
    
        <!-- Navbar brand (mobile) -->
        <a class="navbar-brand d-lg-none" href="index.php"><i class="fas fa-long-arrow-alt-left"></i></a>
    
        <!-- Navbar collapse -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
    
          <!-- Navbar nav -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link " href="index.php" style="font-size: 30px;"><i class="fas fa-long-arrow-alt-left"></i></a>
            </li>            
          </ul>          
    
        </div>
      </div>
    </nav>



    <?php 

      if (isset($_POST['search'])) {

        $searchtxt = $_POST['search-txt'];
        $searchtxtLower = strtolower($searchtxt); 


     ?>   

    <!-- NEW MENU -->
    <section class="py-7 py-md-9 border-bottom">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-8 col-lg-6 text-center">


            <!-- Subheading -->
            <span class="mb-2">
              You Searched For . . .  
            </span>

            <!-- Heading -->
            <h2 class="mb-6">
              <?php echo '"'.$searchtxtLower. '"'; ?>
            </h2>


          </div>
        </div>

        <div class="row">
          <div class="col-12">

            <!-- Content -->
            <div class="tab-content" id="menuContent">
              <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="mainsTab">
                <div class="row">

                <?php 

                  $results = $fs->data_get_all_documents();
                  //print_r($results);
                  foreach ($results as $result) {
                      $menuLower = strtolower($result->data()['item_name']);
                      
                      if ($result->exists() && str_contains($menuLower, $searchtxtLower)) {    
                      
                ?>                
                  <div class="col-12 col-md-6">
                    <div class="py-3 border-bottom">
                      <div class="row">
                        <div class="col-3 align-self-center">

                          <!-- Image -->
                          <div class="ratio ratio-1x1">
                            <img class="object-fit-cover" src="assets/img/26.jpg" alt="...">
                          </div>

                        </div>
                        <div class="col-6">

                          <!-- Name -->
                          <h5 class="mb-2"><?php echo $result->data()['item_name']; ?></h5>

                          <!-- Info -->
                          <p class="mb-0">
                            <i class="fas fa-phone"></i> &nbsp; &nbsp; <?php echo $result->data()['phone'] ?>
                          </p>

                        </div>
                        <div class="col-3">

                          <!-- Price -->
                          <div class="fs-6 text-center text-black"> 
                            $ <?php echo $result->data()['price'] ?>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                <?php
                    } else {
                        //printf('Document %s does not exist!' . PHP_EOL, $result->id());
                        //echo "<div class= 'col-3'>Sorry! .</div> ";
                    }
                    
                  }
                ?>                  

              </div>              
            </div>

          </div>
        </div>
      </div>
    </section>


     <?php

      }else{
        $_POST['search'] = ""; 
      }


     ?>




    

    <!-- JAVASCRIPT -->
    <!-- Vendor JS -->
    <script src="assets/js/vendor.bundle.js"></script>
    
    <!-- Theme JS -->
    <script src="assets/js/theme.bundle.js"></script>

  </body>
</html>
