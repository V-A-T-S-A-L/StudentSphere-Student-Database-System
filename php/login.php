<?php
session_start();

    include("database.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $roll_no = $_POST['roll_no'];
        $password = $_POST['password'];

        $query = "SELECT * FROM students WHERE roll_no = '$roll_no' LIMIT 1";

        $result = mysqli_query($conn, $query);
        
        if($result) {
            if($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                if($user_data['password'] === $password) {
                    $_SESSION['roll_no'] = $user_data['roll_no'];
                    header("Location: studentHome.php");
                    die;
                }
            }
            //echo '<text style="color:#FF0000;" name="message">Invalid username or password!</textarea>';
			      echo '<script>alert("Invalid username or password!")</script>';
        }
    }
?>
<link rel="stylesheet" type="text/css" href="../css/MStudentLogin.css">
</head>
<body>
  <div class="wrapper">
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method = "post">
      <h1>Student Login</h1>
      <div class="input-box">
        <input type="text" name="roll_no" placeholder="Roll No." required>
        <i class='bx bxs-user'></i>
      </div>
      <div class="input-box">
        <input type="password" name="password" placeholder="Password" required>
        <i class='bx bxs-lock-alt' ></i>
      </div>
      <button type="submit" class="btn">Login</button><br><br>
    </form>
  </div>
</body>
</html> 

<style>
  body {
    background-image: linear-gradient(rgba(0,0,0,0.75),rgba(0,0,0,0.75)),url(../images/back.avif);
  }
</style>