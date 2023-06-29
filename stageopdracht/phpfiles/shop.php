<?php
session_start();

// Inclusie van de databaseverbinding
require_once 'dbconnect.php';

// Functie om producten uit de database op te halen
function getProducts($db) {
    $query = "SELECT * FROM products";
    $stmt = $db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Producten ophalen uit de database
$products = getProducts($db);

// Voeg een product toe aan de winkelwagen
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];

    $cart_item = array(
        'id' => $product_id,
        'name' => $product_name,
        'price' => $product_price
    );

    // Voeg het product toe aan de winkelwagen
    $_SESSION['cart'][] = $cart_item;
}

// Verwijder een product uit de winkelwagen
if (isset($_GET['remove'])) {
    $item_id = $_GET['remove'];
    if (isset($_SESSION['cart'][$item_id])) {
        unset($_SESSION['cart'][$item_id]);
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Webshop</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="./mijnpagina.php">home</a></li>
            <li><a href="shop.php">shop</a></li>
            <li><a href="contact.php">contact</a></li>
        </ul>
    </nav>

    <!-- Productlijst -->
    <h2>Producten</h2>
    <ul>
        <?php foreach ($products as $product): ?>
            <li>
                <span><?php echo $product['name']; ?></span>
                <span><?php echo $product['price']; ?></span>
                <form action="" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo '€', $product['price']; ?>">
                    
                    <button type="submit" name="add_to_cart">Toevoegen aan winkelwagen</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Winkelwagen -->
    <h2>Winkelwagen</h2>
    <ul>
        <?php if (isset($_SESSION['cart'])): ?>
            <?php foreach ($_SESSION['cart'] as $key => $item): ?>
                <li>
                    <span><?php echo $item['name']; ?> - <?php echo $item['price']; ?></span>
                    <a href="?remove=<?php echo $key; ?>">Verwijderen</a>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>Winkelwagen is leeg</li>
        <?php endif; ?>
    </ul>
    <button class="checkoutbutton"><a href="checkout.php">kassa</a></button>
</body>
</html>
