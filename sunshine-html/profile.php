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
   <title>Profielpagina</title>
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
   <!--
      [if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]
   -->

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
                              '<li class="nav-item active"><a class="nav-link" href="profile.php">Profiel</a></li>
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
   </header>
   <!-- end header -->
   <!-- banner -->
   <div class="back_re">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="title">
                  <h2>Uw profielpagina</h2>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end banner -->
   <!-- profile -->
   <div class="profile">
      <div class="container">
         <div class="row">
            <div class="col-md-6 offset-md-3">
               <div class="titlepage">
                  <span>
                     Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor
                     invidunt ut labore et dolore magna aliquyam erat, sed diam voluptu
                  </span>
               </div>
            </div>
            <?php
            // SELECT logged in user name
            $logged_user_name = isset($_SESSION['loggedIn']['user']) ? $_SESSION['loggedIn']['user'] : (isset($_SESSION['beheerderLoggedIn']['user']) ? $_SESSION['beheerderLoggedIn']['user'] : null);
            if ($logged_user_name == null) {
               echo 'Dit zou niet mogen gebeuren.';
               echo 'U zal worden herleidt naar de thuis pagina';
               header('Refresh: 4; url=index.php', true, 0);
               exit();
            } else {
               // SELECT gebruiker en klant ID's
               $sqlSelectIdsUser = 'SELECT id_gebruiker, id_klant FROM gebruikers WHERE gebruiker_naam = ?';
               $stmt = $pdo->prepare($sqlSelectIdsUser);
               $stmt->execute([$logged_user_name]);
               $IdsUser = $stmt->fetch(PDO::FETCH_ASSOC);
            }


            if (isset($_POST['editFinish'])) {
               unset($_POST['edit']);
               unset($_POST['editFinish']);
               // All de form input veranderen naar variabelen
               $user_name = $_POST['gebruiker_naam'];

               // SELECT de ingegeven gebruiker naam als deze voorkomt
               $sqlSelectUserName = 'SELECT gebruiker_naam FROM gebruikers WHERE gebruiker_naam = ?';
               $stmt = $pdo->prepare($sqlSelectUserName);
               $stmt->execute([$user_name]);
               $result = $stmt->fetch(PDO::FETCH_ASSOC);
               if (isset($result)) {
                  $user_name = null;
               }

               $customerFields = array('voornaam', 'achternaam', 'email', 'geboortedatum');
               $addressFields = array('postcode', 'straat', 'nummer');
               $customerCount = implode(', ', array_fill(0, count($customerFields) + 1, '?'));
               $addressCount = implode(', ', array_fill(0, count($addressFields) + 1, '?'));
               $customerValues = array();
               $addressValues = array();

               // Specifiek klant INSERT klaar zetten
               foreach ($customerFields as $field) {
                  if (isset($_POST[$field])) {
                     $customerValues[] = $_POST[$field];
                  }
               }
               // Specifiek adres INSERT klaar zetten
               foreach ($addressFields as $field) {
                  if (isset($_POST[$field])) {
                     $addressValues[] = $_POST[$field];
                  }
               }

               // We gaan eerst zien als de klant al dan niet bestaat
               if (!isset($IdsUser['id_klant']) || $IdsUser['id_klant'] == 0) {
                  // Als de gebruiker geen klant is:
                  // INSERT nieuwe klant
                  $sqlInsertCustomer = 'INSERT INTO klant (id_gebruiker, voornaam, achternaam, email, geboortedatum) VALUES (' . $customerCount . ')';
                  $stmt = $pdo->prepare($sqlInsertCustomer);

                  // De logged in gebruiker ID en de klant INSERT info samenbrengen
                  $values = array_merge(array($IdsUser['id_gebruiker']), $customerValues);
                  $stmt->execute($values);

                  // SELECT de nieuwe klant ID
                  $sqlSelectIdCustomer = 'SELECT id_klant FROM klant WHERE id_gebruiker = ?';
                  $stmt = $pdo->prepare($sqlSelectIdCustomer);
                  $stmt->execute([$IdsUser['id_gebruiker']]);
                  $IdCustomer = $stmt->fetch(PDO::FETCH_ASSOC)['id_klant'];

                  // UPDATE gebruiker met nieuwe klant ID
                  $sqlUpdateUser = 'UPDATE gebruikers SET id_klant = ? WHERE id_gebruiker = ?';
                  $stmt = $pdo->prepare($sqlUpdateUser);
                  $stmt->execute([$IdCustomer, $IdsUser['id_gebruiker']]);

                  // INSERT nieuw adres die we koppelen aan de klant
                  $sqlInsertAddress = 'INSERT INTO adres (id_klant, postcode, straat, nummer) VALUES (' . $addressCount . ')';
                  $stmt = $pdo->prepare($sqlInsertAddress);
                  // De logged in gebruiker ID en de adres INSERT info samenbrengen
                  $values = array_merge(array($IdCustomer), $addressValues);
                  $stmt->execute($values);

                  // SELECT de nieuwe adres ID
                  $sqlSelectIdCustomer = 'SELECT id_adres FROM adres WHERE id_klant = ?';
                  $stmt = $pdo->prepare($sqlSelectIdCustomer);
                  $stmt->execute([$IdCustomer]);
                  $IdAdres = $stmt->fetch(PDO::FETCH_ASSOC);

                  // UPDATE de klant met de nieuwe adres ID
                  $sqlUpdateUser = 'UPDATE klant SET id_adres = ? WHERE id_gebruiker = ?';
                  $stmt = $pdo->prepare($sqlUpdateUser);
                  $stmt->execute([$IdAdres['id_adres'], $IdsUser['id_gebruiker']]);
               } else {
                  // Als de gebruiker wel al een klant is:
                  // UPDATE gebruiker met nieuwe gebruiker info
                  if (isset($user_name) && $user_name != null) {
                     $sqlUpdateUser = 'UPDATE gebruikers SET gebruiker_naam = ? WHERE gebruiker_naam = ?';
                     $stmt = $pdo->prepare($sqlUpdateUser);
                     $stmt->execute([$user_name, $logged_user_name]);

                     if (isset($_SESSION['loggedIn'])) {
                        $_SESSION['loggedIn']['user'] = $user_name;
                     } else if (isset($_SESSION['beheerderLoggedIn'])) {
                        $_SESSION['beheerderLoggedIn']['user'] = $user_name;
                     }
                  }
                  /** else if ($user_name == null) {
                     echo '<span>De ingegeven gebruikersnaam is al in gebruik<span><br>';
                  } */
                  unset($user_name);


                  /**
                  // INSERT nieuwe klant
                  $sqlInsertCustomer = "INSERT INTO klant (id_gebruiker, voornaam, achternaam, email, geboortedatum) VALUES ($insertCustomerCount)";
                  $stmt = $pdo->prepare($sqlInsertCustomer);
                  // De logged in gebruiker ID en de klant INSERT info samenbrengen
                  $customerValues = array_merge(array($IdsUser["id_gebruiker"]), $insertCustomerValues);
                  $stmt->execute($customerValues);
                   */


                  // UPDATE klant met nieuwe klant info
                  $sqlUpdateCustomer = 'UPDATE klant SET voornaam = ?, achternaam = ?, email = ?, geboortedatum = ? WHERE id_gebruiker = ?';
                  $stmt = $pdo->prepare($sqlUpdateCustomer);
                  $values = array_merge($customerValues, array($IdsUser['id_gebruiker']));
                  $stmt->execute($values);

                  // SELECT adres info
                  $sqlSelectAddress = 'SELECT * FROM adres WHERE id_klant = ?';
                  $stmt = $pdo->prepare($sqlSelectAddress);
                  $stmt->execute([$IdsUser['id_klant']]);
                  $addressInfo = $stmt->fetch(PDO::FETCH_ASSOC);

                  if (empty($addressInfo)) {
                     // INSERT nieuw adres die we koppelen aan de klant
                     $sqlInsertAddress = 'INSERT INTO adres (id_klant, postcode, straat, nummer) VALUES (' . $addressCount . ')';
                     $stmt = $pdo->prepare($sqlInsertAddress);
                     // De logged in gebruiker klant ID en de adres INSERT info samenbrengen
                     $values = array_merge(array($IdsUser['id_klant']), $addressValues);
                     $stmt->execute($values);

                     // SELECT de nieuwe adres ID
                     $sqlSelectIdCustomer = 'SELECT id_adres FROM adres WHERE id_klant = ?';
                     $stmt = $pdo->prepare($sqlSelectIdCustomer);
                     $stmt->execute([$IdsUser['id_klant']]);
                     $IdAdres = $stmt->fetch(PDO::FETCH_ASSOC);

                     // UPDATE de klant met de nieuwe adres ID
                     $sqlUpdateUser = 'UPDATE klant SET id_adres = ? WHERE id_klant = ?';
                     $stmt = $pdo->prepare($sqlUpdateUser);
                     $stmt->execute([$IdAdres['id_adres'], $IdsUser['id_klant']]);
                  } else {
                     // UPDATE adres met nieuwe adres info
                     $sqlUpdateAdres = 'UPDATE adres SET postcode = ?, straat = ?, nummer = ? WHERE id_klant = ?';
                     $stmt = $pdo->prepare($sqlUpdateAdres);
                     $values = array_merge($addressValues, array($IdsUser['id_klant']));
                     $stmt->execute($values);
                  }
               }
            }
            if (!isset($_POST['edit'])) {
               $logged_user_name = isset($_SESSION['loggedIn']['user']) ? $_SESSION['loggedIn']['user'] : (isset($_SESSION['beheerderLoggedIn']['user']) ? $_SESSION['beheerderLoggedIn']['user'] : null);
               $sql = 'SELECT email, gebruiker_naam, voornaam, achternaam, geboortedatum, created_at, straat, nummer, postcode, producten, datum_handeling FROM gebruikers g, klant k, adres a, bestelling b WHERE g.gebruiker_naam = ? AND k.id_gebruiker = g.id_gebruiker AND k.id_adres = a.id_adres AND k.id_bestelling = b.id_bestelling';
               $stmt = $pdo->prepare($sql);
               $stmt->execute([$logged_user_name]);
               $results = $stmt->fetch(PDO::FETCH_ASSOC);
               if (empty($results)) {
                  $sql = 'SELECT email, gebruiker_naam, voornaam, achternaam, geboortedatum, created_at, straat, nummer, postcode FROM gebruikers g, klant k, adres a WHERE g.gebruiker_naam = ? AND k.id_gebruiker = g.id_gebruiker AND k.id_adres = a.id_adres';
                  $stmt = $pdo->prepare($sql);
                  $stmt->execute([$logged_user_name]);
                  $results = $stmt->fetch(PDO::FETCH_ASSOC);
                  if (empty($results)) {
                     $sql = 'SELECT gebruiker_naam, created_at FROM gebruikers WHERE gebruiker_naam = ?';
                     $stmt = $pdo->prepare($sql);
                     $stmt->execute([$logged_user_name]);
                     $results = $stmt->fetch(PDO::FETCH_ASSOC);
                  }
               } ?>
               <div class='fieldset-container'>
                  <fieldset class='userOrder'>
                     <legend>Uw info</legend>
                     <div class='seperator'></div>
                     <figure><img src='images/profile_icon.png' alt='#'></figure><br>
                     <span>Lopende bestelling:</span><br>
                     <?php
                     // SELECT bestelling
                     $sqlSelectOrder = 'SELECT producten FROM bestelling WHERE id_klant = ?';
                     $stmt = $pdo->prepare($sqlSelectOrder);
                     $stmt->execute([$IdsUser['id_klant']]);
                     $CustomerOrder = $stmt->fetch(PDO::FETCH_ASSOC);

                     // Verwijder product van bestelling als aangegeven
                     if (isset($_POST['remove_from_cart'])) {
                        $post_product_name = $_POST['product_name'];
                        // UPDATE bestelling
                        $sqlUpdateOrder = 'UPDATE bestelling SET producten = ? WHERE id_klant = ?';
                        $products = array();
                        foreach ($CustomerOrder as $product) {
                           $parts = explode('x', $product);
                           $product_name = $parts[0];
                           $product_quantity = $parts[1];
                           $product_price = $parts[2];
                           if ($post_product_name != $product_name) {
                              array_push($products, $product_name . 'x' . $product_quantity . 'x' . $product_price);
                           }
                        }
                        $newproducts = implode(', ', $products);
                        $stmt = $pdo->prepare($sqlUpdateOrder);
                        $stmt->execute([$newproducts, $IdsUser['id_klant']]);

                        unset($_POST['remove_from_cart']);
                        unset($_POST['product_name']);
                        unset($CustomerOrder);
                        unset($_SESSION['cart']);
                     }

                     // Bestelling(en) tonen
                     if (!empty($CustomerOrder['producten'])) {
                        // Explode de bestelling tweemaal om weer te geven
                        $CustomerOrderOld = explode(', ', $CustomerOrder['producten']);
                        $CustomerOrderNew = array();
                        $total_price = 0;

                        echo '<ul>';
                        foreach ($CustomerOrderOld as $product) {
                           $parts = explode('x', $product);
                           $product_name = $parts[0];
                           $product_quantity = $parts[1];
                           $product_price = $parts[2];
                           $product_total_price = $product_price * $product_quantity;
                           $total_price += $product_total_price;
                           echo '<li>' . $product_name . ' x ' . $product_quantity . ' = €' . $product_total_price . ' <form method="post"><input type="hidden" name="product_name" value="' . $product_name . '"><button class="remove_btn" name="remove_from_cart" type="submit">Remove</button></form></li>';
                        }
                        echo '</ul>'; ?>
                        <br><span>Uw totaal komt uit tot: € <?php echo $total_price; ?></span>
                     <?php
                     } else {
                        echo '<p>Uw winkelmandje is leeg</p>';
                     }
                     ?>
                  </fieldset>

                  <fieldset class='userSkel'>
                     <div class='seperator'></div>
                     <span>Gebruikersnaam: </span><br>
                     <span>Voornaam: </span><br>
                     <span>Achternaam: </span><br>
                     <span>Email: </span><br>
                     <span>Leeftijd: </span><br>
                     <span>Adres: </span><br>
                     <span>Account gecreêrd op: </span><br>
                     <form method='post'>
                        <button class='send_btn' name='edit' type='submit' value='1' formtarget='_self'>Aanpassen</button>
                     </form>
                  </fieldset>

                  <fieldset class='userInfo'>
                     <div class='seperator'></div>
                     <?php
                     echo $results['gebruiker_naam'] . '<br>';
                     echo (count($results) > 2) ? (isset($results['voornaam']) ? $results['voornaam'] . '<br>' : 'Onbekend<br>') : 'Onbekend<br>';
                     echo (count($results) > 2) ? (isset($results['achternaam']) ? $results['achternaam'] . '<br>' : 'Onbekend<br>') : 'Onbekend<br>';
                     echo (count($results) > 2) ? (isset($results['email']) ? $results['email'] . '<br>' : 'Onbekend<br>') : 'Onbekend<br>';
                     $currentDate = date('Y-m-d');
                     $diff = (count($results) > 2) ? (isset($results['geboortedatum']) ? date_diff(date_create($results['geboortedatum']), date_create($currentDate)) : 'Onbekend') : 'Onbekend';
                     echo ($diff != 'Onbekend') ? $diff->format('%y') . ' Jaar<br>' : $diff . '<br>';

                     $list = array();
                     (count($results) > 2) ? (isset($results['straat']) ? (isset($results['nummer']) ? (isset($results['postcode']) ? ($list[0] = $results['straat'] and $list[1] = ' ' . $results['nummer'] and $list[2] = ' ' . $results['postcode']) : null) : ($list[0] = $results['straat'] and $list[1] = ' ' . $results['nummer'])) : $list[0] = $results['straat']) : 'Onbekend<br>';

                     foreach ($list as $item) {
                        echo $item;
                     }
                     echo '<br>';
                     echo $results['created_at'] . '<br>';
                     ?>
                  </fieldset>
               </div>
            <?php
            } else {
            ?>
               <fieldset class='userInfo'>
                  <legend>Uw info</legend>
                  <hr>
                  <form method='post'>
                     <span>Gebruikersnaam: </span><input type="text" name="gebruiker_naam"><br>
                     <span>Voornaam*: </span><input type="text" name="voornaam" required><br>
                     <span>Achternaam*: </span><input type="text" name="achternaam" required><br>
                     <span>Email*: </span><input type="email" name="email" required><br>
                     <span>Geboortedatum: </span><input type="date" name="geboortedatum"><br><br>
                     <hr>
                     <span>Adres</span><br>
                     <span>Straatnaam*: </span><input type="text" name="straat" required><br>
                     <span>Huisnummer*: </span><input type="number" name="nummer" required><br>
                     <span>Postcode: </span><input type="number" name="postcode"><br>

                     <button class='send_btn' name='editFinish' type='submit' value='1' formtarget='_self'>Beïndigen</button>
                  </form>
               </fieldset>
            <?php
            }
            ?>
         </div>
      </div>
   </div>
   <!-- end profile -->
   <!-- footer -->
   <footer>
      <div class="footer">
         <div class="container">
            <div class="row">
               <div class="col-md-8 offset-md-2">
                  <div class="newslatter">
                     <h4>Abboneer Aan Onze Nieuwsbrief</h4>
                     <form class="bottom_form">
                        <input class="enter" placeholder="Typ uw emailaddres" type="text" name="Typ uw emailaddres">
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
                     <li><a href="products.php">Producten</a></li>
                     <li><a href="contact.php">Contacteer Ons</a></li>
                  </ul>
               </div>
               <div class="col-md-3">
                  <h3>TOP voedsel</h3>
                  <p class="many">
                     There are many variations of passages of Lorem Ipsum available, but the majority have
                     suffered alteration in some form, by injected
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
                     <p>© 2019 All Rights Reserved. Design by <a href="https://html.design/"> Free Html
                           Templates</a></p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </footer>
   <!-- end footer -->
   <!-- Javascript files-->
   <script src="js/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
   </script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
   </script>
   <!-- sidebar -->
   <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
   <script src="js/custom.js"></script>
</body>

</html>