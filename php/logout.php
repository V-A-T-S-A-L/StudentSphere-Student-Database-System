<?php

    if(isset($_SESSION['roll_no'])) {
        unset($_SESSION['roll_no']);
    }
    header("Location: login.php");
    die;
?>