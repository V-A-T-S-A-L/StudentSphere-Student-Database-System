<?php
    session_start();

    include("database.php");
    include("functions.php");

    $user_data = check_login_teacher($conn);
    
    $student_data = check_login($conn);

    $personal_details = getDetails($conn);

    $rollno = $student_data['roll_no'];

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $desc = $_POST['desc'];
        $sql = "INSERT INTO tech_comp (roll_no, description) VALUES ('$rollno', '$desc')";
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
<title>Hackathon Page</title>
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
    .hackathon {
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
    .button:hover {
        background-color: #2980b9;
    }
    .button-text {
        text-decoration: none;
        color: white;
    }
    label {
        display: block;
        margin-bottom: 10px;
        font-size: 18px;
    }
    input[type="text"],
    textarea {
        width: calc(100% - 22px);
        padding: 15px;
        margin: 5px 0 20px;
        border: 1px solid black;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 16px;
    }
</style>
</head>
<body>
    <div class="container">
    <h2>Technical Competions</h2>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method = "post">
    <div id="hackathonsContainer">
        <div class="hackathon">
            <label for="hackathonDescription">Name and Description</label>
            <textarea id="hackathonDescription1" name="desc" required></textarea>
        </div>
    </div>
    <div class="button-container">
        <button class="button"><a href="studentDisplay.php" class="button-text">Back</a></button>
        <button type="submit" class="button">Save</button>
    </div>
    </div>
    </form>
</body>
</html>
