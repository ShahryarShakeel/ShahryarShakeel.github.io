<?php
  $receiving_email_address = 'shahryar.softwaredigital@gmail.com';//reciepient email address

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  
  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name']; 
  $contact->from_email = $_POST['email']; 
  $contact->subject = $_POST['subject'];

  $contact->reply_to = $_POST['email'];

  // SMTP configuration
  $contact->smtp = array(
    'host' => 'smtp.gmail.com', //smtp.hostinger.com
    'username' => 'shahryar.softwaredigital@gmail.com',//info@iqtechsolutions.co.uk
    'password' => '',
    'port' => '587',//465
    'encryption' => 'tls' // ssl
  );

  // Add message details
  $contact->add_message( $_POST['name'], 'From');
  $contact->add_message( $_POST['email'], 'Email');
  $contact->add_message( $_POST['message'], 'Message', 10);

  echo $contact->send();
?>

