<?php
$receiving_email_address = 'info@iqtechsolutions.co.uk'; // Recipient email address

if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
    include($php_email_form);
} else {
    die('Unable to load the "PHP Email Form" Library!');
}

$contact = new PHP_Email_Form;
$contact->ajax = true; // Set AJAX to true

$contact->to = $receiving_email_address;
$contact->from_name = $_POST['name'];
$contact->from_email = $_POST['email'];
$contact->subject = !empty($_POST['subject']) ? $_POST['subject'] : 'Contact Form Submission'; // Default subject if not provided
$contact->reply_to = $_POST['email'];

// Add message details
$contact->add_message($_POST['name'], 'From');
$contact->add_message($_POST['email'], 'Email');
$contact->add_message($_POST['message'], 'Message', 10);

// Compose email
$message = "{$_POST['message']}"; // Use only the message content provided by the user

// Set email headers
$headers = 'From: ' . $contact->from_email . "\r\n" . 
           'Reply-To: ' . $contact->reply_to . "\r\n";

// Send the email and capture the result
$email_sent = mail($receiving_email_address, $contact->subject, $message, $headers);

// Return appropriate response
if ($email_sent) {
    echo 'OK'; // Return 'OK' for success
} else {
    echo 'Email sending failed.'; // Return error message for failure
}
?>
