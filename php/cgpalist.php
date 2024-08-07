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
<link rel="stylesheet">
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
    width: 70%;
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
  transform: scale(1.01);
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

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        z-index: 1;
        width: 125px;
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
        width: 125px;
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

::-webkit-scrollbar {
        width: 0px; /* width of the scrollbar */
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

</style>
</head>
<body>

<div class="container">
    <div class="card">
      <div class="card-content">
      
      <a href="list.php"><button class="btn"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M0 12c0 6.627 5.373 12 12 12s12-5.373 12-12-5.373-12-12-12-12 5.373-12 12zm7.58 0l5.988-5.995 1.414 1.416-4.574 4.579 4.574 4.59-1.414 1.416-5.988-6.006z"/></svg></button></a>
        <h2>List of Students</h2><br>
      </div>
          <table>
            <tr>
              <th>Roll Number </th>
              <th>Name</th>
              <th>Sem 1</th>
              <th>Sem 2</th>
              <th>Sem 3</th>
              <th>Sem 4</th>
              <th>Sem 5</th>
              <th>Sem 6</th>
              <th>Sem 7</th>
              <th>Sem 8</th>
            </tr>
            <?php 
              
                  //$sql = "SELECT * FROM personal_details";
                  $sql = "SELECT * FROM cgpa ORDER BY roll_no";
                  $result = mysqli_query($conn, $sql);
                  //$name = "SELECT * FROM personal_details";
                  //$nameResult = mysqli_query($conn, $name);

                  if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                          ?><tr><td><?php echo $row["roll_no"];?></td><td><?php 
                          $roll = $row["roll_no"];
                          $name = "SELECT * FROM personal_details WHERE roll_no = '$roll'";
                          $nameResult = mysqli_query($conn, $name);

                          if($nameResult->num_rows > 0) {
                            $nameAssoc = mysqli_fetch_assoc($nameResult);
                            $username = $nameAssoc["name"];
                            echo "<li><a href='studentDisplay.php?id=$roll' class='name-text'>$username</a></li>";
                          }

                          else {
                            echo "<li><a href='studentDisplay.php?id=$roll' class='name-text'>--</a></li>";
                          }
                        ?></td><td><?php 
                            if($row['sem1'] != 0) echo $row['sem1']; else echo "--";
                          ?></td>
                          <td><?php 
                            if($row['sem2'] != 0) echo $row['sem2']; else echo "--";
                          ?></td>
                          <td><?php 
                            if($row['sem3'] != 0) echo $row['sem3']; else echo "--";
                          ?></td>
                          <td><?php 
                            if($row['sem4'] != 0) echo $row['sem4']; else echo "--";
                          ?></td>
                          <td><?php 
                            if($row['sem5'] != 0) echo $row['sem5']; else echo "--";
                          ?></td>
                          <td><?php 
                            if($row['sem6'] != 0) echo $row['sem6']; else echo "--";
                          ?></td>
                          <td><?php 
                            if($row['sem7'] != 0) echo $row['sem7']; else echo "--";
                          ?></td>
                          <td><?php 
                            if($row['sem8'] != 0) echo $row['sem8']; else echo "--";
                          ?></td>
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