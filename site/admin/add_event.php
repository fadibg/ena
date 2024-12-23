<?php
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];
    $end_event = $_POST['end_event'];
    $created_by = $_POST['created_by'];
    $location = $_POST['location'];
    $url_location = $_POST['url_location'];

    // Handle file upload for image_url
    if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = './site/uploads/'; // Directory where images will be stored
        $originalFileName = basename($_FILES['image_url']['name']);
        $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);

        // Generate a unique file name
        $uniqueFileName = uniqid('event_', true) . '.' . $fileExtension;
        $targetFilePath = $uploadDir . $uniqueFileName;

        // Ensure the directory exists
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['image_url']['tmp_name'], $targetFilePath)) {
            $image_url = $targetFilePath; // Store the path for database insertion
        } else {
            die('Error: Failed to upload the image.');
        }
    } else {
        $image_url = null; // Handle case where no image is uploaded
    }

    // Insert data into the events table
    $stmt = $pdo->prepare("
        INSERT INTO events (title, description, event_date, created_at, end_event, image_url, location, url_location, created_by)
        VALUES (?, ?, ?, NOW(), ?, ?, ?, ?, ?)
    ");
    $stmt->execute([$title, $description, $event_date, $end_event, $image_url, $location, $url_location, $created_by]);

    // Query all member emails
    $stmt = $pdo->query("SELECT email FROM members"); // Adjust table name if needed
    $emails = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Prepare email content
    $subject = "New Event: $title";
    $message = "
    <html>
    <head>
        <title>New Event Notification</title>
    </head>
    <body>
        <h1>$title</h1>
        <p>$description</p>
        <p><strong>Event Date:</strong> $event_date</p>
        <p><strong>Location:</strong> $location</p>
        <p><a href='$url_location'>Click here for more details</a></p>
    </body>
    </html>
    ";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
    $headers .= "From: infoenauae@gmail.com" . "\r\n";
    // Send email to each member
    foreach ($emails as $email) {
        mail($email['email'], $subject, $message, $headers);
    }

    // Redirect to the control panel
    header("Location: control_panel.php");
    exit;
}
?>
