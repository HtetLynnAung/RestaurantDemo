<?php 

include('configold.php');

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

    <!-- NAVBAR -->
    <nav class="navbar navbar-light navbar-expand-lg  fixed-top">
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
              <a class="nav-link " href="menu.php">Menu</a>
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
              <a class="nav-link active" href="profile.php"><?php echo $_SESSION['user_first_name']; ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="logout.php" data-tooltip="Logout?" data-position="right">Logout</a>
            </li>
          </ul>
    
        </div>
      </div>
    </nav>

    <!-- ARTICLE -->
    <article class="pt-10 pt-md-12">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-8 col-lg-6 text-center">

            <!-- Preheading -->
            <h6 class="text-xs text-primary">
              Restaurant Profile
            </h6>

            <!-- Heading -->
            <h1 class="mb-4">
              <?php echo $_SESSION['user_first_name'] ." ". $_SESSION['user_last_name'] ?>
            </h1>

            <!-- Subheading -->
            <p class="mb-6">
              <?php echo $_SESSION['user_email_address']; ?>
            </p>

          </div>
        </div>
        <div class="row">
          <div class="col-12">

            <!-- Image -->
            <figure class="mb-6 text-center">
              <?php echo "<img class='img-fluid' src=".$_SESSION['user_image'].">" ?>
              
            </figure>

          </div>
        </div>        
    </article>
    

    <!-- JAVASCRIPT -->
    <!-- Vendor JS -->
    <script src="assets/js/vendor.bundle.js"></script>
    
    <!-- Theme JS -->
    <script src="assets/js/theme.bundle.js"></script>

  </body>
</html>
