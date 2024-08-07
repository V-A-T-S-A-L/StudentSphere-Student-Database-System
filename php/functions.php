<?php

    function check_login($conn) {

        if(isset($_SESSION['roll_no'])) {

            $id = $_SESSION['roll_no'];
            $query = "SELECT * FROM students WHERE roll_no = '$id' LIMIT 1";

            $result = mysqli_query($conn, $query);

            if($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                return $user_data;
            }
            header("Location: login.php");
            die;
        }
    }

    function getDetails($conn) {

        if(isset($_SESSION['roll_no'])) {

            $id = $_SESSION['roll_no'];
            $query = "SELECT * FROM personal_details WHERE roll_no = '$id'";

            $result = mysqli_query($conn, $query);

            if($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                return $user_data;
            }
            //header("Location: login.php");
            return -1;
            die;
        }
    }

    function getPhoto($conn, $userId) {

        if(isset($_SESSION['roll_no'])) {

            $id = $_SESSION['roll_no'];
            $query = "SELECT * FROM profile_pic WHERE roll_no = '$userId'";

            $result = mysqli_query($conn, $query);

            if($result && mysqli_num_rows($result) > 0) {
                $pic = mysqli_fetch_assoc($result);
                return $pic;
            }
            //header("Location: login.php");
            return -1;
            die;
        }
    }

    function getSportsFile($conn, $userId) {

        if(isset($_SESSION['roll_no'])) {

            $id = $_SESSION['roll_no'];
            $query = "SELECT * FROM sports_certificates WHERE roll_no = '$userId'";

            $result = mysqli_query($conn, $query);

            if($result && mysqli_num_rows($result) > 0) {
                $pic = mysqli_fetch_assoc($result);
                return $pic;
            }
            //header("Location: login.php");
            return -1;
            die;
        }
    }

    function getTechFile($conn, $userId) {

        if(isset($_SESSION['roll_no'])) {

            $id = $_SESSION['roll_no'];
            $query = "SELECT * FROM tech_certificate WHERE roll_no = '$userId'";

            $result = mysqli_query($conn, $query);

            if($result && mysqli_num_rows($result) > 0) {
                $pic = mysqli_fetch_assoc($result);
                return $pic;
            }
            //header("Location: login.php");
            return -1;
            die;
        }
    }

    function getIntFile($conn, $userId) {

        if(isset($_SESSION['roll_no'])) {

            $id = $_SESSION['roll_no'];
            $query = "SELECT * FROM internship_certificate WHERE roll_no = '$userId'";

            $result = mysqli_query($conn, $query);

            if($result && mysqli_num_rows($result) > 0) {
                $pic = mysqli_fetch_assoc($result);
                return $pic;
            }
            //header("Location: login.php");
            return -1;
            die;
        }
    }

    function getCGPA($conn) {

        if(isset($_SESSION['roll_no'])) {

            $id = $_SESSION['roll_no'];
            $query = "SELECT * FROM cgpa WHERE roll_no = '$id' LIMIT 1";

            $result = mysqli_query($conn, $query);

            if($result && mysqli_num_rows($result) > 0) {
                $cgpa_data = mysqli_fetch_assoc($result);
                return $cgpa_data;
            }
            //header("Location: index.php");
            return -1;
            die;
        }
    }

    function check_login_teacher($conn) {

        if(isset($_SESSION['id'])) {

            $id = $_SESSION['id'];
            $query = "SELECT * FROM teachers WHERE id = '$id' LIMIT 1";

            $result = mysqli_query($conn, $query);

            if($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                return $user_data;
            }
            header("Location: teacherlogin.php");
            die;
        }
    }

    function check_login_admin($conn) {

        if(isset($_SESSION['id'])) {

            $id = $_SESSION['id'];
            $query = "SELECT * FROM admin WHERE id = '$id' LIMIT 1";

            $result = mysqli_query($conn, $query);

            if($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                return $user_data;
            }
            header("Location: adminLogin.php");
            die;
        }
    }

    function getCouncil($conn) {

        if(isset($_SESSION['roll_no'])) {

            $id = $_SESSION['roll_no'];
            $query = "SELECT * FROM council WHERE roll_no = '$id' LIMIT 1";

            $result = mysqli_query($conn, $query);

            if($result && mysqli_num_rows($result) > 0) {
                $council_data = mysqli_fetch_assoc($result);
                return $council_data;
            }
            //header("Location: index.php");
            return -1;
            die;
        }
    }

    function getRandomQuote() {
        
        $quotes = [
            "\"A good teacher is like a candle—it consumes itself to light the way for others.\"",
            "\"A teacher takes a hand, opens a mind, and touches a heart.\"",
            "\"Teaching is the key to unlocking the golden door of freedom.\"",
            "\"A great teacher can turn complexity into simplicity.\"",
            "\"A teacher affects eternity; one can never tell where their influence stops.\"",
            "\"A teacher is a compass that activates the magnets of curiosity, knowledge, and wisdom in the pupils.\""
        ];
    
        $randomIndex = array_rand($quotes);
    
        return $quotes[$randomIndex];
    }
?>