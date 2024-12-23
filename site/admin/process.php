<?php
require_once('fpdf.php'); // Include TCPDF
require '../config/db.php';
// Database connection

// Fetch data from the database

    if(!empty($_POST['options'])){
        $ids = $_POST['options'];// IDs to fetch
    $placeholders = implode(',', $ids);
    $sql = "SELECT fullName, email, uaeNational, membershipType, nationality, emirates_id_number, phone_number FROM members WHERE id IN ($placeholders)";
}else{
    $sql = "SELECT fullName, email, uaeNational, membershipType, nationality, emirates_id_number, phone_number FROM members";

}


// Prepare a SQL statement with placeholders
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if the result contains any rows
if (count($result)  > 0) {
    // Create a new PDF document using FPDF
    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->Image('../../assets/images/Untitled.png', 10, 10, 50); // Adjust the path and size as needed (x=10, y=10, width=30)

    // Move down to make space for title
    $pdf->Ln(20); // Line break for spacing after the logo
    // Set font
    $pdf->SetFont('Arial', 'B', 8);

    // Add title
    $pdf->Cell(190, 10, 'Members List', 1, 1, 'C');

    // Add table headers
    $pdf->Cell(30, 10, 'Full Name', 1);
    $pdf->Cell(40, 10, 'Email', 1);
    $pdf->Cell(20, 10, 'UAE Na', 1);
    $pdf->Cell(40, 10, 'Membership Type', 1);
    $pdf->Cell(30, 10, 'Nationality', 1);
    $pdf->Cell(30, 10, 'Emirates ID', 1);
    $pdf->Ln(); // Line break

    // Set font for table content
    $pdf->SetFont('Arial', '', 12);

    // Fetch data and populate the table
    foreach ( $result as $row):
        $pdf->Cell(30, 10, $row['fullName'], 1);
        $pdf->Cell(40, 10, $row['email'], 1);
        $pdf->Cell(20, 10, ($row['uaeNational'] ? 'Yes' : 'No'), 1);
        $pdf->Cell(40, 10, $row['membershipType'], 1);
        $pdf->Cell(30, 10, $row['nationality'], 1);
        $pdf->Cell(30, 10, $row['emirates_id_number'], 1);
        $pdf->Ln(); // Line break
    endforeach;
    // Output the PDF to the browser
    $pdf->Output('D', 'members_list.pdf'); // 'D' forces the download of the file
} else {
    echo "No records found.";
}

// Close the database connection

?>