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
   </header>
   <!-- end header -->
   <!-- profile -->
   <div class="profile">
      <div class="container">
         <div class="row">
            <div class="col-md-6 offset-md-3">
               <div class="titlepage">
                  <span>
                     Hier kunt u uw gebruikers en klanten info zien zoals uw gebruikersnaam of uw opgegeven naam.
                     U kunt hier ook uw lopende bestelling zien.
                  </span>
               </div>
            </div>
            <?php
            // SELECT logged in user name
            $logged_user_name = isset($_SESSION['logged_in']['user']) ? $_SESSION['logged_in']['user'] : (isset($_SESSION['admin_logged_in']['user']) ? $_SESSION['admin_logged_in']['user'] : null);
            // If there isn't a set username this should mean there isn't logged in yet, if that's the case we send the user to the home page
            if ($logged_user_name == null) {
               // Fix from: https://stackoverflow.com/questions/27123470/redirect-in-php-without-use-of-header-method
               echo 'Dit zou niet mogen gebeuren.<br>
               U zal worden herleidt naar de thuis pagina';

               echo '<meta http-equiv="refresh" content="0; URL=http://localhost/html_php_gip/sunshine-html/index.php">';
            } else {
               // SELECT user and customer ID's
               $ids_user = sql_select_ids_user($pdo, $logged_user_name);
            }

            // If the user has sent the POST 'edit_finish' from the form where they can edit their information we update their information accordingly
            if (isset($_POST['edit_finish'])) {
               unset($_POST['edit']);
               unset($_POST['edit_finish']);

               // SELECT the POST username from the database
               $result = sql_select_user_username($pdo);
               if (isset($result)) {
                  $user_name = null;
               }

               // Change the form input into two array variables
               $customer_fields = array('voornaam', 'achternaam', 'email', 'geboortedatum');
               $address_fields = array('postcode', 'straat', 'nummer');
               $customer_count = implode(', ', array_fill(0, count($customer_fields) + 1, '?'));
               $address_count = implode(', ', array_fill(0, count($address_fields) + 1, '?'));
               $customer_values = array();
               $address_values = array();

               // Specifically prepare the customer INSERT
               foreach ($customer_fields as $field) {
                  if (isset($_POST[$field])) {
                     $customer_values[] = $_POST[$field];
                  }
               }
               // Specifically prepare the address INSERT
               foreach ($address_fields as $field) {
                  if (isset($_POST[$field])) {
                     $address_values[] = $_POST[$field];
                  }
               }

               // Check if there is a set customer ID or one that is equal to 0
               if (!isset($ids_user['id_klant']) || $ids_user['id_klant'] == 0) {
                  // If there isn't a customer ID or it is set to 0:

                  // Bring the logged in user ID and customer INSERT info together
                  $values = array_merge(array($ids_user['id_gebruiker']), $customer_values);

                  // INSERT new customer
                  sql_insert_customer_info($pdo, $values, $customer_count);

                  // SELECT the new customer ID
                  $ids_user['id_klant'] = sql_select_customer_id($pdo, $ids_user);

                  // UPDATE user with new customer ID
                  sql_update_user_id($pdo, $ids_user);

                  // INSERT new address
                  sql_insert_address_info($pdo, $ids_user, $address_count, $address_values);

                  // SELECT the new address ID
                  $id_address = sql_select_address_id($pdo, $ids_user);

                  // UPDATE the customer with the new address ID
                  sql_update_customer_address_id($pdo, $id_address, $ids_user);
               } else {
                  // If there is a customer ID or it isn' set to 0:
                  // If the POST username variable is set and if it isn't null
                  if (isset($user_name) && $user_name != null) {
                     // UPDATE user with new user info
                     sql_update_user_username($pdo, $user_name, $logged_user_name);

                     if (isset($_SESSION['logged_in'])) {
                        $_SESSION['logged_in']['user'] = $user_name;
                     } else if (isset($_SESSION['admin_logged_in'])) {
                        $_SESSION['admin_logged_in']['user'] = $user_name;
                     }
                  } else if ($user_name == null) {
                     echo '<span>De ingegeven gebruikersnaam is al in gebruik<span><br>';
                  }
                  // Don't know why we unset here
                  unset($user_name);


                  /**
                  // This bit is still here because I don't quite remember why it was here to begin with
                  // INSERT nieuwe klant
                  $sql_insert_customer = "INSERT INTO klant (id_gebruiker, voornaam, achternaam, email, geboortedatum) VALUES ($insertCustomerCount)";
                  $stmt = $pdo->prepare($sql_insert_customer);
                  // De logged in gebruiker ID en de klant INSERT info samenbrengen
                  $customer_values = array_merge(array($ids_user["id_gebruiker"]), $insertCustomerValues);
                  $stmt->execute($customer_values);
                   */


                  // UPDATE customer with new customer info
                  sql_update_customer_info($pdo, $customer_values, $ids_user);

                  // SELECT address info
                  $address_info = sql_select_address_info($pdo, $ids_user);

                  // If there isn't any address info
                  if (empty($address_info)) {
                     // INSERT new address
                     sql_insert_address_info($pdo, $address_count, $ids_user, $address_values);

                     // SELECT the new address ID
                     $id_address = sql_select_address_id($pdo, $ids_user);

                     // UPDATE the customer with the new address ID
                     sql_update_customer_address_id($pdo, $id_address, $ids_user);
                  } else {
                     // If there is address info
                     // UPDATE address with the new address info
                     sql_update_address_info($pdo, $address_values, $ids_user);
                  }
               }
            }
            // If the POST 'edit' isn't sent we'll try and gather all the relevant user information
            // This'll also display all the information via several fieldsets
            if (!isset($_POST['edit'])) {
               $results = sql_select_user_customer_address_order_info($pdo, $logged_user_name);
               if (empty($results)) {
                  // If we didn't manage to gather any results we assume that there isn't an order placed yet and try again
                  $results = sql_select_user_customer_address_info($pdo, $logged_user_name);
                  if (empty($results)) {
                     // If we didn't manage to gather any results still we'll simply select the username and when the entry in the database was made
                     $results = sql_select_user_info($pdo, $logged_user_name);
                  }
               } ?>
               <div class='fieldset-container'>
                  <!-- A fieldset to display the user's order -->
                  <fieldset class='user_order'>
                     <legend>Uw info</legend>
                     <div class='seperator'></div>
                     <figure><img src='images/profile_icon.png' alt='#'></figure><br>
                     <div id="list">
                        <span>Lopende bestelling:</span><br>
                        <?php
                        // SELECT customer order
                        $customer_order = sql_select_order($pdo, $ids_user);

                        // Remove product(s) from the customer order if prompted
                        if (isset($_POST['remove_from_cart'])) {
                           // The UPDATE order query
                           $sql_update_order = 'UPDATE bestelling SET producten = ? WHERE id_klant = ?';

                           // Explode the original order for a list of products sepperated by a comma
                           $customer_order_old = explode(', ', $customer_order['producten']);

                           // Variables we'll need
                           $customer_order_new = array();
                           $products = array();
                           $post_product_name = $_POST['product_name'];

                           // For every product in the newly exploded order
                           foreach ($customer_order_old as $product) {
                              // Explode each product for the individual name, quantity and price
                              $parts = explode('x', $product);
                              $product_name = $parts[0];
                              $product_quantity = $parts[1];
                              $product_price = $parts[2];

                              // If the product name isn't equal to the POST product name, we add the product info to an array
                              if ($product_name != $post_product_name) {
                                 array_push($products, $product_name . 'x' . $product_quantity . 'x' . $product_price);
                              }
                           }

                           // We implode the array so that every entry is sepperated by a comma
                           $customer_order_new = implode(', ', $products);
                           $stmt = $pdo->prepare($sql_update_order);
                           // Execute
                           $stmt->execute([$customer_order_new, $ids_user['id_klant']]);

                           unset($_POST['remove_from_cart']);
                           unset($_POST['product_name']);
                           $customer_order['producten'] = $customer_order_new;
                        }

                        // Showing the order if it exist's
                        if (!empty($customer_order['producten'])) {
                           // Explode the original order for a list of products sepperated by a comma
                           $customer_order_old = explode(', ', $customer_order['producten']);

                           // Variables we'll need
                           $customer_order_new = array();
                           $total_price = 0;

                           echo '<ul>';
                           // For every product in the newly exploded order
                           foreach ($customer_order_old as $product) {
                              // Explode each product for the individual name, quantity and price
                              $parts = explode('x', $product);
                              $product_name = $parts[0];
                              $product_quantity = $parts[1];
                              $product_price = $parts[2];
                              $product_total_price = $product_price * $product_quantity;
                              $total_price += $product_total_price;
                              // Displaying the product info along with a button to remove said product if need be
                              echo '<li><span>' . $product_name . ' x ' . $product_quantity . ' = €' . $product_total_price . '</span><form method="post"><input type="hidden" name="product_name" value="' . $product_name . '"><div id="button"><button class="remove_btn" name="remove_from_cart" type="submit">Verwijder</button></div></form></li>';
                           }
                           echo '</ul>'; ?>
                           <br><span>Uw totaal komt uit tot: € <?php echo $total_price; ?></span>
                        <?php
                        } else {
                           // If the order doesn't exist
                           echo '<p>Uw winkelmandje is leeg</p>';
                        }
                        ?>
                     </div>
                  </fieldset>

                  <!-- A fieldset to display the user info if it exist's, or 'Onbekend' if it doesn't -->
                  <fieldset class='user_info'>
                     <div class='seperator'></div>
                     <div id='row'>
                        <span>Gebruikersnaam: </span>
                        <?php
                        echo isset($results['gebruiker_naam']) ? '<span>' . $results['gebruiker_naam'] . '</span><br>' : '<span>Onbekend</span><br>';
                        ?>
                     </div>
                     <div id='row'>
                        <span>Voornaam: </span>
                        <?php
                        echo isset($results['voornaam']) ? '<span>' . $results['voornaam'] . '</span><br>' : '<span>Onbekend</span><br>';
                        ?>
                     </div>
                     <div id='row'>
                        <span>Achternaam: </span>
                        <?php
                        echo isset($results['achternaam']) ? '<span>' . $results['achternaam'] . '</span><br>' : '<span>Onbekend</span><br>';
                        ?>
                     </div>
                     <div id='row'>
                        <span>Email: </span>
                        <?php
                        echo isset($results['email']) ? '<span>' . $results['email'] . '</span><br>' : '<span>Onbekend</span><br>';
                        ?>
                     </div>
                     <div id='row'>
                        <span>Leeftijd: </span>
                        <?php
                        $current_date = date('Y-m-d');
                        $diff = (isset($results['geboortedatum']) && $results['geboortedatum'] != '0000-00-00') ? date_diff(date_create($results['geboortedatum']), date_create($current_date)) : 'Onbekend';
                        echo is_string($diff) != 1 ? '<span>' . $diff->format('%y') . ' Jaar</span><br>' : '<span>' . $diff . '</span><br>';
                        ?>
                     </div>
                     <div id='row'>
                        <span>Adres: </span>
                        <?php
                        $list = array();
                        isset($results['straat']) ? (isset($results['nummer']) ? (isset($results['postcode']) ? ($list[0] = $results['straat'] and $list[1] = ' ' . $results['nummer'] and $list[2] = ' ' . $results['postcode']) : null) : ($list[0] = $results['straat'] and $list[1] = ' ' . $results['nummer'])) : $list[0] = 'Onbekend';
                        echo '<span>';
                        foreach ($list as $item) {
                           echo $item;
                        }
                        echo '</span><br>';
                        ?>
                     </div>
                     <div id='row'>
                        <span>Account gecreêrd op: </span>
                        <?php
                        echo isset($results['gemaakt_op']) ? '<span>' . $results['gemaakt_op'] . '</span><br>' : '<span>Onbekend</span><br>';
                        ?>
                     </div>
                     <form method='post'>
                        <button class='send_btn' name='edit' type='submit' value='1' formtarget='_self'>Aanpassen</button>
                     </form>
                  </fieldset>
               </div>
            <?php
            } else {
               // If the POST 'edit' is sent we'll allow the user to change certain pieces of information about themselfs in the database
               $results = sql_select_user_info($pdo, $logged_user_name);
            ?>
               <!-- A fieldset where the user can input new info about themselfs -->
               <fieldset class='user_input'>
                  <legend>Uw info</legend>
                  <hr>
                  <form method='post'>
                     <div id='row'>
                        <span>Gebruikersnaam: </span>
                        <input type="text" name="gebruiker_naam" placeholder="<?php echo $results['gebruiker_naam']; ?>" readonly><br>
                     </div>
                     <div id='row'>
                        <span>Voornaam*: </span>
                        <input type="text" name="voornaam" required><br>
                     </div>
                     <div id='row'>
                        <span>Achternaam*: </span>
                        <input type="text" name="achternaam" required><br>
                     </div>
                     <div id='row'>
                        <span>Email*: </span>
                        <input type="email" name="email" required><br>
                     </div>
                     <div id='row'>
                        <span>Geboortedatum: </span>
                        <input type="date" name="geboortedatum"><br>
                     </div>
                     <hr>
                     <div id='row'>
                        <span>Adres</span><br>
                     </div>
                     <div id='row'>
                        <span>Straatnaam*: </span>
                        <input type="text" name="straat" required><br>
                     </div>
                     <div id='row'>
                        <span>Huisnummer*: </span>
                        <input type="number" name="nummer" required><br>
                     </div>
                     <div id='row'>
                        <span>Postcode: </span>
                        <input type="number" name="postcode"><br>
                     </div>
                     <button class='send_btn' name='edit_finish' type='submit' value='1' formtarget='_self'>Beïndigen</button>
                  </form>
               </fieldset>
            <?php }
            // End PDO connection
            $pdo = null; ?>
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
                     <h4>Aboneer Aan Onze Nieuwsbrief</h4>
                     <form class="bottom_form">
                        <input class="enter" placeholder="Typ uw emailaddres" type="text" name="Typ uw emailaddres">
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