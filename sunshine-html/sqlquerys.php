<?php
require_once('config.php');

function sql_select_product_and_stock($pdo) {
    $sql = 'SELECT * FROM product p, stock s WHERE p.id_stock = s.id_stock';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function sql_select_product_name($pdo) {
    $sql = 'SELECT product_naam FROM product';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function sql_select_ids_user($pdo, $logged_user_name) {
    $sql = 'SELECT id_gebruiker, id_klant FROM gebruikers WHERE gebruiker_naam = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$logged_user_name]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function sql_select_user_username($pdo) {
    $user_name = $_POST['gebruiker_naam'];
    $sql = 'SELECT gebruiker_naam FROM gebruikers WHERE gebruiker_naam = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_name]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function sql_insert_customer_info($pdo, $values, $customer_count) {
    $sql = 'INSERT INTO klant (id_gebruiker, voornaam, achternaam, email, geboortedatum) VALUES (' . $customer_count . ')';
    $stmt = $pdo->prepare($sql);
    $stmt->execute($values);
}
function sql_select_customer_id($pdo, $ids_user) {
    $sql = 'SELECT id_klant FROM klant WHERE id_gebruiker = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$ids_user['id_gebruiker']]);
    return $stmt->fetch(PDO::FETCH_ASSOC)['id_klant'];
}
function sql_update_user_id($pdo, $ids_user) {
    $sql = 'UPDATE gebruikers SET id_klant = ? WHERE id_gebruiker = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$ids_user['id_klant'], $ids_user['id_gebruiker']]);
}
function sql_insert_address_info($pdo, $ids_user, $address_count, $address_values) {
    $sql = 'INSERT INTO adres (id_klant, postcode, straat, nummer) VALUES (' . $address_count . ')';
    $stmt = $pdo->prepare($sql);
    // Bring the customer ID and address INSERT info together
    $values = array_merge(array($ids_user['id_klant']), $address_values);
    $stmt->execute($values);
}
function sql_select_address_id($pdo, $ids_user) {
    $sql = 'SELECT id_adres FROM adres WHERE id_klant = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$ids_user['id_klant']]);
    return $stmt->fetch(PDO::FETCH_ASSOC)['id_adres'];
}
function sql_update_customer_address_id($pdo, $id_address, $ids_user) {
    $sql = 'UPDATE klant SET id_adres = ? WHERE id_gebruiker = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_address['id_adres'], $ids_user['id_gebruiker']]);
}
function sql_update_user_username($pdo, $user_name, $logged_user_name) {
    $sql = 'UPDATE gebruikers SET gebruiker_naam = ? WHERE gebruiker_naam = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_name, $logged_user_name]);
}
function sql_update_customer_info($pdo, $customer_values, $ids_user) {
    $sql = 'UPDATE klant SET voornaam = ?, achternaam = ?, email = ?, geboortedatum = ? WHERE id_gebruiker = ?';
    $stmt = $pdo->prepare($sql);
    $values = array_merge($customer_values, array($ids_user['id_gebruiker']));
    $stmt->execute($values);
}
function sql_select_address_info($pdo, $ids_user) {
    $sql = 'SELECT * FROM adres WHERE id_klant = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$ids_user['id_klant']]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function sql_update_address_info($pdo, $address_values, $ids_user) {
    $sql = 'UPDATE adres SET postcode = ?, straat = ?, nummer = ? WHERE id_klant = ?';
    $stmt = $pdo->prepare($sql);
    $values = array_merge($address_values, array($ids_user['id_klant']));
    $stmt->execute($values);
}
function sql_select_user_customer_address_order_info($pdo, $logged_user_name) {
    $sql = 'SELECT email, gebruiker_naam, voornaam, achternaam, geboortedatum, created_at, straat, nummer, postcode, producten, datum_handeling FROM gebruikers g, klant k, adres a, bestelling b WHERE g.gebruiker_naam = ? AND k.id_gebruiker = g.id_gebruiker AND k.id_adres = a.id_adres AND k.id_bestelling = b.id_bestelling';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$logged_user_name]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function sql_select_user_customer_address_info($pdo, $logged_user_name) {
    $sql = 'SELECT email, gebruiker_naam, voornaam, achternaam, geboortedatum, created_at, straat, nummer, postcode FROM gebruikers g, klant k, adres a WHERE g.gebruiker_naam = ? AND k.id_gebruiker = g.id_gebruiker AND k.id_adres = a.id_adres';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$logged_user_name]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function sql_select_user_info($pdo, $logged_user_name) {
    $sql = 'SELECT gebruiker_naam, created_at FROM gebruikers WHERE gebruiker_naam = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$logged_user_name]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function sql_select_order($pdo, $ids_user) {
    $sql = 'SELECT * FROM bestelling WHERE id_klant = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$ids_user['id_klant']]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function sql_insert_customer($pdo, $ids_user, $customer_info) {
    $sql = 'INSERT INTO klant (id_gebruiker, voornaam, achternaam, email) VALUES (?, ?, ?, ?)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$ids_user['id_gebruiker'], $customer_info['voornaam'], $customer_info['achternaam'], $customer_info['email']]);
}
function sql_update_user($pdo, $ids_user) {
    $sql = 'UPDATE gebruikers SET id_klant = ? WHERE id_gebruiker = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$ids_user['id_klant'], $ids_user['id_gebruiker']]);
}
function sql_insert_address_info_2($pdo, $ids_user, $customer_info) {
    $sql = 'INSERT INTO adres (id_klant, postcode, straat, nummer) VALUES (?, ?, ?, ?)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$ids_user['id_klant'], $customer_info['postcode'], $customer_info['straat'], $customer_info['nummer']]);
}
function sql_select_order_id($pdo, $ids_user) {
    $sql = 'SELECT id_bestelling FROM bestelling WHERE id_klant = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$ids_user['id_klant']]);
    return $stmt->fetchColumn();
}
function sql_update_customer($pdo, $id_address, $id_order, $ids_user) {
    $sql = 'UPDATE klant SET id_adres = ?, id_bestelling = ? WHERE id_klant = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_address, $id_order, $ids_user['id_klant']]);
}
function sql_update_stock($pdo, $product_quantity, $product_name) {
    $sql = 'UPDATE product p, stock s SET stock = stock - :quantity WHERE product_naam = :productName AND p.id_stock = s.id_stock';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['quantity' => $product_quantity, 'productName' => $product_name]);
}
function sql_update_product($pdo, $values, $product_id) {
    $sql = 'UPDATE product SET product_prijs = :price WHERE id_product = :product_id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['price' => $values['price'], 'product_id' => $product_id]);
}
function sql_update_stock_2($pdo, $values, $product_id) {
    $sql = 'UPDATE stock SET stock = :stock WHERE id_stock = :product_id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['stock' => $values['stock'], 'product_id' => $product_id]);
}
?>