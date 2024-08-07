<?php
    session_start();

    include("database.php");
    include("functions.php");

    $user_data = check_login_teacher($conn);
    
    $student_data = check_login($conn);

    $personal_details = getDetails($conn);

    $rollno = $student_data['roll_no'];

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $company = $_POST['company'];
        $role = $_POST['role'];

        $sql = "INSERT INTO internship (roll_no, company_name, role) VALUES ('$rollno', '$company', '$role')";
        $result = mysqli_query($conn, $sql);

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
<title>Internship Page</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-image: url(../images/back.avif);
        background-size: 100% 100%;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .container {
        position: relative;
        backdrop-filter: blur(10px); /* Adjust the blur value as needed */
        background: rgba(255, 255, 255, 0); /* Adjust the alpha value for card transparency */
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        padding: 20px;
        margin: 20px auto;
        width: 60%;
        transition: width 2s ease;
        transition: box-shadow 0.3s ease;
    }
    .container:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.9);
    }
    h2 {
        text-align: center;
    }
    .internship {
        margin-bottom: 10px;
    }
    .button-container {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }
    .button {
        padding: 15px 30px;
        background-color: #3498db;
        text-decoration: none;
        color: white;
        border-color: black;
        border-radius: 10px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }
    .button-text {
        text-decoration: none;
        color: white;
    }
    .button:hover {
        background-color: #2980b9;
    }
    label {
        display: block;
        margin-bottom: 10px;
        font-size: 18px;
    }
    input[type="text"] {
        width: calc(100% - 22px);
        padding: 15px;
        margin: 5px 0 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 16px;
    }
</style>
</head>
<body>

<div class="container">
    <h2>Internship Page</h2>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method = "post">
    <div id="internshipsContainer">
        <div class="internship">
            <label for="companyName">Company Name</label>
            <input type="text" id="companyName1" name="company" required>
            <label for="role">Role</label>
            <input type="text" id="role1" name="role" required>
        </div>
    </div>
    <div class="button-container">
        <button class="button"><a href="studentDisplay.php" class="button-text">Back</a></button>
        <button type="submit" class="button">Save</button>
    </div>
    </form>
</div>
</body>
</html>
