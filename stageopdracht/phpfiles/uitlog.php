<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>uitloggen</title>
    <link rel="stylesheet" type="text/css" href="company.css">
</head>
<body>
    <?php
    session_start();
    header("refresh: 2; url=../index.php");

    echo "<h2>uitloggen . . . </h2>";
    session_destroy();
    ?>
</body>
</html>