<?php
session_start();
$_SESSION["lastpage"] = $_SERVER["REQUEST_URI"];

if (isset($_POST["logout"])) {
   unset($_SESSION["loggedIn"]); 
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
      <title>Product</title>
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
      // Connectie creëeren
      $conn = new mysqli("localhost", "root", "", "gip"); 
      // Connectie checken
      if ($conn->connect_errno) {
            die("Connectie mislukt: " . $conn->connect_error);
      }
      $pID = 1;
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
                                 <a class="nav-link" href="index.php">Thuis Pagina</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="about.php">Over Ons</a>
                              </li>
                              <li class="nav-item active">
                                 <a class="nav-link" href="product.php">Onze Producten</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="gallery.php">Galerij</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="stock.php">Stock</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="order.php">Bestelformulier</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="contact.php">Contacteer Ons</a>
                              </li>
                              <li class="nav-item">
                                 <?php
                                 $item = (empty($_SESSION["loggedIn"]) == true || $_SESSION["loggedIn"] != true) ? '<a class="nav-link" href="login.php">Login</a>' : '
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
                     <h2>Onze Producten</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end banner -->
      <!-- our products -->
      <div class="products">
         <div class="container">
            <div class="row">
               <div class="col-md-7">
                  <div class="titlepage">
                     <span>
                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptu
                     </span>
                  </div>
               </div>
            </div>
            <?php
            $sql = "SELECT id_product, product_naam, product_prijs, stock FROM product p, stock s WHERE p.id_stock = s.id_stock";
            $result = $conn->query($sql);
            $arr = array();

            while($row = $result->fetch_assoc()) {
               $arr[] = $row;
            }
            
            // https://stackoverflow.com/questions/4729322/selecting-mysql-table-data-into-an-array
            // used solution: https://www.geeksforgeeks.org/how-to-search-by-keyvalue-in-a-multidimensional-array-in-php/?ref=rp
            
            // Function to recursively search for a
            // given key=>value 
            function search($array, $key, $value) {
               $results = array();
                  
               // if it is array
               if (is_array($array)) {
                     
                  // if array has required key and value
                  // matched store result 
                  if (isset($array[$key]) && $array[$key] == $value) {
                        $results[] = $array;
                  }
                     
                  // Iterate for each element in array
                  foreach ($array as $subarray) {
                        
                        // recur through each element and append result 
                        $results = array_merge($results, 
                              search($subarray, $key, $value));
                  }
               }
               return $results;
            }
            ?>
            <div class="sub_form">
               <div class="wrapper">
                  <fieldset class="test">
                     <legend>Uw Order</legend>
                     <hr>
                     <?php
                     if (isset($_POST["optieProduct"])) {
                        if (empty($_SESSION["lijst"])) {
                           $_SESSION["lijst"]["Optie " . 0] = $_POST["optieProduct"];
                        } else {
                           $_SESSION["lijst"]["Optie " . count($_SESSION["lijst"])] = $_POST["optieProduct"];
                        }
                     }

                     if (isset($_SESSION["lijst"])) {
                        // Initialize array for counting products
                        $u = array();

                        // Count number of products in the list
                        foreach ($_SESSION["lijst"] as $val) {
                           // The text
                           $var2 = preg_replace('/[0-9]+/', '', $val);
                           // The number
                           $var = filter_var($val, FILTER_SANITIZE_NUMBER_INT);
                           
                           if (!isset($u[$var2]["Count"])) {
                              $u[$var2]["Count"] = 1;
                           } else {
                              $u[$var2]["Count"]++;
                           }
                        }

                        if (!empty($u)) {
                           foreach ($u as $key => $val) {
                              echo "U heeft ".$val["Count"]." ".$key."<br>";
                           }
                        }
                     } else {
                        echo "de session is leeg";
                     }
                     echo "<br>";

                     if (!empty($_SESSION["lijst"])) {
                     ?>
                     <form action="process.php">
                        <button class="send_btn" name="optieSend" value="1" type="submit">Finaliseren</button>
                     </form>
                     <?php
                     }
                     ?>
                  </fieldset>
                  <fieldset class="orderField">
                     <div class="row">
                     <?php
                     $sql = "SELECT id_product, product_naam, product_prijs, stock FROM product p, stock s WHERE p.id_stock = s.id_stock";
                     $result = $conn->query($sql);
                     while($row = $result->fetch_assoc()) {
                        ?>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                           <div id="ho_bo" class="our_products">
                              <div class="product">
                              <figure><img src="images/pro<?php echo $row["product_naam"]; ?>.png" alt="#"/></figure>
                              </div>
                              <?php
                              $res = search($arr, 'id_product', $pID);
                              
                              foreach ($res as $var) {
                                 echo "<h3>".ucfirst($var["product_naam"])."</h3/>"
                                    . "<span>Product info</span><br />"
                                    . "<p>Prijs per: €".$var["product_prijs"]."</p/>"
                                    . "<p>In stock: ".$var["stock"]."</p>";
                                 $pID++;
                              }
                              ?>
                              <form method="post">
                                 <button class="send_btn" name="optieProduct" value="<?php echo $var["product_naam"] . " " . $var["id_product"]; ?>" formtarget="_self">Toevoegen</button>
                              </form>
                           </div>
                        </div>
                     <?php }
                     ?>
                     </div>
                  </fieldset>
                  <div id="breaker"></div>
               </div>
            </div>
         </div>
      </div>
      
      <?php
      $conn->close();
      ?>
      <!-- end our products -->
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
                     <div class="border_top1"></div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <h3>menu LINKS</h3>
                     <ul class="link_menu">
                        <li><a href="#">Thuis Pagina</a></li>
                        <li><a href="about.php">Over ons</a></li>
                        <li><a href="product.php">Onze Producten</a></li>
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