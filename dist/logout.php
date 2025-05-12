<?php
session_start();

if (isset($_SESSION['loggedin'])) {
    session_destroy();
    header("Location: /index.php");
} else {
    header("Location: /index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
</head>
<body>
    <?= $_SESSION['loggedin'] ? 'Anda Masih Login' : 'Anda sudah logout' ?>
</body>
</html>