<?php 
include('configold.php');
require_once 'firestore.php';

    
    $fs = new Firestore(collection:'menu');
    
    //print_r($fs->getDocument(name: 'pizza'));

    //$result = $fs->getDocument(name: 'pizza');
    //print_r($result['phone']);
    //$addNewDoc = $fs->setNewDocument(name: 'Sandwish');
    //print_r($addNewDoc);



if($_SESSION['access_token'] == '') {
  header("Location: login.php");
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

  <!-- ALERT -->
    <?php 
      //if($addNewDoc == 1){
        ?>
        <!-- <div class="alert alert-success alert-dismissible fade show mt-8" role="alert" >
          <strong>Good!</strong> <?php //echo $_SESSION['status']; ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>  -->

        <?php 

        //unset($_SESSION['status']);
      //}
     ?>


    <!-- NAVBAR -->
    <nav class="navbar navbar-light navbar-expand-lg fixed-top">
      <div class="container">
    
        <!-- Navbar brand (mobile) -->
        <a class="navbar-brand d-lg-none" href="index.php">Touch</a>
    
        <!-- Navbar toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    
        <!-- Navbar collapse -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
    
          <!-- Navbar nav -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link " href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="menu.php">Menu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="#">About Us</a>
            </li>
          </ul>
    
          <!-- Navbar brand -->
          <a class="navbar-brand d-none d-lg-flex mx-lg-auto" href="index.php">
            Touch
          </a>
    
          <!-- Navbar nav -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link " href="profile.php"><?php echo $_SESSION['user_first_name'] ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="logout.php" data-tooltip="Logout?" data-position="right">Logout</a>
            </li>
                      <!--    <li class="nav-item">
              <a class="nav-link " href="contact-us.html">Contact</a>
            </li> -->
          </ul>
    
        </div>
      </div>
    </nav>



    <!-- ADD ITEM FORM -->
    <section class="py-7 py-md-9">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-8 col-lg-6 text-center">

            <!-- Heading -->
            <h2 class="mb-2">
              Import New Menu to 
            </h2>
            <!-- Subheading -->
            <p class="mb-6">
              <?php     //echo $result['pizza']; ?>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam illo praesentium sequi in cum, beatae maiores quae qui.
            </p>

          </div>
        </div>
        <div class="row">

          <div class="col-md-12 order-md-1">

            <!-- add menu Form -->
            <form class="" method="POST" action="menu.php">

               <!-- Contact number (hidden) -->
                 <!--  <input type="hidden" name="contact_number"> -->

                  <!-- Item name -->
                  <div class="mb-3">
                    <label class="visually-hidden" for="user_name">Item name</label>
                    <input class="form-control" id="item_name" name="item_name" type="text" placeholder="Item name" required>
                  </div>

                  <!-- Phone number -->
                  <div class="mb-3">
                    <label class="visually-hidden" for="user_phone">Phone number</label>
                    <input class="form-control" id="user_phone" name="user_phone" type="text" placeholder="Phone number" required>
                  </div>

                  <!-- Price -->
                  <div class="mb-3">
                    <label class="visually-hidden" for="item_price">Price</label>
                    <input class="form-control" id="item_price" name="item_price" type="text" placeholder="Price" required> 
                  </div>

                  <!-- photo -->
                  <!--  <div class="mb-3">
                    <label class="visually-hidden" for="item_photo">Photo</label>
                    <input class="form-control" id="item_photo" name="item_photo" type="file" placeholder="Photo" required>
                  </div> --> 

                  <div class="col text-center">

                   <!-- Button -->
                   <button class="btn btn-outline-primary" type="submit" name="test_menu">
                      Add New Item
                    </button>
                  </div>

            </form>


        <?php 

          if (isset($_POST['test_menu'])) {

              $itemname = $_POST['item_name'];
              $phone = $_POST['user_phone'];
              $price = $_POST['item_price'];      

              $data = [
                'item_name' => $itemname,
                'phone' => $phone,
                'price' => $price
              ];

                //print_r($data);
             
                $addNewDoc = $fs->setNewDocument($itemname, $data);

                print_r($addNewDoc);     
                
          }else{

            $_POST['test_menu'] = "";
            ?>
              <div> <?php echo $_POST['test_menu']. "no dataYet"; ?> </div>
              <?php
          }


     ?>
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
                1234 Altschul, Los Angeles, CA 10027-0000
              </li>
              <li class="d-flex mb-2">
                <div class="fas fa-phone me-3 mt-2 fs-sm"></div>
                +1 987 654 3210
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
    
    
    <!--  -->
    <!-- TOAST -->
    <div class="toast position-fixed bottom-0 start-50 translate-middle-x mb-3 mb-md-5" id="notification" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body mx-auto"></div>
      </div>
    </div>

    <!-- JAVASCRIPT -->
    <!-- Vendor JS -->
    <script src="assets/js/vendor.bundle.js"></script>
    
    <!-- Theme JS -->
    <script src="assets/js/theme.bundle.js"></script>

  </body>
</html>
