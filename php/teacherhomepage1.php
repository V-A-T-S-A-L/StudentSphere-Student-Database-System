<?php
session_start();

    include("database.php");
    include("functions.php");

    $user_data = check_login_teacher($conn);
    $id = $user_data['id'];

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        if(isset($_POST['searchName'])) {
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
        
        if(isset($_POST['newUsername'])) {
            $name = $_POST['newUser'];
            $sql = "UPDATE teachers SET name='$name' WHERE id='$id'";

            $result = mysqli_query($conn, $sql);
            header("Location: teacherHomePage1.php");
            die;
        }

        if(isset($_POST['newPassword'])) {
            $oldPass = $_POST['oldPass'];
            $newPass = $_POST['newPass'];
            
            $sql = "SELECT password FROM teachers WHERE id='$id'";
            $result = mysqli_query($conn, $sql);

            $assoc = mysqli_fetch_assoc($result);
            $confirmPass = $assoc['password'];

            if($oldPass == $confirmPass) {
                $sql = "UPDATE teachers SET password = '$newPass' WHERE id = '$id'";
                $result = mysqli_query($conn, $sql);
            }
        }
    }
?>

<style>
    .add-text {
        text-decoration: none;
        color: black;
    }

    nav ul li a{
        color: #fff ;
        text-decoration: none;
        transition: all 0.3s;
    }
    nav ul li a:hover {
        color: lightgreen;
    }
</style>


<!DOCTYPE html>
<html>
    <head>
        <title>Display | Teacher</title>
        <link rel="stylesheet"  href="../css/style1.css">
        
    </head>
    <body>
    
        <div class="container">
            <nav>
                <img src="../images/graylogo.png" class="logo">
                
                
            <ul>
                
                <li><a href="home.php">Home</a></li>
                <li><a href="list.php">Students</a></li>
                <?php if($user_data['admin'] == 1) echo "<li><a href='teachersList.php'>Teachers</a></li>"?>
                
                <div class='dropdown'>
                    <button class='dropbtn' onclick='drop()'>Profile</button>
                    <div class='dropdown-content' id='dropdown-content'>
                        <?php 
                            if($user_data['admin'] == 0) {
                                echo"<a onclick='changeName()'>Change Name</a>";
                            }
                        ?>
                        <a onclick='changePass()'>Change password</a>
                    </div>
                </div>
                <?php if($user_data['admin'] == 1) echo "<li><a href='adminLogout.php'>Logout</a></li>";
                        
                        else echo"<li><a href='logoutteacher.php'>Logout</a></li>";?>
            </ul>
            <a href="signup1.php" class="add-text"><button type="submit" class="btn"><img src="../images/add.png">Student</button></a>
            <?php 
                if($user_data['admin'] == 1) {
                    echo "<a href='signup2.php' class='add-text'><button type='submit' class='btn'><img src='../images/add.png'>Teacher</button></a>";
                }
            ?>
            </nav>
            <div class="content">
            <h1>Welcome <?php echo $user_data['name']; ?></h1>

            <p id="quote-text"><?php echo getRandomQuote(); ?></p>
            
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method = "post">
                <input type="text" placeholder="Search Student" name="search">
                <button type="submit" class="btn" name="searchName">Search</button>
            </form>
            
            <!--
            <form action="upload.php" method="post" enctype="multipart/form-data">
            <label for="excelFile">Choose Excel File:</label>
            <input type="file" name="excelFile" id="excelFile" accept=".xls, .xlsx" required>
            <button type="submit">Upload</button>
            </form>
            -->
            
        </div>
    </div>

    <div class="overlay" id="overlay"></div>
    <div class="change-username-window" id="change-username-window">
        <form class="change-username-form" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method = "post">
            <h2>Change Username</h2>
            <input type="text" id="new-username" name="newUser" placeholder="New Username" required>
            <button type="submit" name="newUsername">Submit</button>
        </form>
    </div>

    <div class="overlayPass" id="overlayPass"></div>
    <div class="change-password-window" id="change-password-window">
        <form class="change-password-form" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method = "post">
            <h2>Change Password</h2>
            <input type="password" id="old-password" name="oldPass" placeholder="Old Password" required>
            <input type="password" id="new-password" name="newPass" placeholder="New Password" required>
            <button type="submit" name="newPassword">Submit</button>
        </form>
    </div>
    
</body>
</html>

<script>
    function drop() {
        var block = document.getElementById("dropdown-content"); 

        if(block.style.display === 'block') {
            block.style.display = 'none';
        } else {
            block.style.display = 'block';
        }
    }

    function changeName() {
        document.getElementById("overlay").style.display = "flex";
        document.getElementById("change-username-window").style.display = "flex";
    }

    function changePass() {
        document.getElementById("overlayPass").style.display = "flex";
        document.getElementById("change-password-window").style.display = "flex";
    }
</script>

<style>
    .btn {
        margin-right: 10px;
        color: white;
        transition: all 0.3s;
        border: solid 1px;
        border-color: black;
    }

    .btn:hover {
        color: black;
    }

    .btn img {
        filter: invert();
        mix-blend-mode: screen;
    }

    .overlay {
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
    }

    .change-username-window {
        display: none;
        justify-content: center;
        position: fixed;
        width: 400px;
        background-color: #f9f9f9;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
        padding: 20px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1001; /* Ensure the window is above the overlay */
    }

    .change-username-window h2 {
        padding-bottom: 25px;
    }

    /* Style for form elements */
    .change-username-form label,
    .change-username-form input[type="text"],
    .change-username-form button {
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
    .change-username-form button {
        background-color: #3498db;
        color: white;
        border-color: black;
        border-radius: 5px;
        cursor: pointer;
    }

    .change-username-form input:focus {
        outline: none;
        border-color: #3498db;
        box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
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
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
        padding: 20px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1001; /* Ensure the window is above the overlay */
    }

    .change-password-window h2 {
        padding-bottom: 25px;
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

    .dropbtn {
        background-color: transparent;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
    }

    .dropbtn:hover {
        color: lightgreen;
    }

    /* The container <div> - needed to position the dropdown content */
    .dropdown {
      position: relative;
      display: inline-block;
      cursor: pointer;
    }

    /* Dropdown Content (Hidden by Default) */
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: transparent;
        min-width: 180px;
        box-shadow: 0px 8px 16px 0px rgba(0 0 0 / 50%);
        border-radius: 15px;
        z-index: 1;
        transform: translateX(15px);
    }

    /* Links inside the dropdown */
    .dropdown-content a {
        color: white;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    /* Change color of dropdown links on hover */
    .dropdown-content a:hover {
        background-color: darkslategrey;
        color: lightgreen;
        border-radius: 15px;
    }

    /* Show the dropdown menu on hover 
    .dropdown:hover .dropdown-content {display: block;}*/
</style>