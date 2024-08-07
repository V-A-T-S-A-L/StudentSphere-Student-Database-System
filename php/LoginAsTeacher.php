<?php
session_start();

    include("database.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $login = $_POST['id'];
        $password = $_POST['password'];

        $query = "SELECT * FROM teachers WHERE id = '$login' LIMIT 1";

        $result = mysqli_query($conn, $query);
        
        if($result) {
            if($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                if($user_data['password'] === $password && $user_data['admin'] == 0) {
                    $_SESSION['id'] = $user_data['id'];
                    header("Location: teacherhomepage1.php");
                    die;
                }
            }
            echo '<script>alert("Invalid username or password!")</script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form | Teacher </title>
  <link rel="stylesheet" type="text/css" href="../css/Login1.css">
  
</head>
<body>
  <div class="banner"> 
     
  <div class="wrapper">

    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method = "post">
      <h1>Login</h1>
      <div class="input-box">
        <input type="text" placeholder="Name" name="id" required>
        <i class='bx bxs-user'></i>
      </div>
      <div class="input-box">
        <input type="password" placeholder="Password" name="password" required>
        <i class='bx bxs-lock-alt' ></i>
      </div>
      <!--<div class="remember-forgot">
        <label><input type="checkbox">Remember Me</label>
        <a href="#">Forgot Password</a>
      </div>-->
      <br>
      <button type="submit" class="btn">Login</button>
      
      
    </form>
    <button type="submit" class="btn1"><a href="home.php" class="Login">Home</a></button>
    </div>
  </div>
</body>
</html>

<style>
  .wrapper {
    transform: translateY(200px);
  }
</style>