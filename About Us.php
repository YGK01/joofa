<?php
session_start();
error_reporting(0);
include('assets/config.php');

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="About Us" content="About Joo Fa">
  <meta charset="utf-8">

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/JLogo.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style2.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">

  <title>About Us | Joo Fa Trading </title>

  <!-- Mobile Specific Meta-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Favicon -->
  <link rel="shortcut icon" type="assets/image/x-icon" href="assets/img/favicon.png" />
  <!-- Ionic Icon Css -->
  <link rel="stylesheet" href="assets/plugins/Ionicons/css/ionicons.min.css">
  <!-- Owl Carousel CSS -->
  <link rel="stylesheet" href="assets/plugins/slick/slick.css">
  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="assets/css/style.css">
<style>
  video {
  width: 100%;
  height: auto;
}

</style>
</head>

<body id="body">

<?php include('assets/C_header.php'); ?>

<!-- Slider Start -->
<section class="slider">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block">
          <h1 class="animated fadeInUp">Joo Fa Trading</h1>
          <h2 class="animated fadeInUp">Insist on handmade coffee, let the previous taste continue</h2>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- About Section -->
<section class="about section">
	<div class="container">
		<div class="row">
			<div class="col-md-7 col-sm-12">
				<div class="block">
					<div class="section-title">
						<h2>About Us</h2>
						<p>Hand-roasted strong and pure coffee for decades</p>
					</div>
					<p>Joo Fa Coffee has a history of more than 50 years. The homemade coffee has been handed down by a Hainanese master. It is also the main coffee "supplier" for the old villagers in the town. Aside from all fully machined coffee production methods, the boss Lim SengPeng still insists on using traditional coffee production methods to provide customers with the most traditional and original coffee aroma.</p>
				</div>
			</div>
			<div class="col-md-5 col-sm-12">
				<div class="block">
					<img src="assets/images/JooFa1.jpg" alt="Img">
				</div>
			</div>
		</div>
	</div>
</section>

<section class="feature bg-2">
  <div class="container">
    <div class="row">
      <div class="col"></div>
      <div class="col-lg-5 col-md-offset-6">
      <br>
        <h2 class="section-subtitle">In order to ensure the quality of coffee, the boss does everything from start to finish</h2>
        <p>There is no luxurious production environment, and several traditional machines with a history of more than 40 years are placed on the open space next to the rural ancestral home. It's very interesting to watch these "old" traditional machines thriving under the operation of the boss. These are the processes that you can't experience when you usually live in the city and enjoy ready-made coffee. From screening coffee cherries to drying, frying, and grinding coffee, the owner, Lin Chengping, does it all. After brewing, this traditional ground coffee has no sour taste even after sitting for a few hours. Come here on a treasure hunt.</p>
        <br>
      </div>
    </div>
  </div>
</section>

<!-- VIDEO -->

<section class="call-to-action bg-1 section-sm overly">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block ">
          <h2>The production of Coffee:</h2>
        <video width="800" controls>
          <source src="assets/videos/JooFa_A.mp4" type="video/mp4">
        </video>
      </div>
    </div>
  </div>
</div>
</section>

<!-- Content Start -->
<!-- footer Start -->

    <!--
    Essential Scripts
    =====================================-->

    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/chat.js"></script>

    <!-- Main jQuery -->
    <script src="assets/plugins/jQuery/jquery.min.js"></script>
    <!-- Bootstrap 3.1 -->
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <!-- slick Carousel -->
    <script src="assets/plugins/slick/slick.min.js"></script>
    <script src="assets/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
    <!-- filter -->
    <script src="assets/plugins/shuffle/shuffle.min.js"></script>
    <script src="assets/plugins/SyoTimer/jquery.syotimer.min.js"></script>

    <!-- Form Validator -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.32/jquery.form.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.11.1/jquery.validate.min.js"></script>

    <!-- Google Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places"></script>
    <script src="assets/plugins/google-map/map.js"></script>

    <script src="assets/js/script.js"></script>
    
    <?php include('assets/footer.html'); ?>
    
    </body>

    </html>
