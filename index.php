<?php 
include('configold.php');


// if(isset($_GET["code"])){
    
//     $_SESSION['access_token'] = $token['access_token'];
//     $token = $google_client->fetchAccessTokenWithAuthCode($_GET['code']);

//     $google_client->setAccessToken($token);
//     $_SESSION["code"] = $token; 
    
//     //Getting User Profile
//      $gauth = new Google_Service_Oauth2($google_client);
//      $google_info = $gauth->userinfo->get();
//      $email = $google_info->email;
//      $name = $google_info->name;
//      $gender = $google_info->gender;
//      $pic = $google_info->picture;


//     echo "Welcome! " .$name. ". You are registered with " .$email;
//     //echo $gender;
//     //echo "<img src='" .$pic. "'/> ";
    

// }else
// {

// }

// $email = "";
// $name = "";

  require_once 'firestore.php';
  $fs = new Firestore(collection:'menu');


if($_SESSION['access_token'] == '') {
  header("Location: index.php");
  }  

  //This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
if(isset($_GET["code"]))
{
  //It will Attempt to exchange a code for an valid authentication token.
  $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
  //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
    if(!isset($token['error']))
    {
      //Set the access token used for requests
      $google_client->setAccessToken($token['access_token']);
      //Store "access_token" value in $_SESSION variable for future use.
      $_SESSION['access_token'] = $token['access_token'];
      //Create Object of Google Service OAuth 2 class
      $google_service = new Google_Service_Oauth2($google_client);
      //Get user profile data from google
      $data = $google_service->userinfo->get();
      //Below you can find Get profile data and store into $_SESSION variable
      if(!empty($data['given_name']))
      {
          $_SESSION['user_first_name'] = $data['given_name'];
      }
      if(!empty($data['family_name']))
      {
          $_SESSION['user_last_name'] = $data['family_name'];
      }
      if(!empty($data['email']))
      {
          $_SESSION['user_email_address'] = $data['email'];
      }
      if(!empty($data['gender']))
      {
          $_SESSION['user_gender'] = $data['gender'];
      }
      if(!empty($data['picture']))
      {
          $_SESSION['user_image'] = $data['picture'];
      }
    }
}
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <!-- Title -->
    <title>Touch - Restaurant</title>
    
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
    
    <link rel="stylesheet" type="text/css" href="css/main.css">


  </head>
  <body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-dark navbar-expand-lg navbar-togglable fixed-top">
      <div class="container">
    
        <!-- Navbar brand (mobile) -->
        <a class="navbar-brand d-lg-none" href="index.html">Touch</a>
    
        <!-- Navbar toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    
        <!-- Navbar collapse -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
    
          <!-- Navbar nav -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="menu.php">Menu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="#">About Us</a>
            </li>
          </ul>
    
          <!-- Navbar brand -->
          <a class="navbar-brand d-none d-lg-flex mx-lg-auto" href="index.html">
            Touch
          </a>
    
          <!-- Navbar nav -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link " href="profile.php"><?php echo $_SESSION['user_first_name'] ?></a>

              <li class="nav-item">
              <a class="nav-link " href="logout.php" data-tooltip="Logout?" data-position="right" >Logout</a>
          </ul>

    
        </div>
      </div>
    </nav>

    <!-- HEADER -->
    <header data-jarallax data-speed=".8" style="background-image: url('img/23.jpg');">
      <div class="pt-10 pb-8 pt-md-15 pb-md-13 bg-black-50">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 text-center">

              <!-- Heading -->
              <h1 class="display-6 fw-bold text-white">
                Our menu
              </h1>

            </div>
          </div>

          <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-8" >

              <form class="" method="POST" action="searchresult.php">                  

                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Find Your Favourite" aria-label="Find Your Favourite" aria-describedby="button-addon2" name="search-txt" id="search-txt">
                  <button class="btn btn-outline-secondary text-white" type="submit" id="search" name="search">Search</button>
                </div>     

              </form>


            </div>
          </div>



        </div>
      </div>
    </header>


    <!-- NEW MENU -->
    <section class="py-7 py-md-9 border-bottom">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-8 col-lg-6 text-center">

            <!-- Heading -->
            <h2 class="mb-2">
              Menu options
            </h2>

            <!-- Subheading -->
            <p class="mb-6">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              Ratione numquam eos perferendis itaque hic unde, ad, laudantium minima.
            </p>

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
                      if ($result->exists()) {           
                ?>                
                  <div class="col-12 col-md-6">
                    <div class="py-3 border-bottom">
                      <div class="row">
                        <div class="col-3 align-self-center">

                          <!-- Image -->
                          <div class="ratio ratio-1x1">
                            <img class="object-fit-cover" src="img/26.jpg" alt="Image">
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
                    }
                    
                  }
                ?>                  

              </div>              
            </div>

          </div>
        </div>
      </div>
    </section>

    <!-- MENU WITH SLIDER -->
    <section class="py-7 py-md-9 overflow-hidden">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-8 col-lg-6 text-center">

            <!-- Heading -->
            <h2 class="mb-2">
              Our <em>featured</em> dishes
            </h2>

            <!-- Subheading -->
            <p class="mb-6">
              Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam aliquam id sint accusamus eius voluptatum explicabo quae similique, quas.
            </p>

          </div>
        </div>
        <div class="row">
          <div class="col-12">

            <!-- Slider -->
            <div class="flickity-viewport-visible" data-flickity='{"cellAlign": "left", "contain": true, "imagesLoaded": true, "pageDots": false}'>
            <?php 

              $results = $fs->data_get_all_documents();
              //print_r($results);
              foreach ($results as $result) {
                  if ($result->exists()) {
                      //printf('Document data for document %s:' . PHP_EOL, $document->id());
                      //print_r($result->data()['item_name']);            
            ?>
              <div class="w-100 px-2" style="max-width: 320px;">

                <!-- Card -->
                <div class="card border-0">

                  <!-- Image -->
                  <img class="card-img-top" src="" alt="Image" />

                  <!-- Body -->
                  <div class="card-body">

                    <!-- Heading -->
                    <div class="row mb-2">
                      <div class="col">
                        <h5 class="mb-0"><?php echo $result->data()['item_name']; ?></h5>
                      </div>
                      <div class="col-auto">
                        <span class="fs-4 font-serif text-black">$ <?php echo $result->data()['price'] ?></span>
                      </div>
                    </div>


                  </div>

                </div>

              </div>
              <?php

                      //printf(PHP_EOL);   
                      //return array($document->data());  
                    } else {
                        //printf('Document %s does not exist!' . PHP_EOL, $result->id());
                    }
                    
                }
              ?>

            </div>

          </div>
        </div>
      </div>
    </section>


    <!-- FOOTER -->
    <footer class="py-7 py-md-9 bg-black">
      <div class="container px-4">
        <div class="row gx-7">
          <div class="col-sm-4">
    
            <!-- Heading -->
            <h5 class="text-xs text-primary">
              About Us
            </h5>
    
            <!-- Text -->
            <p class="mb-6">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti dolorum, sint corporis nostrum, possimus unde eos vitae eius quasi saepe.
            </p>
    
          </div>
          <div class="col-sm-4">
    
            <!-- Heading -->
            <h5 class="text-xs text-primary">
              Contact info
            </h5>
    
            <!-- List -->
            <ul class="list-unstyled mb-6">
              <li class="d-flex mb-2">
                <div class="fas fa-map-marker-alt me-3 mt-2 fs-sm"></div>
                1234 Altschul, Los Angeles
              </li>
              <li class="d-flex mb-2">
                <div class="fas fa-phone me-3 mt-2 fs-sm"></div>
                 987 654 3210
              </li>
              <li class="d-flex">
                <div class="far fa-envelope me-3 mt-2 fs-sm"></div> <a href="mailto:admin@domain.com">admin@domain.com</a>
              </li>
            </ul>
    
          </div>
          <div class="col-sm-4">
    
            <!-- Heading -->
            <h5 class="text-xs text-primary">
              Opening hours
            </h5>
    
            <!-- Text -->
            <div class="mb-3">
              <div class="text-xs">Monday - Thursday</div>
              <div class="font-serif">10:00 AM - 11:00 PM</div>
            </div>
    
            <!-- Text -->
            <div class="mb-6">
              <div class="text-xs">Friday - Sunday</div>
              <div class="font-serif">12:00 AM - 03:00 AM</div>
            </div>
    
          </div>
        </div>
        <div class="row">
          <div class="col-12">
    
            <!-- Copyright -->
            <div class="d-flex align-items-center">
              <hr class="hr-sm me-3" style="height: 1px;" /> &copy; 2021 Touch. All rights reserved.
            </div>
    
          </div>
        </div>
      </div>
    </footer>
      

    <!-- JAVASCRIPT -->
    <!-- Vendor JS -->
    <script src="assets/js/vendor.bundle.js"></script>
    
    <!-- Theme JS -->
    <script src="assets/js/theme.bundle.js"></script>

  </body>
</html>
