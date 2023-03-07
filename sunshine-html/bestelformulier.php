<?php
session_start();
$_SESSION['lastpage'] = $_SERVER['REQUEST_URI'];
function UnsetLogin()
{
   unset($_SESSION["loggedIn"]); 
}
if (empty($_POST["logout"]) != true) {
   UnsetLogin();
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
      <title>Bestelformulier</title>
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
      <style>
         *{
            box-sizing: border-box;
            margin: 0;
         }
         .wrapper{
            margin: auto;
            width: 100%;
            max-width: 1000px;
            padding:80px;
            background-color: hsla(455,75%,20%,0.05);
         }
         fieldset{
            float: left;
            width: 33%;
            display: inline-block;
            box-sizing: border-box;
         }
         fieldset input{
            width: 80%;
         }
         .wrapper #breaker{
            clear: both;
         }
      </style>
   </head>
   <!-- body -->
   <body class="main-layout inner_page">
      <!-- loader  --><!--
      <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="#"/></div>
      </div>
         --><!-- end loader -->
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
                              <a href="index.html"><img src="images/logo.png" alt="#" /></a>
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
                                    <a class="nav-link" href="index.php">Home</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="about.php">About</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="product.php">Our Product</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="galerij.php">Galerij</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="stock.php">Stock</a>
                                 </li>
                                 <li class="nav-item active">
                                    <a class="nav-link" href="bestelformulier.php">Bestelformulier</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="contact.php">Contacteer Ons</a>
                                 </li>
                                 <li class="nav-item">
                                    <?php
                                    if (empty($_SESSION["loggedIn"]) == true || $_SESSION["loggedIn"] != true) { ?>
                                       <a class="nav-link" href="login_page.php">Login</a>
                                       <?php
                                    } else { ?>
                                       <form method="post">
                                       <button class="nav-link" name="logout" type="submit" value="1"
                                       formtarget="_self" onclick="UnsetLogin()">Logout</button>
                                       </form>
                                       <?php
                                    }
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
         <!-- end header -->
         <!-- banner -->
      
      </header>
      <!-- end banner -->
      <div class="back_re">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="title">
                        <h2>Bestellen</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--  bestelformulier
      class="order"
      class="col-md-12" -->
      <div>
         <div class="sub_form">
            <div class="wrapper">
               <fieldset>
                  <legend>Producten lijst</legend>
                  <hr>
                  <?php
                  // Connectie creëeren
                  $conn = new mysqli("localhost", "root", "", "gip"); 
                  // Connectie checken
                  if ($conn->connect_errno) {
                     die("Connectie mislukt: " . $conn->connect_error);
                  }

                  $result = $conn->query("SELECT product_naam, product_prijs FROM product");
                  echo '<ul class="link_menu">';
                  while ($row = $result->fetch_assoc()) {
                     unset($name);
                     unset($price);
                     $name = ucfirst($row["product_naam"]);
                     $price = $row["product_prijs"];
                     echo '<li class="">'.$name.' € '.$price.'</li><br>';
                  }
                  echo '</ul>';
                  $conn->close();
                  ?>
               </fieldset>
               <form method="post" id="request">
               <fieldset>
                  <legend>Een order plaatsen</legend>
                  <hr>
                  <?php
                  // Connectie creëeren
                  $conn = new mysqli("localhost", "root", "", "gip"); 
                  // Connectie checken
                  if ($conn->connect_errno) {
                        die("Connectie mislukt: " . $conn->connect_error);
                  }
                  
                  $result = $conn->query("SELECT product_naam FROM product");
                  
                  $j = 0;
                  while ($row = $result->fetch_assoc()) {
                     $resultArray[$j] = $row["product_naam"];
                     $j++;
                     print_r($row);
                  }
                  print_r($resultArray);
                  /*
                  foreach ($result as $arr) {
                     $resultArray[$j] = $result->fetch_assoc();
                     $j++;
                  }
                  */
                  $result = $conn->query("SELECT product_naam FROM product");
                  echo '<select class="orderUs" name="productLijst" id="productLijst" onchange="selection()">';
                  echo '<option value="" selected disabled hidden>Kies hier</option>';
                  while ($row = $result->fetch_assoc()) {
                     unset($name);
                     $name = ucfirst($row["product_naam"]);
                     echo '<option value="'.$name.'">'.$name.'</option>';
                  }
                  echo '</select>';
                  if (empty($_COOKIE["gekozenProduct"]) != true) {
                        $gekozenProduct = $_COOKIE["gekozenProduct"];
                        $result = $conn->query("SELECT product_prijs FROM product WHERE product_naam = '".mysqli_real_escape_string($conn, $gekozenProduct)."'");
                  }

                  while($row = $result->fetch_assoc()) {
                        $_COOKIE["price"] = $row["product_prijs"];
                  }
                  $conn->close();
                  // if (empty($_COOKIE["price"]) != true) { echo $_COOKIE["price"]; }
                  ?>
                  <div>
                     <input class="orderUs" placeholder="Aantal" type="number" id="aantal" name="aantal" value="" min="1" max="300" step="1"><br>
                  </div>
                  <div>
                     <button class="send_btn" type="button" onclick="AddInput()">+1</button>
                     <button class="send_btn" type="submit" formtarget="_self">Finaliseren</button>
                  </div>
               </fieldset>
               </form>
               <fieldset>
                  <legend>Uw order</legend>
                  <hr>
               </fieldset>
               <fieldset>
                  <legend>Al de variabelen</legend>
                  <hr>
                  <?php
                  if (empty($_COOKIE["gekozenProduct"]) != true) {
                     echo "Het geselecteerde product zou " . $_COOKIE["gekozenProduct"] . " moeten zijn.<br>";
                  } else {
                     echo "We konden het geselecteerde product niet aflezen.<br>";
                  }

                  if (empty($_COOKIE["price"]) != true) {
                     echo "De prijs zou " . $_COOKIE["price"] . " moeten zijn.<br>";
                  } else {
                     echo "We konden de prijs van het geselecteerde product niet aflezen.<br>";
                  }
                  print_r($resultArray);
                  ?>
               </fieldset>
               <div id="breaker"></div>
            </div>
         </div>
      </div>
      <!-- end bestelformulier -->
      <footer>
         <div class="footer">
            <div class="container">
               <div class="row">
                  <div class="col-md-8 offset-md-2">
                     <div class="newslatter">
                        <h4>Subscribe Our Newsletter</h4>
                        <form class="bottom_form">
                           <input class="enter" placeholder="Enter your email" type="text" name="Enter your email">
                           <button class="sub_btn">subscribe</button>
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
                        <li><a href="#">Home</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="product.php">Ons Product</a></li>
                        <li><a href="galerij.php">Galerij</a></li>
                        <li><a href="bestelformulier.php">Bestelformulier</a></li>
                        <li><a href="stock.php">Stock</a></li>
                        <li><a href="contact.php">Contacteer Ons</a></li>
                     </ul>
                  </div>
                  <div class=" col-md-3">
                     <h3>TOP food</h3>
                     <p class="many">
                        There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected
                     </p>
                  </div>
                  <div class="col-lg-3 offset-mdlg-2     col-md-4 offset-md-1">
                     <h3>Contact </h3>
                     <ul class="conta">
                        <li><i class="fa fa-map-marker" aria-hidden="true"></i> Location</li>
                        <li> <i class="fa fa-envelope" aria-hidden="true"></i><a href="#"> demo@gmail.com</a></li>
                        <li><i class="fa fa-mobile" aria-hidden="true"></i> Call : +01 1234567890</li>
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
      <script>
            function selectionnnnn() {
            var x = document.getElementById("product").value;
            document.cookie = "gekozenProduct = " + x;
            }
      </script>
      <script>
         // Holy fucking shit is dit cool
         // https://stackoverflow.com/questions/10418518/when-all-previous-fields-are-filled-add-new-input-field
         // http://jsfiddle.net/F8qR2/
         // http://jsfiddle.net/puVPc/
         function AddInput() {
            var passedArray = <?php echo json_encode($resultArray); ?>;
            
            alert(passedArray);
            
            var cnt = $("select", $("#request")).size() + 1;
            $("<hr><select class='orderUs' name='productLijst" + cnt + "' id='productLijst" + cnt + "' onchange='selection()'> <option value='' selected disabled hidden>Kies hier</option> <option value=''>Test</option>" +
            /*
               while(var i = 0; i < passedArray.length; i++)
               {
                  "<option value=''>" + passedArray[i] + "</option>";
               }
            */
            + "</select>").insertAfter("#request input[type='number']:last");
            $("input", $("#request")).unbind("keyup").bind("keyup", function(){ AdditionEvent() });

            var cnt2 = $("input[type='number']", $("#request")).size() + 1;
            $("<div><input class='orderUs' placeholder='AantalV" + cnt2 + "' type='number' name='aantalV" + cnt + "' id='aantalV" + cnt2 + "' value='' min='1' max='300' step='1'/></div>").insertAfter("#request select:last");
            $("input", $("#request")).unbind("keyup").bind("keyup", function(){ AdditionEvent() });
         }
         
         function AddInput() {
            console.log("adding inputs")
            var passedArray = <?php echo json_encode($resultArray); ?>;
            
            let select = document.createElement("SELECT")

            console.log(passedArray)
            for(let i = 0; i < passedArray.length; i++) {
               console.log(passedArray[i])
            }
            let i = 0;
            
            // alert(passedArray);
            
            
         }
      </script>
   </body>
</html>