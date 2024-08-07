<?php
    session_start();

    include("database.php");
    include("functions.php");

    $user_data = check_login_teacher($conn);
    
    $student_data = check_login($conn);

    $personal_details = getDetails($conn);
    //$roll_no = $personal_details['roll_no'];

    $cgpa_data = getCGPA($conn);

    $council_data = getCouncil($conn);

    $userId = $student_data['roll_no'];

    $pic = getPhoto($conn, $userId);
?>

<style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-image: url(../images/back.avif); /* Replace with your background image URL */
    background-size: 100% 100%;
    background-color: #202020;
    width: 100%;
    height: 100vh;
    background-repeat: no-repeat;
    background-attachment: fixed;
    }
    header {
        display: flex;
        justify-content: space-between;
        position: sticky;
        top: 0;
        z-index: 100;
        /*background-color: rgba(0, 0, 0, 0.623); /* Adjust the alpha value for header transparency */
        background-color: white;
        color: #fff;
        text-align: center;
        padding: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0);
        transition: all 0.3s;
    }      
    
    .navbar {
        display: flex;
        justify-content: right;
        align-items: flex-start;
    }

    .profile {
        display: flex;
        justify-content: left;
        align-items:flex-start;
    }

    .img {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        object-fit: cover;
        position: relative;
        left: 2;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .img:hover {
        border-radius: 25%;
    }

    .file-css {
        display: inline-block;
        cursor: pointer;
        padding: 5px 12px;
        background-color: #555;
        color: white;
        border-radius: 5px;
        font-size: 10px;
        margin-left: 10px;
    }

    .upload-css {
        display: inline-block;
        cursor: pointer;
        padding: 8px 12px;
        background-color: #555;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 10px;
        margin-left: 0px;
        margin-top: 13px;
        width: 55px;
    }

    .logo a {
        color: black;
        text-decoration: none;
        -webkit-text-stroke: 1px black;
        font-size: 20px; /* Adjust font size */
        font-weight: bold;
        padding: 10px;
        transition: color 0.3s ease;
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
        margin-right: 10px;
        width: 200px; /* Adjust width of the search input */
    }

    .search-button {
        padding: 8px 16px; 
        border-color: black;
        border-radius: 10px;
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
        backdrop-filter: blur(5px); /* Adjust the blur value as needed */
        background: rgba(255, 255, 255, 0); /* Adjust the alpha value for card transparency */
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        padding: 20px;
        margin: 20px auto;
        width: 60%;
        transition: width 2s ease;
        transition: all 0.3s ease;
        color: #202020;
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

    .certificate-button {
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

    .certificate-button:hover {
        background-color: #2980b9;
    }

    .certificate-file {
        display: none;
        position: absolute;
        width: 110px;
        top: 10px;
        right: 10px;
        padding: 8px 16px;
        transform: translateX(-110px);
        font-size: 14px;
        border-radius: 10px;
        background-color: #3498db; /* Change to your desired button color */
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .upload-button {
        display: none;
        position: absolute;
        width: 105px;
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

    .edit-button:hover {
        background-color: #2980b9; /* Change to your desired button hover color */
    }

    .edit {
        text-decoration: none;
        color: white;
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
            color: black;
        }

        tr:nth-child(even) {
            background-color: #e0e0e0;
        }

        h1 {
              text-align: center;
              font-size:30px;
        }

        #fileInput {
        display: none;
    }

    #fileSelect {
        display: none;
    }

    #fileUpload {
        display: none;
    }

    .nav__cont {
        position: fixed;
        width: 60px;
        top:0;
        height: 100vh;
        z-index: 100;
        background-color: #202020;
        overflow:hidden;
        transition:width .3s ease;
        box-shadow:4px 7px 10px rgba(0,0,0,.4);
        &:hover {
          width: 160px;
        }
        &:hover .logo {
            transition: 0.3s ease;
            transform: translateX(50px);
        }
        @media screen and (min-width: 600px) {
            width: 60px;
        }
    }

    .nav {
        list-style-type: none;
        color:white;
        &:first-child {
          padding-top:1.5rem;
        }

        li {
            height: 15px;
            transition: all 0.3s;
        }

        li:hover {
            transform: scale(1.05);
        }
    }

    .nav__items {
        height: 35px;
        padding-bottom:4rem;
        font-family: 'roboto';
        list-style-type: none;
        position: relative;
        top: 15;
        a {
            position: relative;
            display:block;
            top:-25px;
            padding-left:25px;
            padding-right:15px;
            transition:all .3s ease;
            margin-left:5px;
            margin-right:0px;
            text-decoration: none;
            color:white;
            font-family: 'roboto';
            font-weight: 100;
            font-size: 1.35em;
            &:after {
                content:'';
                width: 100%;
                height: 100%;
                position: absolute;
                top:0;
                left:0;
                border-radius:12px;
                color: #4691f6;
                background-color: black;
                opacity:0;
                transition:all .5s ease;
                z-index: -10;
            }
        }
        &:hover a:after {
            opacity: 1;
            color: #2980b9;
        }
        svg{
            width:20px;
            height:26px;
            position: relative;
            left:-25px;
            cursor:pointer;
            @media screen and(min-width:600px) {
                width:32px;
                height:32px;
                left:-15px;
            }
        } 
    }

    .svg-icon {
        width: 1em;
        height: 1em;
    }

    .svg-icon path,
    .svg-icon polygon,
    .svg-icon rect {
        fill: #ddd;
    }

    .svg-icon circle {
        stroke: #4691f6;
        stroke-width: 1;
    }

    .dropbtn {
        cursor: pointer;
    }

    .overlayPass {
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
    }

    .change-password-window {
        display: none;
        justify-content: center;
        position: fixed;
        width: 400px;
        background-color: #f9f9f9;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        padding: 20px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1001; /* Ensure the window is above the overlay */
        transition: all 0.3s;
    }

    .change-password-window:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.9);
        width: 410px;
    }

    .change-password-window h2 {
        padding-bottom: 5px;
    }

    /* Style for form elements */
    .change-password-form label,
    .change-password-form input[type="password"],
    .change-password-form button {
        width: 100%;
        display: block;
        margin-bottom: 15px;
        font-size: 16px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    /* Style for submit button */
    .change-password-form button {
        background-color: #3498db;
        color: white;
        border-color: black;
        border-radius: 5px;
        cursor: pointer;
    }

    .change-password-form input:focus {
        outline: none;
        border-color: #3498db;
        box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
    }

    .svg_icon {
        width: 2em;
        height: 2em;
    }

    .svg_icon path,
    .svg_icon polygon,
    .svg_icon rect {
        fill: #4691f6;
    }

    .svg_icon circle {
        stroke: #4691f6;
        stroke-width: 1;
    }

    .passClose-button {
        border: none;
        background-color: white;
        cursor: pointer;
        transition: all 0.3s;
    }

    .passClose-button:hover {
        transform: rotateZ(90deg);
    }

    .ss-logo-div {
        margin-left: 17px;
        position: absolute;
        bottom: 20;
    }

    .ss-logo {
        transform: scale(1.2);
        width: 120px;
        height: 40px;
        cursor: pointer;
    }
</style>

<script>
        document.addEventListener("DOMContentLoaded", function() {
    // Dummy data for demonstration, replace with actual data
   /* const studentData = {
        name: "John Doe",
        contactInfo: "john.doe@example.com",
        socials: {
            twitter: "@john_doe",
            linkedin: "/in/johndoe",
        },
        academicDetails: {
            cgpa: [3.5, 3.8, 3.6, 3.9, 3.7, 3.8, 3.9, 4.0],
        },
        participationDetails: {
            sportsEvents: ["Football", "Basketball", "Track and Field"],
        },
    };*/

    // Display student name, contact info, and socials
    const studentCard = document.getElementById("studentCard");
    studentCard.innerHTML = `
        <h2>${studentData.name}</h2>
        <p>Contact: ${studentData.contactInfo}</p>
        <p>Socials: 
            <a href="https://twitter.com/${studentData.socials.twitter}" target="_blank">${studentData.socials.twitter}</a>
            <a href="https://linkedin.com${studentData.socials.linkedin}" target="_blank">${studentData.socials.linkedin}</a>
        </p>
        <button onclick="editStudentInfo()">Edit Info</button>
    `;

    // Display academic details (CGPA)
    const academicDetails = document.getElementById("cgpaTable");
    studentData.academicDetails.cgpa.forEach((cgpa, index) => {
        const row = academicDetails.insertRow();
        const semesterCell = row.insertCell(0);
        const cgpaCell = row.insertCell(1);
        semesterCell.textContent = `Semester ${index + 1}`;
        cgpaCell.textContent = cgpa;
    });

    // Display participation in sports events
    const participationDetails = document.getElementById("sportsEventsList");
    studentData.participationDetails.sportsEvents.forEach(event => {
        const listItem = document.createElement("li");
        listItem.textContent = event;
        participationDetails.appendChild(listItem);
    });
    });

    function editInfo() {
        document.getElementById("Personal").readOnly = false;
        document.getElementById("address").readOnly = false;
        document.querySelectorAll('.contact-details input').forEach(input => {
            input.readOnly = false;
        });
        document.querySelector(".btn").innerText = "Save Information";
        document.querySelector(".btn").onclick = saveInfo;
    }

    function saveInfo() {
        // You can implement the logic to save the information here
        // For simplicity, let's just disable the fields again
        document.getElementById("Personal").readOnly = true;
        document.getElementById("address").readOnly = true;
        document.querySelectorAll('.contact-details input').forEach(input => {
            input.readOnly = true;
        });
        document.querySelector(".btn").innerText = "Edit Information";
        document.querySelector(".btn").onclick = editInfo;
    }

</script>

<?php
    if (isset($_POST['submit'])) {

        $filename = $_FILES["file"]["name"];

        $tempname = $_FILES["file"]["tmp_name"];  

        $folder = "uploads/".$filename;

        $sql = "INSERT INTO profile_pic (roll_no, pic) VALUES ('$userId', '$filename')";
        $check = "SELECT * FROM profile_pic WHERE roll_no = '$userId'";
        $checkres = mysqli_query($conn, $check);

        if($checkres && mysqli_fetch_assoc($checkres) == 0) {
            mysqli_query($conn, $sql);       

            if (move_uploaded_file($tempname, $folder)) {
                $msg = "Image uploaded successfully";
            }else{
                $msg = "Failed to upload image";
            }
        }

        else {
            $update = "UPDATE profile_pic SET pic = '$filename' WHERE roll_no = '$userId'";
            mysqli_query($conn, $update);
            move_uploaded_file($tempname, $folder);
        }

        $sql = "SELECT * FROM profile_pic WHERE roll_no = '$userId'";
        $res = mysqli_query($conn, $sql);
        $arr = mysqli_fetch_assoc($res);
        $check = "SELECT * FROM profile_pic WHERE roll_no = '$userId'";
        $checkres = mysqli_query($conn, $check);

        if($checkres && mysqli_fetch_assoc($checkres) == 0) {
            if($arr['pic'] == '') {
                $defaultPic = "add.png";
                $sql = "INSERT INTO profile_pic (roll_no, pic) VALUES ('$userId', '$defaultPic')";
                $query = mysqli_query($conn, $sql);
            }
        } else {
            if($arr['pic'] == '') {
                $defaultPic = "add.png";
                $sql = "UPDATE profile_pic SET pic = '$defaultPic' WHERE roll_no = '$userId'";
                $query = mysqli_query($conn, $sql);
            }
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        if(isset($_POST['sportsUpl']) && isset($_FILES["sportsFile"]) && $_FILES["sportsFile"]["error"] == 0) {

            $filename = $_FILES["sportsFile"]["name"];

            $tempname = $_FILES["sportsFile"]["tmp_name"];  

            $folder = "sports/".$filename;

            $sql = "INSERT INTO sports_certificates (roll_no, sports_pdf) VALUES ('$userId', '$filename')";
            $check = "SELECT * FROM sports_certificates WHERE roll_no = '$userId'";
            $checkres = mysqli_query($conn, $check);

            if($checkres && mysqli_fetch_assoc($checkres) == 0) {
                mysqli_query($conn, $sql);       

                if (move_uploaded_file($tempname, $folder)) {
                    $msg = "Image uploaded successfully";
                }else{
                    $msg = "Failed to upload image";
                }
            }

            else {
                $update = "UPDATE sports_certificates SET sports_pdf = '$filename' WHERE roll_no = '$userId'";
                mysqli_query($conn, $update);
                move_uploaded_file($tempname, $folder);
            }
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        if(isset($_POST['techUpl']) && isset($_FILES["techFile"]) && $_FILES["techFile"]["error"] == 0) {

            $filename = $_FILES["techFile"]["name"];

            $tempname = $_FILES["techFile"]["tmp_name"];  

            $folder = "tech/".$filename;

            $sql = "INSERT INTO tech_certificate (roll_no, tech_pdf) VALUES ('$userId', '$filename')";
            $check = "SELECT * FROM tech_certificate WHERE roll_no = '$userId'";
            $checkres = mysqli_query($conn, $check);

            if($checkres && mysqli_fetch_assoc($checkres) == 0) {
                mysqli_query($conn, $sql);       

                if (move_uploaded_file($tempname, $folder)) {
                    $msg = "Image uploaded successfully";
                }else{
                    $msg = "Failed to upload image";
                }
            }

            else {
                $update = "UPDATE tech_certificate SET tech_pdf = '$filename' WHERE roll_no = '$userId'";
                mysqli_query($conn, $update);
                move_uploaded_file($tempname, $folder);
            }
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        if(isset($_POST['intUpl']) && isset($_FILES["intFile"]) && $_FILES["intFile"]["error"] == 0) {

            $filename = $_FILES["intFile"]["name"];

            $tempname = $_FILES["intFile"]["tmp_name"];  

            $folder = "internship/".$filename;

            $sql = "INSERT INTO internship_certificate (roll_no, internship_pdf) VALUES ('$userId', '$filename')";
            $check = "SELECT * FROM internship_certificate WHERE roll_no = '$userId'";
            $checkres = mysqli_query($conn, $check);

            if($checkres && mysqli_fetch_assoc($checkres) == 0) {
                mysqli_query($conn, $sql);       

                if (move_uploaded_file($tempname, $folder)) {
                    $msg = "Image uploaded successfully";
                }else{
                    $msg = "Failed to upload image";
                }
            }

            else {
                $update = "UPDATE internship_certificate SET internship_pdf = '$filename' WHERE roll_no = '$userId'";
                mysqli_query($conn, $update);
                move_uploaded_file($tempname, $folder);
            }
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        if(isset($_POST['newPassword'])) {
            $oldPass = $_POST['oldPass'];
            $newPass = $_POST['newPass'];
            
            $sql = "SELECT password FROM students WHERE roll_no='$userId'";
            $result = mysqli_query($conn, $sql);

            $assoc = mysqli_fetch_assoc($result);
            $confirmPass = $assoc['password'];

            if($oldPass == $confirmPass) {
                $sql = "UPDATE students SET password = '$newPass' WHERE roll_no = '$userId'";
                $result = mysqli_query($conn, $sql);
            }
        }
    }
?>

<script>
    function triggerFileInput() {
        document.getElementById('fileSelect').click();
        document.getElementById('fileUpload').style.display = 'block';
    }

    function sportsUpload() {
        document.getElementById('sportsUpl').style.display = 'block';
        document.getElementById('sportsFile').style.display = 'block';
    }

    function techUpload() {
        document.getElementById('techUpl').style.display = 'block';
        document.getElementById('techFile').style.display = 'block';
    }

    function intUpload() {
        document.getElementById('intUpl').style.display = 'block';
        document.getElementById('intFile').style.display = 'block';
    }

    function toggleSidebar() {
        var sidebar = document.getElementById("sidebar");
        
        if(sidebar.style.display === "block") {
            sidebar.style.display = "none";
        } else {
            sidebar.style.display = "block";
        }
    }

    function changePass() {
        document.getElementById("overlayPass").style.display = "flex";
        document.getElementById("change-password-window").style.display = "block";
    }

    function closeWindow() {
        document.getElementById("overlayPass").style.display = "none";
        document.getElementById("change-password-window").style.display = "none";
    }

    function toggleMode() {
        var body = document.getElementById("body");
        if(body.style.backgroundImage === "url(../images/dark-mode.jpg)") {
            body.style.backgroundImage = "url(../images/back.avif)";
        } else {
            body.style.backgroundImage = "url(../images/dark-mode.jpg)";
        }    
    }
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="teststyle.css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Student Details</title>
</head>
<body id="body">
    <!--<header>
        <nav class="profile">
            <div class="logo">
                <?php 
                    if($pic == -1) {
                        echo "<img src='../images/add.png' class='img' onclick='triggerFileInput()''>";
                    }
                    
                    else {
                        $sql = "SELECT * FROM profile_pic WHERE roll_no = '$userId'";
                        $result = mysqli_query($conn, $sql);
                        if($result) {
                            $profilePhotoPath = mysqli_fetch_assoc($result);
                        }
                        echo '<img class="img" onclick="triggerFileInput()" src="uploads/' . $profilePhotoPath["pic"] . '">';
                    }
                ?>
            </div>
            <div class="logo">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="file" name="file" id="fileSelect" class="file-css">
                    <input type="submit" name="submit" id="fileUpload" value="Upload" class="upload-css">
                </form>
            </div>
        </nav>
        
        <nav class="navbar">
            <div class="logo">
                <a href="home.php" class="home-link">Home</a>
            </div>

            <div class="logo">
                <a href="studentMsg.php" class="home-link">Message</a>
            </div>

            <div class="logo">
                <a href="logout.php" class="home-link">Logout</a>
            </div>

            <div class="logo">
                <a href="Registration.php" class="home-link">Details</a>
            </div>
        </nav>
    </header>-->
    <svg>
        <defs>
            <g id="home">
                <svg class="svg-icon" viewBox="0 0 20 20">
					<path d="M18.121,9.88l-7.832-7.836c-0.155-0.158-0.428-0.155-0.584,0L1.842,9.913c-0.262,0.263-0.073,0.705,0.292,0.705h2.069v7.042c0,0.227,0.187,0.414,0.414,0.414h3.725c0.228,0,0.414-0.188,0.414-0.414v-3.313h2.483v3.313c0,0.227,0.187,0.414,0.413,0.414h3.726c0.229,0,0.414-0.188,0.414-0.414v-7.042h2.068h0.004C18.331,10.617,18.389,10.146,18.121,9.88 M14.963,17.245h-2.896v-3.313c0-0.229-0.186-0.415-0.414-0.415H8.342c-0.228,0-0.414,0.187-0.414,0.415v3.313H5.032v-6.628h9.931V17.245z M3.133,9.79l6.864-6.868l6.867,6.868H3.133z"></path>
				</svg>
            </g>

            <g id="search">
                <svg class="svg-icon" viewBox="0 0 20 20">
					<path d="M17.218,2.268L2.477,8.388C2.13,8.535,2.164,9.05,2.542,9.134L9.33,10.67l1.535,6.787c0.083,0.377,0.602,0.415,0.745,0.065l6.123-14.74C17.866,2.46,17.539,2.134,17.218,2.268 M3.92,8.641l11.772-4.89L9.535,9.909L3.92,8.641z M11.358,16.078l-1.268-5.613l6.157-6.157L11.358,16.078z"></path>
				</svg>
            </g>

            <g id="map">
                <svg class="svg-icon" viewBox="0 0 20 20">
					<path d="M8.749,9.934c0,0.247-0.202,0.449-0.449,0.449H4.257c-0.247,0-0.449-0.202-0.449-0.449S4.01,9.484,4.257,9.484H8.3C8.547,9.484,8.749,9.687,8.749,9.934 M7.402,12.627H4.257c-0.247,0-0.449,0.202-0.449,0.449s0.202,0.449,0.449,0.449h3.145c0.247,0,0.449-0.202,0.449-0.449S7.648,12.627,7.402,12.627 M8.3,6.339H4.257c-0.247,0-0.449,0.202-0.449,0.449c0,0.247,0.202,0.449,0.449,0.449H8.3c0.247,0,0.449-0.202,0.449-0.449C8.749,6.541,8.547,6.339,8.3,6.339 M18.631,4.543v10.78c0,0.248-0.202,0.45-0.449,0.45H2.011c-0.247,0-0.449-0.202-0.449-0.45V4.543c0-0.247,0.202-0.449,0.449-0.449h16.17C18.429,4.094,18.631,4.296,18.631,4.543 M17.732,4.993H2.46v9.882h15.272V4.993z M16.371,13.078c0,0.247-0.202,0.449-0.449,0.449H9.646c-0.247,0-0.449-0.202-0.449-0.449c0-1.479,0.883-2.747,2.162-3.299c-0.434-0.418-0.714-1.008-0.714-1.642c0-1.197,0.997-2.246,2.133-2.246s2.134,1.049,2.134,2.246c0,0.634-0.28,1.224-0.714,1.642C15.475,10.331,16.371,11.6,16.371,13.078M11.542,8.137c0,0.622,0.539,1.348,1.235,1.348s1.235-0.726,1.235-1.348c0-0.622-0.539-1.348-1.235-1.348S11.542,7.515,11.542,8.137 M15.435,12.629c-0.214-1.273-1.323-2.246-2.657-2.246s-2.431,0.973-2.644,2.246H15.435z"></path>
				</svg>
            </g>

            <g id="planner">
                <svg class="svg-icon" viewBox="0 0 20 20">
                    <path fill="none" d="M18.271,9.212H3.615l4.184-4.184c0.306-0.306,0.306-0.801,0-1.107c-0.306-0.306-0.801-0.306-1.107,0
	                    L1.21,9.403C1.194,9.417,1.174,9.421,1.158,9.437c-0.181,0.181-0.242,0.425-0.209,0.66c0.005,0.038,0.012,0.071,0.022,0.109
	                    c0.028,0.098,0.075,0.188,0.142,0.271c0.021,0.026,0.021,0.061,0.045,0.085c0.015,0.016,0.034,0.02,0.05,0.033l5.484,5.483
	                    c0.306,0.307,0.801,0.307,1.107,0c0.306-0.305,0.306-0.801,0-1.105l-4.184-4.185h14.656c0.436,0,0.788-0.353,0.788-0.788
	                    S18.707,9.212,18.271,9.212z">
                    </path>
                </svg>
            </g>

            <g id="password">
                <svg class="svg-icon" viewBox="0 0 20 20">
					<path fill="none" d="M19.404,6.65l-5.998-5.996c-0.292-0.292-0.765-0.292-1.056,0l-2.22,2.22l-8.311,8.313l-0.003,0.001v0.003l-0.161,0.161c-0.114,0.112-0.187,0.258-0.21,0.417l-1.059,7.051c-0.035,0.233,0.044,0.47,0.21,0.639c0.143,0.14,0.333,0.219,0.528,0.219c0.038,0,0.073-0.003,0.111-0.009l7.054-1.055c0.158-0.025,0.306-0.098,0.417-0.211l8.478-8.476l2.22-2.22C19.695,7.414,19.695,6.941,19.404,6.65z M8.341,16.656l-0.989-0.99l7.258-7.258l0.989,0.99L8.341,16.656z M2.332,15.919l0.411-2.748l4.143,4.143l-2.748,0.41L2.332,15.919z M13.554,7.351L6.296,14.61l-0.849-0.848l7.259-7.258l0.423,0.424L13.554,7.351zM10.658,4.457l0.992,0.99l-7.259,7.258L3.4,11.715L10.658,4.457z M16.656,8.342l-1.517-1.517V6.823h-0.003l-0.951-0.951l-2.471-2.471l1.164-1.164l4.942,4.94L16.656,8.342z"></path>
				</svg>
            </g>
        </defs>
    </svg>

    <nav class="nav__cont">
        <li class="nav__items"><div class="logo">
            <?php 
                if($pic == -1) {
                    echo "<img src='../images/add.png' class='img' onclick='triggerFileInput()''>";
                }
                
                else {
                    $sql = "SELECT * FROM profile_pic WHERE roll_no = '$userId'";
                    $result = mysqli_query($conn, $sql);
                    if($result) {
                        $profilePhotoPath = mysqli_fetch_assoc($result);
                    }
                    echo '<img class="img" onclick="triggerFileInput()" src="uploads/' . $profilePhotoPath["pic"] . '">';
                }
            ?>
        </div>
        <div class="logo">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="file" id="fileSelect" class="file-css">
                <input type="submit" name="submit" id="fileUpload" value="Upload" class="upload-css">
            </form>
        </div>
        </li>
        <ul class="nav">
        <li class="nav__items ">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
            <use xlink:href="#home"></use>
          </svg>
          <a href="home.php">Home</a>
        </li>
                                
        <li class="nav__items ">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
            <use xlink:href="#map"></use>
          </svg>
         <a href="Registration.php">Data</a>
        </li>
                    
        <li class="nav__items ">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 35.6">
            <use xlink:href="#password"></use></svg>
            <div class="dropdown">
                <a class="dropbtn" onclick="changePass()">Password</a>
            </div>
        </li>
                
        <li class="nav__items ">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 35.6">
            <use xlink:href="#planner"></use></svg>
          <a href="logout.php">Logout</a>
        </li>

        <!--<li class="nav__items ">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 35.6">
            <use xlink:href="#planner"></use></svg>
          <a onclick="toggleMode()">Dark</a>
        </li>-->
    </ul>
        <div class="ss-logo-div">
            <img src="../images/graylogo.png" class="ss-logo">
        </div>
    </nav>

    <div class="overlayPass" id="overlayPass"></div>
    <div class="change-password-window" id="change-password-window">
        <button onclick="closeWindow()" class="passClose-button"><svg class="svg_icon" viewBox="0 0 20 20">
			<path fill="none" d="M13.864,6.136c-0.22-0.219-0.576-0.219-0.795,0L10,9.206l-3.07-3.07c-0.219-0.219-0.575-0.219-0.795,0
				c-0.219,0.22-0.219,0.576,0,0.795L9.205,10l-3.07,3.07c-0.219,0.219-0.219,0.574,0,0.794c0.22,0.22,0.576,0.22,0.795,0L10,10.795
				l3.069,3.069c0.219,0.22,0.575,0.22,0.795,0c0.219-0.22,0.219-0.575,0-0.794L10.794,10l3.07-3.07
				C14.083,6.711,14.083,6.355,13.864,6.136z M10,0.792c-5.086,0-9.208,4.123-9.208,9.208c0,5.085,4.123,9.208,9.208,9.208
				s9.208-4.122,9.208-9.208C19.208,4.915,15.086,0.792,10,0.792z M10,18.058c-4.451,0-8.057-3.607-8.057-8.057
				c0-4.451,3.606-8.057,8.057-8.057c4.449,0,8.058,3.606,8.058,8.057C18.058,14.45,14.449,18.058,10,18.058z"></path>
			</svg>
        </button>

        <form class="change-password-form" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method = "post">
            <h2>Change Password</h2>
            <input type="password" id="old-password" name="oldPass" placeholder="Old Password" required>
            <input type="password" id="new-password" name="newPass" placeholder="New Password" required>
            <button type="submit" name="newPassword">Submit</button>
        </form>
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
        Roll No: <?php if($personal_details != -1) echo $personal_details['roll_no']; else echo "Data not found!";?>
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
        <i class="fa-brands fa-linkedin"></i>
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
                else echo"0 W's, L student";
            ?>
        </ul>
        <button class="certificate-button" onclick="sportsUpload()" id="sportsCert">Certificate</button>
        <form action="" method="post" enctype="multipart/form-data">
            <input class="upload-button" type="submit" name="sportsUpl" id="sportsUpl" value="upload">
            <input type="file" class="certificate-file" id="sportsFile" name="sportsFile">
        </form>
    </section>

    <!-- Mitesh -->

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
            else echo"0 W's, L student";
        ?>
        </ul>
        <button class="certificate-button" onclick="techUpload()" id="techCert">Certificate</button>
        <form action="" method="post" enctype="multipart/form-data">
            <input class="upload-button" type="submit" name="techUpl" id="techUpl" value="upload">
            <input type="file" class="certificate-file" id="techFile" name="techFile">
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
            else echo"0 W's, L student";
        ?>
        </ul>
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
            else echo"0 W's, L student";
        ?>
        </ul>
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
        <button class="certificate-button" onclick="intUpload()" id="intCert">Certificate</button>
        <form action="" method="post" enctype="multipart/form-data">
            <input class="upload-button" type="submit" name="intUpl" id="intUpl" value="upload">
            <input type="file" class="certificate-file" id="intFile" name="intFile">
        </form>
    </section>
    <br>

    <script src="testscript.js"></script>
</body>
</html>

