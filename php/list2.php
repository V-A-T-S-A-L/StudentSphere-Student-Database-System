<?php
    session_start();

    include("database.php");
    include("functions.php");

    $user_data = check_login_teacher($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>List of Students</title>
<style>
*{
    margin: 0;
    padding: 0;
    font-family: 'Poppins',sans-serif;
    box-sizing: border-box;
}
    .container {
    width: 100%;
    min-height: 100vh;
    background-image: url(back.avif);
    background-size: cover;
    background-position: center;
    padding: 10px 8%;
    }
    h2 {
        text-align: center;
        color: rgb(0, 4, 8);
        padding: 10px;
    }
    .student-list {
        list-style: none;
        padding: 0;
    }
    .student-list li {
        border-bottom: 1px solid #ccc;
        padding: 10px 0;
    }
    .student-list li:last-child {
        border-bottom: none;
    }
    .student {
        display: flex;
        align-items: center;
    }


    .container {
        display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #dedcdc; 

}

.card {
    width: 60%;
  height: 500px;
 
  background-color: rgb(203 203 203 / 42%);
  backdrop-filter: blur(10px); 
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(18, 18, 18, 0.111);
  overflow: hidden;
  transition: all 0.3s;

}

.card:hover {
  box-shadow: 0 4px 8px rgba(18, 18, 18, 0.5);
}

.card-content {
  padding: 20px;
}

.card-content h2 {
  margin-top: 0;
}

.card-content p {
  margin-bottom: 0;
}
table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  padding: 8px;
  text-align: center;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #f2f2f2;
}

.dropdown {
        position: relative;
        display: inline-block;
        padding: 5px;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        z-index: 1;
        width: 725px;
        border-radius: 20px;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #f1f1f1;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown:hover .dropbtn {
        background-color: #3e8e41;
    }

    .dropbtn{
        display : block;
        width: 725px;
        padding: 10px;
        border-radius: 20px;
    }
    .arrow-down {
        width: 0;
        height: 0;
        border-left: 8px solid transparent;
        border-right: 8px solid transparent;
        border-top: 8px solid black;
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
    }


</style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-content">
            <div class="dropdown">
                <button onclick="myFunction()" class="dropbtn">CGPA</button>
                <div id ="myDropdown" class="dropdown-content">
                    <a href="Student1.html">Item 1</a>
                    <a href="#">Item 2</a>
                    <a href="#">Item 3</a>
                </div>
            </div>
          <h2>List of Students</h2>
          <table>
            <tr>
              <th>Name</th>
              <th>Roll Number </th>
              <th>Participating Event</th>
            </tr>
          </table>
  
        <!-- Add more students as needed -->
    </ul>
</div>
</div>
</div>
<script>
    function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
    
    </script>

</body>



</html>