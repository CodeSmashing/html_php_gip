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
      <title>Stock</title>
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
      <?php
      require_once('config.php');

      try {
         // create a PDO object and set connection parameters
         $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";
         $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
         );
         $pdo = new PDO($dsn, $db_user, $db_pass, $options);
      } catch(PDOException $e) {
         // handle any errors that may occur during connection
         echo "Connection failed: " . $e->getMessage();
         exit();
      }
      ?>
   </head>
   <!-- body -->
   <body class="main-layout inner_page">
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
                     <nav class="navigation navbar navbar-expand-md navbar-dark ">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarsExample04">
                           <ul class="navbar-nav mr-auto">
                              <li class="nav-item ">
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
                                 <li class="nav-item active">
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
      </header>
      <!-- end header -->
      <!-- banner -->
      <div class="back_re">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="title">
                     <h2>Onze stock</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end banner -->
      <!-- start main page -->
      <div class="stock">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <span>Onze trotse stock van dingen.</span>
                  </div>
               </div>
            </div>
            <form id="form stock" action="process.php" method="post">
               <?php
               $sql = "SELECT * FROM product p, stock s WHERE p.id_stock = s.id_stock";
               $result = $pdo->query($sql);
               while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                  <div class="row sum">
                     <div class="gallery_img">
                        <figure><img src="images/pro<?php echo $row["product_naam"]; ?>.png" alt="#"/></figure>
                     </div>
                     <span class="list" id="id">Product Id <?php echo $row["id_product"]; ?></span>
                     <span class="list" id="id">Stock Id: <?php echo $row["id_stock"]; ?></span>
                     <span class="list" id="name">Naam: <?php echo $row["product_naam"]; ?> </span>
                     <span class="list" id="num">Huidige Prijs: <?php echo $row["product_prijs"]; ?></span>
                     <span class="list" id="num">Huidige Stock: <?php echo $row["stock"]; ?></span>
                     <input type="text" name="product[<?php echo $row['id_product']; ?>][price]" placeholder="Input Prijs"></input>
                     <input type="text" name="product[<?php echo $row['id_stock']; ?>][stock]" placeholder="Input Stock"></input>
                     <button type="submit"><img class="vink" src="images/vink.png" alt="#"></button>
                  </div>
               <?php }
               $pdo = null;
               ?>
            </form>
         </div>
      </div>
      <!-- end main page -->
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
                        <li><a href="product.php">Ons Product</a></li>
                        <li><a href="gallery.php">Galerij</a></li>
                        <li><a href="order.php">Bestelformulier</a></li>
                        <li><a href="stock.php">Stock</a></li>
                        <li><a href="contact.php">Contacteer Ons</a></li>
                     </ul>
                  </div>
                  <div class="col-md-3">
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
        <!-- Javascript files-->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery-3.0.0.min.js"></script>
        <!-- sidebar -->
        <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="js/custom.js"></script>
     </body>
</html>