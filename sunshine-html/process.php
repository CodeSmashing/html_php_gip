<?php
ob_start();
session_start();
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
      <title>Verwerken</title>
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
                              <li class="nav-item">
                                 <a class="nav-link" href="stock.php">Stock</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="contact.php">Contact</a>
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
                     <h2>Info</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end banner -->
      <?php
      // Hulp van : https://stackoverflow.com/questions/36240145/how-to-use-serverhttp-referer-correctly-in-php
      // Als de laatste pagina /contact.php is :
      if($_SESSION['lastpage'] == "/html_php_gip/sunshine-html/contact.php")
      {
         echo $_REQUEST["Name"], "<br><br>";
         echo $_REQUEST["Phone"], "<br><br>";
         echo $_REQUEST["Email"], "<br><br>";
         echo $_REQUEST["Message"], "<br><br>";
         $pdo = null;
      } // Als de laatste pagina /login_page.php is; als er nog niet ingelogd is; als er aangeduid werd dat er word geregistreerd :
      else if (($_SESSION['lastpage'] == "/html_php_gip/sunshine-html/login.php") && (!isset($_SESSION["loggedIn"]) == true)) {
         // Hulp van : https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php
         // En : https://www.geeksforgeeks.org/how-to-insert-form-data-into-database-using-php/
         
         // Gebruikersnaam word gedeclareerd voor verder gebruik
         if (isset($_REQUEST["eName"]) === true) {
             $_SESSION["gbr"] = trim($_REQUEST["eName"]);
         } else {
            echo "Volgens ons is er geen gebruikersnaam ingegeven.<br>
            U zal worden herleidt naar de registratie pagina.<br>";
            header("Refresh: 4; url=login_page.php", true, 0);
            exit();
         }
         
         // Paswoord word gedeclareerd voor verder gebruik
         if (isset($_REQUEST["pass"]) === true) {
             $_SESSION["pwd"] = trim($_REQUEST["pass"]);
         } else {
             echo "Volgens ons is er geen paswoord ingegeven.<br>
             U zal worden herleidt naar de registratie pagina.<br>";
             header("Refresh: 4; url=login_page.php", true, 0);
             exit();
         }

         // Als de gebruiker heeft aangeduid dat die wilt registreren (default optie)
         if ($_REQUEST["registreren"] == "1") {
            // Een select statement declareren
            $sql = "SELECT id_gebruiker FROM gebruikers WHERE gebruiker_naam = ?";
            // De select statement voorbereiden
            if ($stmt = $pdo->prepare($sql)) {
               // Variabelen binden aan de voorbereidde select als parameters
               $stmt->bindParam(1, $param_username);

               // Parameters bepalen
               $param_username = trim($_SESSION["gbr"]);

               // Proberen de voorbereidde statement uit te voeren
               if ($stmt->execute()) {
                  // Het resultaat pakken
                  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  // Als het resultaat al één of meerdere keren voorkomt
                  if (!empty($results)) {
                     echo "Deze gebruikersnaam is al in gebruik.<br>
                     U zal worden herleidt naar de vorige pagina.<br>";
                     header("Refresh: 4; url=".$_SESSION['lastpage']."", true, 0);
                     exit();
                  }
               } else {
                  echo "Oops! Iets ging mis met het uitvoeren van het programma, u word terug gestuurd.";
                  header("Refresh: 4; url=".$_SESSION['lastpage']."", true, 0);
                  exit();
               }
            }
            // Statement sluiten
            $stmt->closeCursor();

            // Zien als het paswoord leeg is of niet
            if (empty($_SESSION["pwd"])) {
               echo "U heeft geen passwoord ingegeven.<br>
               U zal worden herleidt naar de vorige pagina.<br>";
               header("Refresh: 4; url=".$_SESSION['lastpage']."", true, 0);
               exit();
            }

            // Zien als er input errors zijn voordat we iets in de database steken
            if (!(empty($_SESSION["pwd"]) && empty($_SESSION["gbr"]))) {   
               // Een insert statement declareren
               $sql = "INSERT INTO gebruikers (gebruiker_naam, gebruiker_pass) VALUES (?, ?)";
               // Een insert statement voorbereiden
               if ($stmt = $pdo->prepare($sql)) {
                  // Variabelen binden aan de voorbereidde insert als parameters
                  $stmt->bindParam(1, $param_username);
                  $stmt->bindParam(2, $param_password);

                  // Parameters declareren
                  $param_username = $_SESSION["gbr"];
                  $param_password = password_hash($_SESSION["pwd"], PASSWORD_DEFAULT); // Creëert een paswoord hash
               
                  // Proberen de voorbereidde statement uit te voeren
                  if ($stmt->execute()) {
                     $_SESSION["loggedIn"] = array(
                        "loggedIn" => true,
                        "user" => $_SESSION["gbr"]
                     );
                     echo "Bedankt om te registreren.<br>
                     U zal worden herleidt naar de home pagina.<br>";
                     header("Refresh: 4; url=index.php", true, 0);
                     exit();
                     
                  } else {
                     echo "Oops! Iets ging fout bij het registreren.<br>
                     U zal worden herleidt naar de vorige pagina.<br>";
                     header("Refresh: 4; url=".$_SESSION['lastpage']."", true, 0);
                     exit();
                  }
               }
               // Statement sluiten
               $stmt->closeCursor();
            } else {
               echo "Oops! Ofwel is er geen paswoord, ofwel geen gebruikersnaam ingegeven.<br>
               U zal worden herleidt naar de vorige pagina.<br>";
               header("Refresh: 4; url=".$_SESSION['lastpage']."", true, 0);
               exit();
            }  
            // Connectie beëindigen
            $pdo = null;

            // Als de gebruiker heeft aangeduid dat die niet wilt registreren
         } else if ($_REQUEST["registreren"] == "2") {
            // Een SELECT statement declareren
            $sql = "SELECT gebruiker_pass FROM gebruikers WHERE gebruiker_naam = ?;";
            
            // De SELECT statement voorbereiden
            if ($stmt = $pdo->prepare($sql)) {
               // Variabelen binden aan de voorbereidde SELECT als 'parameters'
               $stmt->bindParam(1, $param_username);

               // Parameters bepalen
               $param_username = $_SESSION["gbr"];

               // Proberen de voorbereidde statement uit te voeren
               if ($stmt->execute()) {
                  // Als de 'fetch' lukt, bepalen we de te vergelijken met hash
                  $result = $stmt->fetch(PDO::FETCH_ASSOC);
               } else {
                   echo "Oops! Iets ging mis met het controleren van het passwoord, u word terug gestuurd.";
                   header("Refresh: 4; url=login_page.php", true, 0);
                   exit();
               }
            }
            // Statement sluiten
            $stmt->closeCursor();

            // De $_REQUEST["pass"] vergelijken we nu met onze hash
            if (password_verify($_SESSION["pwd"], $result["gebruiker_pass"]) == true) {
               // De gebruiker zijn session word aangeduid als ingelogged en we behouden de naam om hem te herkennen
               $_SESSION["loggedIn"] = array(
                  "loggedIn" => true,
                  "user" => $_SESSION["gbr"]
               );
               echo "Bedankt om in te loggen.<br>";
               ?>
               <div><a class='read_more' href='index.php' role='button'>Home</a></div>
               <?php
            } else {
               echo "Sorry, maar iets ging fout bij de paswoord verificatie.<br>
               U zal worden herleidt naar de vorige pagina.<br>";
               header("Refresh: 4; url=".$_SESSION['lastpage']."", true, 0);
               exit();
            }
            // Connectie beëindigen
            $pdo = null;
            
            // Als de gebruiker heeft aangeduid dat die wilt inloggen als beheerder
         } else if ($_REQUEST["registreren"] == "3") {
            // Een SELECT statement declareren
            $sql = "SELECT * FROM gebruikers WHERE gebruiker_naam = ? AND gebruiker_level = 1";
            // De select statement voorbereiden
            if ($stmt = $pdo->prepare($sql)) {
               // Variabelen binden aan de voorbereidde SELECT als parameters
               $stmt->bindParam(1, $param_username);

               // Parameters bepalen
               $param_username = trim($_SESSION["gbr"]);

               // Proberen de voorbereidde statement uit te voeren
               if ($stmt->execute()) {
                  // Het resultaat pakken
                  $results = $stmt->fetch(PDO::FETCH_ASSOC);
                  // De gebruiker's paswoord hash pakken
                  $hash = $results["gebruiker_pass"];
                  // Deze vergelijken met de ingevulde passwoord
                  if (password_verify($_REQUEST["pass"], $hash)) {
                     $_SESSION["beheerderLoggedIn"] = array(
                       "loggedIn" => true,
                       "user" => $_SESSION["gbr"]
                     );
                     echo "Alles klopt, u zult worden aangemeld als beheerder.<br>
                     U zal worden herleidt naar de home pagina.<br>";
                     header("Refresh: 4; url=index.php", true, 0);
                     exit();
                  } else {
                     echo "Sorry maar dit paswoord is verkeerd, u zal worden herleidt naat de vorige pagina.<br>";
                     header("Refresh: 4; url=".$_SESSION['lastpage']."", true, 0);
                     exit();
                  }
               } else {
                  echo "Oops! Iets ging mis met het uitvoeren van het programma, u word terug gestuurd.";
                  header("Refresh: 4; url=".$_SESSION['lastpage']."", true, 0);
                  exit();
               }
            }
            // Statement sluiten
            $stmt->closeCursor();

            // Connectie beëindigen
            $pdo = null;
         }
      } // Als de laatste pagina /product.php is
      else if ($_SESSION['lastpage'] == "/html_php_gip/sunshine-html/order.php") {
         ?>
         <div class="process">
            <div class="container">
               <div class="row">
                  <div class="col-md-6 offset-md-3">
                     <div class="titlepage">
                        <h2>Onze Producten</h2>
                        <span>
                           U heeft een bestelling aangegeven, maar om deze te kunnen versturen hebben wij een adres nodig.<br><hr>
                           De velden met een * zijn noodzakelijk.
                        </span>
                     </div>
                  </div>
               </div>
            </div>
            <form method="post">
               <input type="text" name="firstname" placeholder="Voornaam*" pattern="[a-zA-Z]+(?:\s+[a-zA-Z]+)*" required></input><br>
               <input type="text" name="lastname" placeholder="Familienaam*" pattern="[a-zA-Z]+(?:\s+[a-zA-Z]+)*" required></input><br><br>

               <input type="email" name="email" placeholder="Email" pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$"></input><br>
               <input type="text" name="streetname" placeholder="Straatnaam*" pattern="[a-zA-Z0-9\s]+" required></input><br>
               <input type="number" name="housenum" placeholder="Huisnummer*" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required></input><br>
               <input type="number" name="areacode" placeholder="Postcode*" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required></input><br><br>

               <button type="submit" name="customerInfo" class="send_btn" formtarget="_self">Bestelling plaatsen</button>
            </form>
         </div>
         <?php
         if (isset($_POST["customerInfo"]) && (isset($_SESSION["loggedIn"]) || isset($_SESSION["beheerderLoggedIn"]))) {
            ?>
            <span>De opgeschreven informatie is compleet, uw bestelling zal worden doorgevoerd.</span><br>
            <?php
            $sql = "SELECT voornaam, achternaam FROM klant WHERE voornaam = ? AND achternaam = ?";
            if ($stmt = $pdo->prepare($sql)) {
               // Variabelen binden aan de voorbereidde SELECT als parameters
               $stmt->bindParam(1, $param_firstname);
               $stmt->bindParam(2, $param_lastname);

               // Parameters bepalen
               $param_firstname = $_POST["firstname"];
               $param_lastname = $_POST["lastname"];

               // Proberen de voorbereidde statement uit te voeren
               if ($stmt->execute()) {
                  // Het resultaat pakken
                  $results = $stmt->fetch(PDO::FETCH_ASSOC);
                  // Deze vergelijken met de ingevulde gegevens
                  if ((empty($results)) || (in_array($param_firstname, $results) || in_array($param_lastname, $results))) {
                     /* Als de ingevulde gegevens niet voorkomen in de database of 
                     als de ingevulde gegevens deels voorkomen in de database */

                     // SELECT logged in user ID
                     $userName = isset($_SESSION["loggedIn"]) ? $_SESSION["loggedIn"]["user"] : (isset($_SESSION["beheerderLoggedIn"]) ? $_SESSION["beheerderLoggedIn"]["user"] : null);
                     $sqlSelectIdUser = "SELECT id_gebruiker FROM gebruikers WHERE gebruiker_naam = ?";
                     $stmt = $pdo->prepare($sqlSelectIdUser);
                     $stmt->execute([$userName]);
                     $IdUser = $stmt->fetchColumn();

                     // INSERT klant adres
                     $sqlInsertAddress = "INSERT INTO adres (straat, nummer) VALUES (?, ?)";
                     $stmt = $pdo->prepare($sqlInsertAddress);
                     $stmt->execute([$_POST["streetname"], $_POST["housenum"]]);
                     
                     // INSERT klant
                     $sqlInsertCustomer = "INSERT INTO klant (id_gebruiker, voornaam, achternaam, email) VALUES (?, ?, ?, ?)";
                     $stmt = $pdo->prepare($sqlInsertCustomer);
                     $stmt->execute([$IdUser, $_POST["firstname"], $_POST["lastname"], $_POST["email"]]);

                     // SELECT klant ID
                     $sqlSelectIdCustomer = "SELECT id_klant FROM klant k WHERE voornaam = ? AND achternaam = ?";
                     $stmt = $pdo->prepare($sqlSelectIdCustomer);
                     $stmt->execute([$_POST["firstname"], $_POST["lastname"]]);
                     $IdCustomer = $stmt->fetchColumn();

                     // INSERT bestelling
                     $sqlInsertOrder = "INSERT INTO bestelling (producten, id_klant) VALUES (?, ?)";
                     $products = array();
                     foreach ($_SESSION["cart"] as $product_name => $product) {
                        array_push($products, $product_name . "x" . $product["quantity"]);
                     }
                     $newproducts = implode(", ", $products);
                     $stmt = $pdo->prepare($sqlInsertOrder);
                     $stmt->execute([$newproducts, $IdCustomer]);

                     // SELECT relevante adres- en bestelling ID's (relevant voor nieuw klant)
                     $sqlSelectIdAddress = "SELECT id_adres FROM adres a WHERE straat = ? AND nummer = ?";
                     $stmt = $pdo->prepare($sqlSelectIdAddress);
                     $stmt->execute([$_POST["streetname"], $_POST["housenum"]]);
                     $IdAddress = $stmt->fetchColumn();

                     $sqlSelectIdOrder = "SELECT id_bestelling FROM bestelling WHERE id_klant = ?";
                     $stmt = $pdo->prepare($sqlSelectIdOrder);
                     $stmt->execute([$IdCustomer]);
                     $IdOrder = $stmt->fetchColumn();
                     
                     // UPDATE klant met adres- en bestelling ID's
                     $sqlUpdateCustomer = "UPDATE klant SET id_adres = ?, id_bestelling = ? WHERE id_klant = ?";
                     $stmt = $pdo->prepare($sqlUpdateCustomer);
                     $stmt->execute([$IdAddress, $IdOrder, $IdCustomer]);

                     // UPDATE gebruiker met klant ID
                     $sqlUpdateUser = "UPDATE gebruikers SET id_klant = ? WHERE id_gebruiker = ?";
                     $stmt = $pdo->prepare($sqlUpdateUser);
                     $stmt->execute([$IdCustomer, $IdUser]);
                  } else if (in_array($param_firstname, $results) && in_array($param_lastname, $results)) {
                     // Als de ingevulde gegevens exact voorkomen in de database

                     // SELECT klant ID
                     $sqlSelectIdCustomer = "SELECT id_klant FROM klant WHERE voornaam = ? AND achternaam = ?";
                     $stmt = $pdo->prepare($sqlSelectIdCustomer);
                     $stmt->execute([$_POST["firstname"], $_POST["lastname"]]);
                     $IdCustomer = $stmt->fetchColumn();

                     // SELECT klant bestelling
                     $sqlSelectOrder = "SELECT producten FROM bestelling WHERE id_klant = ?";
                     $stmt = $pdo->prepare($sqlSelectOrder);
                     $stmt->execute([$IdCustomer]);
                     $CustomerOrder = $stmt->fetch(PDO::FETCH_ASSOC);

                     // Explode de bestelling tweemaal om nieuwe producten/aantallen toe te voegen
                     $CustomerOrderOld = explode(", ", $CustomerOrder["producten"]);
                     $CustomerOrderNew = array();

                     foreach ($CustomerOrderOld as $product) {
                        $parts = explode("x", $product);
                        $product_name = $parts[0];
                        $product_quantity = $parts[1];
                        $CustomerOrderNew[$product_name] = $product_quantity;
                     }
                     
                     // Nieuwe producten/aantallen toevoegen
                     foreach ($_SESSION["cart"] as $product_name => $product) {
                        if (array_key_exists($product_name, $CustomerOrderNew)) {
                           $CustomerOrderNew[$product_name] += $product["quantity"];
                        } else {
                           $CustomerOrderNew[$product_name] = $product["quantity"];
                        }
                     }
                     
                     // UPDATE bestelling
                     $sqlUpdateOrder = "UPDATE bestelling SET producten = ? WHERE id_klant = ?";
                     $products = array();
                     foreach ($CustomerOrderNew as $product_name => $product_quantity) {
                        array_push($products, $product_name . "x" . $product_quantity);
                     }
                     $newproducts = implode(", ", $products);
                     $stmt = $pdo->prepare($sqlUpdateOrder);
                     $stmt->execute([$newproducts, $IdCustomer]);
                  } else {
                     echo "I'm a test.<br>";
                  }
               } else {
                  echo "Oops! Iets ging mis met het uitvoeren van het programma, u word terug gestuurd.";
                  header("Refresh: 4; url=".$_SESSION['lastpage']."", true, 0);
                  exit();
               }
            }

            // Subtract items in cart from stock
            /*
            foreach ($_SESSION["cart"] as $product_name => $product) {
               $product_quantity = $product["quantity"];
               $sql = "UPDATE product a, stock s SET stock = stock - :quantity WHERE product_naam = :productName AND a.id_stock = s.id_stock";
               $stmt = $pdo->prepare($sql);
               $stmt->execute(['quantity' => $product_quantity, 'productName' => $product_name]);
            } ?>
            */
            ?>

            <span>Bedankt om een bestelling te plaatsen.</span><br>
            <span>Deze zal na enige tijd verwerkt en doorgestuurd worden naar het opgegeven adres.</span>

            <?php
            // Clear cart and redirect to home page
            /*
            unset($_SESSION["cart"]);
            echo "U zal worden herleidt naar de home pagina";
            header("Refresh: 4; url=index.php", true, 0);
            exit();
            */
         }
         // Connectie beëindigen
         $pdo = null;
      } else if ($_SESSION['lastpage'] == "/html_php_gip/sunshine-html/stock.php") {
         foreach ($_POST['product'] as $productId => $values) {
            echo "Product id: ". $productId ." | New price: ".$values['price']." | New stock: ". $values['stock'] ."<br>";
            if ($values['price'] != NULL) {
               $sql = "UPDATE product SET product_prijs = ".$values['price']." WHERE id_product = $productId";
               $result = $pdo->query($sql);
            }
            if ($values['stock'] != NULL) {
               $sql = "UPDATE stock SET stock = ".$values['stock']." WHERE id_stock = $productId";
               $result = $pdo->query($sql);
            }
         }
         unset($_POST['product']);
         $pdo = null;
      } // Als de laatste pagina niet /login_page.php is :
      else {
         // From https://stackoverflow.com/questions/768431/how-do-i-make-a-redirect-in-php?page=1&tab=scoredesc#tab-top
         // User Hammad Khan
         // Learn output buffering dammit: https://stackoverflow.com/questions/2832010/what-is-output-buffering
         // http://web.archive.org/web/20101216035343/http://dev-tips.com/featured/output-buffering-for-web-developers-a-beginners-guide

         echo "Sorry, maar u komt van een pagina waarvoor we nog geen data kunnen processeren.<br>
         U zal worden terug gestuur naar de vorige pagina.";
         $pdo = null;
         header("Refresh: 4; url=".$_SESSION['lastpage']."", true, 0);
         exit();
      }
      ?>
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
                        <li><a href="about.php">Over Ons</a></li>
                        <li><a href="order.php">Bestel</a></li>
                        <li><a href="products.php">Products</a></li>
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
<?php ob_end_flush(); ?>