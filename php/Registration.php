<?php
session_start();

    include("database.php");
    include("functions.php");

    $user_data = check_login($conn);
    $roll_no = $user_data['roll_no'];
    $sql = "SELECT roll_no FROM personal_details WHERE roll_no = $roll_no";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo '<script>alert("Details cannot be changed multiple times!")</script>';
        //header("Location: index.php");
        die;
    }
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $roll_no = $user_data['roll_no'];
        $name = $_POST['fullName'];
        $email = $_POST['email'];
        $github = $_POST['github'];
        $linkedin = $_POST['linkedin'];
        $contact = $_POST['phoneNumber'];
        $address = $_POST['address'];

        $query = "INSERT INTO personal_details (roll_no, name, email, github, linkedin,	contact, address) VALUES ('$roll_no', '$name', '$email', '$github', '$linkedin', '$contact', '$address')";
        $result1 = mysqli_query($conn, $query);

        foreach ($_POST['achievement'] as $key => $value) {
            $sql = "INSERT INTO sports (rollno, achievement) VALUES ('$roll_no', '$value')";
            $result = mysqli_query($conn, $sql);
        }

        foreach ($_POST['techComp'] as $key => $value) {
            $sql = "INSERT INTO tech_comp (roll_no, description) VALUES ('$roll_no', '$value')";
            $result = mysqli_query($conn, $sql);
        }

        foreach ($_POST['patent'] as $key => $value) {
            $sql = "INSERT INTO patent (roll_no, description) VALUES ('$roll_no', '$value')";
            $result = mysqli_query($conn, $sql);
        }

        foreach ($_POST['project'] as $key => $value) {
            $sql = "INSERT INTO project (roll_no, description) VALUES ('$roll_no', '$value')";
            $result = mysqli_query($conn, $sql);
        }

        foreach ($_POST['companyName'] as $key => $value) {
            $name = $value;
            $role = $_POST['role'][$key];
            $sql = "INSERT INTO internship (roll_no, company_name, role) VALUES ('$roll_no', '$name', '$role')";
            $result = mysqli_query($conn, $sql);
        }

        foreach ($_POST['councilName'] as $key => $value) {
            $name = $value;
            $role = $_POST['position'][$key];
            $sql = "INSERT INTO council (roll_no, council_name, position) VALUES ('$roll_no', '$name', '$role')";
            $result = mysqli_query($conn, $sql);
        }

        if (isset($_POST["submit"]) && isset($_FILES["sportsFile"])) {
            $filename = $_FILES["sportsFile"]["name"];
            $fileData = file_get_contents($_FILES["sportsFile"]["tmp_name"]);
        
            $stmt = $conn->prepare("INSERT INTO sports_certificates (roll_no, sports_pdf) VALUES (?, ?)");
            $stmt->bind_param("sb", $filename, $fileData);
            
            if ($stmt->execute()) {
                echo "PDF uploaded successfully.";
            } else {
                echo "Error uploading PDF.";
            }
        
            $stmt->close();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration Form</title>
<style>
    body {
        font-family: Arial, sans-serif;
        /*background-color: #010c1a;*/
        background-image: linear-gradient(rgba(0,0,0,0.75),rgba(0,0,0,0.75)),url(../images/back.avif);

        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .container {
        width: 90%; /* Increased width */
        max-width: 800px; /* Maximum width */
        padding: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 1);
    }
    h2 {
        text-align: center;
    }
    .slide {
        display: none;
    }
    .active-slide {
        display: block;
    }
    .button-container {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }
    .button {
        padding: 15px 30px; /* Increased button padding */
        background-color: #4caf50;
        color: white;
        /*border: none;*/
        border-color: black;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px; /* Increased button font size */
    }
    label {
        display: block;
        margin-bottom: 10px; /* Increased label margin */
        font-size: 18px; /* Increased label font size */
    }
    input[type="text"],
    input[type="email"],
    input[type="file"],
    textarea,
    select {
        width: calc(100% - 22px);
        padding: 15px; /* Increased input padding */
        margin: 5px 0 20px; /* Increased input margin */
        border: 1px solid #000000;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 16px; /* Increased input font size */
    }
</style>
</head>
<body>

<div class="container">
    <h2>Details <?php echo $user_data['roll_no'];?></h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <!-- Slide 1: Personal Details -->
        <div class="slide active-slide" id="personalDetails">
            <label for="fullName">Full Name</label>
            <input type="text" id="fullName" name="fullName" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <div class="button-container">
                <button type="button" class="button" onclick="nextSlide()">Next</button>
            </div>
        </div>

        <!-- Slide 2: Socials -->
        <div class="slide" id="socials">
            <label for="github">GitHub Profile</label>
            <input type="text" id="github" name="github">

            <label for="linkedin">LinkedIn Profile</label>
            <input type="text" id="linkedin" name="linkedin">

            <div class="button-container">
                <button type="button" class="button" onclick="prevSlide()">Previous</button>
                <button type="button" class="button" onclick="nextSlide()">Next</button>
            </div>
        </div>

        <!-- Slide 3: Contact Information -->
        <div class="slide" id="contactInformation">
            <label for="phoneNumber">Phone Number</label>
            <input type="text" id="phoneNumber" name="phoneNumber" required>

            <label for="address">Address</label>
            <input type="text" id="address" name="address" required>

            <div class="button-container">
                <button type="button" class="button" onclick="prevSlide()">Previous</button>
                <button type="button" class="button" onclick="nextSlide()">Next</button>
            </div>
        </div>

        <!-- Slide 4: Sports Achievements -->
        <div class="slide" id="sportsAchievements">
            <div id="achievementsContainer">
                <div class="achievement-input">
                    <label>Sports Achievements</label>
                    <br>
                    <label for="achievement">Achievement 1</label>
                    <textarea id="achievement1" name="achievement[]" required></textarea>
                </div>
            </div>
            
            <button type="button" class="button" id="addAchievementButton">Add Achievement</button>
            
            <div class="button-container">
                <button type="button" class="button" onclick="prevSlide()">Previous</button>
                <button type="button" class="button" onclick="nextSlide()">Next</button>
            </div>
        </div>

        <!-- Slide 5: Hackathon Participation -->
        <div class="slide" id="hackathonParticipation">
            <div id="hackathonContainer">
                <div class="hackathon-input">
                <label>Technical Events</label>
                <br>
                    <label for="hackathonDescription">1. Name and Description</label>
                    <textarea id="hackathonDescription1" name="techComp[]" required></textarea>
                </div>
            </div>
            <button type="button" class="button" id="addHackathonButton">Add Hackathon</button>

            <div class="button-container">
                <button type="button" class="button" onclick="prevSlide()">Previous</button>
                <button type="button" class="button" onclick="nextSlide()">Next</button>
            </div>
        </div>

        <!-- Slide 6: Patent Filed -->
        <div class="slide" id="patentFiled">
            <div id="patentContainer">
                <div class="patent-input">
                <label>Patents</label>
                <br>
                    <label for="patentDescription">1. Name and Description</label>
                    <textarea id="patentDescription1" name="patent[]" required></textarea>
                </div>
            </div>
            <button type="button" class="button" id="addPatentButton">Add Patent</button>

            <div class="button-container">
                <button type="button" class="button" onclick="prevSlide()">Previous</button>
                <button type="button" class="button" onclick="nextSlide()">Next</button>
            </div>
        </div>

        <!-- Slide 7: Mini Projects -->
        <div class="slide" id="miniProjects">
            <div id="miniProjectContainer">
                <div class="mini-project-input">
                <label>Mini Projects</label>
                <br>
                    <label for="projectDescription">1. Name and Description</label>
                    <textarea id="projectDescription1" name="project[]" required></textarea>
                </div>
            </div>
            <button type="button" class="button" id="addMiniProjectButton">Add Mini Project</button>

            <div class="button-container">
                <button type="button" class="button" onclick="prevSlide()">Previous</button>
                <button type="button" class="button" onclick="nextSlide()">Next</button>
            </div>
        </div>

        <!-- Slide 8: Internships -->
        <div class="slide" id="internships">
            <div id="internshipContainer">
                <div class="internship-input">
                <label>Internships</label>
                <br>
                    <label for="companyName">1. Company Name</label>
                    <input type="text" id="companyName1" name="companyName[]" required>

                    <label for="role">Role</label>
                    <input type="text" id="role1" name="role[]" required>
                </div>
            </div>
            <button type="button" class="button" id="addInternshipButton">Add Internship</button>

            <div class="button-container">
                <button type="button" class="button" onclick="prevSlide()">Previous</button>
                <button type="button" class="button" onclick="nextSlide()">Next</button>
            </div>
        </div>

        <!-- Slide 9: Council Membership -->
        <div class="slide" id="councilMembership">
            <div id="councilContainer">
                <div class="council-input">
                <label>Councils</label>
                <br>
                    <label for="councilName">1. Council Name</label>
                    <input type="text" id="councilName1" name="councilName[]" required>

                    <label for="position">Position</label>
                    <input type="text" id="position1" name="position[]" required>
                </div>
            </div>
            <button type="button" class="button" id="addCouncilButton">Add Council</button>

            <div class="button-container">
                <button type="button" class="button" onclick="prevSlide()">Previous</button>
                <button type="submit" class="button">Submit</button>
            </div>
        </div>
    </form>
</div>

<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');

    function showSlide(slideIndex) {
        slides.forEach((slide, index) => {
            if (index === slideIndex) {
                slide.classList.add('active-slide');
            } else {
                slide.classList.remove('active-slide');
            }
        });
    }

    function nextSlide() {
        if (currentSlide < slides.length - 1) {
            currentSlide++;
            showSlide(currentSlide);
        }
    }

    function prevSlide() {
        if (currentSlide > 0) {
            currentSlide--;
            showSlide(currentSlide);
        }
    }
    document.getElementById('addAchievementButton').addEventListener('click', function() {
        const achievementsContainer = document.getElementById('achievementsContainer');
        const numAchievements = achievementsContainer.querySelectorAll('.achievement-input').length + 1;
        const newAchievementInput = document.createElement('div');
        newAchievementInput.classList.add('achievement-input');
        newAchievementInput.innerHTML = `
            <label for="achievement">Achievement ${numAchievements}</label>
            <textarea id="achievement${numAchievements}" name="achievement[]" required></textarea>
        `;
        achievementsContainer.appendChild(newAchievementInput);
    });

    document.getElementById('addHackathonButton').addEventListener('click', function() {
        const hackathonContainer = document.getElementById('hackathonContainer');
        const numHackathons = hackathonContainer.querySelectorAll('.hackathon-input').length + 1;
        const newHackathonInput = document.createElement('div');
        newHackathonInput.classList.add('hackathon-input');
        newHackathonInput.innerHTML = `
            <label for="hackathonDescription">${numHackathons}. Name and Description</label>
            <textarea id="hackathonDescription${numHackathons}" name="techComp[]" required></textarea>
        `;
        hackathonContainer.appendChild(newHackathonInput);
    });

    document.getElementById('addPatentButton').addEventListener('click', function() {
        const patentContainer = document.getElementById('patentContainer');
        const numPatents = patentContainer.querySelectorAll('.patent-input').length + 1;
        const newPatentInput = document.createElement('div');
        newPatentInput.classList.add('patent-input');
        newPatentInput.innerHTML = `
            <label for="patentDescription">${numPatents}. Name and Description</label>
            <textarea id="patentDescription${numPatents}" name="patent[]" required></textarea>
        `;
        patentContainer.appendChild(newPatentInput);
    });

    document.getElementById('addMiniProjectButton').addEventListener('click', function() {
        const miniProjectContainer = document.getElementById('miniProjectContainer');
        const numProjects = miniProjectContainer.querySelectorAll('.mini-project-input').length + 1;
        const newProjectInput = document.createElement('div');
        newProjectInput.classList.add('mini-project-input');
        newProjectInput.innerHTML = `
            <label for="projectDescription">${numProjects}. Name and Description</label>
            <textarea id="projectDescription${numProjects}" name="project[]" required></textarea>
        `;
        miniProjectContainer.appendChild(newProjectInput);
    });

    document.getElementById('addInternshipButton').addEventListener('click', function() {
        const internshipContainer = document.getElementById('internshipContainer');
        const numInternships = internshipContainer.querySelectorAll('.internship-input').length + 1;
        const newInternshipInput = document.createElement('div');
        newInternshipInput.classList.add('internship-input');
        newInternshipInput.innerHTML = `
            <label for="companyName">${numInternships}. Company Name</label>
            <input type="text" id="companyName${numInternships}" name="companyName[]" required>

            <label for="role">Role</label>
            <input type="text" id="role${numInternships}" name="role[]" required>
        `;
        internshipContainer.appendChild(newInternshipInput);
    });

    document.getElementById('addCouncilButton').addEventListener('click', function() {
        const councilContainer = document.getElementById('councilContainer');
        const numCouncils = councilContainer.querySelectorAll('.council-input').length + 1;
        const newCouncilInput = document.createElement('div');
        newCouncilInput.classList.add('council-input');
        newCouncilInput.innerHTML = `
            <label for="councilName">${numCouncils}. Council Name</label>
            <input type="text" id="councilName${numCouncils}" name="councilName[]" required>

            <label for="position">Position</label>
            <input type="text" id="position${numCouncils}" name="position[]" required>
        `;
        councilContainer.appendChild(newCouncilInput);
    });
</script>

</body>
</html>
