<?php
session_start();
require_once '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture user credentials
    $fullName = $_POST['full_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $uaeNational = $_POST['membership_type'] == 'active' ? 1 : 0;
    $membershipType = $_POST['membership_type'];

    // Capture basic information
    $title = $_POST['title'];
    $type = $_POST['type'];
    $gender = $_POST['gender'];
    $emirate = $_POST['emirate'];
    $po_box = $_POST['po_box'];

    // Capture community details
    $requested_society = $_POST['requested_society'];
    $professional_title = $_POST['professional_title'];
    $level_of_education = $_POST['level_of_education'];
    $license_name = $_POST['license_name'];
    $work_type = $_POST['work_type'];
    $nationality = $_POST['nationality'];

    // Capture contact details
    $emirates_id_number = $_POST['emirates_id_number'];
    $phone_number = $_POST['phone_number'];

    // Handle file uploads with unique names
    function generateUniqueFileName($file) {
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileName = pathinfo($file['name'], PATHINFO_FILENAME);
        return $fileName . '_' . time() . '.' . $fileExtension;
    }

    $photo = generateUniqueFileName($_FILES['photo']);
    $passportCopy = generateUniqueFileName($_FILES['passportCopy']);
    $uaeId = generateUniqueFileName($_FILES['uaeId']);
    $medicalLicense = isset($_FILES['medicalLicense']) && $_FILES['medicalLicense']['name'] ? generateUniqueFileName($_FILES['medicalLicense']) : null;
    $resume = generateUniqueFileName($_FILES['resume']);
    $qualifications = generateUniqueFileName($_FILES['qualifications']);

    // Move files to uploads directory
    move_uploaded_file($_FILES['photo']['tmp_name'], "../uploads/$photo");
    move_uploaded_file($_FILES['passportCopy']['tmp_name'], "../uploads/$passportCopy");
    move_uploaded_file($_FILES['uaeId']['tmp_name'], "../uploads/$uaeId");
    move_uploaded_file($_FILES['resume']['tmp_name'], "../uploads/$resume");
    move_uploaded_file($_FILES['qualifications']['tmp_name'], "../uploads/$qualifications");

    if ($medicalLicense) {
        move_uploaded_file($_FILES['medicalLicense']['tmp_name'], "../uploads/$medicalLicense");
    }
    function generateVerificationCode($length = 6) {
        return str_pad(random_int(0, pow(10, $length) - 1), $length, '0', STR_PAD_LEFT);
    }

    // Generate a new verification code
    $vari= generateVerificationCode();
    $to = $email; // Assuming the user's email is stored in the session
    $subject = "Your Verification Code";
    $message = "Your new verification code is: $vari";
    $headers = "From: noreply@example.com";

    // Send the email
    if (mail($to, $subject, $message, $headers)) {
        echo "A new verification code has been sent to your email.";
    } else {
        echo "Failed to resend the verification code. Please try again.";
    }
    $dataArray = [
        'fullName'=>$fullName,
        'email'=>$email,
        'password'=>$password,
        'uaeNational'=>$uaeNational,
        'membershipType'=>$membershipType,
        'title'=>$title,
        'type'=>$type,
        'gender'=>$gender,
        'emirate'=>$emirate,
        'po_box'=>$po_box,
        'requested_society'=>$requested_society,
        'professional_title'=>$professional_title,
        'level_of_education'=>$level_of_education,
        'license_name'=>$license_name,
        'work_type'=>$work_type,
        'nationality'=>$nationality,
        'emirates_id_number'=>$emirates_id_number,
        'phone_number'=>$phone_number,
        'photo'=>$photo,
        'passportCopy'=>$passportCopy,
        'uaeId'=>$uaeId,
        'medicalLicense'=>$medicalLicense,
        'resume'=>$resume,
        'qualifications'=>$qualifications,
        'v'=>$vari
    ];

    // Store the array in the session
    $_SESSION['user_data'] = $dataArray;
    // Insert into the database
       header("Location: varification.html");
}
?>
