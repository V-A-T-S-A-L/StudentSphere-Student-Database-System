<?php
session_start();

    include("database.php");
    include("functions.php");

    $user_data = check_login_teacher($conn);
    
    $student_data = check_login($conn);

    $cgpa_data = getCGPA($conn);

    $council_data = getCouncil($conn);
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> </title>
  <link rel="stylesheet" type="text/css" href="../css/NewInfodisplay.css">
</head>
<div class="container">
<br>

<h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name  :  <?php echo $student_data['name'];?></h2>
<br>
<h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Class : <?php echo $student_data['email_id'];?></h2>
<br>
<h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Roll No : <?php echo $student_data['roll_no'];?></h2>
<br>
<hr>
<br>

<h2>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; CGPA:
</h2>
<button type="submit" class="btn"><a href="editcgpa2.php" class="Edit">Edit</a></button>




<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 0;
    }

    table {
        transform: translate(-100px,-30px);
        width: 80%;
        margin: 50px auto;
        border-collapse: collapse;
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 0 20px rgb(0, 0, 0, 0.1);
    }

    th, td {
        border: 1px solid #dddddd;
        text-align: center;
        padding: 12px;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #e0e0e0;
    }
</style>

<body>
    


<table>
    <tr>
        <th>Sem 1</th>
        <th>Sem 2</th>
        <th>Sem 3</th>
        <th>Sem 4</th>
        <th>Sem 5</th>
        <th>Sem 6</th>
        <th>Sem 7</th>
        <th>Sem 8</th>
    </tr>
    <tr>
        <td><?php if($cgpa_data != -1 && $cgpa_data['sem1'] != 0) {echo" {$cgpa_data['sem1']}<br>";} else {echo "--<br>";}?></td>
        <td><?php if($cgpa_data != -1 && $cgpa_data['sem2'] != 0) {echo" {$cgpa_data['sem2']}<br>";} else {echo "--<br>";}?></td>
        <td><?php if($cgpa_data != -1 && $cgpa_data['sem3'] != 0) {echo" {$cgpa_data['sem3']}<br>";} else {echo "--<br>";}?></td>
        <td><?php if($cgpa_data != -1 && $cgpa_data['sem4'] != 0) {echo" {$cgpa_data['sem4']}<br>";} else {echo "--<br>";}?></td>
        <td><?php if($cgpa_data != -1 && $cgpa_data['sem5'] != 0) {echo" {$cgpa_data['sem5']}<br>";} else {echo "--<br>";}?></td>
        <td><?php if($cgpa_data != -1 && $cgpa_data['sem6'] != 0) {echo" {$cgpa_data['sem6']}<br>";} else {echo "--<br>";}?></td>
        <td><?php if($cgpa_data != -1 && $cgpa_data['sem7'] != 0) {echo" {$cgpa_data['sem7']}<br>";} else {echo "--<br>";}?></td>
        <td><?php if($cgpa_data != -1 && $cgpa_data['sem8'] != 0) {echo" {$cgpa_data['sem8']}<br>";} else {echo "--<br>";}?></td>
    </tr>
</table>
<hr>
<h2>
    <br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; COUNCIL:
</h2>
<button type="submit" class="btn"><a href="#" class="Edit">Edit</a></button>
<br>

<table>
    <tr>
        <th>Column 1</th>
        <th>Column 2</th>
        </tr>
        <tr>
            <td>Row 1, Cell 1</td>
            <td>Row 1, Cell 2</td>
            </tr>
            </table>


        </div>
</body>
</html>
