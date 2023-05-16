<?php
session_start();
$_SESSION["lastpage"] = $_SERVER["REQUEST_URI"];
if (isset($_POST["logout"])) {
   unset($_SESSION["loggedIn"]);
   unset($_SESSION["beheerderLoggedIn"]);
   $_POST["logout"] = "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <!-- basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- mobile metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">
   <!-- site metas -->
   <title>Thuis Pagina</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">
   <!-- bootstrap css -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   <!-- style css -->
   <link rel="stylesheet" href="css/style.css">
   <!-- Responsive-->
   <link rel="stylesheet" href="css/responsive.css">
   <!-- fevicon -->
   <link rel="icon" href="images/fevicon.png" type="image/gif" />
   <!-- Scrollbar Custom CSS -->
   <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
   <!-- Tweaks for older IEs-->
   <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
   <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

   <?php
   $db_host = 'localhost';
   $db_user = 'root';
   $db_pass = '';
   $db_name = 'gip';

   require_once('config.php');

   try {
      // create a PDO object and set connection parameters
      $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";
      $options = array(
         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
         PDO::ATTR_EMULATE_PREPARES => false,
      );
      $pdo = new PDO($dsn, $db_user, $db_pass, $options);
   } catch (PDOException $e) {
      // handle any errors that may occur during connection
      echo "Connection failed: " . $e->getMessage();
      exit();
   }
   $pID = 1;
   ?>
</head>
<!-- body -->

<body class="main-layout">
   <!-- loader  -->
   <!--
      <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="#"/></div>
      </div>
      -->
   <!-- end loader -->
   <!-- header -->
   <header class="full_bg">
      <!-- header inner -->
      <div class="header">
         <div class="container-fluid">
            <div class="row">
               <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                  <div class="full">
                     <div class="center-desk">
                        <div class="logo">
                           <a href="index.php"><img src="images/logo.png" alt="#" /></a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                  <nav class="navigation navbar navbar-expand-md navbar-dark">
                     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                     </button>
                     <div class="collapse navbar-collapse" id="navbarsExample04">
                        <ul class="navbar-nav mr-auto">
                           <li class="nav-item active">
                              <a class="nav-link" href="index.php">Thuis</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="about.php">Over Ons</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="order.php">Bestel</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="products.php">Producten</a>
                           </li>
                           <?php if (!empty($_SESSION["beheerderLoggedIn"])) { ?>
                              <li class="nav-item">
                                 <a class="nav-link" href="stock.php">Stock</a>
                              </li>
                           <?php } ?>
                           <li class="nav-item">
                              <a class="nav-link" href="contact.php">Contact</a>
                           </li>
                           <?php
                           $item = ((empty($_SESSION['loggedIn']) == true || $_SESSION['loggedIn'] != true) && (empty($_SESSION['beheerderLoggedIn']) == true)) ?
                              '<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>' :
                              '<li class="nav-item"><a class="nav-link" href="profile.php">Profiel</a></li>
                              <li class="nav-item"><form method="post" action="index.php">
                              <button class="nav-link" name="logout" type="submit" value="1" formtarget="_self">Logout</button>
                              </form></li>';
                           echo $item;
                           ?>
                        </ul>
                     </div>
                  </nav>
               </div>
            </div>
         </div>
      </div>
      <!-- end header inner -->
      <!-- banner -->
      <section class="banner_main">
         <div class="container">
            <div class="banner_po">
               <div class="row">
                  <div class="col-md-7">
                     <div class="text_box">
                        <span>Now started</span>
                        <h1> <strong>Fruit And </strong> <br> Vegetables </h1>
                        <a class="read_more" href="#about" role="button">About us</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </header>
   <!-- end header -->
   <!-- end banner -->
   <!-- about -->
   <div id="about" class="about">
      <div class="container">
         <div class="row">
            <div class="col-md-6 offset-md-3">
               <div class="titlepage">
                  <h2>Over Ons</h2>
                  <span>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptu </span>
               </div>
            </div>
            <div class="col-md-12">
               <div class="about_img">
                  <figure><img src="images/about.png" alt="#" /></figure>
                  <a class="read_more" href="Javascript:void(0)">Lees Meer</a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end about -->
   <!-- our products -->
   <div class="index">
      <div class="container">
         <div class="row">
            <div class="col-md-6 offset-md-3">
               <div class="titlepage">
                  <h2>Onze Producten</h2>
                  <span>
                     Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptu
                  </span>
               </div>
            </div>
         </div>
         <?php
         $sql = "SELECT * FROM product p, stock s WHERE p.id_stock = s.id_stock";
         $result = $pdo->query($sql);
         $products = $result->fetchAll(PDO::FETCH_ASSOC);
         ?>
         <div id="productCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
               <?php
               $num_slides = ceil(count($products) / 4);
               for ($i = 0; $i < $num_slides; $i++) { ?>
                  <li data-target="#productCarousel" data-slide-to="<?php echo $i; ?>" <?php if ($i == 0) { ?>class="active" <?php } ?>></li>
               <?php } ?>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
               <?php for ($i = 0; $i < $num_slides; $i++) { ?>
                  <div class="carousel-item <?php if ($i == 0) { ?>active<?php } ?>">
                     <div class="row">
                        <?php for ($j = $i * 4; $j < ($i + 1) * 4 && $j < count($products); $j++) { ?>
                           <div class="our_products">
                              <div class="product">
                                 <figure><img src="images/pro<?php echo $products[$j]['product_naam']; ?>.png" alt="#"></figure>
                              </div>
                              <h3><?php echo ucfirst($products[$j]['product_naam']); ?></h3>
                              <span>Product info</span><br />
                              <p>Prijs per: € <?php echo $products[$j]['product_prijs']; ?></p>
                              <p>In stock: <?php echo $products[$j]['stock']; ?></p>
                              <form action="product.php" method="post">
                                 <button class="send_btn">Koop nu</button>
                              </form>
                           </div>
                        <?php } ?>
                     </div>
                  </div>
               <?php } ?>
            </div>

            <!-- Controls -->
            <a class="carousel-control-prev" href="#productCarousel" role="button" data-slide="prev">
               <span class="carousel-control-prev-icon" aria-hidden="true"></span>
               <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#productCarousel" role="button" data-slide="next">
               <span class="carousel-control-next-icon" aria-hidden="true"></span>
               <span class="sr-only">Next</span>
            </a>
         </div>
      </div>
   </div>
   <!-- end our products -->
   <!-- using -->
   <div class="using">
      <div class="container-fluid">
         <div class="row d_flex">
            <div class="col-md-6">
               <div class="titlepage">
                  <h2>Lorem Ipsum using</h2>
                  <p>Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise</p>
                  <a class="read_more white_bg" href="Javascript:void(0)">Lees Meer</a>
               </div>
            </div>
            <div class="col-md-5 offset-md-1 padding_right0">
               <div class="frout_img">
                  <figure><img src="images/frout.png" alt="#" /></figure>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end using -->
   <!-- products/gallery -->
   <div class="products">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <h2>Galerij</h2>
                  <span>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy </span>
               </div>
            </div>
         </div>
         <div class="row">
            <?php
            // SELECT logged in user name
            $logged_user_name = isset($_SESSION['loggedIn']['user']) ? $_SESSION['loggedIn']['user'] : (isset($_SESSION['beheerderLoggedIn']['user']) ? $_SESSION['beheerderLoggedIn']['user'] : null);
            
            // SELECT al de product namen om dan via een loop al de relevante fotos te tonen
            $sql = "SELECT product_naam FROM product";
            $result = $pdo->query($sql);
            $products = $result->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php for ($j = 0; $j < count($products); $j++) { ?>
               <div class="products_img">
                  <figure><?php if (isset($logged_user_name)) { echo '<a href="order.php">'; } ?><img src='images/pro<?php echo ucfirst($products[$j]['product_naam']); ?>.png' alt='#'><?php if (isset($logged_user_name)) { echo '</a>'; } ?></figure>
               </div>
            <?php }
            $pdo = null; ?>
         </div>
      </div>
   </div>
   <!-- end products/gallery -->
   <!--  contact -->
   <div class="contact">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <h2>Contacteer Ons</h2>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6  padding_right0">
               <div class="map_main">
                  <div class="map-responsive">
                     <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&amp;q=Eiffel+Tower+Paris+France" width="600" height="453" frameborder="0" style="border:0; width: 100%;" allowfullscreen=""></iframe>
                  </div>
               </div>
            </div>
            <div class="col-md-6 padding_left0">
               <form id="request" class="main_form">
                  <div class="row">
                     <div class="col-md-12 ">
                        <input class="contactus" placeholder="Name" type="type" name="Name">
                     </div>
                     <div class="col-md-12">
                        <input class="contactus" placeholder="Phone" type="type" name="Phone">
                     </div>
                     <div class="col-md-12">
                        <input class="contactus" placeholder="Email" type="type" name="Email">
                     </div>
                     <div class="col-md-12">
                        <textarea class="textarea" placeholder="Message" type="type" Message="Message">Message</textarea>
                     </div>
                     <div class="col-md-12">
                        <button class="send_btn">Send</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <!-- end contact -->
   <!--  footer -->
   <footer>
      <div class="footer">
         <div class="container">
            <div class="row">
               <div class="col-md-8 offset-md-2">
                  <div class="newslatter">
                     <h4>Abboneer Aan Onze Nieuwsbrief</h4>
                     <form class="bottom_form">
                        <input class="enter" placeholder="Typ uw email" type="text" name="Typ uw email">
                        <button class="sub_btn">Abboneer</button>
                     </form>
                  </div>
               </div>
               <div class="col-sm-12">
                  <div class=" border_top1"></div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-4">
                  <h3>menu LINKS</h3>
                  <ul class="link_menu">
                     <li><a href="#">Thuis Pagina</a></li>
                     <li><a href="about.php">Over Ons</a></li>
                     <li><a href="order.php">Bestel</a></li>
                     <li><a href="products.php">Producten</a></li>
                     <li><a href="stock.php">Stock</a></li>
                     <li><a href="contact.php">Contacteer Ons</a></li>
                  </ul>
               </div>
               <div class=" col-md-3">
                  <h3>TOP voedsel</h3>
                  <p class="many">
                     There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected
                  </p>
               </div>
               <div class="col-lg-3 offset-mdlg-2 col-md-4 offset-md-1">
                  <h3>Contact</h3>
                  <ul class="conta">
                     <li><i class="fa fa-map-marker" aria-hidden="true"></i>Locatie</li>
                     <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="#">demo@gmail.com</a></li>
                     <li><i class="fa fa-mobile" aria-hidden="true"></i>Tell : +01 1234567890</li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="copyright">
            <div class="container">
               <div class="row">
                  <div class="col-md-10 offset-md-1">
                     <p>© 2019 All Rights Reserved. Design by <a href="https://html.design/"> Free Html Templates</a></p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </footer>
   <!-- end footer -->
   <!-- Javascript files-->
   <script src="js/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   <!-- sidebar -->
   <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
   <script src="js/custom.js"></script>
</body>

</html>