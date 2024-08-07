<?php
    session_start();
    include("database.php");
    include("functions.php");

    require('../FPDF-master/fpdf.php');

    $studentData = check_login($conn);
    $roll_no = $studentData['roll_no']; 

    class PDF extends FPDF {
        // Page header
        function Header() {

            if($this->PageNo() == 1) {
                // Arial bold 15
                $this->SetFont('Arial', 'B', 15);
                // Title
                $this->Cell(0, 10, 'Student Report', 0, 1, 'C');
                // Line break
                $this->Ln(10);
            }
        }
    
        // Page footer
        function Footer() {
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial', 'I', 8);
            // Page number
            $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
        }
    }

    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 12);

    //personal info
    $sql = "SELECT * FROM personal_details WHERE roll_no = '$roll_no'";
    $result = mysqli_query($conn, $sql);

    $personal_details = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) == 0) {
        ?>  
            <style>
                /* Modal styles */
                .modal {
                    background-color: black;
                    display: none;
                    position: fixed;
                    z-index: 1;
                    left: 0;
                    top: 0;
                    width: 100%;
                    height: 100%;
                    overflow: auto;
                }
                .modal-content {
                    background-image: url(../images/404.jpg);
                    background-repeat: no-repeat;
                    background-size: cover;
                    background-position: center;
                    font-size: 30px;
                    color: red;
                    display: flex;
                    margin: 2% auto;
                    padding: 20px;
                    border: 1px solid #888;
                    border-radius: 25px;
                    width: 20%;
                    justify-content: space-around;
                    transition: all 0.3s;
                }
                .modal-content:hover {
                    border-radius: 15px;
                }
                /* Button styles */
                .modal-button {
                    padding: 10px 20px;
                    color: black;
                    margin: 10px;
                    border-radius: 25px;
                    transform: translateY(75px);
                    cursor: pointer;
                    transition: all 0.3s;
                }

                .modal-button:hover {
                    background-color: #ddd;
                }
            </style>
            <div id="myModal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                  <button id="okButton" class="modal-button">OK</button>
                </div>
            </div>
            <script>
                // Get the modal
                var modal = document.getElementById("myModal");

                // Get the OK button
                var okButton = document.getElementById("okButton");

                // Display the modal
                modal.style.display = "block";

                // When the user clicks on OK button, close the modal
                okButton.onclick = function() {
                    modal.style.display = "none";
                    window.close();
                }
            </script>
        <?php
    }

    //$pdf->Rect(5, 25, 180, 50);
    $pdf->Cell(0, 6, "Name:      ".$personal_details['name'], 0, 1);
    $pdf->Cell(0, 6, "Roll No:    ".$roll_no, 0, 1);
    $pdf->Cell(0, 6, "Contact:    " . $personal_details['contact'], 0, 1);
    $pdf->Cell(0, 6, "E-mail:      " . $personal_details['email'], 0, 1);
    $pdf->MultiCell(150, 6, "Address:   " . $personal_details['address'], 0, 1);
    $pdf->ln();

    $pdf->Rect(10, $pdf->GetY(), 190, .2, "F");
    $pdf->ln();

    //image
    $pdf->Rect(159, 29, 29, 29);
    $pic = getPhoto($conn, $roll_no);

    if($pic == -1) {
        $pdf->Cell(40);
        $img = '../images/blankprofile.jpg';
        $pdf->Image($img, 160, 30, 27, 27);
        $pdf->Ln();
    } else { 
        $pdf->Cell(40);
        $pdf->Image("../php/uploads/". $pic['pic'], 160, 30, 27, 27);
        $pdf->Ln();
    }

    //CGPA
    $cgpa = getCGPA($conn);

    $pdf->SetFont('Arial', 'BU', 12);
    $pdf->Cell(0, 10, "CGPA:", 0, 1);

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(23.75, 10, "Sem 1", 1, 0, 'C');
    $pdf->Cell(23.75, 10, "Sem 2", 1, 0, 'C');
    $pdf->Cell(23.75, 10, "Sem 3", 1, 0, 'C');
    $pdf->Cell(23.75, 10, "Sem 4", 1, 0, 'C');
    $pdf->Cell(23.75, 10, "Sem 5", 1, 0, 'C');
    $pdf->Cell(23.75, 10, "Sem 6", 1, 0, 'C');
    $pdf->Cell(23.75, 10, "Sem 7", 1, 0, 'C');
    $pdf->Cell(23.75, 10, "Sem 8", 1, 0, 'C');
    $pdf->ln();

    if($cgpa != -1) {
        $pdf->Cell(23.75, 10, "".$cgpa['sem1'], 1, 0, 'C');
        $pdf->Cell(23.75, 10, "".$cgpa['sem2'], 1, 0, 'C');
        $pdf->Cell(23.75, 10, "".$cgpa['sem3'], 1, 0, 'C');
        $pdf->Cell(23.75, 10, "".$cgpa['sem4'], 1, 0, 'C');
        $pdf->Cell(23.75, 10, "".$cgpa['sem5'], 1, 0, 'C');
        $pdf->Cell(23.75, 10, "".$cgpa['sem6'], 1, 0, 'C');
        $pdf->Cell(23.75, 10, "".$cgpa['sem7'], 1, 0, 'C');
        $pdf->Cell(23.75, 10, "".$cgpa['sem8'], 1, 0, 'C');
    }

    else {
        $pdf->Cell(23.75, 10, "--", 1, 0, 'C');
        $pdf->Cell(23.75, 10, "--", 1, 0, 'C');
        $pdf->Cell(23.75, 10, "--", 1, 0, 'C');
        $pdf->Cell(23.75, 10, "--", 1, 0, 'C');
        $pdf->Cell(23.75, 10, "--", 1, 0, 'C');
        $pdf->Cell(23.75, 10, "--", 1, 0, 'C');
        $pdf->Cell(23.75, 10, "--", 1, 0, 'C');
        $pdf->Cell(23.75, 10, "--", 1, 0, 'C');
    }
    
    $pdf->ln(20);

    $pdf->Rect(10, $pdf->GetY(), 190, .2, "F");
    $pdf->ln();

    //Partcipation in sports 
    $sql = "SELECT * FROM sports WHERE rollno = '$roll_no'";
    $result = mysqli_query($conn, $sql);

    $pdf->SetFont('Arial', 'BU', 12);
    $pdf->Cell(0, 0, "Participation in sports:", 0, 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->ln(10);
    $i = 1;

    while($row = $result->fetch_assoc()) {
        $pdf->Cell(50, 5, "".$i.") ".$row['achievement'], 0, 1);
        $pdf->ln();
        $i++;
    }

    $pdf->Rect(10, $pdf->GetY(), 190, .2, "F");
    $pdf->ln(10);

    //participation in technical events
    $sql = "SELECT * FROM tech_comp WHERE roll_no = '$roll_no'";
    $result = mysqli_query($conn, $sql);

    $pdf->SetFont('Arial', 'BU', 12);
    $pdf->Cell(0, 0, "Participation in technical events:", 0, 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->ln(10);
    $i = 1;

    while($row = $result->fetch_assoc()) {
        $pdf->Cell(50, 5, "".$i.") ".$row['description'], 0, 1);
        $pdf->ln();
        $i++;
    }

    $pdf->Rect(10, $pdf->GetY(), 190, .2, "F");
    $pdf->ln(10);

    //council
    $sql = "SELECT * FROM council WHERE roll_no = '$roll_no'";
    $result = mysqli_query($conn, $sql);

    $pdf->SetFont('Arial', 'BU', 12);
    $pdf->Cell(0, 0, "Part of council:", 0, 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->ln(10);
    $i = 1;
    
    if(mysqli_num_rows($result) > 0) {
        while($row = $result->fetch_assoc()) {
            $pdf->Cell(50, 5, "".$i.") ".$row['council_name'].": ".$row['position'], 0, 1);
            $pdf->ln();
            $i++;
        }
    } else {
        $pdf->Cell(50, 5, "None", 0, 1);
        $pdf->ln();
    }
    
    $pdf->Rect(10, $pdf->GetY(), 190, .2, "F");
    $pdf->ln(10);

    //projects
    $sql = "SELECT * FROM project WHERE roll_no = '$roll_no'";
    $result = mysqli_query($conn, $sql);

    $pdf->SetFont('Arial', 'BU', 12);
    $pdf->Cell(0, 0, "Projects:", 0, 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->ln(10);
    $i = 1;
    
    if(mysqli_num_rows($result) > 0) {
        while($row = $result->fetch_assoc()) {
            $pdf->Cell(50, 5, "".$i.") ".$row['description'], 0, 1);
            $pdf->ln();
            $i++;
        }
    } else {
        $pdf->Cell(50, 5, "None", 0, 1);
        $pdf->ln();
    }
    
    $pdf->Rect(10, $pdf->GetY(), 190, .2, "F");
    $pdf->ln(10);

    //patent
    $sql = "SELECT * FROM patent WHERE roll_no = '$roll_no'";
    $result = mysqli_query($conn, $sql);

    $pdf->SetFont('Arial', 'BU', 12);
    $pdf->Cell(0, 0, "Patents:", 0, 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->ln(10);
    $i = 1;
    
    if(mysqli_num_rows($result) > 0) {
        while($row = $result->fetch_assoc()) {
            $pdf->Cell(50, 5, "".$i.") ".$row['description'], 0, 1);
            $pdf->ln();
            $i++;
        }
    } else {
        $pdf->Cell(50, 5, "None", 0, 1);
        $pdf->ln();
    }
    
    $pdf->Rect(10, $pdf->GetY(), 190, .2, "F");
    $pdf->ln(10);

    //internship
    $sql = "SELECT * FROM internship WHERE roll_no = '$roll_no'";
    $result = mysqli_query($conn, $sql);

    $pdf->SetFont('Arial', 'BU', 12);
    $pdf->Cell(0, 0, "Internships:", 0, 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->ln(10);
    $i = 1;    

    if(mysqli_num_rows($result) > 0) {
        while($row = $result->fetch_assoc()) {
            $pdf->Cell(50, 5, "".$i.") Company name: ".$row['company_name'], 0, 1);
            $pdf->Cell(50, 5, "    Role: ".$row['role'], 0, 1);
            $pdf->ln();
            $i++;
        }
    } else {
        $pdf->Cell(50, 5, "None", 0, 1);
        $pdf->ln();
    }
    
    $pdf->Rect(10, $pdf->GetY(), 190, .2, "F");
    $pdf->ln(10);
    $pdf->output();
    //$filename = $roll_no."_report";
    //$pdf->output('', $filename, '.pdf');
?>