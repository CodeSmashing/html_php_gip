<?php
session_start();
$_SESSION['lastpage'] = $_SERVER['REQUEST_URI'];

if (isset($_POST['logout'])) {
   unset($_SESSION['logged_in']);
   unset($_SESSION['admin_logged_in']);
   $_POST['logout'] = '';
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
   <title>Product</title>
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
   require_once('config.php');
   require_once('sqlquerys.php');
   ?>

</head>
<!-- body -->

<body class="main-layout inner_page">
   <!-- loader  -->
   <div class="loader_bg">
      <div class="loader"><img src="images/loading.gif" alt="#" /></div>
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
                  <nav class="navigation navbar navbar-expand-md navbar-dark ">
                     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                     </button>
                     <div class="collapse navbar-collapse" id="navbarsExample04">
                        <ul class="navbar-nav mr-auto">
                           <li class="nav-item">
                              <a class="nav-link" href="index.php">Thuis</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="about.php">Over Ons</a>
                           </li>
                           <li class="nav-item active">
                              <a class="nav-link" href="order.php">Bestel</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="products.php">Producten</a>
                           </li>
                           <?php
                           // Only show the link to the stock page to admin's who're logged in
                           if (!empty($_SESSION["admin_logged_in"])) { ?>
                              <li class="nav-item">
                                 <a class="nav-link" href="stock.php">Stock</a>
                              </li>
                           <?php } ?>
                           <li class="nav-item">
                              <a class="nav-link" href="contact.php">Contact</a>
                           </li>
                           <?php
                           // Depending on whether or not the user is logged in, either show a login button or a logout button along with a button to the profile page
                           $item = ((empty($_SESSION['logged_in']) == true || $_SESSION['logged_in'] != true) && (empty($_SESSION['admin_logged_in']) == true)) ?
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
      <div class="back_re">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="title">
                     <h2>Uw Bestelling Plaatsen</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end banner -->
   </header>
   <!-- end header -->
   <!-- our products -->
   <div class="products">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <span>
                     Hier krijgt u de mogelijkheid om een bestelling te plaatsen via onze website. 
                  </span>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="order">
      <div class="container">
         <div class="sub_form">
            <div class="wrapper">
               <!-- A fieldset to display all the products in the user's current order -->
               <fieldset class="list">
                  <legend>Uw Order</legend>
                  <hr>
                  <?php
                  // If the user is logged in
                  if (isset($_SESSION['logged_in']) || isset($_SESSION['admin_logged_in'])) {
                     // Initialize cart if it doesn't exist
                     if (!isset($_SESSION['cart'])) {
                        $_SESSION['cart'] = array();
                     }

                     // Add product to cart if submitted
                     if (isset($_POST['add_to_cart'])) {
                        $product_name = $_POST['product_name'];
                        ((int)$_POST['product_quantity'] == 0) ? $product_quantity = 1 : $product_quantity = (int)$_POST['product_quantity'];
                        $product_price = (float)$_POST["product_price"];

                        if (isset($_SESSION['cart'][$product_name])) {
                           $_SESSION['cart'][$product_name]['quantity'] += $product_quantity;
                           $_SESSION['cart'][$product_name]['price'] = $product_price;
                        } else {
                           $_SESSION['cart'][$product_name] = array('quantity' => $product_quantity, 'price' => $product_price);
                        }
                     }

                     // Remove product from cart if submitted
                     if (isset($_POST['remove_from_cart'])) {
                        $product_name = $_POST['product_name'];
                        unset($_SESSION['cart'][$product_name]);
                     }

                     // Display cart if not empty
                     if (empty($_SESSION['cart'])) {
                        echo '<p>Uw winkelmandje is leeg</p>';
                     } else {
                        echo '<ul>';
                        $total_price = 0;
                        foreach ($_SESSION['cart'] as $product_name => $product) {
                           $product_price = $product['price'];
                           $product_quantity = $product['quantity'];
                           $product_total_price = $product_price * $product_quantity;
                           $total_price += $product_total_price;

                           echo '<li><span>' . $product_name . ' x ' . $product_quantity . ' = €' . $product_total_price . '</span><form method="post"><input type="hidden" name="product_name" value="' . $product_name . '"><div id="button"><button class="remove_btn" name="remove_from_cart" type="submit">Verwijder</button></div></form></li>';
                        }
                        echo '</ul>'; ?>
                        <br><span>Uw totaal komt uit tot: € <?php echo $total_price; ?></span>
                        <form action="process.php">
                           <button class="send_btn" type="submit">Finaliseren</button>
                        </form>
                     <?php
                     }
                  } else {
                     // If the user isn't logged in we ask them to log in
                     ?>
                     <span>U zult moeten inloggen om een bestelling te mogen plaatsen.</span><br>
                     <div class='center'><a class="send_btn" href="login.php">Login pagina</a></div>
                  <?php }
                  ?>
               </fieldset>
               <!-- A fieldset to display all the products in our database along with relevant information -->
               <fieldset class="order_field">
                  <?php
                  $products = sql_select_product_and_stock($pdo);
                  $num_products = count($products);

                  // Calculate the number of slides needed
                  $num_slides = ceil($num_products / 8);

                  // Check if we need to add dummy products
                  $num_dummy_products = $num_slides * 8 - $num_products;
                  if ($num_dummy_products > 0) {
                     for ($i = 0; $i < $num_dummy_products; $i++) {
                        $products[] = array(
                           'product_naam' => 'N/A',
                           'product_prijs' => ' ',
                           'stock' => ' '
                        );
                     }
                     $num_products += $num_dummy_products;
                  }
                  ?>
                  <div id="product_carousel" class="carousel slide" data-ride="carousel">
                     <!-- Indicators -->
                     <ol class="carousel-indicators">
                        <?php for ($i = 0; $i < $num_slides; $i++) { ?>
                           <li data-target="#product_carousel" data-slide-to="<?php echo $i; ?>" <?php if ($i == 0) { ?>class="active" <?php } ?>></li>
                        <?php } ?>
                     </ol>

                     <!-- Wrapper for slides -->
                     <div class="carousel-inner">
                        <?php for ($i = 0; $i < $num_slides; $i++) { ?>
                           <div class="carousel-item <?php if ($i == 0) { ?>active<?php } ?>">
                              <div class="row">
                                 <?php for ($j = $i * 8; $j < ($i + 1) * 8 && $j < $num_products; $j++) { ?>
                                    <div id="ho_bo" class="our_products">
                                       <div class="our_products">
                                          <div class="product">
                                             <figure><img src="images/pro<?php echo $products[$j]['product_naam']; ?>.png" alt="#"></figure>
                                          </div>
                                          <h3><?php echo ucfirst($products[$j]['product_naam']); ?></h3>
                                          <span>Product info</span><br />
                                          <p>Prijs per: € <?php echo $products[$j]['product_prijs']; ?></p>
                                          <p>In stock: <?php echo $products[$j]['stock']; ?></p>
                                          <form method="post">
                                             <input type="hidden" name="product_price" value="<?php echo $products[$j]["product_prijs"]; ?>" <?php if ($products[$j]["product_prijs"] == ' ') { ?>disabled<?php } ?>></input>
                                             <input type="hidden" name="product_name" value="<?php echo $products[$j]["product_naam"]; ?>" <?php if ($products[$j]["product_prijs"] == ' ') { ?>disabled<?php } ?>></input>
                                             <input type="number" name="product_quantity" placeholder="Hoeveelheid" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" <?php if ($products[$j]["product_prijs"] == ' ') { ?>disabled<?php } ?>></input>
                                             <button type="submit" name="add_to_cart" class="send_btn" <?php if ($products[$j]["product_prijs"] == ' ') { ?>disabled<?php } ?>>Toevoegen</input>
                                          </form>
                                       </div>
                                    </div>
                                 <?php } ?>
                              </div>
                           </div>
                        <?php }
                        // End PDO connection
                        $pdo = null; ?>
                     </div>
                     <!-- Controls -->
                     <a class="carousel-control-prev" href="#product_carousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                     </a>
                     <a class="carousel-control-next" href="#product_carousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                     </a>
                  </div>
               </fieldset>
            </div>
         </div>
      </div>
   </div>
   <!-- end our products -->
   <!--  footer -->
   <footer>
      <div class="footer">
         <div class="container">
            <div class="row">
               <div class="col-md-8 offset-md-2">
                  <div class="newslatter">
                     <h4>Aboneer Aan Onze Nieuwsbrief</h4>
                     <form class="bottom_form">
                        <input class="enter" placeholder="Typ uw email" type="text" name="Typ uw email">
                        <button class="sub_btn">Aboneer</button>
                     </form>
                  </div>
               </div>
               <div class="col-sm-12">
                  <div class="border_top1"></div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-4">
                  <h3>menu LINKS</h3>
                  <ul class="link_menu">
                     <li><a href="#">Thuis Pagina</a></li>
                     <li><a href="about.php">Over ons</a></li>
                     <li><a href="order.php">Bestel</a></li>
                     <li><a href="products.php">Producten</a></li>
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