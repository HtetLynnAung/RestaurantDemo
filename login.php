<?php 
    //Include Google Configuration File
  include('configold.php');

  if(!isset($_SESSION['access_token'])) {
   //Create a URL to obtain user authorization

  } else {
    //header("Location: login.php");
  }
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
    <title>Touch - Restaurant- Login</title>
  </head>
  <body>




    <!-- LOGIN FORM -->
    <section class="py-7 py-md-9">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-8 col-lg-6 text-center">

            <!-- Heading -->
            <h2 class="mb-2">
              Get  to  your  account
            </h2>

            <!-- Subheading -->
            <p class="mb-6">

            </p>

          </div>
        </div>



        <div class="row">
        	<div class="col-md-12 text-center">
        		<div class="mb-6">
        			<?php 
        			echo "<a href= '".$google_client->createAuthUrl()."'> <img src='img/g-login.png'></a>"; 
        			?>
        			
        		</div>
        		
        	</div>
        </div>
      </div>
    </section>



    <!-- JAVASCRIPT -->
    <!-- Vendor JS -->
    <script src="assets/js/vendor.bundle.js"></script>
    
    <!-- Theme JS -->
    <script src="assets/js/theme.bundle.js"></script>

  </body>
</html>


