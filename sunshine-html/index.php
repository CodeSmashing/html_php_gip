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
      <link rel="stylesheet" href="css/bootstrap.min.css">
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
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
   </head>
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="#"/></div>
      </div>
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
                                 <a class="nav-link" href="product.php">Producten</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="gallery.php">Galerij</a>
                              </li>
                              <?php if (!empty($_SESSION["beheerderLoggedIn"])) { ?>
                                 <li class="nav-item">
                                    <a class="nav-link" href="stock.php">Stock</a>
                                 </li>
                              <?php } ?>
                              <li class="nav-item">
                                 <a class="nav-link" href="contact.php">Contact</a>
                              </li>
                              <li class="nav-item">
                                 <?php
                                 $item = ((empty($_SESSION["loggedIn"]) == true || $_SESSION["loggedIn"] != true) && (empty($_SESSION["beheerderLoggedIn"]) == true)) ? '<a class="nav-link" href="login.php">Login</a>' : '
                                 <form method="post">
                                 <button class="nav-link" name="logout" type="submit" value="1"
                                 formtarget="_self">Logout</button>
                                 </form>' ;
                                 echo $item;
                                 ?>
                              </li>
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
                     <figure><img src="images/about.png" alt="#"/></figure>
                     <a class="read_more" href="Javascript:void(0)">Lees Meer</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end about -->
      <!-- our products -->
      <div class="products">
         <div class="container">
            <div class="row">
               <div class="col-md-7">
                  <div class="titlepage">
                     <h2>Onze Producten</h2>
                     <span>
                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptu
                     </span>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-3 col-md-6 col-sm-6">
                  <div id="ho_bo" class="our_products">
                     <div class="product">
                        <figure><img src="images/pro1.png" alt="#"/></figure>
                     </div>
                     <h3>Mangoes For Juice</h3>
                     <span>Nam libero tempore</span>
                     <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non </p>
                  </div>
               </div>
               <div class="col-lg-3 col-md-6 col-sm-6">
                  <div id="ho_bo" class="our_products">
                     <div class="product">
                        <figure><img src="images/pro2.png" alt="#"/></figure>
                     </div>
                     <h3>Apple For Juice</h3>
                     <span>Nam libero tempore</span>
                     <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non </p>
                  </div>
               </div>
               <div class="col-lg-3 col-md-6 col-sm-6">
                  <div id="ho_bo" class="our_products">
                     <div class="product">
                        <figure><img src="images/pro3.png" alt="#"/></figure>
                     </div>
                     <h3>Orange For Juice</h3>
                     <span>Nam libero tempore</span>
                     <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non </p>
                  </div>
               </div>
               <div class="col-lg-3 col-md-6 col-sm-6">
                  <div id="ho_bo" class="our_products">
                     <div class="product">
                        <figure><img src="images/pro4.png" alt="#"/></figure>
                     </div>
                     <h3>Pineapple For Juice</h3>
                     <span>Nam libero tempore</span>
                     <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non </p>
                  </div>
               </div>
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
                     <h2 >Lorem Ipsum using</h2>
                     <p>Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise</p>
                     <a class="read_more white_bg" href="Javascript:void(0)">Lees Meer</a>
                  </div>
               </div>
               <div class="col-md-5 offset-md-1 padding_right0">
                  <div class="frout_img">
                     <figure><img src="images/frout.png" alt="#"/></figure>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end using -->
      <!-- gallery -->
      <div  class="gallery">
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
               <div class="col-md-4 col-sm-6">
                  <div class="gallery_img">
                     <figure><img src="images/gallery1.png" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-md-4 col-sm-6">
                  <div class="gallery_img">
                     <figure><img src="images/gallery2.png" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-md-4 col-sm-6">
                  <div class="gallery_img">
                     <figure><img src="images/gallery3.png" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-md-4 col-sm-6">
                  <div class="gallery_img">
                     <figure><img src="images/gallery4.png" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-md-4 col-sm-6">
                  <div class="gallery_img">
                     <figure><img src="images/gallery5.png" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-md-4 col-sm-6">
                  <div class="gallery_img">
                     <figure><img src="images/gallery6.png" alt="#"/></figure>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end gallery -->
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
                        <li><a href="product.php">Onze Producten</a></li>
                        <li><a href="gallery.php">Galerij</a></li>
                        <li><a href="order.php">Bestelformulier</a></li>
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
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
   </body>
</html>