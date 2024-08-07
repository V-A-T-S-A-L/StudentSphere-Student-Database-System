<?php
session_start();

    include("database.php");
    include("functions.php");

    $user_data = check_login($conn);
    $cgpa_data = getCGPA($conn);
?>

<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Sem Results</h1>
    Hello, <?php echo $user_data['name']; ?>
    <br><br>
    <?php 
    if($cgpa_data != -1) {
    if($cgpa_data['sem1'] != 0) {echo" Sem 1: {$cgpa_data['sem1']}<br>";}
    if($cgpa_data['sem2'] != 0) {echo" Sem 2: {$cgpa_data['sem2']}<br>";}
    if($cgpa_data['sem3'] != 0) {echo" Sem 3: {$cgpa_data['sem3']}<br>";}
    if($cgpa_data['sem4'] != 0) {echo" Sem 4: {$cgpa_data['sem4']}<br>";}
    if($cgpa_data['sem5'] != 0) {echo" Sem 5: {$cgpa_data['sem5']}<br>";}
    if($cgpa_data['sem6'] != 0) {echo" Sem 6: {$cgpa_data['sem6']}<br>";}
    if($cgpa_data['sem7'] != 0) {echo" Sem 7: {$cgpa_data['sem7']}<br>";}
    if($cgpa_data['sem8'] != 0) {echo" Sem 8: {$cgpa_data['sem8']}<br>";}
    }
    else echo"Data Not Found!";
    ?>
</body>
</html>