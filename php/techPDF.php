<?php
    session_start();

    include("database.php");
    include("functions.php");

    $user_data = check_login_teacher($conn);

    $student_data = check_login($conn);

    $personal_details = getDetails($conn);
    $roll_no = $personal_details['roll_no'];

    $pdfFile = getTechFile($conn, $roll_no);

    if($pdfFile == -1) {
        echo "No certificates have been uploaded!";
    }

    else {
        $file = "tech/".$pdfFile['tech_pdf'];
        if(file_exists($file)) {


           header('Content-type: application/pdf');

           $file = fopen($file, 'rb');

           fpassthru($file);

           fclose($file);
        } else {
           echo 'PDF file not found.';
        }
    }
?>