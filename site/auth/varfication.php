<?php
require_once '../config/db.php';
$passthruo=$_SESSION['user_data'];
if($_POST['statuse']==$passthruo['v']){
$stmt = $pdo->prepare("INSERT INTO members
(fullName, email, password, uaeNational, membershipType, title, type, gender, emirate, po_box, requested_society, professional_title, level_of_education, license_name, work_type, nationality, emirates_id_number, phone_number, photo, passportCopy, uaeId, medicalLicense, resume, qualifications,registration_date)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,NOW())");

$stmt->execute([
    $passthruo['fullName'],
    $passthruo['email'],
   $passthruo['password'],
   $passthruo['uaeNational'],
    $passthruo['membershipType'],
    $passthruo['title'],
   $passthruo['type'],
   $passthruo['gender'],
   $passthruo['emirate'],
   $passthruo['po_box'],
   $passthruo['requested_society'],
    $passthruo['professional_title'],
   $passthruo['level_of_education'],
   $passthruo['license_name'],
   $passthruo['work_type'],
    $passthruo['nationality'],
   $passthruo['emirates_id_number'],
    $passthruo['phone_number'],
   $passthruo['photo'],
    $passthruo['passportCopy'],
    $passthruo['uaeId'],
   $passthruo['medicalLicense'],
    $passthruo['resume'],
   $passthruo['qualifications']
   ]);

echo json_encode(["message" => "Registration successful!"]);

header("Location: ../../login.html");
}else{


    // Save the new code in the session
    $passthruo['v'] = $newCode;

    // Send the new code to the user's email (example: replace this with actual email sending logic)
    $to = $passthruo['email']; // Assuming the user's email is stored in the session
    $subject = "Your Verification Code";
    $message = "Your new verification code is: $newCode";
    $headers = "From: noreply@example.com";

    // Send the email
    if (mail($to, $subject, $message, $headers)) {
        echo "A new verification code has been sent to your email.";
    } else {
        echo "Failed to resend the verification code. Please try again.";
    }
    header("Location: varfication.html");
}
?>