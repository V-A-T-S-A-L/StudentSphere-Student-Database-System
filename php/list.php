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

</style>
</head>
<body>

<div class="container">
    <div class="card">
      <div class="card-content">
      <div class="dropdown">
                <button onclick="openMenu()" class="dropbtn"><svg class="svg-icon-profile" viewBox="0 0 20 20">
							    <path fill="none" d="M3.314,4.8h13.372c0.41,0,0.743-0.333,0.743-0.743c0-0.41-0.333-0.743-0.743-0.743H3.314
								  c-0.41,0-0.743,0.333-0.743,0.743C2.571,4.467,2.904,4.8,3.314,4.8z M16.686,15.2H3.314c-0.41,0-0.743,0.333-0.743,0.743
								  s0.333,0.743,0.743,0.743h13.372c0.41,0,0.743-0.333,0.743-0.743S17.096,15.2,16.686,15.2z M16.686,9.257H3.314
								  c-0.41,0-0.743,0.333-0.743,0.743s0.333,0.743,0.743,0.743h13.372c0.41,0,0.743-0.333,0.743-0.743S17.096,9.257,16.686,9.257z"></path>
						    </svg></button>

                <div id ="myDropdown" class="dropdown-content" id="dropdown-content">
                    <a href="cgpalist.php">
                      <svg class="svg-icon" viewBox="0 0 20 20">
							          <path fill="none" d="M9.896,3.838L0.792,1.562v14.794l9.104,2.276L19,16.356V1.562L9.896,3.838z M9.327,17.332L1.93,15.219V3.27
								        l7.397,1.585V17.332z M17.862,15.219l-7.397,2.113V4.855l7.397-1.585V15.219z"></path>
						        </svg>CGPA</a>

                    <a href="sportslist.php">
                      <svg class="svg-icon" viewBox="0 0 20 20">
							          <path fill="none" d="M10,2.531c-4.125,0-7.469,3.344-7.469,7.469c0,4.125,3.344,7.469,7.469,7.469c4.125,0,7.469-3.344,7.469-7.469C17.469,5.875,14.125,2.531,10,2.531 M10,3.776c1.48,0,2.84,0.519,3.908,1.384c-1.009,0.811-2.111,1.512-3.298,2.066C9.914,6.072,9.077,5.017,8.14,4.059C8.728,3.876,9.352,3.776,10,3.776 M6.903,4.606c0.962,0.93,1.82,1.969,2.53,3.112C7.707,8.364,5.849,8.734,3.902,8.75C4.264,6.976,5.382,5.481,6.903,4.606 M3.776,10c2.219,0,4.338-0.418,6.29-1.175c0.209,0.404,0.405,0.813,0.579,1.236c-2.147,0.805-3.953,2.294-5.177,4.195C4.421,13.143,3.776,11.648,3.776,10 M10,16.224c-1.337,0-2.572-0.426-3.586-1.143c1.079-1.748,2.709-3.119,4.659-3.853c0.483,1.488,0.755,3.071,0.784,4.714C11.271,16.125,10.646,16.224,10,16.224 M13.075,15.407c-0.072-1.577-0.342-3.103-0.806-4.542c0.673-0.154,1.369-0.243,2.087-0.243c0.621,0,1.22,0.085,1.807,0.203C15.902,12.791,14.728,14.465,13.075,15.407 M14.356,9.378c-0.868,0-1.708,0.116-2.515,0.313c-0.188-0.464-0.396-0.917-0.621-1.359c1.294-0.612,2.492-1.387,3.587-2.284c0.798,0.97,1.302,2.187,1.395,3.517C15.602,9.455,14.99,9.378,14.356,9.378"></path>
						        </svg>Sports</a>

                    <a href="techlist.php">
                      <svg class="svg-icon" viewBox="0 0 20 20">
							          <path d="M17.237,3.056H2.93c-0.694,0-1.263,0.568-1.263,1.263v8.837c0,0.694,0.568,1.263,1.263,1.263h4.629v0.879c-0.015,0.086-0.183,0.306-0.273,0.423c-0.223,0.293-0.455,0.592-0.293,0.92c0.07,0.139,0.226,0.303,0.577,0.303h4.819c0.208,0,0.696,0,0.862-0.379c0.162-0.37-0.124-0.682-0.374-0.955c-0.089-0.097-0.231-0.252-0.268-0.328v-0.862h4.629c0.694,0,1.263-0.568,1.263-1.263V4.319C18.5,3.625,17.932,3.056,17.237,3.056 M8.053,16.102C8.232,15.862,8.4,15.597,8.4,15.309v-0.89h3.366v0.89c0,0.303,0.211,0.562,0.419,0.793H8.053z M17.658,13.156c0,0.228-0.193,0.421-0.421,0.421H2.93c-0.228,0-0.421-0.193-0.421-0.421v-1.263h15.149V13.156z M17.658,11.052H2.509V4.319c0-0.228,0.193-0.421,0.421-0.421h14.308c0.228,0,0.421,0.193,0.421,0.421V11.052z"></path>
						        </svg>Tech</a>

                    <a href="councillist.php">
                      <svg class="svg-icon" viewBox="0 0 20 20">
							          <path d="M15.573,11.624c0.568-0.478,0.947-1.219,0.947-2.019c0-1.37-1.108-2.569-2.371-2.569s-2.371,1.2-2.371,2.569c0,0.8,0.379,1.542,0.946,2.019c-0.253,0.089-0.496,0.2-0.728,0.332c-0.743-0.898-1.745-1.573-2.891-1.911c0.877-0.61,1.486-1.666,1.486-2.812c0-1.79-1.479-3.359-3.162-3.359S4.269,5.443,4.269,7.233c0,1.146,0.608,2.202,1.486,2.812c-2.454,0.725-4.252,2.998-4.252,5.685c0,0.218,0.178,0.396,0.395,0.396h16.203c0.218,0,0.396-0.178,0.396-0.396C18.497,13.831,17.273,12.216,15.573,11.624 M12.568,9.605c0-0.822,0.689-1.779,1.581-1.779s1.58,0.957,1.58,1.779s-0.688,1.779-1.58,1.779S12.568,10.427,12.568,9.605 M5.06,7.233c0-1.213,1.014-2.569,2.371-2.569c1.358,0,2.371,1.355,2.371,2.569S8.789,9.802,7.431,9.802C6.073,9.802,5.06,8.447,5.06,7.233 M2.309,15.335c0.202-2.649,2.423-4.742,5.122-4.742s4.921,2.093,5.122,4.742H2.309z M13.346,15.335c-0.067-0.997-0.382-1.928-0.882-2.732c0.502-0.271,1.075-0.429,1.686-0.429c1.828,0,3.338,1.385,3.535,3.161H13.346z"></path>
						        </svg>Council</a>

                    <a href="projectlist.php">
                      <svg class="svg-icon" viewBox="0 0 20 20">
                        <path fill="none" d="M7.228,11.464H1.996c-0.723,0-1.308,0.587-1.308,1.309v5.232c0,0.722,0.585,1.308,1.308,1.308h5.232
		                    c0.723,0,1.308-0.586,1.308-1.308v-5.232C8.536,12.051,7.95,11.464,7.228,11.464z M7.228,17.351c0,0.361-0.293,0.654-0.654,0.654
		                    H2.649c-0.361,0-0.654-0.293-0.654-0.654v-3.924c0-0.361,0.292-0.654,0.654-0.654h3.924c0.361,0,0.654,0.293,0.654,0.654V17.351z
		                     M17.692,11.464H12.46c-0.723,0-1.308,0.587-1.308,1.309v5.232c0,0.722,0.585,1.308,1.308,1.308h5.232
		                    c0.722,0,1.308-0.586,1.308-1.308v-5.232C19,12.051,18.414,11.464,17.692,11.464z M17.692,17.351c0,0.361-0.293,0.654-0.654,0.654
		                    h-3.924c-0.361,0-0.654-0.293-0.654-0.654v-3.924c0-0.361,0.293-0.654,0.654-0.654h3.924c0.361,0,0.654,0.293,0.654,0.654V17.351z
		                     M7.228,1H1.996C1.273,1,0.688,1.585,0.688,2.308V7.54c0,0.723,0.585,1.308,1.308,1.308h5.232c0.723,0,1.308-0.585,1.308-1.308
		                    V2.308C8.536,1.585,7.95,1,7.228,1z M7.228,6.886c0,0.361-0.293,0.654-0.654,0.654H2.649c-0.361,0-0.654-0.292-0.654-0.654V2.962
		                    c0-0.361,0.292-0.654,0.654-0.654h3.924c0.361,0,0.654,0.292,0.654,0.654V6.886z M17.692,1H12.46c-0.723,0-1.308,0.585-1.308,1.308
		                    V7.54c0,0.723,0.585,1.308,1.308,1.308h5.232C18.414,8.848,19,8.263,19,7.54V2.308C19,1.585,18.414,1,17.692,1z M17.692,6.886
		                    c0,0.361-0.293,0.654-0.654,0.654h-3.924c-0.361,0-0.654-0.292-0.654-0.654V2.962c0-0.361,0.293-0.654,0.654-0.654h3.924
		                    c0.361,0,0.654,0.292,0.654,0.654V6.886z"></path>
                    </svg>Projects</a>

                    <a href="patentlist.php">
                      <svg class="svg-icon" viewBox="0 0 20 20">
							          <path fill="none" d="M17.222,5.041l-4.443-4.414c-0.152-0.151-0.356-0.235-0.571-0.235h-8.86c-0.444,0-0.807,0.361-0.807,0.808v17.602c0,0.448,0.363,0.808,0.807,0.808h13.303c0.448,0,0.808-0.36,0.808-0.808V5.615C17.459,5.399,17.373,5.192,17.222,5.041zM15.843,17.993H4.157V2.007h7.72l3.966,3.942V17.993z"></path>
							          <path fill="none" d="M5.112,7.3c0,0.446,0.363,0.808,0.808,0.808h8.077c0.445,0,0.808-0.361,0.808-0.808c0-0.447-0.363-0.808-0.808-0.808H5.92C5.475,6.492,5.112,6.853,5.112,7.3z"></path>
							          <path fill="none" d="M5.92,5.331h4.342c0.445,0,0.808-0.361,0.808-0.808c0-0.446-0.363-0.808-0.808-0.808H5.92c-0.444,0-0.808,0.361-0.808,0.808C5.112,4.97,5.475,5.331,5.92,5.331z"></path>
							          <path fill="none" d="M13.997,9.218H5.92c-0.444,0-0.808,0.361-0.808,0.808c0,0.446,0.363,0.808,0.808,0.808h8.077c0.445,0,0.808-0.361,0.808-0.808C14.805,9.58,14.442,9.218,13.997,9.218z"></path>
							          <path fill="none" d="M13.997,11.944H5.92c-0.444,0-0.808,0.361-0.808,0.808c0,0.446,0.363,0.808,0.808,0.808h8.077c0.445,0,0.808-0.361,0.808-0.808C14.805,12.306,14.442,11.944,13.997,11.944z"></path>
							          <path fill="none" d="M13.997,14.67H5.92c-0.444,0-0.808,0.361-0.808,0.808c0,0.447,0.363,0.808,0.808,0.808h8.077c0.445,0,0.808-0.361,0.808-0.808C14.805,15.032,14.442,14.67,13.997,14.67z"></path>
						        </svg>Patents</a>

                    <a href="internshiplist.php">
                      <svg class="svg-icon" viewBox="0 0 20 20">
							          <path fill="none" d="M16.852,5.051h-4.018c0.131-0.225,0.211-0.482,0.211-0.761V3.528c0-0.841-0.682-1.522-1.521-1.522H8.478c-0.841,0-1.523,0.682-1.523,1.522V4.29c0,0.279,0.081,0.537,0.211,0.761H3.148c-0.841,0-1.522,0.682-1.522,1.523v9.897c0,0.842,0.682,1.523,1.522,1.523h13.704c0.842,0,1.523-0.682,1.523-1.523V6.574C18.375,5.733,17.693,5.051,16.852,5.051zM7.716,3.528c0-0.42,0.341-0.761,0.762-0.761h3.045c0.42,0,0.762,0.341,0.762,0.761V4.29c0,0.421-0.342,0.761-0.762,0.761H8.478c-0.42,0-0.762-0.34-0.762-0.761V3.528z M17.615,16.471c0,0.422-0.342,0.762-0.764,0.762H3.148c-0.42,0-0.761-0.34-0.761-0.762V9.62h15.228V16.471z M17.615,8.858H2.387V6.574c0-0.421,0.341-0.761,0.761-0.761h13.704c0.422,0,0.764,0.34,0.764,0.761V8.858z"></path>
						        </svg>Internships</a>
                </div>
            </div>
      <a href="teacherhomepage1.php"><button class="btn"><i class="fa fa-home"></i></button></a>
        <h2>List of Students</h2><br>
      </div>
          <table>
            <tr>
              <th>Roll Number </th>
              <th>Name</th>
              <th>Profile Photo</th>
            </tr>
            <?php 
              
                  //$sql = "SELECT * FROM personal_details";
                  $sql = "SELECT * FROM students";
                  $result = mysqli_query($conn, $sql);
                  //$name = "SELECT * FROM personal_details";
                  //$nameResult = mysqli_query($conn, $name);

                  if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                          ?><tr><td><li><?php echo $row["roll_no"];?></li></td><td><?php 
                            $roll = $row["roll_no"];
                            $name = "SELECT * FROM personal_details WHERE roll_no = '$roll'";
                            $nameResult = mysqli_query($conn, $name);

                            if($nameResult->num_rows > 0) {
                              $nameAssoc = mysqli_fetch_assoc($nameResult);
                              $username = $nameAssoc["name"];
                              echo "<a href='studentDisplay.php?id=$roll' class='name-text'>$username</a>";
                            }

                            else {
                              echo "<a href='studentDisplay.php?id=$roll' class='name-text'>--</a>";
                            }
                          ?></td>
                          
                          <td><?php
                            $userId = $row["roll_no"];
                            $pic = getPhoto($conn, $userId);

                            if($pic == -1) {
                              echo "<img src='../images/blankprofile.jpg' class='img'>";
                            }
              
                            else {
                              echo '<img class="img" src="uploads/' . $pic["pic"] . '">';
                            }
                          ?>
                          </td></tr><?php
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