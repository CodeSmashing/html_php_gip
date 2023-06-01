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
							<h2>Info</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end banner -->
	</header>
	<!-- end header -->
	<?php
	// Help from: https://stackoverflow.com/questions/36240145/how-to-use-serverhttp-referer-correctly-in-php
	// If the last page is /contact.php :
	if ($_SESSION['lastpage'] == '/html_php_gip/sunshine-html/contact.php') {
		echo $_REQUEST['Name'], '<br><br>';
		echo $_REQUEST['Phone'], '<br><br>';
		echo $_REQUEST['Email'], '<br><br>';
		echo $_REQUEST['Message'], '<br><br>';
		// End PDO connection
		$pdo = null;
	} else if (($_SESSION['lastpage'] == '/html_php_gip/sunshine-html/login.php') && (!isset($_SESSION['logged_in']))) {
		// If the last page is /login.php and the user isn't logged in
		// Help from: https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php
		// And: https://www.geeksforgeeks.org/how-to-insert-form-data-into-database-using-php/

		// We initialise the username for later use
		if (isset($_REQUEST['username']) === true) {
			$username = $_REQUEST['username'];
			$options = array(
				'options' => array(
					'regexp' => '/^[a-zA-Z0-9_]+$/'
				)
			);
			$input_username = trim(filter_var($username, FILTER_VALIDATE_REGEXP, $options));
		} else {
			echo 'Volgens ons is er geen gebruikersnaam ingegeven.<br>
            U zal worden herleidt naar de login pagina.<br>';
			header('Refresh: 4; url=login.php', true, 0);
			exit();
		}

		// We initialise the password for later use
		if (isset($_REQUEST['password']) === true) {
			$password = $_REQUEST['password'];
			$options = array(
				'options' => array(
					'regexp' => '/^[a-zA-Z0-9_]+$/'
				)
			);
			$input_password = trim(filter_var($password, FILTER_VALIDATE_REGEXP, $options));
		} else {
			echo 'Volgens ons is er geen paswoord ingegeven.<br>
            U zal worden herleidt naar de login pagina.<br>';
			header('Refresh: 4; url=login.php', true, 0);
			exit();
		}

		// If the user told us they'd like to register
		if ($_REQUEST['registreren'] == '1') {
			// SELECT user ID
			$sql_select_id_user = 'SELECT id_gebruiker FROM gebruikers WHERE gebruiker_naam = ?';
			if ($stmt = $pdo->prepare($sql_select_id_user)) {
				// If preparing statement works
				// Bind variable to prepared SELECT as parameters
				$stmt->bindParam(1, $param_username);

				$param_username = $input_username;

				// Try to execute the statement
				if ($stmt->execute()) {
					// If succesfull we fetch the result
					$id_user = $stmt->fetchAll(PDO::FETCH_ASSOC);

					// If the result isn't empty we send the user back to the login page so they can retry because their input username is already in use
					if (!empty($id_user)) {
						echo 'Deze gebruikersnaam is al in gebruik.<br>
                     	U zal worden herleidt naar de login pagina.<br>';
						header('Refresh: 4; url=login.php', true, 0);
						exit();
					}
				} else {
					// If the statement couldn't execute
					echo 'Oops! Iets ging mis met het uitvoeren van het programma.
					U zal worden herleidt naar de login pagina.';
					header('Refresh: 4; url=login.php', true, 0);
					exit();
				}
			}
			/**
			// Close the statement
			$stmt->closeCursor();
			 */
			// Check if the input password is empty or not
			if (empty($input_password)) {
				echo 'U heeft geen passwoord ingegeven.<br>
               	U zal worden herleidt naar de login pagina.<br>';
				header('Refresh: 4; url=login.php', true, 0);
				exit();
			}

			// Maybe we could put a more meaningfull check here but untill then it'll just be a repeat
			if (!(empty($input_password) && empty($input_username))) {
				// INSERT user
				$sql_insert_user = 'INSERT INTO gebruikers (gebruiker_naam, gebruiker_pass) VALUES (?, ?)';
				if ($stmt = $pdo->prepare($sql_insert_user)) {
					// If preparing statement works
					// Bind variable to prepared INSERT as parameters
					$stmt->bindParam(1, $param_username);
					$stmt->bindParam(2, $param_password);

					$param_username = $input_username;
					$param_password = password_hash($input_password, PASSWORD_DEFAULT);

					// Try to execute the statement
					if ($stmt->execute()) {
						// If succesfull we set the user as logged in and keep a note of their username for future use
						$_SESSION['logged_in'] = array(
							'logged_in' => true,
							'user' => $input_username,
						);
						echo 'Bedankt om te registreren.<br>
                     	U zal worden herleidt naar de thuis pagina.<br>';
						header('Refresh: 4; url=index.php', true, 0);
						exit();
					} else {
						// If the statement couldn't execute
						echo 'Oops! Iets ging fout bij het registreren.<br>
                     	U zal worden herleidt naar de login pagina.<br>';
						header('Refresh: 4; url=login.php', true, 0);
						exit();
					}
				}
				/**
				// Close the statement
				$stmt->closeCursor();
				 */
			} else {
				// If the check fails we send the user back to the login page
				echo 'Oops! Ofwel is er geen paswoord, ofwel geen gebruikersnaam ingegeven.<br>
               	U zal worden herleidt naar de login pagina.<br>';
				header('Refresh: 4; url=login.php', true, 0);
				exit();
			}

			// End PDO connection
			$pdo = null;
		} else if ($_REQUEST['registreren'] == '2') {
			// If the user told us they'd not like to register
			// SELECT user pass
			$sql_select_user_pass = 'SELECT gebruiker_pass FROM gebruikers WHERE gebruiker_naam = ?';

			if ($stmt = $pdo->prepare($sql_select_user_pass)) {
				// If preparing statement works
				// Bind variable to prepared SELECT as parameters
				$stmt->bindParam(1, $param_username);

				$param_username = $input_username;

				// Try to execute the statement
				if ($stmt->execute()) {
					// If succesfull we fetch the result
					$hash_result = $stmt->fetch(PDO::FETCH_ASSOC)['gebruiker_pass'];
				} else {
					// If the statement couldn't execute
					echo 'Oops! Iets ging mis met het controleren van het passwoord.<br>
					U zal worden herleidt naar de login pagina.';
					header('Refresh: 4; url=login.php', true, 0);
					exit();
				}
			}
			// Close the statement
			$stmt->closeCursor();

			// We compare the newly selected pass to the input user pass
			if (password_verify($input_password, $hash_result) == true) {
				// If succesfull we set the user as logged in and keep a note of their username for future use
				$_SESSION['logged_in'] = array(
					'logged_in' => true,
					'user' => $input_username,
				);
				/** echo "<div><a class='read_more' href='index.php' role='button'>Home</a></div>"; */
				echo 'Bedankt om in te loggen.<br>';
				header('Refresh: 4; url=index.php', true, 0);
				exit();
			} else {
				// If the verification isn't succesfull
				echo 'Sorry, maar iets ging fout bij de paswoord verificatie.<br>
               	U zal worden herleidt naar de login pagina.<br>';
				header('Refresh: 4; url=login.php', true, 0);
				exit();
			}
			// End PDO connection
			$pdo = null;
		} else if ($_REQUEST['registreren'] == '3') {
			// If the user told us they like to login as an admin
			// SELECT user pass
			$sql_select_user_pass = 'SELECT gebruiker_pass FROM gebruikers WHERE gebruiker_naam = :param_username AND gebruiker_level = 1';

			if ($stmt = $pdo->prepare($sql_select_user_pass)) {
				// If preparing statement works
				// Try to execute the statement
				if ($stmt->execute(['param_username' => $input_username])) {
					// If succesfull we fetch the result
					$hash_result = $stmt->fetch(PDO::FETCH_ASSOC)['gebruiker_pass'];

					// We compare the newly selected pass to the input user pass
					if (password_verify($_REQUEST['password'], $hash_result)) {
						// If succesfull we set the user as logged in and keep a note of their username for future use
						$_SESSION['admin_logged_in'] = array(
							'logged_in' => true,
							'user' => $input_username,
						);
						echo 'Alles klopt, u zult worden aangemeld als beheerder.<br>
                     	U zal worden herleidt naar de thuis pagina.<br>';
						header('Refresh: 4; url=index.php', true, 0);
						exit();
					} else {
						// If the verification isn't succesfull
						echo 'Sorry maar dit paswoord is verkeerd, u zal worden herleidt naat de login pagina.<br>';
						header('Refresh: 4; url=login.php', true, 0);
						exit();
					}
				} else {
					// If the statement couldn't execute
					echo 'Oops! Iets ging mis met het uitvoeren van het programma.<br>
					U zal worden herleidt naar de login pagina.';
					header('Refresh: 4; url=login.php', true, 0);
					exit();
				}
			}
			/**
			// Close the statement
	        $stmt->closeCursor();
			 */

			// End PDO connection
			$pdo = null;
		}
	} else if ($_SESSION['lastpage'] == '/html_php_gip/sunshine-html/order.php') {
		// If the last page is /order.php
	?>
		<div class="process">
			<div class="container">
				<div class="row">
					<div class="col-md-6 offset-md-3">
						<div class="titlepage">
							<h2>Onze Producten</h2>
							<span>
								U heeft een bestelling aangegeven, maar om deze te kunnen versturen hebben wij een adres en nog wat andere noodzakelijke info nodig.<br>
								<hr>
								De velden met een * zijn noodzakelijk.
							</span>
						</div>
					</div>
				</div>
			</div>
			<?php
			$customer_info = array();

			if (isset($_POST['customer_info'])) {
				foreach ($_POST as $key => $value) {
					$customer_info[$key] = $value;
				}
			}

			// If the POST 'customer_info' is empty and the user is logged in
			if (empty($customer_info) && (isset($_SESSION['logged_in']) || isset($_SESSION['admin_logged_in']))) {
				// SELECT logged in username
				$logged_user_name = isset($_SESSION['logged_in']['user']) ? $_SESSION['logged_in']['user'] : (isset($_SESSION['admin_logged_in']['user']) ? $_SESSION['admin_logged_in']['user'] : null);

				// We loop through 4 possible scenario's in order to select the user's information
				$info_user = null;
				$list_sql_select = array(
					$sql_select = 'SELECT * FROM gebruikers g, klant k, adres a, bestelling b WHERE g.gebruiker_naam = ? AND k.id_gebruiker = g.id_gebruiker AND k.id_adres = a.id_adres AND k.id_bestelling = b.id_bestelling',
					$sql_select = 'SELECT * FROM gebruikers g, klant k, adres a WHERE g.gebruiker_naam = ? AND k.id_gebruiker = g.id_gebruiker AND k.id_adres = a.id_adres',
					$sql_select = 'SELECT * FROM gebruikers g, klant k WHERE g.gebruiker_naam = ? AND k.id_gebruiker = g.id_gebruiker',
					$sql_select = 'SELECT * FROM gebruikers WHERE gebruiker_naam = ?'
				);
				foreach ($list_sql_select as $sql_select) {
					$stmt = $pdo->prepare($sql_select);

					// We try each query to get a result
					if ($stmt->execute([$logged_user_name])) {
						$info_user = $stmt->fetch(PDO::FETCH_ASSOC);
						if ($info_user) {
							break;
						}
					}
				}

				// Remember to use preg_match() sometimes
				// We display any relevant information from the result and leave the rest to be filled in by the user
			?>
				<form method="post">
					<input type="text" name="voornaam" value="<?php echo isset($info_user['voornaam']) ? $info_user['voornaam'] : null ?>" placeholder="<?php echo isset($info_user['voornaam']) ? $info_user['voornaam'] : 'Voornaam*' ?>" pattern="[a-zA-Z]+(?:\s+[a-zA-Z]+)*" required <?php if (isset($info_user['voornaam'])) { ?> readonly <?php } ?>></input><br><br>

					<input type="text" name="achternaam" value="<?php echo isset($info_user['achternaam']) ? $info_user['achternaam'] : null ?>" placeholder="<?php echo isset($info_user['achternaam']) ? $info_user['achternaam'] : 'Achternaam*' ?>" pattern="[a-zA-Z]+(?:\s+[a-zA-Z]+)*" required <?php if (isset($info_user['achternaam'])) { ?> readonly <?php } ?>></input><br><br>

					<input type="email" name="email" value="<?php echo isset($info_user['email']) ? $info_user['email'] : null ?>" placeholder="<?php echo isset($info_user['email']) ? $info_user['email'] : 'Email' ?>" pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$" <?php if (isset($info_user['email'])) { ?> readonly <?php } ?>></input><br>

					<input type="text" name="straat" value="<?php echo isset($info_user['straat']) ? $info_user['straat'] : null ?>" placeholder="<?php echo isset($info_user['straat']) ? $info_user['straat'] : 'Straatnaam*' ?>" pattern="[a-zA-Z0-9\s]+" required <?php if (isset($info_user['straat'])) { ?> readonly <?php } ?>></input><br>

					<input type="number" name="nummer" value="<?php echo isset($info_user['nummer']) ? $info_user['nummer'] : null ?>" placeholder="<?php echo isset($info_user['nummer']) ? $info_user['nummer'] : 'Huisnummer*' ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required <?php if (isset($info_user['nummer'])) { ?> readonly <?php } ?>></input><br>

					<input type="number" name="postcode" value="<?php echo isset($info_user['postcode']) ? $info_user['postcode'] : null ?>" placeholder="<?php echo isset($info_user['postcode']) ? $info_user['postcode'] : 'Postcode*' ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required <?php if (isset($info_user['postcode'])) { ?> readonly <?php } ?>></input><br><br>

					<button type="submit" name="customer_info" class="send_btn" formtarget="_self">
						Bestelling plaatsen
					</button>
				</form>
			<?php
			} else if (!empty($customer_info) && (isset($_SESSION['logged_in']) || isset($_SESSION['admin_logged_in']))) {
				// If the POST 'customer_info' isn't empty and the user is logged in
			?>
				<span>De opgeschreven informatie is compleet, uw bestelling zal worden doorgevoerd.</span><br>
				<?php
				// SELECT logged in username
				$logged_user_name = isset($_SESSION['logged_in']['user']) ? $_SESSION['logged_in']['user'] : (isset($_SESSION['admin_logged_in']['user']) ? $_SESSION['admin_logged_in']['user'] : null);

				// SELECT user and customer ID's
				$ids_user = sql_select_ids_user($pdo, $logged_user_name);

				// INSERT customer if there isn't a customer ID or it's equal to 0
				if ((!isset($ids_user['id_klant'])) || ($ids_user['id_klant'] == 0)) {
					// INSERT customer
					sql_insert_customer($pdo, $id_user, $customer_info);

					// SELECT new customer ID
					$ids_user['id_klant'] = sql_select_customer_id($pdo, $ids_user);

					// UPDATE user with new customer ID
					sql_update_user($pdo, $ids_user);
				}

				// SELECT customer address
				$info_address = sql_select_address_info($pdo, $ids_user);

				// INSERT customer address if it doesn't exist
				if (empty($info_address)) {
					sql_insert_address_info_2($pdo, $ids_user, $customer_info);
				}

				// SELECT order
				$customer_order = sql_select_order($pdo, $ids_user);

				// UPDATE order if it exist's but is empty
				if (isset($customer_order['id_bestelling']) && empty($customer_order['producten'])) {
					$sql_order = 'UPDATE bestelling SET producten = ? WHERE id_klant = ?';
					$products = array();
					foreach ($_SESSION['cart'] as $product_name => $product) {
						array_push($products, $product_name . 'x' . $product['quantity'] . 'x' . $product['price']);
					}
					$new_products = implode(', ', $products);
					$stmt = $pdo->prepare($sql_order);
					$stmt->execute([$new_products, $ids_user['id_klant']]);
				} else if (isset($customer_order['id_bestelling']) && isset($customer_order['producten'])) {
					// UPDATE order if it exist's and isn't empty

					// Explode each product for the individual name, quantity and price
					$customer_order_old = explode(', ', $customer_order['producten']);
					$customer_order_new = array();

					foreach ($customer_order_old as $product) {
						$parts = explode('x', $product);
						$product_name = $parts[0];
						$product_quantity = $parts[1];
						$product_price = $parts[2];
						$customer_order_new[$product_name]['quantity'] = $product_quantity;
						$customer_order_new[$product_name]['price'] = $product_price;
					}

					// Add new products or quantities
					foreach ($_SESSION["cart"] as $product_name => $product) {
						if (array_key_exists($product_name, $customer_order_new)) {
							$customer_order_new[$product_name]['quantity'] += $product['quantity'];
						} else {
							$customer_order_new[$product_name]['quantity'] = $product['quantity'];
							$customer_order_new[$product_name]['price'] = $product['price'];
						}
					}

					// UPDATE order
					$sql_update_order = 'UPDATE bestelling SET producten = ? WHERE id_klant = ?';
					$products = array();
					foreach ($customer_order_new as $product_name => $product) {
						array_push($products, $product_name . 'x' . $product['quantity'] . 'x' . $product['price']);
					}
					$new_products = implode(', ', $products);
					$stmt = $pdo->prepare($sql_update_order);
					$stmt->execute([$new_products, $ids_user['id_klant']]);
				} else if (!isset($customer_order['id_bestelling']) && !isset($customer_order['producten'])) {
					// INSERT order if there isn't one set
					$sql_insert_order = 'INSERT INTO bestelling (producten, id_klant) VALUES (?, ?)';
					$products = array();
					foreach ($_SESSION['cart'] as $product_name => $product) {
						array_push($products, $product_name . 'x' . $product['quantity'] . 'x' . $product['price']);
					}
					$new_products = implode(', ', $products);
					$stmt = $pdo->prepare($sql_insert_order);
					$stmt->execute([$new_products, $ids_user['id_klant']]);
				}

				// SELECT relevant address ID
				$id_address = sql_select_address_id($pdo, $ids_user);

				// SELECT relevant order ID
				$id_order = sql_select_order_id($pdo, $ids_user);

				// UPDATE customer with address and order ID's
				sql_update_customer($pdo, $id_address, $id_order, $ids_user);

				// Subtract items in cart from stock
				foreach ($_SESSION['cart'] as $product_name => $product) {
					$product_quantity = $product['quantity'];
					sql_update_stock($pdo, $product_quantity, $product_name);
				}
				// Clear cart and redirect to home page
				unset($_SESSION['cart']);

				echo 'U zal worden herleidt naar de thuis pagina';
				header('Refresh: 4; url=index.php', true, 0);
				exit();
				?>
				<span>Bedankt om een bestelling te plaatsen.</span><br>
				<span>Deze zal na enige tijd verwerkt en doorgestuurd worden naar het opgegeven adres.</span>
			<?php
			}
			// End PDO connection
			$pdo = null;
			?>
		</div>
	<?php
	} else if ($_SESSION['lastpage'] == '/html_php_gip/sunshine-html/stock.php') {
		// If the last page is /stock.php

		// For every sent product accordingly change the price and stock to what's given, if it's given
		foreach ($_POST['product'] as $product_id => $values) {
			echo 'Product id: ' . $product_id . ' | New price: ' . $values['price'] . ' | New stock: ' . $values['stock'] . '<br>';
			if ($values['price'] != null) {
				sql_update_product($pdo, $values, $product_id);
			}
			if ($values['stock'] != null) {
				sql_update_stock_2($pdo, $values, $product_id);
			}
		}
		unset($_POST['product']);

		// End PDO connection
		$pdo = null;
	} else {
		// If the last page is one we don't have:
		// Help from: https://stackoverflow.com/questions/768431/how-do-i-make-a-redirect-in-php?page=1&tab=scoredesc#tab-top
		// User Hammad Khan
		// Note to self, learn output buffering dammit: https://stackoverflow.com/questions/2832010/what-is-output-buffering
		// http://web.archive.org/web/20101216035343/http://dev-tips.com/featured/output-buffering-for-web-developers-a-beginners-guide

		echo 'Sorry, maar u komt van een pagina waarvoor we nog geen data kunnen processeren.<br>
        U zal worden terug gestuurd naar de vorige pagina.';
		header('Refresh: 4; url=' . $_SESSION['lastpage'] . '', true, 0);
		exit();

		// End PDO connection
		$pdo = null;
	}
	?>
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
							<li><a href="about.php">Over Ons</a></li>
							<li><a href="order.php">Bestel</a></li>
							<li><a href="products.php">Products</a></li>
							<li><a href="contact.php">Contacteer Ons</a></li>
						</ul>
					</div>
					<div class="col-md-3">
						<h3>TOP voedsel</h3>
						<p class="many">
							There are many variations of passages of Lorem Ipsum available, but the majority have
							suffered
							alteration in some form, by injected
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
							<p>© 2019 All Rights Reserved. Design by <a href="https://html.design/"> Free Html Templates</a>
							</p>
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
<?php ob_end_flush(); ?>