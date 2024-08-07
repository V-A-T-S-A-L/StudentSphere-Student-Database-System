<?php
    session_start();
    include("database.php");

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        
        $sql = "DELETE FROM teachers WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        header("Location: teachersList.php");
    }
?>