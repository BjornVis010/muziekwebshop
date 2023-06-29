<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>verwijder klant</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="../index.php">home</a></li>
            <li><a href="klantgegevens.php">klanten</a></li>
            <li><a href="product.php">producten</a></li>
            <li><a href="uitlog.php">log uit</a></li>
        </ul>
    </nav>
    <h1>Verander een email</h1>
    <form class="changeform" action="qry-wijzigKlant.php" method="POST">
        <input type="text" name="oldEmail" id="oldEmail" placeholder="old email" required>
			<input type="email" name="newEmail" id="newEmail" placeholder="new email" required>
			<button type="submit" name="submit" id="submit">submit</button>
		</form>
</body>
</html>