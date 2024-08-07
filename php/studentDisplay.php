<?php
    session_start();

    include("database.php");
    include("functions.php");

    $user_data = check_login_teacher($conn);
    
    if(isset($_GET['id'])) {
        $roll_no = $_GET['id'];
        $_SESSION['roll_no'] = $roll_no;
        header("Location: studentDisplay.php");
    } else {
        $student_data = check_login($conn);
        $personal_details = getDetails($conn);
    }
    //$roll_no = $personal_details['roll_no'];
    $cgpa_data = getCGPA($conn);

    $council_data = getCouncil($conn);

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        if(isset($_POST['search'])) {
            $post = $_POST['search'];

            if(is_numeric($post)){
                $roll_no = $_POST['search'];
                $query = "SELECT * FROM students WHERE roll_no = '$roll_no' LIMIT 1";

                $result = mysqli_query($conn, $query);
                
                if($result) {
                    if($result && mysqli_num_rows($result) > 0) {
                        $user_data = mysqli_fetch_assoc($result); 
                        $_SESSION['roll_no'] = $user_data['roll_no'];
                        header("Location: studentDisplay.php");
                        die;
                    }
		        	echo '<script>alert("User not found!")</script>';
                }
            }
        }

        if(isset($_POST['sportsDel'])) {
            $roll_no = $personal_details['roll_no'];
            $sql = "DELETE FROM sports WHERE rollno = '$roll_no'";
            $result = mysqli_query($conn, $sql);
        }

        if(isset($_POST['techDel'])) {
            $roll_no = $personal_details['roll_no'];
            $sql = "DELETE FROM tech_comp WHERE roll_no = '$roll_no'";
            $result = mysqli_query($conn, $sql);
        }

        if(isset($_POST['councilDel'])) {
            $roll_no = $personal_details['roll_no'];
            $sql = "DELETE FROM council WHERE roll_no = '$roll_no'";
            $result = mysqli_query($conn, $sql);
        }

        if(isset($_POST['projectDel'])) {
            $roll_no = $personal_details['roll_no'];
            $sql = "DELETE FROM project WHERE roll_no = '$roll_no'";
            $result = mysqli_query($conn, $sql);
        }

        if(isset($_POST['patentDel'])) {
            $roll_no = $personal_details['roll_no'];
            $sql = "DELETE FROM patent WHERE roll_no = '$roll_no'";
            $result = mysqli_query($conn, $sql);
        }

        if(isset($_POST['internDel'])) {
            $roll_no = $personal_details['roll_no'];
            $sql = "DELETE FROM internship WHERE roll_no = '$roll_no'";
            $result = mysqli_query($conn, $sql);
        }

        if(isset($_POST['confirm'])) {
            $roll_no = $student_data['roll_no'];
            $sql = "DELETE FROM students WHERE roll_no = '$roll_no'";
            $result = mysqli_query($conn, $sql);
            header("Location: teacherhomepage1.php");
        }
    }
?>

<script>
    function openDeleteWindow() {
        document.getElementById("confirmationModal").style.display = "flex";
    }

    function closeDeleteWndow() {
        document.getElementById("confirmationModal").style.display = "none";
    }
</script>

<style>

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-image: url(../images/back.avif); /* Replace with your background image URL */
        background-size: 100% 100%;
        width: 100%;
        height: 100vh;
        background-repeat: no-repeat;
        background-attachment: fixed;
        transition: all 0.3s ease-out;
    }

    .dark-mode {
        background-image: linear-gradient(rgba(0,0,0,0.75),rgba(0,0,0,0.75)),url(../images/back.avif);
        transition: background-image 0.3s ease;

    }

    .dark-mode .card {
        background-color: #031c24; 
        background: rgba(3, 28, 36, 0);
        color: white; 
        position: relative;
        backdrop-filter: blur(10px); 
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        padding: 20px;
        margin: 20px auto;
        width: 60%;
        transition: all 0.3s ease
    }

    header {
        position: sticky;
        top: 0;
        z-index: 100;
        background-color: rgba(0, 0, 0, 0.623); /* Adjust the alpha value for header transparency */
        color: #fff;
        text-align: center;
        overflow-x: hidden;
        padding: 10px;
    }      

    .navbar {
        display: flex;
        justify-content: left;
        align-items: center;
    }

    .logo a {
        color: #fff;
        text-decoration: none;
        margin-left: 15px;
        white-space: nowrap;
        overflow-x: hidden;
        margin-right: 15px;
        font-size: 18px; /* Adjust font size */
        font-weight: bold;
        transition: all 0.3s;
    }

    .logo a:hover {
        color: #3498db;
    }

    .search-bar {
        display: flex;
        align-items: center;
    }

    .search-bar input {
        padding: 8px;
        border: none;
        border-radius: 5px;
        /*margin-left: 870px;
        margin-right: 10px;*/
        position: absolute;
        right: 100;
        top: 4;
        width: 200px; /* Adjust width of the search input */
    }

    .search-button {
        padding: 8px 16px; 
        border-color: black;
        border-radius: 10px;
        position: absolute;
        right: 10;
        top: 2.5;
        background-color: #3498db; /* Change to your desired button color */
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .search-button:hover {
        background-color: #2980b9; /* Change to your desired button hover color */
    }

    .card {
        position: relative;
        backdrop-filter: blur(10px); /* Adjust the blur value as needed */
        background: rgba(255, 255, 255, 0); /* Adjust the alpha value for card transparency */
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        padding: 20px;
        margin: 20px auto;
        width: 60%;
        transition: all 0.3s 
    }

    .card:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.9);
        width: 61%;
    }

    #academicDetails table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    #academicDetails th, #academicDetails td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }

    #participationDetails ul {
        list-style-type: none;
        padding: 0;
    }

    #participationDetails li {
        margin-bottom: 10px;
    }

    .edit-button {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 8px 16px;
        font-size: 14px;
        border-radius: 10px;
        background-color: #3498db; /* Change to your desired button color */
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .edit-text {
        text-decoration: none;
        color: white;
    }

    .certificate-button {
        position: absolute;
        top: 10px;
        right: 76px;
        padding: 8px 16px;
        font-size: 14px;
        border-radius: 10px;
        background-color: #3498db; /* Change to your desired button color */
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .certificate-button:hover {
        background-color: #2980b9;
    }

    .delete-button {
        display: flex;
        align-items: center;
        position: absolute;
        top: 10px;
        left: 10px;
        padding: 8px 16px;
        font-size: 14px;
        border-radius: 10px;
        background-color: red; /* Change to your desired button color */
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .delete-button img {
        width: 14px;
        margin-right: 8px;
        transform: scale(1.2);
        filter: invert();
    }

    .delete-button:hover {
        background-color: #d40202;
    }

    .edit-button:hover {
        background-color: #2980b9; /* Change to your desired button hover color */
    }

    .edit {
        text-decoration: none;
        color: white;
    }

    .social-btn {
        border: none;
        background-color: white;
    }

    /* Style the scrollbar track */
    ::-webkit-scrollbar {
        width: 12px; /* width of the scrollbar */
    }

    /* Style the scrollbar handle */
    ::-webkit-scrollbar-thumb {
        background-color: #3498db; /* color of the handle */
        border-radius: 6px; /* rounded corners of the handle */
    }

    /* Style the scrollbar track when not being hovered over */
    ::-webkit-scrollbar-track {
        background-color: #f0f0f0; /* color of the track */
    }

    /* Style the scrollbar handle when being hovered over */
    ::-webkit-scrollbar-thumb:hover {
        background-color: #2980b9; /* color of the handle on hover */
    }

    table {
            /*transform: translate(-100px,-30px);*/
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 2px solid #dddddd;
            text-align: center;
            padding: 12px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #e0e0e0;
        }

        h1 {
              text-align: center;
              font-size:30px;
        }

    .dark-mode .tr:nth-child(even) {
        background-color: #000;
    }

    .modal {
        display: none; /* Hidden by default */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
        justify-content: center;
        align-items: center;
        z-index: 100;
    }

    .modal-content {
        width: 30%;
        background-color: white;
        padding: 20px;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    }

    .modal-content h3 {
        color: #333;
    }

    .cancel-btn {
        background-color: #4CAF50; /* Green */
        position: relative;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        margin: 10px;
        cursor: pointer;
        border: solid 1px;
        border-color: #031c24;
        transition: all 0.3s;
    }

    .cancel-btn:hover {
        background-color: green;
    }

    .delete-btn {
        background-color: red;
        position: relative;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        margin: 10px;
        cursor: pointer;
        border: solid 1px;
        border-color: #031c24;
        transition: all 0.3s;
    }

    .delete-btn:hover {
        background-color: darkred;
    }

    .delete-div {
        display: flex;
        align-items: center;
        gap: 50px;
        justify-content: space-around;
    }

    .home-link {
        cursor: pointer;
    }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="teststyle.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Student Details</title>
</head>
<body id="body">
    <header>
        <nav class="navbar">
            <div class="logo">
                <a href="teacherhomepage1.php" class="home-link">Home</a>
            </div>
            <div class="logo">
                <a href="report.php" class="home-link" target="_blank">Generate Report</a>
            </div>
            <?php 
                if($user_data['admin'] == 1) {
                    echo    
                        "<div class='logo'>
                            <a class='home-link' onclick='openDeleteWindow()'>Delete</a>
                        </div>";
                }
            ?> 
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method = "post">
                <div class="search-bar">
                    <input type="text" placeholder="Search student..." name="search">
                    <button type="submit" class="search-button">Search</button>
                </div>
            </form>
        </nav>
    </header>

    <div id="confirmationModal" class="modal">
        <div class="modal-content">
            <h3>Are you sure you want to permanently delete the entire data?</h3>
            <div class="delete-div">
                <button id="cancelDelete" onclick="closeDeleteWndow()" class="cancel-btn">Cancel</button>
                <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method = "post">
                    <button id="confirmDelete" name="confirm" class="delete-btn">Delete</button>
                </form>
            </div>
        </div>
    </div>

    <!--<header>
        <h1>Student Information</h1>
    </header>-->
    <section id="studentCard" class="card">
        <!-- Student name, contact info, and socials will be displayed here -->
        <h1>Personal Details</h1>
        <ul id="Personal">
        Name: <?php if($personal_details != -1) echo $personal_details['name']; else echo "Data not found!";?>
        <br>
        <br>
        Roll No: <?php echo $student_data['roll_no'];?>
        <br>
        <br>
        Contact: <?php if($personal_details != -1) echo $personal_details['contact']; else echo "Data not found!";?>
        <br>
        <br>
        Email: <?php if($personal_details != -1) echo $personal_details['email']; else echo "Data not found!";?>
        <br>
        <br>
        Address: <?php if($personal_details != -1) echo $personal_details['address']; else echo "Data not found!";?>
        <br>
        <br>
        </ul>
    </section>

    <section id="academicDetails" class="card">
        <h1>Academic Details</h1>
        <table id="cgpaTable">
            
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
            
            <!-- CGPA details for up to 8 semesters will be displayed here -->
            <!-- Add rows dynamically using JavaScript -->
        </table>
        <button class="edit-button"><a href="editcgpa2.php" class="edit">Edit</a></button>
    </section>

    <section id="participationDetail" class="card">
        <h1>Participation in Sports Events</h1>
        <ul id="sportsEventsList">
            <?php 
                if($personal_details != -1) {
                    $roll_no = $personal_details['roll_no'];
                    $sql = "SELECT * FROM sports WHERE rollno='$roll_no'";
                    $result = mysqli_query($conn, $sql);
                    if ($result->num_rows > 0) {
                        $count = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo $count;
                            echo ") ";
                            echo $row["achievement"] . "<br>"; // Modify to display the appropriate column
                            $count++;
                        }
                    }
                }
                else echo"No data";
            ?>
        </ul>
        <a href="sportsPDF.php" target="_blank"><button class="certificate-button" onclick="editParticipationInfo()">Certificate</button></a>
        <button class="edit-button"><a href="sports.php" class="edit-text">Add</a></button>
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method = "post">
            <a class="edit-text"><button type="submit" class="delete-button" name="sportsDel"><img src="../images/delete.png">Delete Data</button></a>    
        </form>    
      
    </section>

    <section id="TechnicalEvents" class="card">
        <h1>Participation in Technical Events</h1>
        <ul id="TechnicalEventsList">
        <?php 
            if($personal_details != -1) {
                $count = 1;
                $sql = "SELECT * FROM tech_comp WHERE roll_no='$roll_no'";
                $result = mysqli_query($conn, $sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo $count;
                        echo ") ";
                        echo $row["description"] . "<br>"; // Modify to display the appropriate column
                        $count++;
                    }
                }
            }
            else echo"No data";
        ?>
        </ul>
        <a href="techPDF.php" target="_blank"><button class="certificate-button" onclick="editParticipationInfo()">Certificate</button></a>
        <button class="edit-button"><a href="tech.php" class="edit-text">Add</a></button>
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method = "post">
            <a class="edit-text"><button type="submit" class="delete-button" name="techDel"><img src="../images/delete.png">Delete Data</button></a>    
        </form>
    </section>


    <section id="TechnicalEvents" class="card">
        <h1>Council</h1>
        <ul id="TechnicalEventsList">
            <?php
                if($personal_details == -1) echo "No council"; 
                else {
            ?>
        <table id="cgpaTable">
            <tr>
                <th>Council name</th>
                <th>Position</th>
            </tr>
                <?php 
                    if($personal_details != -1) {
                        $sql = "SELECT * FROM council WHERE roll_no='$roll_no'";
                        $result = mysqli_query($conn, $sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?><tr><td><?php echo $row["council_name"];?></td>
                                <td><?php echo $row["position"];?></td></tr><?php
                            }
                        }
                    }
                    }
                ?>  
        </table>
        <button class="edit-button"><a href="council.php" class="edit-text">Add</a></button>
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method = "post">
            <a class="edit-text"><button type="submit" class="delete-button" name="councilDel"><img src="../images/delete.png">Delete Data</button></a>    
        </form>
        </ul>
    </section>

    <section id="TechnicalEvents" class="card">
        <h1>Projects</h1>
        <ul id="TechnicalEventsList">
        <?php 
            if($personal_details != -1) {
                $count = 1;
                $sql = "SELECT * FROM project WHERE roll_no='$roll_no'";
                $result = mysqli_query($conn, $sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo $count;
                        echo ") ";
                        echo $row["description"] . "<br>"; // Modify to display the appropriate column
                        $count++;
                    }
                }
            }
            else echo"No data";
        ?>
        </ul>
        <button class="edit-button"><a href="proj.php" class="edit-text">Add</a></button>
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method = "post">
            <a class="edit-text"><button type="submit" class="delete-button" name="projectDel"><img src="../images/delete.png">Delete Data</button></a>    
        </form>
    </section>

    <section id="Patent" class="card">
        <h1>Patent</h1>
        <ul id="PatentDetail">
        <?php 
            if($personal_details != -1) {
                $count = 1;
                $sql = "SELECT * FROM patent WHERE roll_no='$roll_no'";
                $result = mysqli_query($conn, $sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo $count;
                        echo ") ";
                        echo $row["description"] . "<br>"; // Modify to display the appropriate column
                        $count++;
                    }
                }
            }
            else echo"No data";
        ?>
        </ul>
        <button class="edit-button"><a href="patent.php" class="edit-text">Add</a></button>
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method = "post">
            <a class="edit-text"><button type="submit" class="delete-button" name="patentDel"><img src="../images/delete.png">Delete Data</button></a>    
        </form>
    </section>


    <section id="TechnicalEvents" class="card">
        <h1>Internships</h1>
        <ul id="TechnicalEventsList">
        <?php
                if($personal_details == -1) echo "No internships"; 
                else {
            ?>
        <table id="cgpaTable">
            <tr>
                <th>Company name</th>
                <th>Role</th>
            </tr>
                <?php 
                    if($personal_details != -1) {
                        $sql = "SELECT * FROM internship WHERE roll_no='$roll_no'";
                        $result = mysqli_query($conn, $sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?><tr><td><?php echo $row["company_name"];?></td>
                                <td><?php echo $row["role"];?></td></tr><?php
                            }
                        }
                    }
                    }
                ?>  
        </table>
        </ul>
        <a href="internshipPDF.php" target="_blank"><button class="certificate-button" onclick="editParticipationInfo()">Certificate</button></a>
        <button class="edit-button"><a href="internship.php" class="edit-text">Add</a></button>
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method = "post">
            <a class="edit-text"><button type="submit" class="delete-button" name="internDel"><img src="../images/delete.png">Delete Data</button></a>    
        </form>
    </section>
    <br>
</body>
</html>