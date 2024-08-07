<?php
    session_start();

    include("database.php");
    include("functions.php");

    $user_data = check_login_teacher($conn);
    
    $student_data = check_login($conn);

    $personal_details = getDetails($conn);

    $rollno = $student_data['roll_no'];

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $council = $_POST['councilName'];
        $position = $_POST['position'];

        $sql = "INSERT INTO council (roll_no, council_name, position) VALUES ('$rollno', '$council', '$position')";
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
<title>Council Member Page</title>
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
        width: 100%;
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
    .council-member {
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
        border: 1px solid black;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 16px;
    }
</style>
</head>
<body>

<div class="container">
    <h2>Council Member</h2>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method = "post">
        <div id="councilMembersContainer">
            <div class="council-member">
                <label for="councilName">Council Name</label>
                <input type="text" id="councilName1" name="councilName" required>
                <label for="position">Position</label>
                <input type="text" id="position1" name="position" required>
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
