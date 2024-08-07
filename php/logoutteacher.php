<?php

    if(isset($_SESSION['id'])) {
        unset($_SESSION['id']);
    }
    header("Location: loginasteacher.php");
    die;
?>