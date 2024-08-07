<?php
session_start();

    include("database.php");
    include("functions.php");

    $user_data = check_login($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Home Page</h1>
    <a href="logout.php">Logout</a>
    <br>
    <br>
    Hello, <?php //echo $user_data['name']; ?>
    <br><br>
    <a href="Registration.php">details</a>
</body>
</html>