<?php
    $successMessage = "";
    $errorMessage = "";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitize input data
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);
        $message = htmlspecialchars($_POST['message']);

        // Validate input data
        if (!empty($name) && !empty($email) && !empty($phone) && !empty($message)) {
            // Prepare the email
            $to = "sales@metalium.in";
            $subject = "Contact Form Submission from $name";
            $headers = "From: $email" . "\r\n" .
                       "Reply-To: $email" . "\r\n" .
                       "Content-Type: text/html; charset=UTF-8";
            
            // Create the email body
            $emailBody = "<html><body>";
            $emailBody .= "<h2>Contact Form Submission</h2>";
            $emailBody .= "<p><strong>Name:</strong> $name</p>";
            $emailBody .= "<p><strong>Email:</strong> $email</p>";
            $emailBody .= "<p><strong>Phone:</strong> $phone</p>";
            $emailBody .= "<p><strong>Message:</strong></p>";
            $emailBody .= "<p>$message</p>";
            $emailBody .= "</body></html>";

            // Send the email
            if (mail($to, $subject, $emailBody, $headers)) {
                // Redirect to homepage after success
                header("Location: index.html");
                exit();
            } else {
                $errorMessage = "There was a problem sending your message. Please try again later.";
            }
        } else {
            $errorMessage = "Please fill in all fields.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission</title>
    <!-- Include your CSS and other resources here -->
</head>
<body>

    <?php if (!empty($successMessage)) { ?>
        <p><?php echo $successMessage; ?></p>
    <?php } ?>

    <?php if (!empty($errorMessage)) { ?>
        <p><?php echo $errorMessage; ?></p>
    <?php } ?>

</body>
</html>
