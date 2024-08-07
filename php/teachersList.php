<?php
    session_start();

    include("database.php");
    include("functions.php");

    $user_data = check_login_teacher($conn);
?>

<script>
    function openMenu() {
      var block = document.getElementById("myDropdown"); 

        if(block.style.display === 'block') {
            block.style.display = 'none';
        } else {
            block.style.display = 'block';
        }
    }
</script>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    background-image: linear-gradient(rgba(0,0,0,0.75),rgba(0,0,0,0.75)),url(../images/back.avif);
    background-size: cover;
    background-position: center;
    padding: 10px 8%;
    }
    h2 {
        text-align: center;
        color: rgb(0, 4, 8);
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
 
  background-color: white;

  backdrop-filter: blur(10px); 
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 1);
  overflow: hidden;
  transition: width 0.3s;
  overflow-y: visible;
  scroll-behavior: auto;
}

.name-text {
  text-decoration: none;
  color: black;
}

.card:hover {
  
}

.card-content {
  display: flex;
  align-items: center;
  padding: 20px;
}

.card-content h2 {
  margin-top: 0;
  margin-left: 225px;
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

tr {
  background-color: white;
  transition: all 0.3s;
}

tr:hover {
  background-color: #ddd;
  transform: scale(1.1);
}

.img {
  width: 35px;
  height: 35px;
  border-radius: 50%;
  transition: all 0.3s ease;
  object-fit: cover;
}

.img:hover {
  transform: scale(2);
  border-radius: 15%;
  cursor: none;
}

.btn {
  background-color: white; 
  border: none; 
  color: black; 
  padding: 12px 16px; 
  font-size: 25px; 
  cursor: pointer; 
}

.btn:hover {
  color: royalblue;
}

.dropdown {
        position: absolute;
        display: inline-block;
        padding: 5px;
        margin-left: 575px;
    }

    .dropbtn {
      cursor: pointer;
      font-size: 12px;
      border: none;
      background-color: white;
    }

    .svg-icon-profile {
      width: 2em;
      height: 2em;
      transform: translateX(-525px);
    }

    .svg-icon-profile path,
    .svg-icon-profile polygon,
    .svg-icon-profile rect {
      fill: black;
    }

    rect:hover {
      fill: royalblue;
    }

    .svg-icon-profile circle {
      stroke: black;
      stroke-width: 1;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background: rgba(255, 255, 255, 0.4);
        backdrop-filter: blur(1px);
        -webkit-backdrop-filter: blur(1px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-color: black;
        min-width: 160px;
        box-shadow: 3px 3px 1px 0px rgba(0,0,0,0.5);
        z-index: 1;
        width: 125px;
        border-radius: 20px;
        cursor: pointer;
        transform: translateX(-525px);
    }

    .svg-icon {
      width: 3em;
      height: 1em;
      transform: translateY(0.2em);
    }

    .svg-icon path,
    .svg-icon polygon,
    .svg-icon rect {
      fill: black;
    }

    .svg-icon circle {
      stroke: black;
      stroke-width: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background: rgba(5, 55, 25, 0.4);
        border-radius: 25px;
    }

    /*.dropdown:hover .dropdown-content {
        display: block;
    }*/

    .dropdown:hover .dropbtn {
        background-color: #ddd;
    }

    .dropbtn{
        display : block;
        width: 0px;
        padding: 0px;
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

::-webkit-scrollbar {
        width: 5px; /* width of the scrollbar */
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

    .delete-img {
        height: 25px;
        width: 25px;
        filter:invert();
    }

    .delete-btn {
        border: none;
        background-color: red;
        border-radius: 5px;
    }

</style>
</head>
<body>

<div class="container">
    <div class="card">
      <div class="card-content">
      
      <a href="teacherhomepage1.php"><button class="btn"><i class="fa fa-home"></i></button></a>
        <h2>List of Teachers</h2><br>
      </div>
          <table>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Delete</th>
            </tr>
            <?php 
              
                  //$sql = "SELECT * FROM personal_details";
                  $sql = "SELECT * FROM teachers WHERE admin = 0";
                  $result = mysqli_query($conn, $sql);
                  //$name = "SELECT * FROM personal_details";
                  //$nameResult = mysqli_query($conn, $name);

                  if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                          ?><tr><td><li><?php echo $row["id"];?></li></td><td><?php 
                                echo $row["name"];
                          ?></td>
                          <td><?php $id = $row["id"]; echo "<button class='delete-btn'><a href='deleteTeacher.php?id=$id'><img class='delete-img' src='../images/delete.png'></a></button>";?></td>
                          </tr><?php
                      }
                  }
              
            ?>
          </table>
          <br>
    </ul>
</div>
</div>


</body>
</html>