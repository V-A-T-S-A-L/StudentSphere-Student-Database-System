<?php
session_start();

    include("database.php");
    include("functions.php");

    $user_data = check_login_teacher($conn);
    
    $student_data = check_login($conn);
    $roll = $student_data['roll_no'];

    $cgpa_data = getCGPA($conn);

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $post = $_POST['search'];
        $sem = $_POST['sem'];
        $cgpa = $_POST['cgpa'];
        
        $query = "UPDATE cgpa SET $sem = '$cgpa' WHERE roll_no = '$roll' LIMIT 1";
        $result = mysqli_query($conn, $query);
        if($result) {
          header("Location: studentDisplay.php");
          die;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form | Teacher </title>
  <link rel="stylesheet" type="text/css" href="../css/editcgpa.css">
  
</head>
<body>
  <div class="banner"> 
    <div class="navbar">
        
        </div>  
  <div class="wrapper">

    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method = "post">
            
      <select name="sem" id="language">
        <option value="sem1">Sem 1</option>
        <option value="sem2">Sem 2</option>
        <option value="sem3">Sem 3</option>
        <option value="sem4">Sem 4</option>
        <option value="sem5">Sem 5</option>
        <option value="sem6">Sem 6</option>
        <option value="sem7">Sem 7</option>
        <option value="sem8">Sem 8</option>
      </select>
      
      <div class="input-box">
        <input type="text" placeholder="CGPA" name="cgpa" required>
        <i class='bx bxs-lock-alt' ></i>
      </div>
      <br>
      <button type="submit" class="btn" name="search">Submit</button>
      
      
    </form>
    <button type="submit" class="btn1"><a href="infoDisplayNew.php" class="Login">Back</a></button>
    </div>
  </div>
</body>
</html>

<style>
  .wrapper {
    transform: translateY(50px);
  }
</style>