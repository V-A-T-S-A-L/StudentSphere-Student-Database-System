<?php
session_start();

    include("database.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $roll_no = $_POST['roll_no'];
        $email_id = $_POST['email_id'];
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        $query = "INSERT INTO teachers (id, password) VALUES ('$roll_no','$password')";

        try {
            if(mysqli_query($conn, $query)) {
                header("Location: teacherhomepage1.php");
                die;
            }
        }
        catch(mysqli_sql_exception) {
          //echo '<text style="color:#FF0000;" name="message">Account already exists!</textarea>';
          echo '<script>alert("Account already exists!")</script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form | Teacher </title>
  <link rel="stylesheet" type="text/css" href="../css/AddStudent.css">
</head>
<body>
    <div class="wrapper">
      <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method = "post">
        <h1>Add Teacher</h1>
        <div class="input-box">
          <input type="text" name="roll_no" placeholder="ID" required>
          <i class='bx bxs-user'></i>
        </div>
        <div class="input-box">
          <input type="password" name="password" placeholder="Password" required>
          <i class='bx bxs-lock-alt' ></i>
        </div>
        <button type="submit" class="btn">Register</button><br><br>
        <!--Already have an account? <a href="login.php" class="login">Login</a>-->
        
      </form>
    </div>
  </body>
    
        