<?php
require('fpdf/fpdf.php'); // Include FPDF library

// Function to generate and download the certificate
function generate_certificate($name, $course_name) {
    // Create a new PDF instance
    $pdf = new FPDF();
    $pdf->AddPage();

    // Set PDF title
    $pdf->SetTitle('Certificate of Completion');

    // Set font
    $pdf->SetFont('Arial', 'B', 16);
    
    // Add title to the certificate
    $pdf->Cell(0, 10, 'Certificate of Completion', 0, 1, 'C');
    $pdf->Ln(10);

    // Add the course and user name
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, "This is to certify that", 0, 1, 'C');
    $pdf->Ln(5);
    
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, $name, 0, 1, 'C');
    $pdf->Ln(10);
    
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, "Has successfully completed the course", 0, 1, 'C');
    $pdf->Ln(5);

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, $course_name, 0, 1, 'C');
    $pdf->Ln(15);

    // Add the signature line and date
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Date: ' . date('F j, Y'), 0, 1, 'L');
    $pdf->Cell(0, 10, 'Signature: __________________________', 0, 1, 'L');

    // Output the PDF to the browser for download
    $pdf->Output('D', 'certificate.pdf'); // The 'D' argument forces download
}

// Check if the user has completed the course
if ($_GET['course_complete'] == 'true') {
    // Replace these with the actual user and course information
    $user_name = 'John Doe';  // For example, fetch this from the session or database
    $course_name = 'Basic Computer Skills';

    generate_certificate($user_name, $course_name); // Call the function to generate certificate
}
?>
