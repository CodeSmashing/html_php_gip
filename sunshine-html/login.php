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
   <title><?php echo (empty($_POST["optie_inlog"]) || $_POST["optie_inlog"] == "2") ? "Registratie" : "Login"; ?></title>
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
                  <nav class="navigation navbar navbar-expand-md navbar-dark">
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
                           <li class="nav-item">
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
                              '<li class="nav-item active"><a class="nav-link" href="login.php">Login</a></li>' :
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
                     <?php
                     echo (empty($_POST['optie_inlog']) == true || $_POST['optie_inlog'] == '2') ? '<h2>Registratie</h2>' : '<h2>Login</h2>';
                     ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end banner -->
   </header>
   <!-- end header -->
   <!-- login -->
   <div class="login">
      <div class="row">
         <div class="col-md-6 offset-md-3">
            <div class="titlepage">
               <?php
               // Depending on whether or not the user selected they wanted to log in or register, we'll give them a different welkomming message
               $item = (empty($_POST['optie_inlog']) == true || $_POST['optie_inlog'] == '2') ? '<span>Welkom tot de registratie pagina, hier kunt u zich een account registreren.</span>' : '
               <span>Welkom tot de inlog pagina, hier kunt u zich inloggen.</span>';
               echo $item;
               ?>
            </div>
         </div>
      </div>
      <?php
      // Variables we'll set to different values depending on what the user wants to do
      $optie_inlog = isset($_POST['optie_inlog']) ? htmlspecialchars($_POST['optie_inlog']) : '2';
      $formAction = ($optie_inlog == '2') ? 'Nieuw registreren' : (($optie_inlog == '3') ? 'Login als beheerder' : 'Login als klant');
      $buttonValue = ($optie_inlog == '2') ? '1' : (($optie_inlog == '3') ? '3' : '2');
      ?>

      <form action="process.php" method="post">
         <hr><b>Gebruikersnaam :</b><br>
         <input type="text" name="username" pattern="[A-z0-9À-ž\s]{2,}" title="Drie of meer characters" required><br><br>

         <b>Paswoord :</b><br>
         <input type="password" name="password" pattern=".{8,}" title="Acht of meer characters" required><br><br>

         <button class="sub_btn" name="registreren" type="submit" value="<?php echo htmlspecialchars($buttonValue); ?>">
            <?php echo htmlspecialchars($formAction); ?>
         </button>
         <br>
      </form>

      <form method="post">
         <button class="sub_btn" name="optie_inlog" type="submit" value="<?php echo htmlspecialchars(($optie_inlog == "2") ? "1" : "2"); ?>">
            <?php echo htmlspecialchars(($optie_inlog == "2") ? "Al een klant?" : "Nog geen klant?"); ?>
         </button><br>

         <?php if ($optie_inlog != "3") { ?>
            <button class="sub_btn" name="optie_inlog" type="submit" value="3">
               Inlog Beheerder
            </button>
         <?php } ?>
      </form>
      <hr>
   </div>
   <!-- end login -->
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