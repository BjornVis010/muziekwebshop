<?php
session_start();

// Inclusie van de databaseverbinding
require_once 'dbconnect.php';

// Controleer of de winkelwagen leeg is
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo 'Winkelwagen is leeg. Voeg eerst producten toe.';
    exit;
}

// Functie om een order in de database op te slaan
function createOrder($db) {
    // Genereer een unieke order-ID
    $order_id = uniqid();

    // Voeg de order toe aan de database
    $query = "INSERT INTO orders (order_id, delivered) VALUES (:order_id, NULL)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':order_id', $order_id);
    $stmt->execute();

    return $order_id;
}

// Maak een nieuwe order aan
$order_id = createOrder($db);

// Verwerk betaling en update de orderstatus
if (isset($_POST['pay'])) {
    // Hier zou de integratie met de betalingsgateway plaatsvinden
    // Voor dit voorbeeld simuleren we alleen een succesvolle betaling
    $payment_success = true;

    if ($payment_success) {
        // Markeer de order als betaald (afgeleverd)
        $query = "UPDATE orders SET delivered = NOW() WHERE order_id = :order_id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':order_id', $order_id);
        $stmt->execute();

        // Verwijder de winkelwagen
        unset($_SESSION['cart']);

        // Stuur de gebruiker door naar een bedankpagina
        header('Location: thank_you.php');
        exit;
    } else {
        echo 'Betaling is mislukt. Probeer het opnieuw.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Betaalpagina</title>
</head>
<body>
    <h1>Kies uw bank om te betalen</h1>

    <form action="" method="POST">
        <select name="bank">
            <option value="rabobank">Rabobank</option>
            <option value="abnamro">ABN AMRO</option>
            <option value="ing">ING</option>
            <!-- Voeg hier meer bankopties toe indien gewenst -->
        </select>
        <br>
        <button type="submit" name="pay">Doorgaan naar betaling</button>
    </form>
</body>
</html>